<?php

namespace App\Service;

use App\Contract\Memory\PlateauInMemoryRepositoryInterface;
use App\Contract\Memory\RoverInMemoryRepositoryInterface;
use App\Entity\Rover;
use App\Helper\Command\MoveForward;
use App\Helper\Command\SpinLeft;
use App\Helper\Command\SpinRight;

class MoveRoverService
{
    const MOVE = "M";
    const TURN_RIGHT = "R";
    const TURN_LEFT = "L";

    private PlateauInMemoryRepositoryInterface $datastorePlateau;
    private RoverInMemoryRepositoryInterface $datastoreRover;

    public function __construct(
        PlateauInMemoryRepositoryInterface $datastorePlateau,
        RoverInMemoryRepositoryInterface $datastoreRover)
    {
        $this->datastorePlateau = $datastorePlateau;
        $this->datastoreRover = $datastoreRover;
    }

    /***
     * @param Rover $rover
     * @param string $commands
     */
    public function execute(Rover $rover, string $commands)
    {
        for ($i = 0; $i < strlen($commands); $i++) {
            $commandsArray = str_split($commands);

            if(in_array($commandsArray[$i], [self::MOVE, self::TURN_LEFT, self::TURN_RIGHT]))
            {
                switch ($commandsArray[$i]) {
                    case self::MOVE:
                        $rover->executeRover(new MoveForward());
                        break;
                    case self::TURN_RIGHT:
                        $rover->executeRover(new SpinRight());
                        break;
                    case self::TURN_LEFT:
                        $rover->executeRover(new SpinLeft());
                        break;
                }
            }
        }
    }
}
