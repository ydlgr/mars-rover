<?php

namespace App\Helper\Direction;

use App\Contract\Direction;
use App\Entity\Rover;
use App\Entity\RoverCoordinates;

class North implements Direction
{
    public function turnRight(): Direction
    {
        return new East();
    }

    public function turnLeft(): Direction
    {
        return new West();
    }

    public function moveForward(Rover $rover, RoverCoordinates $roverCoordinate): void
    {
        $roverCoordinate->setCoordinateX($roverCoordinate->getCoordinateX());
        $roverCoordinate->setCoordinateY($roverCoordinate->getCoordinateY() + 1);
        $rover->setRoverCoordinates($roverCoordinate);
    }

    public function toString(): string
    {
        return DirectionTypes::NORTH;
    }
}
