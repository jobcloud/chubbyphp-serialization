# CallbackPolicy

```php
<?php

use Jobcloud\Serialization\Normalizer\NormalizerContextInterface;
use Jobcloud\Serialization\Policy\CallbackPolicy;
use MyProject\Model\Model;

$model = new Model();

/** @var NormalizerContextInterface $context */
$context = ...;

$policy = new CallbackPolicy(function (string $path, object $object, NormalizerContextInterface $context) {
    return true;
});

echo $policy->isCompliant('path', $model, $context);
// 1
```
