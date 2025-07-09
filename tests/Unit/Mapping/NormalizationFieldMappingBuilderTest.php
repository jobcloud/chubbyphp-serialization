<?php

declare(strict_types=1);

namespace Jobcloud\Tests\Serialization\Unit\Mapping;

use Chubbyphp\Mock\MockObjectBuilder;
use Jobcloud\Serialization\Mapping\NormalizationFieldMappingBuilder;
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
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

/**
 * @covers \Jobcloud\Serialization\Mapping\NormalizationFieldMappingBuilder
 *
 * @internal
 */
final class NormalizationFieldMappingBuilderTest extends TestCase
{
    public function testGetDefaultMapping(): void
    {
        $fieldMapping = NormalizationFieldMappingBuilder::create('name')->getMapping();

        self::assertSame('name', $fieldMapping->getName());
        self::assertInstanceOf(FieldNormalizer::class, $fieldMapping->getFieldNormalizer());
        self::assertInstanceOf(NullPolicy::class, $fieldMapping->getPolicy());
    }

    public function testGetMappingWithNormalizer(): void
    {
        $builder = new MockObjectBuilder();

        /** @var FieldNormalizerInterface|MockObject $fieldNormalizer */
        $fieldNormalizer = $builder->create(FieldNormalizerInterface::class, []);

        $fieldMapping = NormalizationFieldMappingBuilder::create('name', $fieldNormalizer)->getMapping();

        self::assertSame('name', $fieldMapping->getName());
        self::assertSame($fieldNormalizer, $fieldMapping->getFieldNormalizer());
        self::assertInstanceOf(NullPolicy::class, $fieldMapping->getPolicy());
    }

    public function testGetDefaultMappingForCallback(): void
    {
        $fieldMapping = NormalizationFieldMappingBuilder::createCallback('name', static function (): void {})->getMapping();

        self::assertSame('name', $fieldMapping->getName());
        self::assertInstanceOf(CallbackFieldNormalizer::class, $fieldMapping->getFieldNormalizer());
        self::assertInstanceOf(NullPolicy::class, $fieldMapping->getPolicy());
    }

    public function testGetDefaultMappingForDateTime(): void
    {
        $fieldMapping = NormalizationFieldMappingBuilder::createDateTime('name')->getMapping();

        self::assertSame('name', $fieldMapping->getName());
        self::assertInstanceOf(DateTimeFieldNormalizer::class, $fieldMapping->getFieldNormalizer());
        self::assertInstanceOf(NullPolicy::class, $fieldMapping->getPolicy());
    }

    public function testGetDefaultMappingForDateTimeWithFormat(): void
    {
        $fieldMapping = NormalizationFieldMappingBuilder::createDateTime('name', \DateTime::ATOM)->getMapping();

        /** @var DateTimeFieldNormalizer $fieldNormalizer */
        $fieldNormalizer = $fieldMapping->getFieldNormalizer();

        self::assertSame('name', $fieldMapping->getName());
        self::assertInstanceOf(DateTimeFieldNormalizer::class, $fieldNormalizer);
        self::assertInstanceOf(NullPolicy::class, $fieldMapping->getPolicy());

        $reflection = new \ReflectionProperty($fieldNormalizer, 'format');
        $reflection->setAccessible(true);

        self::assertSame(\DateTime::ATOM, $reflection->getValue($fieldNormalizer));
    }

    public function testGetDefaultMappingForEmbedMany(): void
    {
        $fieldMapping = NormalizationFieldMappingBuilder::createEmbedMany('name')->getMapping();

        self::assertSame('name', $fieldMapping->getName());
        self::assertInstanceOf(EmbedManyFieldNormalizer::class, $fieldMapping->getFieldNormalizer());
        self::assertInstanceOf(NullPolicy::class, $fieldMapping->getPolicy());
    }

    public function testGetDefaultMappingForEmbedOne(): void
    {
        $fieldMapping = NormalizationFieldMappingBuilder::createEmbedOne('name')->getMapping();

        self::assertSame('name', $fieldMapping->getName());
        self::assertInstanceOf(EmbedOneFieldNormalizer::class, $fieldMapping->getFieldNormalizer());
        self::assertInstanceOf(NullPolicy::class, $fieldMapping->getPolicy());
    }

    public function testGetDefaultMappingForReferenceMany(): void
    {
        $fieldMapping = NormalizationFieldMappingBuilder::createReferenceMany('name')->getMapping();

        self::assertSame('name', $fieldMapping->getName());
        self::assertInstanceOf(ReferenceManyFieldNormalizer::class, $fieldMapping->getFieldNormalizer());
        self::assertInstanceOf(NullPolicy::class, $fieldMapping->getPolicy());
    }

    public function testGetDefaultMappingForReferenceOne(): void
    {
        $fieldMapping = NormalizationFieldMappingBuilder::createReferenceOne('name')->getMapping();

        self::assertSame('name', $fieldMapping->getName());
        self::assertInstanceOf(ReferenceOneFieldNormalizer::class, $fieldMapping->getFieldNormalizer());
        self::assertInstanceOf(NullPolicy::class, $fieldMapping->getPolicy());
    }

    public function testGetMapping(): void
    {
        $builder = new MockObjectBuilder();

        /** @var FieldNormalizerInterface|MockObject $fieldNormalizer */
        $fieldNormalizer = $builder->create(FieldNormalizerInterface::class, []);

        /** @var MockObject|PolicyInterface $policy */
        $policy = $builder->create(PolicyInterface::class, []);

        $fieldMapping = NormalizationFieldMappingBuilder::create('name', $fieldNormalizer)
            ->setPolicy($policy)
            ->getMapping()
        ;

        self::assertSame('name', $fieldMapping->getName());
        self::assertSame($fieldNormalizer, $fieldMapping->getFieldNormalizer());
        self::assertSame($policy, $fieldMapping->getPolicy());
    }
}
