# MethodAccessor

```php
<?php

use Jobcloud\Serialization\Accessor\MethodAccessor;
use MyProject\Model;

$object = new Model;
$object->setName('php');

$accessor = new MethodAccessor('name');

echo $accessor->getValue($object);
// 'php'
```
