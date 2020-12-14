<?php

namespace App\Dashboard\Metric;

use Doctrine\Persistence\ObjectRepository;

interface MetricInvoker
{
    public function getResourceKey(): string;

    public function getRepository(): ObjectRepository;

    public function __invoke();
}
