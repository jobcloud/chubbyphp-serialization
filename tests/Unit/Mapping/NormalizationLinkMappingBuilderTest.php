<?php

declare(strict_types=1);

namespace Jobcloud\Tests\Serialization\Unit\Mapping;

use Chubbyphp\Mock\MockObjectBuilder;
use Jobcloud\Serialization\Mapping\NormalizationLinkMappingBuilder;
use Jobcloud\Serialization\Normalizer\CallbackLinkNormalizer;
use Jobcloud\Serialization\Normalizer\LinkNormalizer;
use Jobcloud\Serialization\Normalizer\LinkNormalizerInterface;
use Jobcloud\Serialization\Policy\NullPolicy;
use Jobcloud\Serialization\Policy\PolicyInterface;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Psr\Link\LinkInterface;

/**
 * @covers \Jobcloud\Serialization\Mapping\NormalizationLinkMappingBuilder
 *
 * @internal
 */
final class NormalizationLinkMappingBuilderTest extends TestCase
{
    public function testGetDefaultMapping(): void
    {
        $builder = new MockObjectBuilder();

        /** @var LinkNormalizerInterface|MockObject $linkNormalizer */
        $linkNormalizer = $builder->create(LinkNormalizerInterface::class, []);

        $linkMapping = NormalizationLinkMappingBuilder::create('name', $linkNormalizer)->getMapping();

        self::assertSame('name', $linkMapping->getName());
        self::assertSame($linkNormalizer, $linkMapping->getLinkNormalizer());
        self::assertInstanceOf(NullPolicy::class, $linkMapping->getPolicy());
    }

    public function testGetDefaultMappingForCallback(): void
    {
        $linkMapping = NormalizationLinkMappingBuilder::createCallback('name', static function (): void {})->getMapping();

        self::assertSame('name', $linkMapping->getName());
        self::assertInstanceOf(CallbackLinkNormalizer::class, $linkMapping->getLinkNormalizer());
        self::assertInstanceOf(NullPolicy::class, $linkMapping->getPolicy());
    }

    public function testGetDefaultMappingForLink(): void
    {
        $builder = new MockObjectBuilder();

        /** @var LinkInterface|MockObject $link */
        $link = $builder->create(LinkInterface::class, []);

        $linkMapping = NormalizationLinkMappingBuilder::createLink('name', $link)->getMapping();

        self::assertSame('name', $linkMapping->getName());
        self::assertInstanceOf(LinkNormalizer::class, $linkMapping->getLinkNormalizer());
        self::assertInstanceOf(NullPolicy::class, $linkMapping->getPolicy());
    }

    public function testGetMapping(): void
    {
        $builder = new MockObjectBuilder();

        /** @var LinkNormalizerInterface|MockObject $linkNormalizer */
        $linkNormalizer = $builder->create(LinkNormalizerInterface::class, []);

        /** @var MockObject|PolicyInterface $policy */
        $policy = $builder->create(PolicyInterface::class, []);

        $linkMapping = NormalizationLinkMappingBuilder::create('name', $linkNormalizer)
            ->setPolicy($policy)
            ->getMapping()
        ;

        self::assertSame('name', $linkMapping->getName());
        self::assertSame($linkNormalizer, $linkMapping->getLinkNormalizer());
        self::assertSame($policy, $linkMapping->getPolicy());
    }
}
