<?php

declare(strict_types=1);

namespace Chubbyphp\Tests\Serialization\Mapping;

use Chubbyphp\Mock\MockByCallsTrait;
use Chubbyphp\Serialization\Mapping\NormalizationLinkMappingBuilder;
use Chubbyphp\Serialization\Normalizer\CallbackLinkNormalizer;
use Chubbyphp\Serialization\Normalizer\LinkNormalizer;
use Chubbyphp\Serialization\Normalizer\LinkNormalizerInterface;
use Chubbyphp\Serialization\Policy\NullPolicy;
use Chubbyphp\Serialization\Policy\PolicyInterface;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Psr\Link\LinkInterface;

/**
 * @covers \Chubbyphp\Serialization\Mapping\NormalizationLinkMappingBuilder
 */
class NormalizationLinkMappingBuilderTest extends TestCase
{
    use MockByCallsTrait;

    public function testGetDefaultMapping()
    {
        /** @var LinkNormalizerInterface|MockObject $linkNormalizer */
        $linkNormalizer = $this->getMockByCalls(LinkNormalizerInterface::class);

        $linkMapping = NormalizationLinkMappingBuilder::create('name', $linkNormalizer)->getMapping();

        self::assertSame('name', $linkMapping->getName());
        self::assertSame([], $linkMapping->getGroups());
        self::assertSame($linkNormalizer, $linkMapping->getLinkNormalizer());
        self::assertInstanceOf(NullPolicy::class, $linkMapping->getPolicy());
    }

    public function testGetDefaultMappingForCallback()
    {
        $linkMapping = NormalizationLinkMappingBuilder::createCallback('name', function () {})->getMapping();

        self::assertSame('name', $linkMapping->getName());
        self::assertSame([], $linkMapping->getGroups());
        self::assertInstanceOf(CallbackLinkNormalizer::class, $linkMapping->getLinkNormalizer());
        self::assertInstanceOf(NullPolicy::class, $linkMapping->getPolicy());
    }

    public function testGetDefaultMappingForLink()
    {
        /** @var LinkInterface|MockObject $link */
        $link = $this->getMockByCalls(LinkInterface::class);

        $linkMapping = NormalizationLinkMappingBuilder::createLink('name', $link)->getMapping();

        self::assertSame('name', $linkMapping->getName());
        self::assertSame([], $linkMapping->getGroups());
        self::assertInstanceOf(LinkNormalizer::class, $linkMapping->getLinkNormalizer());
        self::assertInstanceOf(NullPolicy::class, $linkMapping->getPolicy());
    }

    public function testGetMapping()
    {
        /** @var LinkNormalizerInterface|MockObject $linkNormalizer */
        $linkNormalizer = $this->getMockByCalls(LinkNormalizerInterface::class);

        /** @var PolicyInterface|MockObject $policy */
        $policy = $this->getMockByCalls(PolicyInterface::class);

        $linkMapping = NormalizationLinkMappingBuilder::create('name', $linkNormalizer)
            ->setGroups(['group1'])
            ->setPolicy($policy)
            ->getMapping();

        self::assertSame('name', $linkMapping->getName());
        self::assertSame(['group1'], $linkMapping->getGroups());
        self::assertSame($linkNormalizer, $linkMapping->getLinkNormalizer());
        self::assertSame($policy, $linkMapping->getPolicy());
    }
}
