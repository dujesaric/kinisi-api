<?php

declare(strict_types=1);

namespace App\Tests\Functional;

use Hautelook\AliceBundle\PhpUnit\RefreshDatabaseTrait;
use Symfony\Bundle\FrameworkBundle\Client;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\DomCrawler\Crawler;
use Symfony\Component\HttpFoundation\Response;

class UserTest extends WebTestCase
{
    use RefreshDatabaseTrait;

    /** @var Client */
    protected $client;

    /**
     * @test
     * Registers user
     */
    public function registerAUser(): void
    {
        $data = [
            'email'             => 'test@test.com',
            'firstName'         => "Testinho",
            'lastName'          => 'De Assis Moreira Gaucho',
            'gender'            => 'Male',
            'birthday'          => '1991-02-11',
            'plainPassword'     => 'test123',
            'repeatedPassword'  => 'test123'
        ];

        $response = $this->request('POST', '/users', $data);
        $jsonResponse = json_decode($response->getContent(), true);

        $this->assertEquals(201, $response->getStatusCode());
        $this->assertEquals('application/ld+json; charset=utf-8', $response->headers->get('Content-Type'));

        $this->assertArrayHasKey('email', $jsonResponse);
        $this->assertEquals('test@test.com', $jsonResponse['email']);
    }

    protected function setUp()
    {
        parent::setUp();
        $this->client = static::createClient();
    }

    protected function request(string $method, string $uri, $content = null, array $headers = []): Response
    {
        $server = [
            'CONTENT_TYPE'  => 'application/ld+json',
            'HTTP_ACCEPT'   => 'application/ld+json'
        ];

        foreach ($headers as $key => $value) {
            if (strtolower($key) === 'content-type') {
                $server['CONTENT_TYPE'] = $value;

                continue;
            }

            $server['HTTP_'.strtoupper(str_replace('-', '_', $key))] = $value;
        }

        if (is_array($content) && false !== preg_match('#^application/(?:.+\+)?json$#', $server['CONTENT_TYPE'])) {
            $content = json_encode($content);
        }

        $this->client->request($method, 'api'.$uri, [], [], $server, $content);
        return $this->client->getResponse();
    }
}