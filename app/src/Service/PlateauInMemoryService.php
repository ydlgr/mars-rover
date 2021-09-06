<?php

namespace App\Service;

use App\Contract\PlateauInMemoryRepositoryInterface;
use App\Entity\Plateau;

class PlateauInMemoryService implements PlateauInMemoryRepositoryInterface
{
    public static ?Plateau $data = null;

    public function save(Plateau $plateau): void
    {
        self::$data = $plateau;
    }

    public function getByPlateauId($id): ?Plateau
    {
        return self::$data;
    }
}
