# DateTimeFieldNormalizer

```php
<?php

use Jobcloud\Serialization\Accessor\PropertyAccessor;
use Jobcloud\Serialization\Normalizer\DateTimeFieldNormalizer;
use Jobcloud\Serialization\Normalizer\FieldNormalizer;
use MyProject\Model\Model;

$model = new Model;
$context = ...;

$fieldNormalizer = new DateTimeFieldNormalizer(
    new PropertyAccessor('at'),
    'Y-m-d H:i:s'
);

echo $fieldNormalizer->normalizeField(
    'at',
    $model,
    $context
);
// '2017-01-01 22:00:00'
```
