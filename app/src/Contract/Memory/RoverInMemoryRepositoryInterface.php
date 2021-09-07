<?php

namespace App\Contract\Memory;

use App\Entity\Rover;

interface RoverInMemoryRepositoryInterface
{
    public function save(Rover $rover);

    public function getByRoverId($id);
}
