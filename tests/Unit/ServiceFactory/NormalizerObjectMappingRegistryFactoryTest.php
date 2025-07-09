<?php

declare(strict_types=1);

namespace Jobcloud\Tests\Serialization\Unit\ServiceFactory;

use Chubbyphp\Mock\MockMethod\WithReturn;
use Chubbyphp\Mock\MockObjectBuilder;
use Jobcloud\Serialization\Mapping\NormalizationObjectMappingInterface;
use Jobcloud\Serialization\Normalizer\NormalizerObjectMappingRegistryInterface;
use Jobcloud\Serialization\ServiceFactory\NormalizerObjectMappingRegistryFactory;
use PHPUnit\Framework\TestCase;
use Psr\Container\ContainerInterface;

/**
 * @covers \Jobcloud\Serialization\ServiceFactory\NormalizerObjectMappingRegistryFactory
 *
 * @internal
 */
final class NormalizerObjectMappingRegistryFactoryTest extends TestCase
{
    public function testInvoke(): void
    {
        $builder = new MockObjectBuilder();

        /** @var ContainerInterface $container */
        $container = $builder->create(ContainerInterface::class, [
            new WithReturn('get', [NormalizationObjectMappingInterface::class.'[]'], []),
        ]);

        $factory = new NormalizerObjectMappingRegistryFactory();

        $service = $factory($container);

        self::assertInstanceOf(NormalizerObjectMappingRegistryInterface::class, $service);
    }

    public function testCallStatic(): void
    {
        $builder = new MockObjectBuilder();

        /** @var ContainerInterface $container */
        $container = $builder->create(ContainerInterface::class, [
            new WithReturn('get', [NormalizationObjectMappingInterface::class.'[]default'], []),
        ]);

        $factory = [NormalizerObjectMappingRegistryFactory::class, 'default'];

        $service = $factory($container);

        self::assertInstanceOf(NormalizerObjectMappingRegistryInterface::class, $service);
    }
}
