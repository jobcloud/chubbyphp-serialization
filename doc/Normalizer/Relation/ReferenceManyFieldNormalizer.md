# ReferenceManyFieldNormalizer

```php
<?php

use Jobcloud\Serialization\Accessor\PropertyAccessor;
use Jobcloud\Serialization\Normalizer\Relation\ReferenceManyFieldNormalizer;
use MyProject\Model\ParentModel;
use MyProject\Model\ChildModel;

$parentModel = new ParentModel;
$parentModel->setChildren([(new ChildModel)->setName('php')]);
$context = ...;
$normalizer = ...;

$fieldNormalizer = new ReferenceManyFieldNormalizer(
    new PropertyAccessor('id'),
    new PropertyAccessor('children')
);

$data = $fieldNormalizer->normalizeField(
    'children',
    $parentModel,
    $context,
    $normalizer
);

print_r(
    $data
);
// ['4b184500-38d3-4cdf-b0ec-d36a61d1f9cd']
```
