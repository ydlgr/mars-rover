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

    public function test_create_rover_with_given_parameters_x_y_direction(): void
    {
        $this->client->request(
            'POST',
            '/rover',
            [
                'coordinate_x' => 1,
                'coordinate_y' => 2,
                'direction' => "S",
                'plateau_id' => 1
            ]);

        $this->assertEquals(
            Response::HTTP_CREATED,
            $this->client->getResponse()->getStatusCode()
        );
    }


    public function test_show_rover_with_given_id(): void
    {
        $this->client->request(
            'GET',
            '/rover/1'
        );

        $this->assertEquals(
            Response::HTTP_OK,
            $this->client->getResponse()->getStatusCode()
        );
    }

}
