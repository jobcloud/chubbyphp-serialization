<?php

declare(strict_types=1);

namespace Jobcloud\Serialization\ServiceFactory;

use Chubbyphp\Laminas\Config\Factory\AbstractFactory;
use Jobcloud\Serialization\Normalizer\Normalizer;
use Jobcloud\Serialization\Normalizer\NormalizerInterface;
use Jobcloud\Serialization\Normalizer\NormalizerObjectMappingRegistryInterface;
use Psr\Container\ContainerInterface;
use Psr\Log\LoggerInterface;
use Psr\Log\NullLogger;

final class NormalizerFactory extends AbstractFactory
{
    public function __invoke(ContainerInterface $container): NormalizerInterface
    {
        /** @var NormalizerObjectMappingRegistryInterface $normalizerObjectMappingRegistry */
        $normalizerObjectMappingRegistry = $this->resolveDependency(
            $container,
            NormalizerObjectMappingRegistryInterface::class,
            NormalizerObjectMappingRegistryFactory::class
        );

        /** @var LoggerInterface $logger */
        $logger = $container->has(LoggerInterface::class) ? $container->get(LoggerInterface::class) : new NullLogger();

        return new Normalizer($normalizerObjectMappingRegistry, $logger);
    }
}
