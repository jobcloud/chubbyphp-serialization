# CallbackLinkNormalizer

```php
<?php

use Jobcloud\Serialization\Link\Link;
use Jobcloud\Serialization\Normalizer\CallbackLinkNormalizer;
use Jobcloud\Serialization\Normalizer\NormalizerContextInterface;
use MyProject\Model\Model;

$model = new Model;
$context = ...;

$fieldNormalizer = new CallbackLinkNormalizer(
    function (
        string $path,
        object $object,
        NormalizerContextInterface $context
    ) {
        return new Link('/api/model');
    }
);

echo $fieldNormalizer->normalizeLink(
    '',
    $model,
    $context
);
// 'php'
```
