<?php

namespace App\Entity;

use App\Contract\Direction;
use App\Contract\Command;

class Rover
{
    private int $id;
    private Plateau $plateau;
    private RoverCoordinates $roverCoordinates;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }/**
 * @param int $id
 */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return Plateau
     */
    public function getPlateau(): Plateau
    {
        return $this->plateau;
    }

    /**
     * @param Plateau $plateau
     */
    public function setPlateau(Plateau $plateau): void
    {
        $this->plateau = $plateau;
    }

    /**
     * @return RoverCoordinates
     */
    public function getRoverCoordinates(): RoverCoordinates
    {
        return $this->roverCoordinates;
    }

    /**
     * @param RoverCoordinates $roverCoordinates
     */
    public function setRoverCoordinates(RoverCoordinates $roverCoordinates): void
    {
        $this->roverCoordinates = $roverCoordinates;
    }

}
