# CallbackFieldNormalizer

```php
<?php

use Jobcloud\Serialization\Normalizer\CallbackFieldNormalizer;
use Jobcloud\Serialization\Normalizer\NormalizerContextInterface;
use Jobcloud\Serialization\Normalizer\NormalizerInterface;
use MyProject\Model\Model;

$model = new Model;
$context = ...;

$fieldNormalizer = new CallbackFieldNormalizer(
    function (
        string $path,
        object $object,
        NormalizerContextInterface $context,
        NormalizerInterface $normalizer = null
    ) {
        return $object->getName();
    }
);

echo $fieldNormalizer->normalizeField(
    'name',
    $model,
    $context
);
// 'php'
```
