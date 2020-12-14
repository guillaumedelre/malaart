<?php

namespace App\Model\Dashboard;

class View
{
    /** @var Metric[] */
    protected array $metrics;

    protected Stock $stock;

    /**
     * @return Metric[]
     */
    public function getMetrics(): array
    {
        return $this->metrics;
    }

    /**
     * @param Metric[] $metrics
     *
     * @return View
     */
    public function setMetrics(array $metrics): View
    {
        $this->metrics = $metrics;
        return $this;
    }

    /**
     * @return Stock
     */
    public function getStock(): Stock
    {
        return $this->stock;
    }

    /**
     * @param Stock $stock
     *
     * @return View
     */
    public function setStock(Stock $stock): View
    {
        $this->stock = $stock;
        return $this;
    }
}
