<?php

declare(strict_types=1);

namespace Jobcloud\Serialization\Mapping;

use Jobcloud\Serialization\Normalizer\FieldNormalizerInterface;
use Jobcloud\Serialization\Policy\PolicyInterface;

interface NormalizationFieldMappingInterface
{
    public function getName(): string;

    public function getFieldNormalizer(): FieldNormalizerInterface;

    public function getPolicy(): PolicyInterface;
}
