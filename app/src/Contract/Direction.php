<?php

namespace App\Contract;

use App\Entity\Rover;
use App\Entity\RoverCoordinates;

interface Direction
{
    public function turnRight() :Direction;

    public function turnLeft() : Direction;

    public function moveForward(Rover $rover, RoverCoordinates $roverCoordinate): void;

    public function toString(): string;

}
