<?php

declare(strict_types=1);

namespace Jobcloud\Serialization\Normalizer;

use Jobcloud\Serialization\SerializerLogicException;
use Psr\Link\LinkInterface;

final class CallbackLinkNormalizer implements LinkNormalizerInterface
{
    /**
     * @var callable
     */
    private $callback;

    public function __construct(callable $callback)
    {
        $this->callback = $callback;
    }

    /**
     * @return array<string, mixed>
     *
     * @throws SerializerLogicException
     */
    public function normalizeLink(string $path, object $object, NormalizerContextInterface $context): array
    {
        $callback = $this->callback;

        $link = $callback($path, $object, $context);

        if (!$link instanceof LinkInterface) {
            $type = get_debug_type($link);

            throw SerializerLogicException::createInvalidLinkTypeReturned($path, $type);
        }

        return (new LinkNormalizer($link))->normalizeLink($path, $object, $context);
    }
}
