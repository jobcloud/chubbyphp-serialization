<?php

declare(strict_types=1);

namespace Jobcloud\Serialization\Mapping;

use Jobcloud\Serialization\Normalizer\LinkNormalizerInterface;
use Jobcloud\Serialization\Policy\PolicyInterface;

interface NormalizationLinkMappingInterface
{
    public function getName(): string;

    public function getLinkNormalizer(): LinkNormalizerInterface;

    public function getPolicy(): PolicyInterface;
}
