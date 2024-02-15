<?php

namespace App\Tests\Integration\Application\Event;

use App\Application\Event\UserCreatedEvent;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class UserCreatedEventTest extends KernelTestCase
{
    protected function setUp(): void
    {
        self::bootKernel();
    }

    public function testUserCreateEvent(): void
    {
        $data = [
            'firstName' => 'John',
            'lastName' => 'Doe',
            'email' => 'john@example.com'
        ];

        $event = new UserCreatedEvent($data);

        $this->assertEquals($data, $event->getData());
    }
}
