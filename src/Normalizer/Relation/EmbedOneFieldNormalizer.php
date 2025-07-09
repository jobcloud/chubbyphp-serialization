<?php

declare(strict_types=1);

namespace Jobcloud\Serialization\Normalizer\Relation;

use Jobcloud\Serialization\Accessor\AccessorInterface;
use Jobcloud\Serialization\Normalizer\FieldNormalizerInterface;
use Jobcloud\Serialization\Normalizer\NormalizerContextInterface;
use Jobcloud\Serialization\Normalizer\NormalizerInterface;
use Jobcloud\Serialization\SerializerLogicException;

final class EmbedOneFieldNormalizer implements FieldNormalizerInterface
{
    public function __construct(private AccessorInterface $accessor) {}

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
    ) {
        if (null === $normalizer) {
            throw SerializerLogicException::createMissingNormalizer($path);
        }

        if (null === $relatedObject = $this->accessor->getValue($object)) {
            return null;
        }

        return $normalizer->normalize($relatedObject, $context, $path);
    }
}
