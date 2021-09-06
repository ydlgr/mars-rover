<?php

namespace App\Controller\V1;

use App\Entity\Plateau;
use App\Exception\ValidationException;
use App\Service\PlateauService;
use App\Util\ConstantResponseMessages;
use App\Util\CustomObjectNormalizer;
use App\Validator\PlateauValidator;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Exception;
use Symfony\Component\Serializer\Exception\ExceptionInterface;

class PlateauController extends BaseController
{
    private PlateauService $plateauService;
    private CustomObjectNormalizer $normalizer;
    private PlateauValidator $plateauValidator;

    public function __construct(
        PlateauService $plateauService,
        CustomObjectNormalizer $normalizer,
        PlateauValidator $plateauValidator)
    {
        $this->plateauService = $plateauService;
        $this->normalizer = $normalizer;
        $this->plateauValidator = $plateauValidator;
    }

    /**
     * @Route("/plateau", name="plateau_store", methods={"POST"})
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        try {
            $this->plateauValidator->validate($request->request->all());

            $plateau = $this->plateauService->savePlateau($request);

            if ($plateau) {
                return $this->createResponse(
                    ['plateau' => $this->normalizer->normalize($plateau)],
                    ConstantResponseMessages::SUCCESS_MESSAGE,
                    Response::HTTP_CREATED);
            }

            return $this->createResponse(
                [],
                ConstantResponseMessages::PLATEAU_SAVE_ERROR_MESSAGE,
                Response::HTTP_BAD_REQUEST
            );

        } catch (ValidationException|ExceptionInterface $e) {

            return $this->createResponse(
                [$e->getMessage()],
                ConstantResponseMessages::EXCEPTION_ERROR_MESSAGE,
                Response::HTTP_BAD_REQUEST
            );
        }
    }

    /**
     * @Route("/plateau/{id}", name="plateau_show", methods={"GET"})
     *
     * @param int $id
     * @return JsonResponse
     */

    public function show(int $id): JsonResponse
    {
        /** @var Plateau $plateau */
        $plateau = $this->plateauService->getPlateauById($id);

        if (!isset($plateau)) {
            return $this->createResponse(
                [],
                ConstantResponseMessages::PLATEAU_DOESNT_EXIST,
                Response::HTTP_BAD_REQUEST);
        }

        return $this->createResponse(
            ['plateau' => $this->normalizer->normalize($plateau)],
            ConstantResponseMessages::SUCCESS_MESSAGE);
    }
}
