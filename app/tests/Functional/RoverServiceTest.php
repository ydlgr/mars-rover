<?php

namespace App\Tests\Functional;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class RoverServiceTest extends WebTestCase
{
    protected $client;

    protected function setUp(): void
    {
        parent::setUp();

        $this->client = static::createClient();
    }

    public function test_create_rover_with_given_parameters_x_y_direction_validation_error_invalid_x_type(): void
    {
        $this->client->request(
            'POST',
            '/rover',
            [
                'coordinate_x' => 'XXX',
                'coordinate_y' => 1,
                'direction' => "N",
                'plateau_id' => 1
            ]);

        $this->assertEquals(Response::HTTP_BAD_REQUEST, $this->client->getResponse()->getStatusCode());

        $expectedJson = '{"status": 400,"message": "Exception Error!","error": ["[coordinate_x] The value \u0022XXX\u0022 is not a valid numeric."]}';
        $this->assertJsonStringEqualsJsonString($expectedJson, $this->client->getResponse()->getContent());
    }

    public function test_create_rover_with_given_parameters_x_y_direction_validation_error_null_direction_Type(): void
    {
        $this->client->request(
            'POST',
            '/rover',
            [
                'coordinate_x' => 3,
                'coordinate_y' => 7,
                'direction' => "",
                'plateau_id' => 1
            ]);

        $this->assertEquals(Response::HTTP_BAD_REQUEST, $this->client->getResponse()->getStatusCode());

        $expectedJson = '{"status":400,"message":"Exception Error!","error":["[direction] This value should not be blank."]}';
        $this->assertJsonStringEqualsJsonString($expectedJson, $this->client->getResponse()->getContent());
    }

    public function test_create_rover_with_given_parameters_x_y_direction_validation_error_invalid_direction_value(): void
    {
        $this->client->request(
            'POST',
            '/rover',
            [
                'coordinate_x' => 3,
                'coordinate_y' => 4,
                'direction' => "A",
                'plateau_id' => 1
            ]);

        $this->assertEquals(Response::HTTP_BAD_REQUEST, $this->client->getResponse()->getStatusCode());

        $expectedJson = '{"status":400,"message":"Exception Error!","error":["[direction] The value you selected is not a valid choice."]}';
        $this->assertJsonStringEqualsJsonString($expectedJson, $this->client->getResponse()->getContent());
    }

    public function test_create_rover_with_given_parameters_x_y_direction(): void
    {
        $this->client->request(
            'POST',
            '/rover',
            [
                'coordinate_x' => 3,
                'coordinate_y' => 3,
                'direction' => "N",
                'plateau_id' => 1
            ]);


        $this->assertEquals(Response::HTTP_CREATED, $this->client->getResponse()->getStatusCode());

        $expectedJson = '{"status":201,"message":"Successful","data":{"rover":{"id":1,"plateau":{"id":1,"width":10,"height":10},"roverCoordinates":{"coordinateX":3,"coordinateY":3},"direction":[]}}}';
        $this->assertJsonStringEqualsJsonString($expectedJson, $this->client->getResponse()->getContent());

    }

    public function test_show_rover_with_given_id(): void
    {
        $this->client->request(
            'GET',
            '/rover/1'
        );

        $this->assertEquals(Response::HTTP_OK, $this->client->getResponse()->getStatusCode());

        $expectedJson = '{"status":200,"message":"Successful","data":{"rover":{"id":1,"plateau":{"id":1,"width":10,"height":10},"roverCoordinates":{"coordinateX":3,"coordinateY":3},"direction":[]}}}';
        $this->assertJsonStringEqualsJsonString($expectedJson, $this->client->getResponse()->getContent());
    }
}
