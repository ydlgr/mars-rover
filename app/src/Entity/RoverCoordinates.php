<?php

namespace App\Entity;

class RoverCoordinates
{
    public function __construct(
        private int $coordinateX,
        private int $coordinateY)
    {
    }

    /**
     * @return int
     */
    public function getCoordinateX(): int
    {
        return $this->coordinateX;
    }

    /**
     * @param int $coordinateX
     */
    public function setCoordinateX(int $coordinateX): void
    {
        $this->coordinateX = $coordinateX;
    }

    /**
     * @return int
     */
    public function getCoordinateY(): int
    {
        return $this->coordinateY;
    }

    /**
     * @param int $coordinateY
     */
    public function setCoordinateY(int $coordinateY): void
    {
        $this->coordinateY = $coordinateY;
    }
}
