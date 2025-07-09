<?php

declare(strict_types=1);

namespace Jobcloud\Tests\Serialization\Unit\Normalizer;

use Chubbyphp\Mock\MockMethod\WithReturn;
use Chubbyphp\Mock\MockObjectBuilder;
use Jobcloud\Serialization\Accessor\AccessorInterface;
use Jobcloud\Serialization\Normalizer\FieldNormalizer;
use Jobcloud\Serialization\Normalizer\NormalizerContextInterface;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

/**
 * @covers \Jobcloud\Serialization\Normalizer\FieldNormalizer
 *
 * @internal
 */
final class FieldNormalizerTest extends TestCase
{
    public function testNormalizeField(): void
    {
        $object = new \stdClass();

        $builder = new MockObjectBuilder();

        /** @var MockObject|NormalizerContextInterface $context */
        $context = $builder->create(NormalizerContextInterface::class, []);

        /** @var AccessorInterface|MockObject $accessor */
        $accessor = $builder->create(AccessorInterface::class, [
            new WithReturn('getValue', [$object], 'name'),
        ]);

        $fieldNormalizer = new FieldNormalizer($accessor);

        self::assertSame(
            'name',
            $fieldNormalizer->normalizeField('name', $object, $context)
        );
    }
}
