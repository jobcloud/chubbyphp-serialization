<?php

declare(strict_types=1);

namespace Jobcloud\Tests\Serialization\Integration;

use Chubbyphp\DecodeEncode\Encoder\Encoder;
use Chubbyphp\DecodeEncode\Encoder\JsonTypeEncoder;
use Jobcloud\Serialization\Normalizer\Normalizer;
use Jobcloud\Serialization\Normalizer\NormalizerContextBuilder;
use Jobcloud\Serialization\Normalizer\NormalizerObjectMappingRegistry;
use Jobcloud\Serialization\Policy\GroupPolicy;
use Jobcloud\Serialization\Serializer;
use Jobcloud\Serialization\SerializerLogicException;
use Jobcloud\Tests\Serialization\Resources\Mapping\ManyModelMapping;
use Jobcloud\Tests\Serialization\Resources\Mapping\ModelMapping;
use Jobcloud\Tests\Serialization\Resources\Mapping\OneModelMapping;
use Jobcloud\Tests\Serialization\Resources\Model\ManyModel;
use Jobcloud\Tests\Serialization\Resources\Model\Model;
use Jobcloud\Tests\Serialization\Resources\Model\OneModel;
use PHPUnit\Framework\TestCase;
use Psr\Log\AbstractLogger;

/**
 * @coversNothing
 *
 * @internal
 */
final class SerializerTest extends TestCase
{
    public function testSerialize(): void
    {
        $logger = $this->getLogger();

        $serializer = new Serializer(
            new Normalizer(
                new NormalizerObjectMappingRegistry([
                    new ManyModelMapping(),
                    new ModelMapping(),
                    new OneModelMapping(),
                ]),
                $logger
            ),
            new Encoder([new JsonTypeEncoder(true)])
        );

        $model = new Model();
        $model->setName('Name');
        $model->setAdditionalInfo('AdditionalInfo');
        $model->setOne((new OneModel())->setName('Name')->setValue('Value'));
        $model->setManies([(new ManyModel())->setName('Name')->setValue('Value')]);

        $expectedJson = <<<'EOD'
            {
                "id": "ebac0dd9-8eca-4eb9-9fac-aeef65c5c59a",
                "name": "Name",
                "one": {
                    "name": "Name",
                    "value": "Value",
                    "_type": "one-model"
                },
                "manies": [
                    {
                        "name": "Name",
                        "value": "Value",
                        "_type": "many-model"
                    }
                ],
                "_links": {
                    "self": {
                        "href": "/api/model/ebac0dd9-8eca-4eb9-9fac-aeef65c5c59a",
                        "templated": false,
                        "rel": [],
                        "attributes": {
                            "method": "GET"
                        }
                    }
                },
                "_type": "model"
            }
            EOD;

        self::assertSame($expectedJson, $serializer->serialize($model, 'application/json'));

        self::assertEquals(
            [
                [
                    'level' => 'info',
                    'message' => 'serialize: path {path}',
                    'context' => [
                        'path' => 'id',
                    ],
                ],
                [
                    'level' => 'info',
                    'message' => 'serialize: path {path}',
                    'context' => [
                        'path' => 'name',
                    ],
                ],
                [
                    'level' => 'info',
                    'message' => 'serialize: path {path}',
                    'context' => [
                        'path' => 'one',
                    ],
                ],
                [
                    'level' => 'info',
                    'message' => 'serialize: path {path}',
                    'context' => [
                        'path' => 'one.name',
                    ],
                ],
                [
                    'level' => 'info',
                    'message' => 'serialize: path {path}',
                    'context' => [
                        'path' => 'one.value',
                    ],
                ],
                [
                    'level' => 'info',
                    'message' => 'serialize: path {path}',
                    'context' => [
                        'path' => 'manies',
                    ],
                ],
                [
                    'level' => 'info',
                    'message' => 'serialize: path {path}',
                    'context' => [
                        'path' => 'manies[0].name',
                    ],
                ],
                [
                    'level' => 'info',
                    'message' => 'serialize: path {path}',
                    'context' => [
                        'path' => 'manies[0].value',
                    ],
                ],
            ],
            $logger->getEntries()
        );
    }

