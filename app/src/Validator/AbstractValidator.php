<?php

namespace App\Validator;

use Symfony\Component\Validator\Validation;

abstract class AbstractValidator
{
    protected $validator;
    protected $constraints;

    public function __construct()
    {
        $this->validator = Validation::createValidator();
        $this->setConstraints();
    }

    public abstract function setConstraints();

    public abstract function validate($value = null);
}
