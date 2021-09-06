<?php

namespace App\Service;

use App\Contract\RoverInMemoryRepositoryInterface;
use App\Entity\Plateau;
use App\Entity\Rover;
use App\Entity\RoverCoordinates;
use Symfony\Component\HttpFoundation\Request;

class RoverService
{
    private RoverInMemoryRepositoryInterface $datastoreRover;
    private PlateauService $plateauService;

    public function __construct(
        RoverInMemoryRepositoryInterface $datastoreRover,
        PlateauService $plateauService)
    {
        $this->datastoreRover = $datastoreRover;
        $this->plateauService = $plateauService;
    }

    /**
     * @param Request $request
     * @return Rover
     */
    public function saveRover($request) : Rover
    {
        $rover = new Rover();
        $rover->setId(1);
        $rover->setRoverCoordinates(
            new RoverCoordinates(
                $request->get('coordinate_x'),
                $request->get('coordinate_y')
            )
        );

        /** @var Plateau $plateau */
        $plateau = $this->plateauService->getPlateauById($request->get('plateau_id'));

        $rover->setPlateau($plateau);

        $this->datastoreRover->save($rover);

        return $rover;
    }

    /**
     * @param int $roverId
     * @return Rover|null
     */
    public function getRoverById(int $roverId) : ?Rover
    {
        return $this->datastoreRover->getByRoverId($roverId);
    }
}
