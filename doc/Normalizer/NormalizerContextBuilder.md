# NormalizerContextBuilder

```php
<?php

use Jobcloud\Serialization\Normalizer\NormalizerContextBuilder;
use Psr\Http\Message\ServerRequestInterface;

$request = ...;

$context = NormalizerContextBuilder::create()
    ->setRequest($request)
    ->setAttributes(['key' => 'value'])
    ->getContext();

print_r($context->getAttributes());
// ['key' => 'value']

$request = $context->getRequest();
```
