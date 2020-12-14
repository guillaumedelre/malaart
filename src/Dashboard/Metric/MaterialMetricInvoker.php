<?php

namespace App\Dashboard\Metric;

use ApiPlatform\Core\Metadata\Resource\Factory\ResourceMetadataFactoryInterface;
use App\Repository\MaterialRepository;

class MaterialMetricInvoker extends AbstractMetric
{
    public function __construct(MaterialRepository $repository, ResourceMetadataFactoryInterface $resourceMetadataFactory)
    {
        parent::__construct($repository, $resourceMetadataFactory);
    }

    public function __invoke(): int
    {
        return count($this->getRepository()->findAll());
    }

}
