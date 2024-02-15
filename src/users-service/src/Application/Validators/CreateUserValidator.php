<?php

namespace App\Application\Validators;

use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Component\Validator\Exception\ValidationFailedException;

class CreateUserValidator
{
    public function __construct(private ValidatorInterface $validator)
    {
        
    }

    public function validate(array $params): void
    {
        $constraints = new Assert\Collection([
            'email' => [
                new Assert\Email(),
                new Assert\NotBlank(),
            ],
            'firstName' => [
                new Assert\Length(['min' => 3]),
                new Assert\NotBlank(),
            ],
            'lastName' => [
                new Assert\Length(['min' => 3]),
                new Assert\NotBlank(),
            ],
        ]);

        $violations = $this->validator->validate($params, $constraints);

        if (count($violations) > 0) {
            throw new ValidationFailedException("Validation failed!", $violations);
        }
    }

}