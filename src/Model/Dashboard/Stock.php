<?php

namespace App\Model\Dashboard;

use App\Entity\Material;

class Stock
{
    /** @var Material[] */
    protected array $warnings;

    protected string $jsonData;

    /**
     * @return Material[]
     */
    public function getWarnings(): array
    {
        return $this->warnings;
    }

    /**
     * @param Material[] $warnings
     *
     * @return Stock
     */
    public function setWarnings(array $warnings): Stock
    {
        $this->warnings = $warnings;
        return $this;
    }

    /**
     * @return string
     */
    public function getJsonData(): string
    {
        return $this->jsonData;
    }

    /**
     * @param string $jsonData
     *
     * @return Stock
     */
    public function setJsonData(string $jsonData): Stock
    {
        $this->jsonData = $jsonData;
        return $this;
    }

}
