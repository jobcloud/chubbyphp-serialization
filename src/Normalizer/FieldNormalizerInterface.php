<?php

declare(strict_types=1);

namespace Jobcloud\Serialization\Normalizer;

use Jobcloud\Serialization\SerializerLogicException;

interface FieldNormalizerInterface
{
    /**
     * @return mixed
     *
     * @throws SerializerLogicException
     */
    public function normalizeField(
        string $path,
        object $object,
        NormalizerContextInterface $context,
        ?NormalizerInterface $normalizer = null
    );
}
