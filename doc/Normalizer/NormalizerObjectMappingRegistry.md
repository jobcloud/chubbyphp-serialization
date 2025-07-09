# NormalizerObjectMappingRegistry

```php
<?php

use Jobcloud\Serialization\Normalizer\NormalizerObjectMappingRegistry;

$registry = new NormalizerObjectMappingRegistry([]);

echo $registry->getObjectMapping('class')->getClass();
// 'class'
```
