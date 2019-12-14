<?php

namespace AppBundle\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class Rsvp extends Constraint
{
    public $message = 'Je aantal personen komt niet overeen met het aantal ingevulde namen.';

    public function validatedBy()
    {
        return \get_class($this).'Validator';
    }

    public function getTargets()
    {
        return self::CLASS_CONSTRAINT;
    }
}
