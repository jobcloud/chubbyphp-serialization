# SimpleNormalizationObjectMapping

## Mapping

### ModelMapping

```php
<?php

namespace MyProject\Serialization;

use Jobcloud\Serialization\Link\LinkBuilder;
use Jobcloud\Serialization\Mapping\NormalizationFieldMappingBuilder;
use Jobcloud\Serialization\Mapping\NormalizationFieldMappingInterface;
use Jobcloud\Serialization\Mapping\NormalizationLinkMapping;
use Jobcloud\Serialization\Mapping\NormalizationLinkMappingInterface;
use Jobcloud\Serialization\Mapping\NormalizationObjectMappingInterface;
use Jobcloud\Serialization\Normalizer\CallbackLinkNormalizer;
use MyProject\Model\Model;

final class ModelMapping implements NormalizationObjectMappingInterface
{
    /**
     * @return string
     */
    public function getClass(): string
    {
        return Model::class;
    }

    /**
     * @return string
     */
    public function getNormalizationType(): string
    {
        return 'model';
    }

    /**
     * @param string      $path
     * @param string|null $type
     *
     * @return array<int, NormalizationFieldMappingInterface>
     */
    public function getNormalizationFieldMappings(string $path, string $type = null): array
    {
        return [
            NormalizationFieldMappingBuilder::create('id')->getMapping(),
            NormalizationFieldMappingBuilder::create('name')->getMapping(),
        ];
    }

    /**
     * @param string $path
     *
     * @return array<int, NormalizationFieldMappingInterface>
     */
    public function getNormalizationEmbeddedFieldMappings(string $path): array
    {
        return [];
    }

    /**
     * @param string $path
     *
     * @return array<int, NormalizationLinkMappingInterface>
     */
    public function getNormalizationLinkMappings(string $path): array
    {
        return [
            new NormalizationLinkMapping(
                'self',
                [],
                new CallbackLinkNormalizer(
                    function (string $path, Model $model) {
                        return LinkBuilder::create('/api/model/' . $model->getId())
                            ->setAttributes([
                                'method' => 'GET'
                            ])
                            ->getLink();
                    }
                )
            ),
        ];
    }
}
```

## Model

### Model

```php
<?php

namespace MyProject\Model;

final class Model
{
    /**
     * @var string
     */
    private $id;

    /**
     * @var string
     */
    private $name;

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     *
     * @return self
     */
    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }
}
```
