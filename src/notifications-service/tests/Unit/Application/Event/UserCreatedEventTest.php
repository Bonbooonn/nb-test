<?php

namespace App\Tests\Unit\Application\Event;

use App\Application\Event\UserCreatedEvent;
use PHPUnit\Framework\TestCase;

class UserCreatedEventTest extends TestCase
{
    public function testGetData()
    {
        $data = [
            'id' => 1,
            'firstName' => 'John',
            'lastName' => 'Doe',
            'email' => 'doe@example.com'
        ];
        
        $event = new UserCreatedEvent($data);

        $this->assertSame($data, $event->getData());
    }
}
