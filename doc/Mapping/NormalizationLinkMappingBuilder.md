# NormalizationLinkMappingBuilder

```php
<?php

use Jobcloud\Serialization\Link\Link;
use Jobcloud\Serialization\Mapping\NormalizationLinkMappingBuilder;
use Jobcloud\Serialization\Normalizer\CallbackLinkNormalizer;
use Jobcloud\Serialization\Normalizer\NormalizerContextInterface;

$fieldMapping = NormalizationLinkMappingBuilder::create(
    'name',
    new CallbackLinkNormalizer(
        function (
            string $path,
            $object,
            NormalizerContextInterface $context
        ) {
            return new Link('/api/model');
        }
    )
)
->getMapping();

echo $fieldMapping->getName();
// 'name'

print_r($fieldMapping->getGroups());
// ['group1']

$fieldMapping
    ->getLinkNormalizer()
    ->normalizeLink(...);
```
