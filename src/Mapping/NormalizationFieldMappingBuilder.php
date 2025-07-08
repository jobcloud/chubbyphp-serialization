<?php

declare(strict_types=1);

namespace Jobcloud\Serialization\Mapping;

use Jobcloud\Serialization\Accessor\PropertyAccessor;
use Jobcloud\Serialization\Normalizer\CallbackFieldNormalizer;
use Jobcloud\Serialization\Normalizer\DateTimeFieldNormalizer;
use Jobcloud\Serialization\Normalizer\FieldNormalizer;
use Jobcloud\Serialization\Normalizer\FieldNormalizerInterface;
use Jobcloud\Serialization\Normalizer\Relation\EmbedManyFieldNormalizer;
use Jobcloud\Serialization\Normalizer\Relation\EmbedOneFieldNormalizer;
use Jobcloud\Serialization\Normalizer\Relation\ReferenceManyFieldNormalizer;
use Jobcloud\Serialization\Normalizer\Relation\ReferenceOneFieldNormalizer;
use Jobcloud\Serialization\Policy\NullPolicy;
use Jobcloud\Serialization\Policy\PolicyInterface;

final class NormalizationFieldMappingBuilder
{
    private ?FieldNormalizerInterface $fieldNormalizer = null;

    private ?PolicyInterface $policy = null;

    private function __construct(private string $name) {}

    public static function create(
        string $name,
        ?FieldNormalizerInterface $fieldNormalizer = null
    ): self {
        $self = new self($name);
        $self->fieldNormalizer = $fieldNormalizer;

        return $self;
    }

    public static function createCallback(string $name, callable $callback): self
    {
        $self = new self($name);
        $self->fieldNormalizer = new CallbackFieldNormalizer($callback);

        return $self;
    }

    public static function createDateTime(string $name, string $format = 'c'): self
    {
        $self = new self($name);
        $self->fieldNormalizer = new DateTimeFieldNormalizer(new PropertyAccessor($name), $format);

        return $self;
    }

    public static function createEmbedMany(string $name): self
    {
        $self = new self($name);
        $self->fieldNormalizer = new EmbedManyFieldNormalizer(new PropertyAccessor($name));

        return $self;
    }

    public static function createEmbedOne(string $name): self
    {
        $self = new self($name);
        $self->fieldNormalizer = new EmbedOneFieldNormalizer(new PropertyAccessor($name));

        return $self;
    }

    public static function createReferenceMany(
        string $name,
        string $idName = 'id'
    ): self {
        $self = new self($name);
        $self->fieldNormalizer = new ReferenceManyFieldNormalizer(
            new PropertyAccessor($idName),
            new PropertyAccessor($name)
        );

        return $self;
    }

    public static function createReferenceOne(
        string $name,
        string $idName = 'id'
    ): self {
        $self = new self($name);
        $self->fieldNormalizer = new ReferenceOneFieldNormalizer(
            new PropertyAccessor($idName),
            new PropertyAccessor($name)
        );

        return $self;
    }

    public function setPolicy(PolicyInterface $policy): self
    {
        $this->policy = $policy;

        return $this;
    }

    public function getMapping(): NormalizationFieldMappingInterface
    {
        return new NormalizationFieldMapping(
            $this->name,
            $this->fieldNormalizer ?? new FieldNormalizer(new PropertyAccessor($this->name)),
            $this->policy ?? new NullPolicy()
        );
    }
}
