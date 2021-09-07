<?php

namespace App\Helper\Direction;

use App\Contract\Direction;
use App\Entity\Rover;
use App\Entity\RoverCoordinates;

class East implements Direction
{
    public function turnRight(): Direction
    {
        return new South();
    }

    public function turnLeft(): Direction
    {
        return new North();
    }

    public function moveForward(Rover $rover, RoverCoordinates $roverCoordinate): void
    {
        $roverCoordinate->setCoordinateX($roverCoordinate->getCoordinateX() + 1);
        $roverCoordinate->setCoordinateY($roverCoordinate->getCoordinateY());
        $rover->setRoverCoordinates($roverCoordinate);
    }

    public function toString(): string
    {
       return DirectionTypes::EAST;
    }
}
