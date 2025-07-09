<?php

declare(strict_types=1);

namespace Jobcloud\Tests\Serialization\Unit\Mapping;

use Chubbyphp\Mock\MockObjectBuilder;
use Jobcloud\Serialization\Mapping\NormalizationFieldMapping;
use Jobcloud\Serialization\Normalizer\FieldNormalizerInterface;
use Jobcloud\Serialization\Policy\PolicyInterface;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

/**
 * @covers \Jobcloud\Serialization\Mapping\NormalizationFieldMapping
 *
 * @internal
 */
final class NormalizationFieldMappingTest extends TestCase
{
    public function testGetName(): void
    {
        $builder = new MockObjectBuilder();

        /** @var FieldNormalizerInterface|MockObject $fieldNormalizer */
        $fieldNormalizer = $builder->create(FieldNormalizerInterface::class, []);

        $fieldMapping = new NormalizationFieldMapping('name', $fieldNormalizer);

        self::assertSame('name', $fieldMapping->getName());
    }

    public function testGetFieldNormalizer(): void
    {
        $builder = new MockObjectBuilder();

        /** @var FieldNormalizerInterface|MockObject $fieldNormalizer */
        $fieldNormalizer = $builder->create(FieldNormalizerInterface::class, []);

        $fieldMapping = new NormalizationFieldMapping('name', $fieldNormalizer);

        self::assertSame($fieldNormalizer, $fieldMapping->getFieldNormalizer());
    }

    public function testGetPolicy(): void
    {
        $builder = new MockObjectBuilder();

        /** @var FieldNormalizerInterface|MockObject $fieldNormalizer */
        $fieldNormalizer = $builder->create(FieldNormalizerInterface::class, []);

        /** @var MockObject|PolicyInterface $policy */
        $policy = $builder->create(PolicyInterface::class, []);

        $fieldMapping = new NormalizationFieldMapping('name', $fieldNormalizer, $policy);

        self::assertSame($policy, $fieldMapping->getPolicy());
    }
}
