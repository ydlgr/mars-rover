<?php

namespace App\Contract;

use App\Entity\Plateau;

interface PlateauInMemoryRepositoryInterface
{
    public function save(Plateau $plateau);

    public function getByPlateauId($id);
}
