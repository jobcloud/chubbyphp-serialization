<?php

declare(strict_types=1);

namespace Jobcloud\Serialization\ServiceFactory;

use Chubbyphp\Laminas\Config\Factory\AbstractFactory;
use Jobcloud\Serialization\Mapping\NormalizationObjectMappingInterface;
use Jobcloud\Serialization\Normalizer\NormalizerObjectMappingRegistry;
use Jobcloud\Serialization\Normalizer\NormalizerObjectMappingRegistryInterface;
use Psr\Container\ContainerInterface;

final class NormalizerObjectMappingRegistryFactory extends AbstractFactory
{
    public function __invoke(ContainerInterface $container): NormalizerObjectMappingRegistryInterface
    {
        return new NormalizerObjectMappingRegistry(
            $container->get(NormalizationObjectMappingInterface::class.'[]'.$this->name)
        );
    }
}
