# GroupPolicy

```php
<?php

use Jobcloud\Serialization\Normalizer\NormalizerContextInterface;
use Jobcloud\Serialization\Policy\GroupPolicy;
use MyProject\Model\Model;

$model = new Model();

/** @var NormalizerContextInterface $context */
$context = ...;
$context = $context->withAttribute('groups', ['group1']);

$policy = new GroupPolicy(['group1']);

echo $policy->isCompliant('path', $model, $context);
// 1
```
