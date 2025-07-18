<?php

declare(strict_types=1);

namespace Jobcloud\Serialization\ServiceFactory;

use Chubbyphp\DecodeEncode\Encoder\Encoder;
use Jobcloud\Serialization\Normalizer\Normalizer;
use Jobcloud\Serialization\Normalizer\NormalizerObjectMappingRegistry;
use Jobcloud\Serialization\Serializer;
use Psr\Container\ContainerInterface;

final class SerializationServiceFactory
{
    /**
     * @return array<string, callable>
     */
    public function __invoke(): array
    {
        return [
            'serializer' => static fn (ContainerInterface $container) => new Serializer(
                $container->get('serializer.normalizer'),
                $container->get('serializer.encoder')
            ),
            'serializer.normalizer' => static fn (ContainerInterface $container) => new Normalizer(
                $container->get('serializer.normalizer.objectmappingregistry'),
                $container->has('logger') ? $container->get('logger') : null
            ),
            'serializer.normalizer.objectmappingregistry' => static fn (ContainerInterface $container) => new NormalizerObjectMappingRegistry($container->get('serializer.normalizer.objectmappings')),
            'serializer.normalizer.objectmappings' => static fn () => [],
            'serializer.encoder' => static fn (ContainerInterface $container) => new Encoder($container->get('serializer.encodertypes')),
            'serializer.encodertypes' => static fn () => [],
        ];
    }
}
