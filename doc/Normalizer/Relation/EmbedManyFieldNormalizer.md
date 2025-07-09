# EmbedManyFieldNormalizer

```php
<?php

use Jobcloud\Serialization\Accessor\PropertyAccessor;
use Jobcloud\Serialization\Normalizer\Relation\EmbedManyFieldNormalizer;
use MyProject\Model\ParentModel;
use MyProject\Model\ChildModel;

$parentModel = new ParentModel;
$parentModel->setChildren([(new ChildModel)->setName('php')]);
$context = ...;
$normalizer = ...;

$fieldNormalizer = new EmbedManyFieldNormalizer(
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
// [['name' => 'php']]
```
