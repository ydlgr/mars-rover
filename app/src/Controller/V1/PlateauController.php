<?php

namespace App\Controller\V1;

use App\Service\PlateauService;
use App\Util\ConstantResponseMessages;
use App\Util\CustomObjectNormalizer;
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

    public function __construct(PlateauService $plateauService, CustomObjectNormalizer $normalizer)
    {
        $this->plateauService = $plateauService;
        $this->normalizer = $normalizer;
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

        } catch (Exception | ExceptionInterface $e) {

            return $this->createResponse(
                [$e->getMessage()],
                ConstantResponseMessages::EXCEPTION_ERROR_MESSAGE,
                Response::HTTP_BAD_REQUEST
            );
        }
    }
}
