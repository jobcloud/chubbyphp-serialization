# ReferenceOneFieldNormalizer

```php
<?php

use Jobcloud\Serialization\Accessor\PropertyAccessor;
use Jobcloud\Serialization\Normalizer\Relation\ReferenceOneFieldNormalizer;
use MyProject\Model\Model;
use MyProject\Model\RelationModel;

$model = new Model;
$model->setReference((new RelationModel)->setName('php'));

$context = ...;
$normalizer = ...;

$fieldNormalizer = new ReferenceOneFieldNormalizer(
    new PropertyAccessor('id'),
    new PropertyAccessor('children')
);

$data = $fieldNormalizer->normalizeField(
    'reference',
    $model,
    $context,
    $normalizer
);

echo $data;
// '4b184500-38d3-4cdf-b0ec-d36a61d1f9cd'
```
