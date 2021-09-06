<?php

namespace App\Contract;

use App\Entity\Rover;

interface RoverInMemoryRepositoryInterface
{
    public function save(Rover $rover);

    public function getByRoverId($id);
}
