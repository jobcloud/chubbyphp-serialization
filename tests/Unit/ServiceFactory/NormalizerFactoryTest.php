<?php

declare(strict_types=1);

namespace Jobcloud\Tests\Serialization\Unit\ServiceFactory;

use Chubbyphp\Mock\MockMethod\WithReturn;
use Chubbyphp\Mock\MockObjectBuilder;
use Jobcloud\Serialization\Normalizer\NormalizerInterface;
use Jobcloud\Serialization\Normalizer\NormalizerObjectMappingRegistryInterface;
use Jobcloud\Serialization\ServiceFactory\NormalizerFactory;
use PHPUnit\Framework\TestCase;
use Psr\Container\ContainerInterface;
use Psr\Log\LoggerInterface;

/**
 * @covers \Jobcloud\Serialization\ServiceFactory\NormalizerFactory
 *
 * @internal
 */
final class NormalizerFactoryTest extends TestCase
{
    public function testInvoke(): void
    {
        $builder = new MockObjectBuilder();

        /** @var NormalizerObjectMappingRegistryInterface $normalizerObjectMappingRegistry */
        $normalizerObjectMappingRegistry = $builder->create(NormalizerObjectMappingRegistryInterface::class, []);

        /** @var ContainerInterface $container */
        $container = $builder->create(ContainerInterface::class, [
            new WithReturn('has', [NormalizerObjectMappingRegistryInterface::class], true),
            new WithReturn('get', [NormalizerObjectMappingRegistryInterface::class], $normalizerObjectMappingRegistry),
            new WithReturn('has', [LoggerInterface::class], false),
        ]);

        $factory = new NormalizerFactory();

        $service = $factory($container);

        self::assertInstanceOf(NormalizerInterface::class, $service);
    }

    public function testCallStatic(): void
    {
        $builder = new MockObjectBuilder();

        /** @var NormalizerObjectMappingRegistryInterface $normalizerObjectMappingRegistry */
        $normalizerObjectMappingRegistry = $builder->create(NormalizerObjectMappingRegistryInterface::class, []);

        /** @var ContainerInterface $container */
        $container = $builder->create(ContainerInterface::class, [
            new WithReturn('has', [NormalizerObjectMappingRegistryInterface::class.'default'], true),
            new WithReturn('get', [NormalizerObjectMappingRegistryInterface::class.'default'], $normalizerObjectMappingRegistry),
            new WithReturn('has', [LoggerInterface::class], false),
        ]);

        $factory = [NormalizerFactory::class, 'default'];

        $service = $factory($container);

        self::assertInstanceOf(NormalizerInterface::class, $service);
    }
}
