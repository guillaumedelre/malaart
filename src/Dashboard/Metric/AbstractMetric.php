<?php

namespace App\Dashboard\Metric;

use ApiPlatform\Core\Metadata\Resource\Factory\ResourceMetadataFactoryInterface;
use Doctrine\Inflector\Inflector;
use Doctrine\Persistence\ObjectRepository;

abstract class AbstractMetric implements MetricInvoker
{
    private ObjectRepository $repository;
    private string $resourceKey;

    public function __construct(ObjectRepository $repository, ResourceMetadataFactoryInterface $resourceMetadataFactory)
    {
        $this->repository = $repository;
        $resourceMetadata = $resourceMetadataFactory->create($repository->getClassName());
        $this->resourceKey = Inflector::tableize($resourceMetadata->getShortName());
    }

    /**
     * @return string
     */
    public function getResourceKey(): string
    {
        return $this->resourceKey;
    }

    /**
     * @return ObjectRepository
     */
    public function getRepository(): ObjectRepository
    {
        return $this->repository;
    }

    abstract public function __invoke();
}
