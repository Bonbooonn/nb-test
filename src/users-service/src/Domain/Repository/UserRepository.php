<?php

namespace App\Domain\Repository;

use App\Domain\Model\User;
use Doctrine\ORM\EntityManagerInterface;

class UserRepository
{
    public function __construct(
        private readonly EntityManagerInterface $entityManager
    ) { }

    public function findAll(): array
    {
        return $this->entityManager->getRepository(User::class)->findAll();
    }

    public function createUser($params): User
    {
        $user = new User(null, $params['email'], $params['firstName'], $params['lastName']);

        $this->entityManager->persist($user);
        $this->entityManager->flush();

        return $user;
    }
}