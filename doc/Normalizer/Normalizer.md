## Normalizer

```php
<?php

use Jobcloud\Serialization\Normalizer\Normalizer;
use Jobcloud\Serialization\Normalizer\NormalizerObjectMappingRegistry;
use MyProject\Serialization\ModelMapping;
use MyProject\Model\Model;

$logger = ...;

$normalizer = new Normalizer(
    new NormalizerObjectMappingRegistry([
        new ModelMapping()
    ]),
    $logger
);

$model = new Model;
$model->setName('php');

$data = $normalizer->normalize(
    $model
);

print_r($data);
// ['name' => 'php']
```
