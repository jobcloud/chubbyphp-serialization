<?php

declare(strict_types=1);

namespace Jobcloud\Serialization\Mapping;

use Jobcloud\Serialization\Normalizer\FieldNormalizerInterface;
use Jobcloud\Serialization\Policy\NullPolicy;
use Jobcloud\Serialization\Policy\PolicyInterface;

final class NormalizationFieldMapping implements NormalizationFieldMappingInterface
{
    private PolicyInterface $policy;

    public function __construct(
        private string $name,
        private FieldNormalizerInterface $fieldNormalizer,
        ?PolicyInterface $policy = null
    ) {
        $this->policy = $policy ?? new NullPolicy();
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getFieldNormalizer(): FieldNormalizerInterface
    {
        return $this->fieldNormalizer;
    }

    public function getPolicy(): PolicyInterface
    {
        return $this->policy;
    }
}
