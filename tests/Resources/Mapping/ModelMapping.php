<?php

declare(strict_types=1);

namespace Jobcloud\Tests\Serialization\Resources\Mapping;

use Jobcloud\Serialization\Link\LinkBuilder;
use Jobcloud\Serialization\Mapping\NormalizationFieldMappingBuilder;
use Jobcloud\Serialization\Mapping\NormalizationFieldMappingInterface;
use Jobcloud\Serialization\Mapping\NormalizationLinkMapping;
use Jobcloud\Serialization\Mapping\NormalizationLinkMappingInterface;
use Jobcloud\Serialization\Mapping\NormalizationObjectMappingInterface;
use Jobcloud\Serialization\Normalizer\CallbackLinkNormalizer;
use Jobcloud\Serialization\Policy\AndPolicy;
use Jobcloud\Serialization\Policy\CallbackPolicy;
use Jobcloud\Serialization\Policy\GroupPolicy;
use Jobcloud\Serialization\Policy\NullPolicy;
use Jobcloud\Serialization\Policy\OrPolicy;
use Jobcloud\Tests\Serialization\Resources\Model\Model;

final class ModelMapping implements NormalizationObjectMappingInterface
{
    public function getClass(): string
    {
        return Model::class;
    }

    public function getNormalizationType(): string
    {
        return 'model';
    }

    /**
     * @return array<int, NormalizationFieldMappingInterface>
     */
    public function getNormalizationFieldMappings(string $path, ?string $type = null): array
    {
        return [
            NormalizationFieldMappingBuilder::create('id')
                ->setPolicy(new AndPolicy([
                    new NullPolicy(),
                    new OrPolicy([
                        new CallbackPolicy(static fn () => false),
                        new NullPolicy(),
                    ]),
                ]))
                ->getMapping(),
            NormalizationFieldMappingBuilder::create('name')
                ->setPolicy(new GroupPolicy([]))
                ->getMapping(),
            NormalizationFieldMappingBuilder::create('additionalInfo')
                ->setPolicy(new GroupPolicy(['additionalInfo']))
                ->getMapping(),
            NormalizationFieldMappingBuilder::create('hiddenProperty')
                ->setPolicy(new AndPolicy([
                    new NullPolicy(),
                    new OrPolicy([
                        new CallbackPolicy(static fn () => false),
                    ]),
                ]))
                ->getMapping(),
            NormalizationFieldMappingBuilder::createEmbedOne('one')->getMapping(),
            NormalizationFieldMappingBuilder::createEmbedMany('manies')->getMapping(),
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
        return [
            new NormalizationLinkMapping(
                'self',
                new CallbackLinkNormalizer(
                    static fn (string $path, Model $model) => LinkBuilder::create('/api/model/'.$model->getId())
                        ->setAttributes([
                            'method' => 'GET',
                        ])
                        ->getLink()
                )
            ),
        ];
    }
}
