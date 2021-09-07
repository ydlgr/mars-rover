<?php

namespace App\Service;

use App\Contract\Memory\PlateauInMemoryRepositoryInterface;
use App\Entity\Plateau;
use Symfony\Component\HttpFoundation\Request;

class PlateauService
{
    private PlateauInMemoryRepositoryInterface $datastorePlateau;

    public function __construct(PlateauInMemoryRepositoryInterface $datastorePlateau)
    {
        $this->datastorePlateau = $datastorePlateau;
    }

    /**
     * @param Request $request
     * @return Plateau
     */
    public function savePlateau(Request $request) : Plateau
    {
        $plateau = new Plateau();

        $plateau->setId(1);
        $plateau->setWidth($request->get('width'));
        $plateau->setHeight($request->get('height'));

        $this->datastorePlateau->save($plateau);

        return $plateau;
    }

    /**
     * @param int $id
     * @return array
     */
    public function getPlateauById(int $id) : ?Plateau
    {
        return $this->datastorePlateau->getByPlateauId($id);
    }
}
