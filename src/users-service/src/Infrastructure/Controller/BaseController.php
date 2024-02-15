<?php

namespace App\Infrastructure\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Messenger\Stamp\HandledStamp;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

abstract class BaseController extends AbstractController
{
    protected const COMMAND = '';

    abstract public function mapRequestToCommand(Request $request): array;

    public function __construct(protected readonly MessageBusInterface $messageBus)
    {
        
    }

    public function __invoke(Request $request): Response
    {
        $commandClass = static::COMMAND;

        if (!class_exists($commandClass)) {
            throw new \LogicException('Command not found.');
        }

        $params = $this->mapRequestToCommand($request);

        $command = new $commandClass($params);

        $envelope = $this->messageBus->dispatch($command);

        /** @var HandledStamp $handledStamp */
        $handledStamp = $envelope->last(HandledStamp::class);

        if (null === $handledStamp) {
            throw new \LogicException('No handler processed the message.');
        }
        
        return $this->json($handledStamp->getResult());
    }
}