<?php

namespace App\Service;

use App\Contract\RoverInMemoryRepositoryInterface;
use App\Entity\Rover;

class RoverInMemoryService implements RoverInMemoryRepositoryInterface
{
    public static ?Rover $data = null;

    public function save(Rover $rover): void
    {
        self::$data = $rover;
    }

    public function getByRoverId($id): ?Rover
    {
        return self::$data;
    }
}
