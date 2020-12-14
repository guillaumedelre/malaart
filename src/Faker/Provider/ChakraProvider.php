<?php

namespace App\Faker\Provider;

use App\Domain\Chakra;
use Faker\Provider\Base;

class ChakraProvider extends Base
{
    public function chakraName()
    {
        return Chakra::ALL[\random_int(0, \count(Chakra::ALL) - 1)];
    }
}
