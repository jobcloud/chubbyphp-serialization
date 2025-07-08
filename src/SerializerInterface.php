<?php

declare(strict_types=1);

namespace Jobcloud\Serialization;

use Chubbyphp\DecodeEncode\Encoder\EncoderInterface;
use Jobcloud\Serialization\Normalizer\NormalizerContextInterface;
use Jobcloud\Serialization\Normalizer\NormalizerInterface;

interface SerializerInterface extends EncoderInterface, NormalizerInterface
{
    public function serialize(
        object $object,
        string $contentType,
        ?NormalizerContextInterface $context = null,
        string $path = ''
    ): string;
}
