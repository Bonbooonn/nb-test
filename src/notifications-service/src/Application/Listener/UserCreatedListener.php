<?php

namespace App\Application\Listener;

use App\Application\Event\UserCreatedEvent;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
class UserCreatedListener
{
    private string $projectDir;

    public function __construct(ParameterBagInterface $params)
    {
        $this->projectDir = $params->get('kernel.project_dir');
    }

    public function __invoke(UserCreatedEvent $event)
    {
        $logPath = $this->projectDir . '/var/log/user_creation_log.log';
        file_put_contents($logPath, json_encode($event->getData(), JSON_PRETTY_PRINT) . PHP_EOL, FILE_APPEND);
    }
}