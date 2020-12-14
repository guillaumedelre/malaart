<?php

namespace App\Dashboard\Metric;

use ApiPlatform\Core\Metadata\Resource\Factory\ResourceMetadataFactoryInterface;
use App\Repository\StoneRepository;

class StoneMetricInvoker extends AbstractMetric
{
    public function __construct(StoneRepository $repository, ResourceMetadataFactoryInterface $resourceMetadataFactory)
    {
        parent::__construct($repository, $resourceMetadataFactory);
    }

    public function __invoke(): int
    {
        return count($this->getRepository()->findAll());
    }

}
