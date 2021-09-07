<?php

namespace App\Tests\Functional;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class MoveRoverServiceTest extends WebTestCase
{
    protected $client;

    protected function setUp(): void
    {
        parent::setUp();

        $this->client = static::createClient();
    }

    public function test_move_rover_command(): void
    {
        $this->client->request(
            'POST',
            '/move',
            [
                'rover_id' => 1,
                'commands' => 'LMRMMLRMR'
            ]);

        $this->assertEquals(Response::HTTP_OK, $this->client->getResponse()->getStatusCode());

        $expectedJson = '{"status":200,"message":"Successful","data":{"rover":{"id":1,"plateau":{"id":1,"width":10,"height":10},"roverCoordinates":{"coordinateX":2,"coordinateY":6},"direction":"E"}}}';
        $this->assertJsonStringEqualsJsonString($expectedJson, $this->client->getResponse()->getContent());
        }
}
