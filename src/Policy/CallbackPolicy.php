<?php

declare(strict_types=1);

namespace Jobcloud\Serialization\Policy;

use Jobcloud\Serialization\Normalizer\NormalizerContextInterface;

final class CallbackPolicy implements PolicyInterface
{
    /**
     * @var callable
     */
    private $callback;

    public function __construct(callable $callback)
    {
        $this->callback = $callback;
    }

    public function isCompliant(string $path, object $object, NormalizerContextInterface $context): bool
    {
        return ($this->callback)($path, $object, $context);
    }
}
