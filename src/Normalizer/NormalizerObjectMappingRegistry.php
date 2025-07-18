<?php

declare(strict_types=1);

namespace Jobcloud\Serialization\Normalizer;

use Jobcloud\Serialization\Mapping\NormalizationObjectMappingInterface;
use Jobcloud\Serialization\SerializerLogicException;

final class NormalizerObjectMappingRegistry implements NormalizerObjectMappingRegistryInterface
{
    /**
     * @var array<string, NormalizationObjectMappingInterface>
     */
    private array $objectMappings;

    /**
     * @param array<int, NormalizationObjectMappingInterface> $objectMappings
     */
    public function __construct(array $objectMappings)
    {
        $this->objectMappings = [];
        foreach ($objectMappings as $objectMapping) {
            $this->addObjectMapping($objectMapping);
        }
    }

    /**
     * @param class-string $class
     *
     * @throws SerializerLogicException
     */
    public function getObjectMapping(string $class): NormalizationObjectMappingInterface
    {
        $reflectionClass = new \ReflectionClass($class);

        if (\in_array('Doctrine\Persistence\Proxy', $reflectionClass->getInterfaceNames(), true)) {
            /** @var \ReflectionClass $parentReflectionClass */
            $parentReflectionClass = $reflectionClass->getParentClass();
            $class = $parentReflectionClass->getName();
        }

        if (isset($this->objectMappings[$class])) {
            return $this->objectMappings[$class];
        }

        throw SerializerLogicException::createMissingMapping($class);
    }

    private function addObjectMapping(NormalizationObjectMappingInterface $objectMapping): void
    {
        $this->objectMappings[$objectMapping->getClass()] = $objectMapping;
    }
}
