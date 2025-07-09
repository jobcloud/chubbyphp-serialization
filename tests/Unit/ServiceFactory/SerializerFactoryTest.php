<?php

declare(strict_types=1);

namespace Jobcloud\Tests\Serialization\Unit\ServiceFactory;

use Chubbyphp\DecodeEncode\Encoder\EncoderInterface;
use Chubbyphp\Mock\MockMethod\WithReturn;
use Chubbyphp\Mock\MockObjectBuilder;
use Jobcloud\Serialization\Normalizer\NormalizerInterface;
use Jobcloud\Serialization\SerializerInterface;
use Jobcloud\Serialization\ServiceFactory\SerializerFactory;
use PHPUnit\Framework\TestCase;
use Psr\Container\ContainerInterface;

/**
 * @covers \Jobcloud\Serialization\ServiceFactory\SerializerFactory
 *
 * @internal
 */
final class SerializerFactoryTest extends TestCase
{
    public function testInvoke(): void
    {
        $builder = new MockObjectBuilder();

        /** @var NormalizerInterface $normalizer */
        $normalizer = $builder->create(NormalizerInterface::class, []);

        /** @var EncoderInterface $encoder */
        $encoder = $builder->create(EncoderInterface::class, []);

        /** @var ContainerInterface $container */
        $container = $builder->create(ContainerInterface::class, [
            new WithReturn('has', [NormalizerInterface::class], true),
            new WithReturn('get', [NormalizerInterface::class], $normalizer),
            new WithReturn('has', [EncoderInterface::class], true),
            new WithReturn('get', [EncoderInterface::class], $encoder),
        ]);

        $factory = new SerializerFactory();

        $service = $factory($container);

        self::assertInstanceOf(SerializerInterface::class, $service);
    }

    public function testCallStatic(): void
    {
        $builder = new MockObjectBuilder();

        /** @var NormalizerInterface $normalizer */
        $normalizer = $builder->create(NormalizerInterface::class, []);

        /** @var EncoderInterface $encoder */
        $encoder = $builder->create(EncoderInterface::class, []);

        /** @var ContainerInterface $container */
        $container = $builder->create(ContainerInterface::class, [
            new WithReturn('has', [NormalizerInterface::class.'default'], true),
            new WithReturn('get', [NormalizerInterface::class.'default'], $normalizer),
            new WithReturn('has', [EncoderInterface::class.'default'], true),
            new WithReturn('get', [EncoderInterface::class.'default'], $encoder),
        ]);

        $factory = [SerializerFactory::class, 'default'];

        $service = $factory($container);

        self::assertInstanceOf(SerializerInterface::class, $service);
    }
}
