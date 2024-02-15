<?php

namespace App\Tests\Functional\Infrastructure\Controller\User;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class CreateUserControllerTest extends WebTestCase
{
    private $client;

    protected function setUp(): void
    {
        parent::setUp();

        $this->client = static::createClient();

        $kernel = static::bootKernel();

        $application = new \Symfony\Bundle\FrameworkBundle\Console\Application($kernel);
        $application->setAutoExit(false);

        $application->run(new \Symfony\Component\Console\Input\ArrayInput([
            'command' => 'doctrine:database:drop',
            '--force' => true,
            '--env' => 'test',
        ]));

        $application->run(new \Symfony\Component\Console\Input\ArrayInput([
            'command' => 'doctrine:database:create',
            '--env' => 'test',
        ]));

        $application->run(new \Symfony\Component\Console\Input\ArrayInput([
            'command' => 'doctrine:migrations:migrate',
            '--no-interaction' => true,
            '--env' => 'test',
        ]));
    }

    public function testCreateUser(): void
    {
        $data = [
            'email' => 'john@example.com',
            'firstName' => 'John',
            'lastName' => 'Doe',
        ];

        $this->client->request('POST', '/users', [], [], [], json_encode($data));

        $this->assertEquals(Response::HTTP_OK, $this->client->getResponse()->getStatusCode());
        $responseData = json_decode($this->client->getResponse()->getContent(), true);

        $this->assertArrayHasKey('data', $responseData);
    }
}
