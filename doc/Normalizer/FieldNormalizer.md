# FieldNormalizer

```php
<?php

use Jobcloud\Serialization\Accessor\PropertyAccessor;
use Jobcloud\Serialization\Normalizer\FieldNormalizer;
use MyProject\Model\Model;

$model = new Model;
$context = ...;

$fieldNormalizer = new FieldNormalizer(
    new PropertyAccessor('name')
);

echo $fieldNormalizer->normalizeField(
    'name',
    $model,
    $context
);
// 'php'
```
