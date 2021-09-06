<?php

namespace App\Service;

use App\Contract\PlateauInMemoryRepositoryInterface;
use App\Entity\Plateau;

class PlateauInMemoryService implements PlateauInMemoryRepositoryInterface
{
    public static Plateau $data;

    public function save(Plateau $plateau)
    {
        self::$data = $plateau;
    }

    public function getById($id) : ?Plateau
    {
        $plateau = self::$data;

        if($plateau->getId() !== $id){
            return null;
        }
        return $plateau;

    }
}
