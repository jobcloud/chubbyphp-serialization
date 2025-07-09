# NormalizationLinkMapping

```php
<?php

use Jobcloud\Serialization\Link\Link;
use Jobcloud\Serialization\Mapping\NormalizationLinkMapping;
use Jobcloud\Serialization\Normalizer\CallbackLinkNormalizer;
use Jobcloud\Serialization\Normalizer\NormalizerContextInterface;

$fieldMapping = new NormalizationLinkMapping(
    'name',
    ['group1'],
    new CallbackLinkNormalizer(
        function (
            string $path,
            $object,
            NormalizerContextInterface $context
        ) {
            return new Link('/api/model');
        }
    )
);

echo $fieldMapping->getName();
// 'name'

print_r($fieldMapping->getGroups());
// ['group1']

$fieldMapping
    ->getLinkNormalizer()
    ->normalizeLink(...);
```
