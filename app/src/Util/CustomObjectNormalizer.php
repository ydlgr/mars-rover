<?php

namespace App\Util;

use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;

class CustomObjectNormalizer extends ObjectNormalizer
{
    public function normalize($object, string $format = null, array $context = [])
    {
        $normalize = parent::normalize($object, $format, $context);

        return array_filter($normalize, function ($property) {
            return $property !== null;
        });
    }
}
