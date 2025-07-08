<?php

declare(strict_types=1);

namespace Jobcloud\Serialization\Normalizer;

use Jobcloud\Serialization\Accessor\AccessorInterface;

final class FieldNormalizer implements FieldNormalizerInterface
{
    public function __construct(private AccessorInterface $accessor) {}

    /**
     * @return mixed
     */
    public function normalizeField(
        string $path,
        object $object,
        NormalizerContextInterface $context,
        ?NormalizerInterface $normalizer = null
    ) {
        return $this->accessor->getValue($object);
    }
}
