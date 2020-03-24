<?php

declare(strict_types=1);

namespace Chubbyphp\Serialization\Policy;

use Chubbyphp\Serialization\Normalizer\NormalizerContextInterface;

final class NotPolicy implements PolicyInterface
{
    /**
     * @var PolicyInterface
     */
    private $policy;

    public function __construct(PolicyInterface $policy)
    {
        $this->policy = $policy;
    }

    public function isCompliant(NormalizerContextInterface $context, object $object): bool
    {
        return !$this->policy->isCompliant($context, $object);
    }

    public function isCompliantIncludingPath(object $object, NormalizerContextInterface $context, string $path): bool
    {
        return !$this->policy->isCompliantIncludingPath($object, $context, $path);
    }
}
