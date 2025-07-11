<?php

declare(strict_types=1);

namespace Jobcloud\Tests\Serialization\Unit\Normalizer;

use Chubbyphp\Mock\MockObjectBuilder;
use Jobcloud\Serialization\Normalizer\NormalizerContextBuilder;
use Jobcloud\Serialization\Normalizer\NormalizerContextInterface;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ServerRequestInterface;

/**
 * @covers \Jobcloud\Serialization\Normalizer\NormalizerContextBuilder
 *
 * @internal
 */
final class NormalizerContextBuilderTest extends TestCase
{
    public function testCreate(): void
    {
        $context = NormalizerContextBuilder::create()->getContext();

        self::assertInstanceOf(NormalizerContextInterface::class, $context);

        self::assertNull($context->getRequest());
        self::assertSame([], $context->getAttributes());
    }

    public function testCreateWithOverridenSettings(): void
    {
        $builder = new MockObjectBuilder();

        /** @var MockObject|ServerRequestInterface $request */
        $request = $builder->create(ServerRequestInterface::class, []);

        $context = NormalizerContextBuilder::create()
            ->setRequest($request)
            ->setAttributes(['attribute' => 'value'])
            ->getContext()
        ;

        self::assertInstanceOf(NormalizerContextInterface::class, $context);

        self::assertSame($request, $context->getRequest());
        self::assertSame(['attribute' => 'value'], $context->getAttributes());
    }

    public function testCreateSetNullRequest(): void
    {
        $context = NormalizerContextBuilder::create()
            ->setRequest()
            ->getContext()
        ;

        self::assertInstanceOf(NormalizerContextInterface::class, $context);

        self::assertNull($context->getRequest());
    }
}
