# NotPolicy

```php
<?php

use Jobcloud\Serialization\Normalizer\NormalizerContextInterface;
use Jobcloud\Serialization\Policy\NotPolicy;
use MyProject\Model\Model;
use MyProject\Policy\SomePolicy;

$model = new Model();

/** @var NormalizerContextInterface $context */
$context = ...;

$policy = new NotPolicy(new SomePolicy());

echo $policy->isCompliant('path', $model, $context);
// 1
```
