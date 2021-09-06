<?php

namespace App\Tests\Functional;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class PlateauServiceTest extends WebTestCase
{
    protected $client;

    protected function setUp(): void
    {
        parent::setUp();

        $this->client = static::createClient();
    }

    public function test_create_plateau_with_given_parameters_width_and_height()
    {
        $this->client->request(
            'POST',
            '/plateau',
            [
                'width' => 10,
                'height' => 10
            ]);

        $this->assertEquals(
            Response::HTTP_CREATED,
            $this->client->getResponse()->getStatusCode()
        );
    }

    public function test_show_plateau_with_given_id(): void
    {
        $this->client->request(
            'GET',
            '/plateau/1'
        );

        $this->assertEquals(
            Response::HTTP_OK,
            $this->client->getResponse()->getStatusCode()
        );
    }
}
