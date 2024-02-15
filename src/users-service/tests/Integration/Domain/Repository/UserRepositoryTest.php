<?php

namespace App\Tests\Integration\Domain\Repository;

use App\Domain\Model\User;
use App\Domain\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class UserRepositoryTest extends KernelTestCase
{
    private UserRepository $userRepository;

    protected function setUp(): void
    {
        self::bootKernel();

        $this->userRepository = self::getContainer()->get(UserRepository::class);
    }

    public function testFindAll(): void
    {
        $users = $this->userRepository->findAll();

        $this->assertIsArray($users);
    }

    public function testCreateUser(): void
    {
        $user = $this->userRepository->createUser([
            'firstName' => 'John',
            'lastName' => 'Doe',
            'email' => 'doe@example.com'
        ]);

        $this->assertInstanceOf(User::class, $user);
        $this->assertEquals('John', $user->getFirstName());
        $this->assertEquals('Doe', $user->getLastName());
        $this->assertEquals('doe@example.com', $user->getEmail());
    }
}
