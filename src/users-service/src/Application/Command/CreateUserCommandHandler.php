<?php

namespace App\Application\Command;

use App\Application\Event\UserCreatedEvent;
use App\Application\Validators\CreateUserValidator;
use App\Domain\Repository\UserRepository;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;
use Symfony\Component\Messenger\MessageBusInterface;

#[AsMessageHandler]
class CreateUserCommandHandler
{
    public function __construct(
        private readonly UserRepository $userRepository,
        private readonly MessageBusInterface $messageBus,
        private readonly CreateUserValidator $validator
    )
    {
        
    }

    public function __invoke(CreateUserCommand $command): array
    {
        $params = $command->getParams();

        $this->validator->validate($params);

        $user = $this->userRepository->createUser($params);

        $event = new UserCreatedEvent($user->toArray());

        $this->messageBus->dispatch($event);

        return ['data' => 'User Created Successfully!'];
    }
}