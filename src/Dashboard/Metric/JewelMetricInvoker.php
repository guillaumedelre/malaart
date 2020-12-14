<?php

namespace App\Dashboard\Metric;

use ApiPlatform\Core\Metadata\Resource\Factory\ResourceMetadataFactoryInterface;
use App\Entity\Component;
use App\Entity\Jewel;
use App\Repository\JewelRepository;

class JewelMetricInvoker extends AbstractMetric
{
    public function __construct(JewelRepository $repository, ResourceMetadataFactoryInterface $resourceMetadataFactory)
    {
        parent::__construct($repository, $resourceMetadataFactory);
    }

    public function __invoke(): string
    {
        $totalPrice = .0;

        array_map(function (Jewel $jewel) use (&$totalPrice) {
            array_map(function (Component $component) use (&$totalPrice) {
                $totalPrice += $component->getMaterial()->getPrice() * $component->getUnits();
            }, $jewel->getComponents()->toArray());
        }, $this->getRepository()->findAll());

        return number_format($totalPrice, 2, ',', ' ').' €';
    }
}
