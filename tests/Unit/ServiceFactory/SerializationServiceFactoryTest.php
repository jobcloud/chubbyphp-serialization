<?php

declare(strict_types=1);

namespace Jobcloud\Tests\Serialization\Unit\ServiceFactory;

use Chubbyphp\Container\Container;
use Chubbyphp\DecodeEncode\Encoder\Encoder;
use Chubbyphp\Mock\MockObjectBuilder;
use Jobcloud\Serialization\Normalizer\Normalizer;
use Jobcloud\Serialization\Normalizer\NormalizerObjectMappingRegistry;
use Jobcloud\Serialization\Serializer;
use Jobcloud\Serialization\ServiceFactory\SerializationServiceFactory;
use PHPUnit\Framework\TestCase;
use Psr\Log\LoggerInterface;
use Psr\Log\NullLogger;

/**
 * @covers \Jobcloud\Serialization\ServiceFactory\SerializationServiceFactory
 *
 * @internal
 */
final class SerializationServiceFactoryTest extends TestCase
{
    public function testRegister(): void
    {
        $container = new Container();
        $container->factories((new SerializationServiceFactory())());

        self::assertTrue($container->has('serializer'));

        self::assertTrue($container->has('serializer.normalizer'));
        self::assertTrue($container->has('serializer.normalizer.objectmappingregistry'));
        self::assertTrue($container->has('serializer.normalizer.objectmappings'));

        self::assertTrue($container->has('serializer.encoder'));
        self::assertTrue($container->has('serializer.encodertypes'));

        self::assertInstanceOf(Serializer::class, $container->get('serializer'));

        self::assertInstanceOf(Normalizer::class, $container->get('serializer.normalizer'));
        self::assertInstanceOf(
            NormalizerObjectMappingRegistry::class,
            $container->get('serializer.normalizer.objectmappingregistry')
        );
        self::assertIsArray($container->get('serializer.normalizer.objectmappings'));

        self::assertInstanceOf(Encoder::class, $container->get('serializer.encoder'));
        self::assertIsArray($container->get('serializer.encodertypes'));

        /** @var Normalizer $normalizer */
        $normalizer = $container->get('serializer.normalizer');

        self::assertInstanceOf(Normalizer::class, $normalizer);

        $reflectionProperty = new \ReflectionProperty($normalizer, 'logger');
        $reflectionProperty->setAccessible(true);

        self::assertInstanceOf(NullLogger::class, $reflectionProperty->getValue($normalizer));
    }

    public function testRegisterWithDefinedLogger(): void
    {
        $builder = new MockObjectBuilder();

        /** @var LoggerInterface $logger */
        $logger = $builder->create(LoggerInterface::class, []);

        $container = new Container([
            'logger' => static fn () => $logger,
        ]);

        $container->factories((new SerializationServiceFactory())());

        /** @var Normalizer $normalizer */
        $normalizer = $container->get('serializer.normalizer');

        self::assertInstanceOf(Normalizer::class, $normalizer);

        $reflectionProperty = new \ReflectionProperty($normalizer, 'logger');
        $reflectionProperty->setAccessible(true);

        self::assertSame($logger, $reflectionProperty->getValue($normalizer));
    }
}
