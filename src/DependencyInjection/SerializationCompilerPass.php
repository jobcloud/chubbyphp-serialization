<?php

declare(strict_types=1);

namespace Jobcloud\Serialization\DependencyInjection;

use Chubbyphp\DecodeEncode\Encoder\Encoder;
use Jobcloud\Serialization\Normalizer\Normalizer;
use Jobcloud\Serialization\Normalizer\NormalizerObjectMappingRegistry;
use Jobcloud\Serialization\Serializer;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\DependencyInjection\Reference;

final class SerializationCompilerPass implements CompilerPassInterface
{
    public function process(ContainerBuilder $container): void
    {
        $container->register('chubbyphp.serializer', Serializer::class)->setPublic(true)->setArguments([
            new Reference('chubbyphp.serializer.normalizer'),
            new Reference('chubbyphp.serializer.encoder'),
        ]);

        $container
            ->register('chubbyphp.serializer.normalizer', Normalizer::class)
            ->setPublic(true)
            ->setArguments([
                new Reference('chubbyphp.serializer.normalizer.objectmappingregistry'),
                new Reference('logger', ContainerInterface::IGNORE_ON_INVALID_REFERENCE),
            ])
        ;

        $this->registerObjectmappingRegistry($container);
        $this->registerEncoder($container);
    }

    private function registerObjectmappingRegistry(ContainerBuilder $container): void
    {
        $normalizerObjectMappingReferences = [];
        foreach (array_keys($container->findTaggedServiceIds('chubbyphp.serializer.normalizer.objectmapping')) as $id) {
            $normalizerObjectMappingReferences[] = new Reference($id);
        }

        $container
            ->register(
                'chubbyphp.serializer.normalizer.objectmappingregistry',
                NormalizerObjectMappingRegistry::class
            )
            ->setPublic(true)
            ->setArguments([$normalizerObjectMappingReferences])
        ;
    }

    private function registerEncoder(ContainerBuilder $container): void
    {
        $encoderTypeReferences = [];
        foreach (array_keys($container->findTaggedServiceIds('chubbyphp.serializer.encoder.type')) as $id) {
            $encoderTypeReferences[] = new Reference($id);
        }

        $container
            ->register('chubbyphp.serializer.encoder', Encoder::class)
            ->setPublic(true)
            ->setArguments([$encoderTypeReferences])
        ;
    }
}
