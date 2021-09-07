<?php

namespace App\Entity;

use App\Contract\Direction;
use App\Contract\Command;
use App\Helper\Direction\DirectionTypes;

class Rover
{
    private int $id;
    private Plateau $plateau;
    private RoverCoordinates $roverCoordinates;
    private Direction|string $direction;

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

    /**
     * @return Direction|string
     */
    public function getDirection(): string|Direction
    {
        return $this->direction;
    }

    /**
     * @param Direction|string $direction
     */
    public function setDirection(string|Direction $direction): void
    {
        $this->direction = $direction;
    }


    public function turnRight(): void
    {
        $this->setDirection($this->getDirection()->turnRight());
    }

    public function turnLeft(): void
    {
        $this->setDirection($this->getDirection()->turnLeft());
    }

    public function moveForward(): void
    {
        $this->getDirection()->moveForward($this, $this->getRoverCoordinates());
    }

    public function executeRover(Command $command)
    {
        $command->execute($this);
    }

    public function directionConvertor(Direction $direction): string
    {
        return DirectionTypes::ConvertDirectionToString($direction);
    }

}
