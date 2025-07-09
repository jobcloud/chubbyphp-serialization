# NormalizationFieldMappingBuilder

```php
<?php

use Jobcloud\Serialization\Accessor\PropertyAccessor;
use Jobcloud\Serialization\Normalizer\FieldNormalizer;
use Jobcloud\Serialization\Mapping\NormalizationFieldMappingBuilder;

$fieldMapping = NormalizationFieldMappingBuilder::create('name')
    ->setFieldNormalizer(
        new FieldNormalizer(
            new PropertyAccessor('name')
        )
    )
    ->getMapping();

echo $fieldMapping->getName();
// 'name'

print_r($fieldMapping->getGroups());
// ['group1']

$fieldMapping
    ->getFieldNormalizer()
    ->normalizeField(...);
```
