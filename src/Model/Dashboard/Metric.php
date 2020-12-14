<?php

namespace App\Model\Dashboard;

class Metric
{
    use DisplayContextTrait;

    /** @var mixed */
    protected $value;

    /**
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param mixed $value
     *
     * @return Metric
     */
    public function setValue($value)
    {
        $this->value = $value;
        return $this;
    }
}
