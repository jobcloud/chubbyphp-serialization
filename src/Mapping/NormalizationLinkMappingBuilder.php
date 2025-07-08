<?php

declare(strict_types=1);

namespace Jobcloud\Serialization\Mapping;

use Jobcloud\Serialization\Normalizer\CallbackLinkNormalizer;
use Jobcloud\Serialization\Normalizer\LinkNormalizer;
use Jobcloud\Serialization\Normalizer\LinkNormalizerInterface;
use Jobcloud\Serialization\Policy\NullPolicy;
use Jobcloud\Serialization\Policy\PolicyInterface;
use Psr\Link\LinkInterface;

final class NormalizationLinkMappingBuilder
{
    private LinkNormalizerInterface $linkNormalizer;

    private ?PolicyInterface $policy = null;

    private function __construct(private string $name) {}

    public static function create(
        string $name,
        LinkNormalizerInterface $linkNormalizer
    ): self {
        $self = new self($name);
        $self->linkNormalizer = $linkNormalizer;

        return $self;
    }

    public static function createCallback(
        string $name,
        callable $callback
    ): self {
        $self = new self($name);
        $self->linkNormalizer = new CallbackLinkNormalizer($callback);

        return $self;
    }

    public static function createLink(
        string $name,
        LinkInterface $link
    ): self {
        $self = new self($name);
        $self->linkNormalizer = new LinkNormalizer($link);

        return $self;
    }

    public function setPolicy(PolicyInterface $policy): self
    {
        $this->policy = $policy;

        return $this;
    }

    public function getMapping(): NormalizationLinkMappingInterface
    {
        return new NormalizationLinkMapping(
            $this->name,
            $this->linkNormalizer,
            $this->policy ?? new NullPolicy()
        );
    }
}
