<?php

namespace App\Controller\V1;

use App\Entity\Rover;
use App\Exception\ValidationException;
use App\Service\RoverService;
use App\Util\ConstantResponseMessages;
use App\Validator\RoverValidator;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Exception\ExceptionInterface;
use Symfony\Component\Serializer\SerializerInterface;

class RoverController extends BaseController
{
    private RoverValidator $roverValidator;
    private RoverService $roverService;
    private SerializerInterface $serializer;

    public function __construct(
        RoverValidator $roverValidator,
        SerializerInterface $serializer,
        RoverService $roverService)
    {
        $this->roverValidator = $roverValidator;
        $this->roverService = $roverService;
        $this->serializer = $serializer;
    }

    /**
     * @Route("/rover", name="rover_store", methods={"POST"})
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        try {
            $this->roverValidator->validate($request->request->all());

            $rover = $this->roverService->saveRover($request);

            if ($rover) {
                return $this->createResponse(
                    ['rover' => $this->serializer->normalize($rover)],
                    ConstantResponseMessages::SUCCESS_MESSAGE,
                    Response::HTTP_CREATED,
                    );
            }

            return $this->createResponse(
                [],
                ConstantResponseMessages::ROVER_SAVE_ERROR_MESSAGE,
                Response::HTTP_BAD_REQUEST);

        } catch (ValidationException|ExceptionInterface $e) {
            return $this->createResponse([$e->getMessage()], ConstantResponseMessages::EXCEPTION_ERROR_MESSAGE,Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * @Route("/rover/{id}", name="rover_show", methods={"GET"})
     *
     * @param int $id
     * @return JsonResponse
     */
    public function show(int $id): JsonResponse
    {
        /** @var Rover $rover */
        $rover = $this->roverService->getRoverById($id);

        if (!isset($rover)) {
            return $this->createResponse(
                [],
                ConstantResponseMessages::ROVER_DOESNT_EXIST,
                Response::HTTP_BAD_REQUEST);
        }

        return $this->createResponse(
            ['rover' => $this->serializer->normalize($rover)],
            ConstantResponseMessages::SUCCESS_MESSAGE);
    }
}
