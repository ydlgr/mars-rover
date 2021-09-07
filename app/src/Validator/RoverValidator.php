<?php

namespace App\Validator;

use App\Exception\ValidationException;
use Symfony\Component\Validator\Constraints\Choice;
use Symfony\Component\Validator\Constraints\Collection;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Positive;
use Symfony\Component\Validator\Constraints\Type;

class RoverValidator extends AbstractValidator
{
    public function setConstraints()
    {
        $this->constraints = new Collection([
            'coordinate_x' => [
                new NotBlank(),
                new Positive(),
                new Type(['type' => 'numeric', 'message' => 'The value {{ value }} is not a valid {{ type }}.'])
            ],
            'coordinate_y' => [
                new NotBlank(),
                new Positive(),
                new Type(['type' => 'numeric', 'message' => 'The value {{ value }} is not a valid {{ type }}.'])
            ],
            'direction' => [
                new NotBlank(),
                new Choice(['N', 'E', 'W', 'S'])
            ],
            'plateau_id' => [
                new NotBlank(),
                new Type(['type' => 'numeric','message' => 'The value {{ value }} is not a valid {{ type }}.'])
            ],
        ]);
    }

    public function validate($value = null)
    {
        $result = $this->validator->validate($value, $this->constraints);
        foreach ($result as $fieldName => $violation)
        {
            throw new ValidationException($violation->getPropertyPath() . " " . $violation->getMessage());
        }
    }
}
