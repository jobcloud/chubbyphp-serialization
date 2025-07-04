# chubbyphp-serialization

[![CI](https://github.com/chubbyphp/chubbyphp-serialization/actions/workflows/ci.yml/badge.svg)](https://github.com/chubbyphp/chubbyphp-serialization/actions/workflows/ci.yml)
[![Coverage Status](https://coveralls.io/repos/github/chubbyphp/chubbyphp-serialization/badge.svg?branch=master)](https://coveralls.io/github/chubbyphp/chubbyphp-serialization?branch=master)
[![Mutation testing badge](https://img.shields.io/endpoint?style=flat&url=https%3A%2F%2Fbadge-api.stryker-mutator.io%2Fgithub.com%2Fchubbyphp%2Fchubbyphp-serialization%2Fmaster)](https://dashboard.stryker-mutator.io/reports/github.com/chubbyphp/chubbyphp-serialization/master)
[![Latest Stable Version](https://poser.pugx.org/chubbyphp/chubbyphp-serialization/v)](https://packagist.org/packages/chubbyphp/chubbyphp-serialization)
[![Total Downloads](https://poser.pugx.org/chubbyphp/chubbyphp-serialization/downloads)](https://packagist.org/packages/chubbyphp/chubbyphp-serialization)
[![Monthly Downloads](https://poser.pugx.org/chubbyphp/chubbyphp-serialization/d/monthly)](https://packagist.org/packages/chubbyphp/chubbyphp-serialization)

[![bugs](https://sonarcloud.io/api/project_badges/measure?project=chubbyphp_chubbyphp-serialization&metric=bugs)](https://sonarcloud.io/dashboard?id=chubbyphp_chubbyphp-serialization)
[![code_smells](https://sonarcloud.io/api/project_badges/measure?project=chubbyphp_chubbyphp-serialization&metric=code_smells)](https://sonarcloud.io/dashboard?id=chubbyphp_chubbyphp-serialization)
[![coverage](https://sonarcloud.io/api/project_badges/measure?project=chubbyphp_chubbyphp-serialization&metric=coverage)](https://sonarcloud.io/dashboard?id=chubbyphp_chubbyphp-serialization)
[![duplicated_lines_density](https://sonarcloud.io/api/project_badges/measure?project=chubbyphp_chubbyphp-serialization&metric=duplicated_lines_density)](https://sonarcloud.io/dashboard?id=chubbyphp_chubbyphp-serialization)
[![ncloc](https://sonarcloud.io/api/project_badges/measure?project=chubbyphp_chubbyphp-serialization&metric=ncloc)](https://sonarcloud.io/dashboard?id=chubbyphp_chubbyphp-serialization)
[![sqale_rating](https://sonarcloud.io/api/project_badges/measure?project=chubbyphp_chubbyphp-serialization&metric=sqale_rating)](https://sonarcloud.io/dashboard?id=chubbyphp_chubbyphp-serialization)
[![alert_status](https://sonarcloud.io/api/project_badges/measure?project=chubbyphp_chubbyphp-serialization&metric=alert_status)](https://sonarcloud.io/dashboard?id=chubbyphp_chubbyphp-serialization)
[![reliability_rating](https://sonarcloud.io/api/project_badges/measure?project=chubbyphp_chubbyphp-serialization&metric=reliability_rating)](https://sonarcloud.io/dashboard?id=chubbyphp_chubbyphp-serialization)
[![security_rating](https://sonarcloud.io/api/project_badges/measure?project=chubbyphp_chubbyphp-serialization&metric=security_rating)](https://sonarcloud.io/dashboard?id=chubbyphp_chubbyphp-serialization)
[![sqale_index](https://sonarcloud.io/api/project_badges/measure?project=chubbyphp_chubbyphp-serialization&metric=sqale_index)](https://sonarcloud.io/dashboard?id=chubbyphp_chubbyphp-serialization)
[![vulnerabilities](https://sonarcloud.io/api/project_badges/measure?project=chubbyphp_chubbyphp-serialization&metric=vulnerabilities)](https://sonarcloud.io/dashboard?id=chubbyphp_chubbyphp-serialization)


## Description

A simple serialization.

DEPRECATED: No personal interest anymore.
Please take a look to [chubbyphp-parsing](https://github.com/chubbyphp/chubbyphp-parsing) its a different concept. But i believe parsing is the way to go instead of deserialze/validate.

## Requirements

 * php: ^8.2
 * chubbyphp/chubbyphp-decode-encode: ^1.2
 * doctrine/inflector: ^1.4.4|^2.0.10
 * psr/http-message: ^1.1|^2.0
 * psr/link: ^1.1.1|^2.0.1
 * psr/log: ^2.0|^3.0.2

## Suggest

 * chubbyphp/chubbyphp-container: ^2.2
 * pimple/pimple: ^3.5
 * psr/container: ^2.0.2
 * symfony/config: ^5.4.46|^6.4.14|^7.2 (symfony integration)
 * symfony/dependency-injection: ^5.4.46|^6.4.14|^7.2 (symfony integration)

## Installation

Through [Composer](http://getcomposer.org) as [chubbyphp/chubbyphp-serialization][1].

```sh
composer require jobcloud/chubbyphp-serialization
```

## Usage

### Accessor

 * [MethodAccessor][2]
 * [PropertyAccessor][3]

### Encoder

 * [Encoder][4]

#### Type Encoder

 * [JsonTypeEncoder][5]
 * [JsonxTypeEncoder][6]
 * [UrlEncodedTypeEncoder][7]
 * [XmlTypeEncoder][8]
 * [YamlTypeEncoder][9]

### Link

 * [Link][10]
 * [LinkBuilder][11]

### Normalizer

 * [Normalizer][12]

#### Field Normalizer

 * [CallbackFieldNormalizer][13]
 * [DateTimeFieldNormalizer][14]
 * [FieldNormalizer][15]

##### Relation Field Normalizer

 * [EmbedManyFieldNormalizer][16]
 * [EmbedOneFieldNormalizer][17]
 * [ReferenceManyFieldNormalizer][18]
 * [ReferenceOneFieldNormalizer][19]

#### Link Normalizer

 * [CallbackLinkNormalizer][20]

#### Normalizer Context

 * [NormalizerContext][21]
 * [NormalizerContextBuilder][22]

### NormalizerObjectMappingRegistry

* [NormalizerObjectMappingRegistry][23]

### Mapping

#### NormalizationFieldMapping

 * [NormalizationFieldMapping][24]
 * [NormalizationFieldMappingBuilder][25]

#### NormalizationLinkMapping

 * [NormalizationLinkMapping][26]
 * [NormalizationLinkMappingBuilder][27]

#### NormalizationObjectMapping

 * [AdvancecNormalizationObjectMapping][28]
 * [SimpleNormalizationObjectMapping][29]

#### LazyNormalizationObjectMapping

 * [CallableNormalizationObjectMapping][30]
 * [LazyNormalizationObjectMapping][31]

### Policy

* [AndPolicy][32]
* [CallbackPolicy][33]
* [GroupPolicy][34]
* [NotPolicy][35]
* [NullPolicy][36]
* [OrPolicy][37]

### ServiceFactory

#### chubbyphp-container

 * [SerializationServiceFactory][38]

#### chubbyphp-laminas-config-factory

 * [EncoderFactory][40]
 * [NormalizerFactory][41]
 * [NormalizerObjectMappingRegistryFactory][42]
 * [SerializerFactory][43]

### ServiceProvider

* [SerializationServiceProvider][39]

### Serializer

```php
<?php

use Chubbyphp\DecodeEncode\Encoder\Encoder;
use Chubbyphp\DecodeEncode\Encoder\JsonTypeEncoder;
use Chubbyphp\DecodeEncode\Encoder\JsonxTypeEncoder;
use Chubbyphp\DecodeEncode\Encoder\UrlEncodedTypeEncoder;
use Chubbyphp\DecodeEncode\Encoder\XmlTypeEncoder;
use Chubbyphp\DecodeEncode\Encoder\YamlTypeEncoder;
use Chubbyphp\Serialization\Normalizer\Normalizer;
use Chubbyphp\Serialization\Normalizer\NormalizerObjectMappingRegistry;
use Chubbyphp\Serialization\Serializer;
use MyProject\Serialization\ModelMapping;
use MyProject\Model\Model;
use Psr\Http\Message\ServerRequestInterface;

$logger = ...;

$serializer = new Serializer(
    new Normalizer(
        new NormalizerObjectMappingRegistry([
            new ModelMapping()
        ]),
        $logger
    ),
    new Encoder([
        new JsonTypeEncoder(),
        new JsonxTypeEncoder(),
        new UrlEncodedTypeEncoder(),
        new XmlTypeEncoder(),
        new YamlTypeEncoder()
    ])
);

$model = new Model;
$model->setName('php');

$json = $serializer->serialize(
    $model,
    'application/json'
);

echo $json;
// '{"name": "php"}'

$model = new Model;
$model->setName('php');

$data = $serializer->normalize(
    $model
);

print_r($data);
// ['name' => 'php']

print_r($serializer->getContentTypes());
//[
//    'application/json',
//    'application/jsonx+xml',
//    'application/x-www-form-urlencoded',
//    'application/xml',
//    'application/x-yaml'
//]

echo $serializer->encode(
    ['name' => 'php'],
    'application/json'
);
// '{"name": "php"}'
```

## Copyright

2025 Dominik Zogg


[1]: https://packagist.org/packages/chubbyphp/chubbyphp-serialization

[2]: doc/Accessor/MethodAccessor.md
[3]: doc/Accessor/PropertyAccessor.md

[4]: doc/Encoder/Encoder.md

[5]: doc/Encoder/JsonTypeEncoder.md
[6]: doc/Encoder/JsonxTypeEncoder.md
[7]: doc/Encoder/UrlEncodedTypeEncoder.md
[8]: doc/Encoder/XmlTypeEncoder.md
[9]: doc/Encoder/YamlTypeEncoder.md

[10]: doc/Link/Link.md
[11]: doc/Link/LinkBuilder.md

[12]: doc/Normalizer/Normalizer.md

[13]: doc/Normalizer/CallbackFieldNormalizer.md
[14]: doc/Normalizer/DateTimeFieldNormalizer.md
[15]: doc/Normalizer/FieldNormalizer.md

[16]: doc/Normalizer/Relation/EmbedManyFieldNormalizer.md
[17]: doc/Normalizer/Relation/EmbedOneFieldNormalizer.md
[18]: doc/Normalizer/Relation/ReferenceManyFieldNormalizer.md
[19]: doc/Normalizer/Relation/ReferenceOneFieldNormalizer.md

[20]: doc/Normalizer/CallbackLinkNormalizer.md

[21]: doc/Normalizer/NormalizerContext.md
[22]: doc/Normalizer/NormalizerContextBuilder.md

[23]: doc/Normalizer/NormalizerObjectMappingRegistry.md

[24]: doc/Mapping/NormalizationFieldMapping.md
[25]: doc/Mapping/NormalizationFieldMappingBuilder.md

[26]: doc/Mapping/NormalizationLinkMapping.md
[27]: doc/Mapping/NormalizationLinkMappingBuilder.md

[28]: doc/Mapping/AdvancedNormalizationObjectMapping.md
[29]: doc/Mapping/SimpleNormalizationObjectMapping.md

[30]: doc/Mapping/CallableNormalizationObjectMapping.md
[31]: doc/Mapping/LazyNormalizationObjectMapping.md

[32]: doc/Policy/AndPolicy.md
[33]: doc/Policy/CallbackPolicy.md
[34]: doc/Policy/GroupPolicy.md
[35]: doc/Policy/NotPolicy.md
[36]: doc/Policy/NullPolicy.md
[37]: doc/Policy/OrPolicy.md

[38]: doc/ServiceFactory/SerializationServiceFactory.md

[39]: doc/ServiceProvider/SerializationServiceProvider.md

[40]: doc/ServiceFactory/EncoderFactory.md
[41]: doc/ServiceFactory/NormalizerFactory.md
[42]: doc/ServiceFactory/NormalizerObjectMappingRegistryFactory.md
[43]: doc/ServiceFactory/SerializerFactory.md