    public function testSerializeWithGroupPolicy(): void
    {
        $logger = $this->getLogger();

        $serializer = new Serializer(
            new Normalizer(
                new NormalizerObjectMappingRegistry([
                    new ManyModelMapping(),
                    new ModelMapping(),
                    new OneModelMapping(),
                ]),
                $logger
            ),
            new Encoder([new JsonTypeEncoder(true)])
        );

        $model = new Model();
        $model->setName('Name');
        $model->setAdditionalInfo('AdditionalInfo');
        $model->setOne((new OneModel())->setName('Name')->setValue('Value'));
        $model->setManies([(new ManyModel())->setName('Name')->setValue('Value')]);

        $expectedJson = <<<'EOD'
            {
                "id": "ebac0dd9-8eca-4eb9-9fac-aeef65c5c59a",
                "name": "Name",
                "additionalInfo": "AdditionalInfo",
                "one": {
                    "name": "Name",
                    "value": "Value",
                    "_type": "one-model"
                },
                "manies": [
                    {
                        "name": "Name",
                        "value": "Value",
                        "_type": "many-model"
                    }
                ],
                "_links": {
                    "self": {
                        "href": "/api/model/ebac0dd9-8eca-4eb9-9fac-aeef65c5c59a",
                        "templated": false,
                        "rel": [],
                        "attributes": {
                            "method": "GET"
                        }
                    }
                },
                "_type": "model"
            }
            EOD;

        $context = NormalizerContextBuilder::create()
            ->setAttributes([GroupPolicy::ATTRIBUTE_GROUPS => ['additionalInfo']])
            ->getContext()
        ;

        self::assertSame(
            $expectedJson,
            $serializer->serialize($model, 'application/json', $context)
        );

        self::assertEquals(
            [
                [
                    'level' => 'info',
                    'message' => 'serialize: path {path}',
                    'context' => [
                        'path' => 'id',
                    ],
                ],
                [
                    'level' => 'info',
                    'message' => 'serialize: path {path}',
                    'context' => [
                        'path' => 'name',
                    ],
                ],
                [
                    'level' => 'info',
                    'message' => 'serialize: path {path}',
                    'context' => [
                        'path' => 'additionalInfo',
                    ],
                ],
                [
                    'level' => 'info',
                    'message' => 'serialize: path {path}',
                    'context' => [
                        'path' => 'one',
                    ],
                ],
                [
                    'level' => 'info',
                    'message' => 'serialize: path {path}',
                    'context' => [
                        'path' => 'one.name',
                    ],
                ],
                [
                    'level' => 'info',
                    'message' => 'serialize: path {path}',
                    'context' => [
                        'path' => 'one.value',
                    ],
                ],
                [
                    'level' => 'info',
                    'message' => 'serialize: path {path}',
                    'context' => [
                        'path' => 'manies',
                    ],
                ],
                [
                    'level' => 'info',
                    'message' => 'serialize: path {path}',
                    'context' => [
                        'path' => 'manies[0].name',
                    ],
                ],
                [
                    'level' => 'info',
                    'message' => 'serialize: path {path}',
                    'context' => [
                        'path' => 'manies[0].value',
                    ],
                ],
            ],
            $logger->getEntries()
        );
    }

    public function testSerializeWithoutObjectMapping(): void
    {
        $this->expectException(SerializerLogicException::class);
        $this->expectExceptionMessage('There is no mapping for class: "stdClass"');

        $serializer = new Serializer(
            new Normalizer(
                new NormalizerObjectMappingRegistry([
                    new ManyModelMapping(),
                    new ModelMapping(),
                ])
            ),
            new Encoder([new JsonTypeEncoder(true)])
        );

        $serializer->serialize(new \stdClass(), 'application/json');
    }

    private function getLogger(): AbstractLogger
    {
        return new class extends AbstractLogger {
            private array $entries = [];

            public function log($level, $message, array $context = []): void
            {
                $this->entries[] = ['level' => $level, 'message' => $message, 'context' => $context];
            }

            public function getEntries(): array
            {
                return $this->entries;
            }
        };
    }
}
