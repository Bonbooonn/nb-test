<?php

namespace App\Tests\Unit\Application\Validators;

use App\Application\Validators\CreateUserValidator;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Validator\Exception\ValidationFailedException;
use Symfony\Component\Validator\Validation;

class CreateUserValidatorTest extends TestCase
{
    private CreateUserValidator $validator;

    protected function setUp(): void
    {
        $validatorInterface = Validation::createValidator();
        $this->validator = new CreateUserValidator($validatorInterface);
    }

    public function testValidateWithValidParams(): void
    {
        $params = [
            'email' => 'example@email.com',
            'firstName' => 'John',
            'lastName' => 'Doe',
        ];

        $this->validator->validate($params);
        $this->expectNotToPerformAssertions();
    }

    public function testValidateInvalidEmail(): void
    {
        $params = [
            'email' => 'invalid-email',
            'firstName' => 'John',
            'lastName' => 'Doe',
        ];

        $this->expectException(ValidationFailedException::class);
        $this->validator->validate($params);
    }

    #[DataProvider('nullValuesProvider')]
    public function testValidateNullValues($email, $firstName, $lastName): void
    {
        $params = [
            'email' => $email,
            'firstName' => $firstName,
            'lastName' => $lastName,
        ];

        $this->expectException(ValidationFailedException::class);
        $this->validator->validate($params);
    }

    public static function nullValuesProvider(): array
    {
        return [
            'null_email' => [
                'email' => null,
                'firstName' => 'John',
                'lastName' => 'Doe',
            ],
            'null_firstName' => [
                'email' => 'example@email.com',
                'firstName' => null,
                'lastName' => 'Doe',
            ],
            'null_lastName' => [
                'email' => 'example@email.com',
                'firstName' => 'John',
                'lastName' => null,
            ],
        ];
    }
}
