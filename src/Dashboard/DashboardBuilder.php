<?php

namespace App\Dashboard;

use App\Dashboard\Metric\MetricInvoker;
use App\Entity\Material;
use App\Model\Dashboard\Metric;
use App\Model\Dashboard\Stock;
use App\Model\Dashboard\View;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Serializer\SerializerAwareInterface;
use Symfony\Component\Serializer\SerializerAwareTrait;

class DashboardBuilder implements SerializerAwareInterface
{
    use SerializerAwareTrait;

    private ManagerRegistry $managerRegistry;

    /** @var MetricInvoker[] */
    private array $metricInvokers;

    public function __construct(ManagerRegistry $managerRegistry, iterable $metricInvokers)
    {
        $this->managerRegistry = $managerRegistry;
        $this->metricInvokers = iterator_to_array($metricInvokers);
    }

    public function getView(): View
    {
        $metrics = [];
        array_map(
            function (MetricInvoker $invoker) use (&$metrics) {
                $metrics[] = (new Metric())
                    ->setTitle("dashboard.metric.value.{$invoker->getResourceKey()}.title")
                    ->setSubTitle("dashboard.metric.value.{$invoker->getResourceKey()}.sub_title")
                    ->setIcon("dashboard.metric.value.{$invoker->getResourceKey()}.icon")
                    ->setValue($invoker())
                ;
            }, $this->metricInvokers
        );

        $stock = (new Stock())
            ->setWarnings($this->managerRegistry->getRepository(Material::class)->findByThreshold())
            ->setJsonData($this->serializer->serialize($this->managerRegistry->getRepository(Material::class)->findBy([], ['label' => 'ASC']), 'json', ['json_encode_options' => JSON_PRETTY_PRINT]))
        ;

        return (new View())->setMetrics($metrics)->setStock($stock);
    }
}
