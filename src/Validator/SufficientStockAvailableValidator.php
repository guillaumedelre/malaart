<?php

namespace App\Validator;

use App\Entity\Component;
use App\Validator\Constraint\SufficientStockAvailable;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;

class SufficientStockAvailableValidator extends ConstraintValidator
{
    /**
     * @param Component  $value
     * @param Constraint $constraint
     */
    public function validate($value, Constraint $constraint)
    {
        if (!$constraint instanceof SufficientStockAvailable) {
            throw new UnexpectedTypeException($constraint, SufficientStockAvailable::class);
        }

        // custom constraints should ignore null and empty values to allow
        // other constraints (NotBlank, NotNull, etc.) to take care of that
        if (null === $value || '' === $value) {
            return;
        }

        $this->context->buildViolation($constraint->message)
                      ->setParameter('{{ material }}', $value->getMaterial()->__toString())
                      ->setParameter('{{ stock }}', $value->getMaterial()->getUnits())
                      ->addViolation();
    }

}
