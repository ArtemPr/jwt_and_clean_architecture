<?php

namespace Tests\Functional;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class JWTAuthTest extends WebTestCase
{
    public function testGetPages()
    {
        $client = $this->createAuthenticatedClient();
        $client->request('GET', '/api');
        $this->assertSame(200, $client->getResponse()->getStatusCode());
    }

    protected function createAuthenticatedClient($username = 'test', $password = 'test')
    {
        $client = static::createClient();

        $client->request(
            'POST',
            '/api/login_check',
            [],
            [],
            ['CONTENT_TYPE' => 'application/json'],
            json_encode([
                'username' => $username,
                'password' => $password,
            ])
        );

        $data = json_decode($client->getResponse()->getContent(), true);

        $client->setServerParameter('HTTP_Authorization', sprintf('Bearer %s', $data['token']));

        return $client;
    }
}