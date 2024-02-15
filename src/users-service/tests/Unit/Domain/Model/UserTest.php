<?php

namespace App\Tests\Unit\Domain\Model;

use App\Domain\Model\User;
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
    private ?int $id = 1;
    private string $email = 'test@example.com';
    private string $firstName = 'John';
    private string $lastName = 'Doe';

    public function testUserCreation(): void
    {
        $user = new User($this->id, $this->email, $this->firstName, $this->lastName);

        $this->assertInstanceOf(User::class, $user);
        $this->assertEquals($this->id, $user->getId());
        $this->assertEquals($this->email, $user->getEmail());
        $this->assertEquals($this->firstName, $user->getFirstName());
        $this->assertEquals($this->lastName, $user->getLastName());
    }

    public function testEmailCanBeChanged(): void
    {
        $user = new User($this->id, $this->email, $this->firstName, $this->lastName);
        $newEmail = 'new@example.com';

        $user->setEmail($newEmail);

        $this->assertEquals($newEmail, $user->getEmail());
    }

    public function testFirstNameCanBeChanged(): void
    {
        $user = new User($this->id, $this->email, $this->firstName, $this->lastName);
        $newFirstName = 'Jane';

        $user->setFirstName($newFirstName);

        $this->assertEquals($newFirstName, $user->getFirstName());
    }

    public function testLastNameCanBeChanged(): void
    {
        $user = new User($this->id, $this->email, $this->firstName, $this->lastName);
        $newLastName = 'Smith';

        $user->setLastName($newLastName);

        $this->assertEquals($newLastName, $user->getLastName());
    }
}
