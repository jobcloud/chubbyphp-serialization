<?php

declare(strict_types=1);

namespace Jobcloud\Serialization\Policy;

use Jobcloud\Serialization\Normalizer\NormalizerContextInterface;

interface PolicyInterface
{
    public function isCompliant(string $path, object $object, NormalizerContextInterface $context): bool;
}
