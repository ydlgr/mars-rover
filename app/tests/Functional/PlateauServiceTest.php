<?php

namespace App\Tests\Functional;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class PlateauServiceTest extends WebTestCase
{
    public function test_create_plateau_with_given_parameters_width_and_height(): void
    {
        $client = static::createClient();

        $client->request(
            'POST',
            '/plateau',
            [
                'width' => 10,
                'height' => 10
            ]);

        $this->assertEquals(201, $client->getResponse()->getStatusCode());
    }
}
