<?php

namespace App\Tests\Unit\Application\Event;

use App\Application\Event\UserCreatedEvent;
use PHPUnit\Framework\TestCase;

class UserCreatedEventTest extends TestCase
{
    public function testGettersReturnCorrectData(): void
    {
        $event = new UserCreatedEvent([
            'id' => 1,
            'firstName' => 'John',
            'lastName' => 'Doe',
            'email' => 'john@example.com'
        ]);

        $this->assertEquals(1, $event->getData()['id']);
        $this->assertEquals('John', $event->getData()['firstName']);
        $this->assertEquals('Doe', $event->getData()['lastName']);
        $this->assertEquals('john@example.com', $event->getData()['email']);
        $this->assertIsArray($event->getData());
    }
}
