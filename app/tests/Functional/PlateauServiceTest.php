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

    public function test_create_plateau_with_given_parameters_width_height_validation_error_invalid_width_type(): void
    {
        $this->client->request(
            'POST',
            '/plateau',
            [
                'width' => 'ABC',
                'height' => 10
            ]);

        $this->assertEquals(Response::HTTP_BAD_REQUEST, $this->client->getResponse()->getStatusCode());

        $expectedJson = '{"status":400,"message":"Exception Error!","error":["[width] The value \u0022ABC\u0022 is not a valid numeric."]}';
        $this->assertJsonStringEqualsJsonString($expectedJson, $this->client->getResponse()->getContent());
    }

    public function test_create_plateau_with_given_parameters_width_height_validation_error_null_height_type(): void
    {
        $this->client->request(
            'POST',
            '/plateau',
            [
                'width' => 10,
                'height' => ''
            ]);

        $this->assertEquals(Response::HTTP_BAD_REQUEST, $this->client->getResponse()->getStatusCode());

        $expectedJson = '{"status":400,"message":"Exception Error!","error":["[height] This value should not be blank."]}';
        $this->assertJsonStringEqualsJsonString($expectedJson, $this->client->getResponse()->getContent());
    }

    public function test_create_plateau_with_given_parameters_width_and_height(): void
    {
        $this->client->request(
            'POST',
            '/plateau',
            [
                'width' => 10,
                'height' => 10
            ]);

        $this->assertEquals(Response::HTTP_CREATED, $this->client->getResponse()->getStatusCode());

        $expectedJson = '{"status":201,"message":"Successful","data":{"plateau":{"id":1,"width":10,"height":10}}}';
        $this->assertJsonStringEqualsJsonString($expectedJson, $this->client->getResponse()->getContent());
    }

    public function test_show_plateau_with_given_id(): void
    {
        $this->client->request(
            'GET',
            '/plateau/1'
        );

        $this->assertEquals(Response::HTTP_OK, $this->client->getResponse()->getStatusCode());

        $expectedJson = '{"status":200,"message":"Successful","data":{"plateau":{"id":1,"width":10,"height":10}}}';
        $this->assertJsonStringEqualsJsonString($expectedJson, $this->client->getResponse()->getContent());
    }
}
