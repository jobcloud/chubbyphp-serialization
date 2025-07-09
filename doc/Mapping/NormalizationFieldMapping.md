# NormalizationFieldMapping

```php
<?php

use Jobcloud\Serialization\Accessor\PropertyAccessor;
use Jobcloud\Serialization\Normalizer\FieldNormalizer;
use Jobcloud\Serialization\Mapping\NormalizationFieldMapping;

$fieldMapping = new NormalizationFieldMapping(
    'name',
    ['group1'],
    new FieldNormalizer(
        new PropertyAccessor('name')
    )
);

echo $fieldMapping->getName();
// 'name'

print_r($fieldMapping->getGroups());
// ['group1']

$fieldMapping
    ->getFieldNormalizer()
    ->normalizeField(...);
```
