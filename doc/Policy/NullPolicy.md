# NullPolicy

```php
<?php

use Jobcloud\Serialization\Normalizer\NormalizerContextInterface;
use Jobcloud\Serialization\Policy\NullPolicy;
use MyProject\Model\Model;

$model = new Model();

/** @var NormalizerContextInterface $context */
$context = ...;

$policy = new NullPolicy();

echo $policy->isCompliant('path', $model, $context);
// 1
```
