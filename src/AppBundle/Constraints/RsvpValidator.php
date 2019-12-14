<?php

namespace AppBundle\Constraints;

use AppBundle\Entity\Rsvp;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class RsvpValidator extends ConstraintValidator
{
    /**
     * @param Rsvp $value
     * @param \AppBundle\Constraints\Rsvp $constraint
     */
    public function validate($value, Constraint $constraint)
    {
        $aantalPersonen = $value->getPersonen()->count();
        $aantalVoorzien = $value->getAantalPersonen();

        if ($aantalPersonen !== $aantalVoorzien) {
            $this->context->buildViolation($constraint->message)
                ->atPath('aantalPersonen')
                ->addViolation()
            ;
        }
    }
}
