<?php

declare(strict_types=1);

namespace Jobcloud\Serialization\Policy;

use Jobcloud\Serialization\Normalizer\NormalizerContextInterface;

final class NullPolicy implements PolicyInterface
{
    public function isCompliant(string $path, object $object, NormalizerContextInterface $context): bool
    {
        return true;
    }
}
