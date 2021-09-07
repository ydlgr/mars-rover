<?php

namespace App\Controller\V1;

use App\Contract\Memory\RoverInMemoryRepositoryInterface;
use App\Entity\Rover;
use App\Exception\ValidationException;
use App\Service\MoveRoverService;
use App\Util\ConstantResponseMessages;
use App\Validator\MoveRoverValidator;
use Exception;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

class MoveRoverController extends BaseController
{
    private MoveRoverService $moveRoverService;
    private RoverInMemoryRepositoryInterface $datastoreRover;
    private SerializerInterface $serializer;
    private MoveRoverValidator $moveRoverValidator;

    public function __construct(
        RoverInMemoryRepositoryInterface $datastoreRover,
        MoveRoverService $moveRoverService,
        SerializerInterface $serializer,
        MoveRoverValidator $moveRoverValidator)
    {
        $this->moveRoverService = $moveRoverService;
        $this->datastoreRover = $datastoreRover;
        $this->serializer = $serializer;
        $this->moveRoverValidator = $moveRoverValidator;
    }

    /**
     * @Route("/move", name="move", methods={"POST"})
     *
     * @param Request $request
     * @return JsonResponse
     * @throws \Symfony\Component\Serializer\Exception\ExceptionInterface
     */
    public function Move(Request $request): JsonResponse
    {
        try {
            $this->moveRoverValidator->validate($request->request->all());

            $roverId = $request->get('rover_id');
            $commands = $request->get('commands');

            /** @var Rover $rover */
            $rover = $this->datastoreRover->getByRoverId($roverId);

            //execute  commands
            $this->moveRoverService->execute($rover, $commands);

            //Set Rover's last Direction
            $rover->setDirection($rover->getDirection()->toString());

            return $this->createResponse(
                ['rover' => $this->serializer->normalize($rover)],
                ConstantResponseMessages::SUCCESS_MESSAGE);

        } catch (Exception|ValidationException $e) {

            return $this->createResponse(
                [$e->getMessage()],
                ConstantResponseMessages::EXCEPTION_ERROR_MESSAGE,
                Response::HTTP_BAD_REQUEST
            );
        }
    }
}
