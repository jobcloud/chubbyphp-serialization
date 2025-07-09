# NormalizerObjectMappingRegistryFactory

## without name (default)

```php
<?php

use Jobcloud\Serialization\Mapping\NormalizationObjectMappingInterface;
use Jobcloud\Serialization\ServiceFactory\NormalizerObjectMappingRegistryFactory;
use Psr\Container\ContainerInterface;

/** @var ContainerInterface $container */
$container = ...;

// $container->get(NormalizationObjectMappingInterface::class.'[]')

$factory = new NormalizerObjectMappingRegistryFactory();

$normalizerObjectMappingRegistry = $factory($container);
```

## with name `default`

```php
<?php

use Jobcloud\Serialization\Mapping\NormalizationObjectMappingInterface;
use Jobcloud\Serialization\ServiceFactory\NormalizerObjectMappingRegistryFactory;
use Psr\Container\ContainerInterface;

/** @var ContainerInterface $container */
$container = ...;

// $container->get(NormalizationObjectMappingInterface::class.'[]default')

$factory = [NormalizerObjectMappingRegistryFactory::class, 'default'];

$normalizerObjectMappingRegistry = $factory($container);
```
