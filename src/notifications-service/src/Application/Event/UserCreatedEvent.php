<?php

namespace App\Application\Event;

class UserCreatedEvent
{
    public function __construct(private readonly array $data) 
    {

    }

    public function getData()
    {
        return $this->data;
    }
}