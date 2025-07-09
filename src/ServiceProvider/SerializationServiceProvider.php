<?php

declare(strict_types=1);

namespace Jobcloud\Serialization\ServiceProvider;

use Chubbyphp\DecodeEncode\Encoder\Encoder;
use Jobcloud\Serialization\Normalizer\Normalizer;
use Jobcloud\Serialization\Normalizer\NormalizerObjectMappingRegistry;
use Jobcloud\Serialization\Serializer;
use Pimple\Container;
use Pimple\ServiceProviderInterface;

final class SerializationServiceProvider implements ServiceProviderInterface
{
    public function register(Container $container): void
    {
        $container['serializer'] = static fn () => new Serializer($container['serializer.normalizer'], $container['serializer.encoder']);

        $container['serializer.normalizer'] = static fn () => new Normalizer(
            $container['serializer.normalizer.objectmappingregistry'],
            $container['logger'] ?? null
        );

        $container['serializer.normalizer.objectmappingregistry'] = static fn () => new NormalizerObjectMappingRegistry($container['serializer.normalizer.objectmappings']);

        $container['serializer.normalizer.objectmappings'] = static fn () => [];

        $container['serializer.encoder'] = static fn () => new Encoder($container['serializer.encodertypes']);

        $container['serializer.encodertypes'] = static fn () => [];
    }
}
