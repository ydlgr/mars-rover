<?php

namespace App\Helper\Command;

use App\Contract\Command;
use App\Entity\Rover;

class SpinRight implements Command
{
    public function execute(Rover $rover): void
    {
        $rover->turnRight();
    }
}
