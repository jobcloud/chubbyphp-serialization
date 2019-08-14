<?php

declare(strict_types=1);

namespace Chubbyphp\Tests\Serialization\Normalizer;

use Chubbyphp\Mock\MockByCallsTrait;
use Chubbyphp\Serialization\Normalizer\NormalizerContextBuilder;
use Chubbyphp\Serialization\Normalizer\NormalizerContextInterface;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ServerRequestInterface;

/**
 * @covers \Chubbyphp\Serialization\Normalizer\NormalizerContextBuilder
 *
 * @internal
 */
class NormalizerContextBuilderTest extends TestCase
{
    use MockByCallsTrait;

    public function testCreate()
    {
        $context = NormalizerContextBuilder::create()->getContext();

        self::assertInstanceOf(NormalizerContextInterface::class, $context);

        self::assertSame([], $context->getGroups());
        self::assertNull($context->getRequest());
        self::assertSame([], $context->getAttributes());
    }

    public function testCreateWithOverridenSettings()
    {
        /** @var ServerRequestInterface|MockObject $request */
        $request = $this->getMockByCalls(ServerRequestInterface::class);

        $context = NormalizerContextBuilder::create()
            ->setGroups(['group1'])
            ->setRequest($request)
            ->setAttributes(['attribute' => 'value'])
            ->getContext()
        ;

        self::assertInstanceOf(NormalizerContextInterface::class, $context);

        self::assertSame(['group1'], $context->getGroups());
        self::assertSame($request, $context->getRequest());
        self::assertSame(['attribute' => 'value'], $context->getAttributes());
    }

    public function testCreateSetNullRequest()
    {
        $context = NormalizerContextBuilder::create()
            ->setRequest()
            ->getContext()
        ;

        self::assertInstanceOf(NormalizerContextInterface::class, $context);

        self::assertNull($context->getRequest());
    }
}
