<?php

declare(strict_types=1);

namespace Jobcloud\Tests\Serialization\Unit\Link;

use Jobcloud\Serialization\Link\LinkBuilder;
use PHPUnit\Framework\TestCase;

/**
 * @covers \Jobcloud\Serialization\Link\LinkBuilder
 *
 * @internal
 */
final class LinkBuilderTest extends TestCase
{
    public function testSetters(): void
    {
        $link = LinkBuilder::create('/api/models/{id}')
            ->setRels(['models'])
            ->setAttributes(['method' => 'GET'])
            ->getLink()
        ;

        self::assertSame('/api/models/{id}', $link->getHref());
        self::assertTrue($link->isTemplated());
        self::assertSame(['models'], $link->getRels());
        self::assertSame(['method' => 'GET'], $link->getAttributes());
    }

    public function testDefault(): void
    {
        $link = LinkBuilder::create('/api/models')->getLink();

        self::assertSame('/api/models', $link->getHref());
        self::assertFalse($link->isTemplated());
        self::assertSame([], $link->getRels());
        self::assertSame([], $link->getAttributes());
    }
}
