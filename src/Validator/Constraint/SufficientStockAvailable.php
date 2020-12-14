<?php

namespace App\Validator\Constraint;

use App\Validator\SufficientStockAvailableValidator;
use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class SufficientStockAvailable extends Constraint
{
    public $message = 'Il n\'y a pas assez de {{ material }} disponible: {{ stock }} unités restantes.';

    public function validatedBy()
    {
        return SufficientStockAvailableValidator::class;
    }

    public function getTargets()
    {
        return self::CLASS_CONSTRAINT;
    }
}
