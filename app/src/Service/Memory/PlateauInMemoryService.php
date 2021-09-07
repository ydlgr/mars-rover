<?php

namespace App\Service\Memory;

use App\Contract\Memory\PlateauInMemoryRepositoryInterface;
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
