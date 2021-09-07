<?php

namespace App\Helper\Direction;

use App\Contract\Direction;
use App\Entity\Rover;
use App\Entity\RoverCoordinates;

class South implements Direction
{
    public function turnRight(): Direction
    {
        return new West();
    }

    public function turnLeft(): Direction
    {
        return new East();
    }

    public function moveForward(Rover $rover, RoverCoordinates $roverCoordinate): void
    {
        $roverCoordinate->setCoordinateY($roverCoordinate->getCoordinateY() - 1);
        $roverCoordinate->setCoordinateX($roverCoordinate->getCoordinateX());
        $rover->setRoverCoordinates($roverCoordinate);
    }

    public function toString(): string
    {
        return DirectionTypes::SOUTH;
    }
}
