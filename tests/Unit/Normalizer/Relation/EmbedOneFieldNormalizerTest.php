<?php

declare(strict_types=1);

namespace Jobcloud\Tests\Serialization\Unit\Normalizer\Relation;

use Chubbyphp\Mock\MockMethod\WithReturn;
use Chubbyphp\Mock\MockObjectBuilder;
use Jobcloud\Serialization\Accessor\AccessorInterface;
use Jobcloud\Serialization\Normalizer\NormalizerContextInterface;
use Jobcloud\Serialization\Normalizer\NormalizerInterface;
use Jobcloud\Serialization\Normalizer\Relation\EmbedOneFieldNormalizer;
use Jobcloud\Serialization\SerializerLogicException;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

/**
 * @covers \Jobcloud\Serialization\Normalizer\Relation\EmbedOneFieldNormalizer
 *
 * @internal
 */
final class EmbedOneFieldNormalizerTest extends TestCase
{
    public function testNormalizeFieldWithMissingNormalizer(): void
    {
        $this->expectException(SerializerLogicException::class);
        $this->expectExceptionMessage('There is no normalizer at path: "relation"');

        $object = $this->getObject();

        $builder = new MockObjectBuilder();

        /** @var AccessorInterface|MockObject $accessor */
        $accessor = $builder->create(AccessorInterface::class, []);

        /** @var MockObject|NormalizerContextInterface $context */
        $context = $builder->create(NormalizerContextInterface::class, []);

        $fieldNormalizer = new EmbedOneFieldNormalizer($accessor);

        $fieldNormalizer->normalizeField('relation', $object, $context);
    }

    public function testNormalizeFieldWithNull(): void
    {
        $object = $this->getObject();

        $builder = new MockObjectBuilder();

        /** @var AccessorInterface|MockObject $accessor */
        $accessor = $builder->create(AccessorInterface::class, [
            new WithReturn('getValue', [$object], null),
        ]);

        /** @var MockObject|NormalizerContextInterface $context */
        $context = $builder->create(NormalizerContextInterface::class, []);

        /** @var MockObject|NormalizerInterface $normalizer */
        $normalizer = $builder->create(NormalizerInterface::class, []);

        $fieldNormalizer = new EmbedOneFieldNormalizer($accessor);

        $data = $fieldNormalizer->normalizeField('relation', $object, $context, $normalizer);

        self::assertNull($data);
    }

    public function testNormalizeFieldWithObject(): void
    {
        $relation = $this->getRelation();
        $relation->setName('php');

        $object = $this->getObject();
        $object->setRelation($relation);

        $builder = new MockObjectBuilder();

        /** @var AccessorInterface|MockObject $accessor */
        $accessor = $builder->create(AccessorInterface::class, [
            new WithReturn('getValue', [$object], $relation),
        ]);

        /** @var MockObject|NormalizerContextInterface $context */
        $context = $builder->create(NormalizerContextInterface::class, []);

        /** @var MockObject|NormalizerInterface $normalizer */
        $normalizer = $builder->create(NormalizerInterface::class, [
            new WithReturn('normalize', [$relation, $context, 'relation'], ['name' => $relation->getName()]),
        ]);

        $fieldNormalizer = new EmbedOneFieldNormalizer($accessor);

        $data = $fieldNormalizer->normalizeField('relation', $object, $context, $normalizer);

        self::assertSame(['name' => 'php'], $data);
    }

    private function getObject(): object
    {
        return new class {
            private object $relation;

            public function getRelation(): object
            {
                return $this->relation;
            }

            public function setRelation(object $relation): self
            {
                $this->relation = $relation;

                return $this;
            }
        };
    }

    private function getRelation(): object
    {
        return new class {
            private string $name;

            public function getName(): string
            {
                return $this->name;
            }

            public function setName(string $name): self
            {
                $this->name = $name;

                return $this;
            }
        };
    }
}
