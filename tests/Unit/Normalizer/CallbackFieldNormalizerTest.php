<?php

declare(strict_types=1);

namespace Jobcloud\Tests\Serialization\Unit\Normalizer;

use Chubbyphp\Mock\MockObjectBuilder;
use Jobcloud\Serialization\Normalizer\CallbackFieldNormalizer;
use Jobcloud\Serialization\Normalizer\NormalizerContextInterface;
use Jobcloud\Serialization\Normalizer\NormalizerInterface;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

/**
 * @covers \Jobcloud\Serialization\Normalizer\CallbackFieldNormalizer
 *
 * @internal
 */
final class CallbackFieldNormalizerTest extends TestCase
{
    public function testNormalizeField(): void
    {
        $builder = new MockObjectBuilder();

        /** @var MockObject|NormalizerContextInterface $normalizerContext */
        $normalizerContext = $builder->create(NormalizerContextInterface::class, []);

        $object = new \stdClass();

        $fieldNormalizer = new CallbackFieldNormalizer(
            static fn (string $path, $object, NormalizerContextInterface $context, ?NormalizerInterface $normalizer = null) => 'name'
        );

        self::assertSame('name', $fieldNormalizer->normalizeField('name', $object, $normalizerContext));
    }
}
