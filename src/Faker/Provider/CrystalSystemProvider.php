<?php

namespace App\Faker\Provider;

use App\Domain\CrystalSystem;
use Faker\Provider\Base;

class CrystalSystemProvider extends Base
{
    public function crystalSystemName()
    {
        return CrystalSystem::ALL[\random_int(0, \count(CrystalSystem::ALL) - 1)];
    }
}
