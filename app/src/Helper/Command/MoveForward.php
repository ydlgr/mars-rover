<?php

namespace App\Helper\Command;

use App\Contract\Command;
use App\Entity\Rover;

class MoveForward implements Command
{
    public function execute(Rover $rover): void
    {
        $rover->moveForward();
    }
}
