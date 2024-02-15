<?php

namespace App\Infrastructure\Controller\User;

use App\Application\Command\CreateUserCommand;
use App\Infrastructure\Controller\BaseController;
use Symfony\Component\HttpFoundation\Request;;

class CreateUserController extends BaseController
{
    protected const COMMAND = CreateUserCommand::class;

    public function mapRequestToCommand(Request $request): array
    {
        // Decode the JSON content of the request body
        $data = json_decode($request->getContent(), true);

        // It's a good practice to check if the decoding was successful
        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new \RuntimeException('Invalid JSON');
        }

        return [
            'email' => $data['email'] ?? null, // Using null coalesce operator to handle missing keys
            'firstName' => $data['firstName'] ?? null,
            'lastName' => $data['lastName'] ?? null,
        ];
    }
}