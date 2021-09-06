<?php

namespace App\Service;

use App\Contract\PlateauInMemoryRepositoryInterface;
use App\Entity\Plateau;
use Symfony\Component\HttpFoundation\Request;

class PlateauService
{
    private PlateauInMemoryRepositoryInterface $datastore;

    public function __construct(PlateauInMemoryRepositoryInterface $datastore)
    {
        $this->datastore = $datastore;
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

        $this->datastore->save($plateau);

        return $plateau;
    }

    /**
     * @param int $id
     * @return array
     */
    public function getPlateauById(int $id) : ?Plateau
    {
        return $this->datastore->getById($id);
    }
}
