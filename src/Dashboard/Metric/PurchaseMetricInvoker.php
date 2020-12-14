<?php

namespace App\Dashboard\Metric;

use ApiPlatform\Core\Metadata\Resource\Factory\ResourceMetadataFactoryInterface;
use App\Entity\Purchase;
use App\Repository\PurchaseRepository;

class PurchaseMetricInvoker extends AbstractMetric
{
    public function __construct(PurchaseRepository $repository, ResourceMetadataFactoryInterface $resourceMetadataFactory)
    {
        parent::__construct($repository, $resourceMetadataFactory);
    }

    public function __invoke(): string
    {
        $totalPrice = .0;

        array_map(function (Purchase $purchase) use (&$totalPrice) {
            $totalPrice += $purchase->getMaterial()->getPrice() * $purchase->getUnits();
        }, $this->getRepository()->findAll());

        return number_format($totalPrice, 2, ',', ' ').' €';
    }

}
