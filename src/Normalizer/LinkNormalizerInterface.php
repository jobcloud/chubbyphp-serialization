<?php

declare(strict_types=1);

namespace Jobcloud\Serialization\Normalizer;

use Jobcloud\Serialization\SerializerLogicException;

interface LinkNormalizerInterface
{
    /**
     * @return array<string, mixed>
     *
     * @throws SerializerLogicException
     */
    public function normalizeLink(string $path, object $object, NormalizerContextInterface $context): array;
}
