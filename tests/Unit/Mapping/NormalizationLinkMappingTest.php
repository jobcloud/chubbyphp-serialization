<?php

declare(strict_types=1);

namespace Chubbyphp\Tests\Serialization\Unit\Mapping;

use Chubbyphp\Mock\MockByCallsTrait;
use Chubbyphp\Serialization\Mapping\NormalizationLinkMapping;
use Chubbyphp\Serialization\Normalizer\LinkNormalizerInterface;
use Chubbyphp\Serialization\Policy\PolicyInterface;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

/**
 * @covers \Chubbyphp\Serialization\Mapping\NormalizationLinkMapping
 *
 * @internal
 */
final class NormalizationLinkMappingTest extends TestCase
{
    use MockByCallsTrait;

    public function testGetName(): void
    {
        /** @var LinkNormalizerInterface|MockObject $linkNormalizer */
        $linkNormalizer = $this->getMockByCalls(LinkNormalizerInterface::class);

        $linkMapping = new NormalizationLinkMapping('name', ['group1'], $linkNormalizer);

        self::assertSame('name', $linkMapping->getName());
    }

    public function testGetGroups(): void
    {
        /** @var LinkNormalizerInterface|MockObject $linkNormalizer */
        $linkNormalizer = $this->getMockByCalls(LinkNormalizerInterface::class);

        $linkMapping = new NormalizationLinkMapping('name', ['group1'], $linkNormalizer);

        self::assertSame(['group1'], $linkMapping->getGroups());
    }

    public function testGetLinkNormalizer(): void
    {
        /** @var LinkNormalizerInterface|MockObject $linkNormalizer */
        $linkNormalizer = $this->getMockByCalls(LinkNormalizerInterface::class);

        $linkMapping = new NormalizationLinkMapping('name', ['group1'], $linkNormalizer);

        self::assertSame($linkNormalizer, $linkMapping->getLinkNormalizer());
    }

    public function testGetPolicy(): void
    {
        /** @var LinkNormalizerInterface|MockObject $linkNormalizer */
        $linkNormalizer = $this->getMockByCalls(LinkNormalizerInterface::class);

        /** @var PolicyInterface|MockObject $policy */
        $policy = $this->getMockByCalls(PolicyInterface::class);

        $linkMapping = new NormalizationLinkMapping('name', ['group1'], $linkNormalizer, $policy);

        self::assertSame($policy, $linkMapping->getPolicy());
    }
}
