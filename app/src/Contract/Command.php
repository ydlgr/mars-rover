<?php

namespace App\Contract;

use App\Entity\Rover;

interface Command
{
    public function execute(Rover $rover): void;
}
