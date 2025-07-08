<?php

declare(strict_types=1);

namespace Jobcloud\Serialization\Normalizer\Relation;

use Jobcloud\Serialization\Accessor\AccessorInterface;
use Jobcloud\Serialization\Normalizer\FieldNormalizerInterface;
use Jobcloud\Serialization\Normalizer\NormalizerContextInterface;
use Jobcloud\Serialization\Normalizer\NormalizerInterface;
use Jobcloud\Serialization\SerializerLogicException;

final class ReferenceManyFieldNormalizer implements FieldNormalizerInterface
{
    public function __construct(private AccessorInterface $identifierAccessor, private AccessorInterface $accessor) {}

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
        if (null === $relatedObjects = $this->accessor->getValue($object)) {
            return null;
        }

        $values = [];
        foreach ($relatedObjects as $i => $relatedObject) {
            $values[$i] = $this->identifierAccessor->getValue($relatedObject);
        }

        return $values;
    }
}
