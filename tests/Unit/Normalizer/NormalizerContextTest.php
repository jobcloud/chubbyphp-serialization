<?php

declare(strict_types=1);

namespace Chubbyphp\Tests\Serialization\Unit\Normalizer;

use Chubbyphp\Mock\MockByCallsTrait;
use Chubbyphp\Serialization\Normalizer\NormalizerContext;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ServerRequestInterface;

/**
 * @covers \Chubbyphp\Serialization\Normalizer\NormalizerContext
 *
 * @internal
 */
final class NormalizerContextTest extends TestCase
{
    use MockByCallsTrait;

    public function testCreate(): void
    {
        $context = new NormalizerContext();

        self::assertSame([], $context->getGroups());
        self::assertNull($context->getRequest());
        self::assertSame([], $context->getAttributes());
        self::assertNull($context->getAttribute('nonExistingAttribute'));
        self::assertSame('default', $context->getAttribute('nonExistingAttribute', 'default'));
    }

    public function testCreateWithOverridenSettings(): void
    {
        /** @var ServerRequestInterface|MockObject $request */
        $request = $this->getMockByCalls(ServerRequestInterface::class);

        $context = new NormalizerContext(['group1'], $request, ['attribute' => 'value']);

        self::assertSame(['group1'], $context->getGroups());
        self::assertSame($request, $context->getRequest());
        self::assertSame(['attribute' => 'value'], $context->getAttributes());
        self::assertSame('value', $context->getAttribute('attribute'));
    }

    public function testWithAttribute(): void
    {
        /** @var ServerRequestInterface|MockObject $request */
        $request = $this->getMockByCalls(ServerRequestInterface::class);

        $context = new NormalizerContext(['group1'], $request, ['attribute' => 'value']);
        $newContext = $context->withAttribute('otherAttribute', 'value2');

        self::assertNotSame($context, $newContext);
        self::assertSame(['attribute' => 'value', 'otherAttribute' => 'value2'], $newContext->getAttributes());
        self::assertSame(['attribute' => 'value'], $context->getAttributes());
    }
}
