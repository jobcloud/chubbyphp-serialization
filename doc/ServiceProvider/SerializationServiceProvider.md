# SerializationServiceProvider

```php
<?php

use Jobcloud\Serialization\ServiceProvider\SerializationServiceProvider;
use Pimple\Container;

$container = new Container();
$container->register(new SerializationServiceProvider);

$container['serializer']
    ->serialize(...);

$container['serializer.normalizer']
    ->normalize(...);

$container['serializer.encoder']
    ->encode(...);
```
