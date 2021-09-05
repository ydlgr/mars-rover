<?php

namespace App\Traits;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

trait ApiResponse
{
    /**
     * Basic Api Response for endpoints.
     *
     * @param array|null $data
     * @param string|null $message
     * @param int $status
     * @return JsonResponse
     */
    protected function createResponse(?array $data, ?string $message, int $status = Response::HTTP_OK): JsonResponse
    {
        $response = new JsonResponse();

        //If Response is between 200-300, response body will return with 'data', else it will return with 'error'
        $errorOrDataResponse = "error";
        if ($status > Response::HTTP_OK && $status < Response::HTTP_MULTIPLE_CHOICES) {
            $errorOrDataResponse = 'data';
        }

        return $response
            ->setStatusCode($status)
            ->setData(
                [
                    'message' => $message,
                    $errorOrDataResponse => $data
                ]
            );
    }
}
