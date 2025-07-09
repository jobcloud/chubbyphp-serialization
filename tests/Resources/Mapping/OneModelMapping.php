<?php

declare(strict_types=1);

namespace Jobcloud\Tests\Serialization\Resources\Mapping;

use Jobcloud\Serialization\Mapping\NormalizationFieldMappingBuilder;
use Jobcloud\Serialization\Mapping\NormalizationFieldMappingInterface;
use Jobcloud\Serialization\Mapping\NormalizationLinkMappingInterface;
use Jobcloud\Serialization\Mapping\NormalizationObjectMappingInterface;
use Jobcloud\Tests\Serialization\Resources\Model\OneModel;

final class OneModelMapping implements NormalizationObjectMappingInterface
{
    public function getClass(): string
    {
        return OneModel::class;
    }

    public function getNormalizationType(): string
    {
        return 'one-model';
    }

    /**
     * @return array<int, NormalizationFieldMappingInterface>
     */
    public function getNormalizationFieldMappings(string $path): array
    {
        return [
            NormalizationFieldMappingBuilder::create('name')->getMapping(),
            NormalizationFieldMappingBuilder::create('value')->getMapping(),
        ];
    }

    /**
     * @return array<int, NormalizationFieldMappingInterface>
     */
    public function getNormalizationEmbeddedFieldMappings(string $path): array
    {
        return [];
    }

    /**
     * @return array<int, NormalizationLinkMappingInterface>
     */
    public function getNormalizationLinkMappings(string $path): array
    {
        return [];
    }
}
