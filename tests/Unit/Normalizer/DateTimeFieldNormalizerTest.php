<?php

declare(strict_types=1);

namespace Chubbyphp\Tests\Serialization\Unit\Normalizer;

use Chubbyphp\Mock\Call;
use Chubbyphp\Mock\MockByCallsTrait;
use Chubbyphp\Serialization\Accessor\AccessorInterface;
use Chubbyphp\Serialization\Normalizer\DateTimeFieldNormalizer;
use Chubbyphp\Serialization\Normalizer\FieldNormalizerInterface;
use Chubbyphp\Serialization\Normalizer\NormalizerContextInterface;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

/**
 * @covers \Chubbyphp\Serialization\Normalizer\DateTimeFieldNormalizer
 *
 * @internal
 */
final class DateTimeFieldNormalizerTest extends TestCase
{
    use MockByCallsTrait;

    public function testNormalizeFieldWithInvalidConstructArgument(): void
    {
        $this->expectException(\TypeError::class);
        $this->expectExceptionMessage(
            'Chubbyphp\Serialization\Normalizer\DateTimeFieldNormalizer::__construct() expects parameter 1 to be '
                .'Chubbyphp\Serialization\Accessor\AccessorInterface|Chubbyphp\Serialization\Normalizer\\'
                .'FieldNormalizerInterface, DateTime given'
        );

        new DateTimeFieldNormalizer(new \DateTime());
    }

    public function testNormalizeFieldWithFieldNormalizer(): void
    {
        $object = $this->getObject();
        $object->setDate(new \DateTime('2017-01-01 22:00:00+01:00'));

        /** @var NormalizerContextInterface|MockObject $context */
        $context = $this->getMockByCalls(NormalizerContextInterface::class);

        /** @var FieldNormalizerInterface|MockObject $fieldNormalizer */
        $fieldNormalizer = $this->getMockByCalls(FieldNormalizerInterface::class, [
            Call::create('normalizeField')
            ->with('date', $object, $context, null)
                ->willReturn('2017-01-01 22:00:00+01:00'),
        ]);

        $dateTimeFieldNormalizer = new DateTimeFieldNormalizer($fieldNormalizer);

        self::assertSame(
            '2017-01-01T22:00:00+01:00',
            $dateTimeFieldNormalizer->normalizeField(
                'date',
                $object,
                $context
            )
        );
    }

    public function testNormalizeField(): void
    {
        $object = $this->getObject();
        $object->setDate(new \DateTime('2017-01-01 22:00:00+01:00'));

        /** @var NormalizerContextInterface|MockObject $context */
        $context = $this->getMockByCalls(NormalizerContextInterface::class);

        /** @var AccessorInterface|MockObject $accessor */
        $accessor = $this->getMockByCalls(AccessorInterface::class, [
            Call::create('getValue')->with($object)->willReturn('2017-01-01 22:00:00+01:00'),
        ]);

        $dateTimeFieldNormalizer = new DateTimeFieldNormalizer($accessor);

        self::assertSame(
            '2017-01-01T22:00:00+01:00',
            $dateTimeFieldNormalizer->normalizeField(
                'date',
                $object,
                $context
            )
        );
    }

    public function testNormalizeWithValidDateString(): void
    {
        $object = $this->getObject();
        $object->setDate('2017-01-01 22:00:00+01:00');

        /** @var NormalizerContextInterface|MockObject $context */
        $context = $this->getMockByCalls(NormalizerContextInterface::class);

        /** @var AccessorInterface|MockObject $accessor */
        $accessor = $this->getMockByCalls(AccessorInterface::class, [
            Call::create('getValue')->with($object)->willReturn('2017-01-01 22:00:00+01:00'),
        ]);

        $dateTimeFieldNormalizer = new DateTimeFieldNormalizer($accessor);

        self::assertSame(
            '2017-01-01T22:00:00+01:00',
            $dateTimeFieldNormalizer->normalizeField(
                'date',
                $object,
                $context
            )
        );
    }

    public function testNormalizeWithInvalidDateString(): void
    {
        $object = $this->getObject();
        $object->setDate('2017-01-01 25:00:00');

        /** @var NormalizerContextInterface|MockObject $context */
        $context = $this->getMockByCalls(NormalizerContextInterface::class);

        /** @var AccessorInterface|MockObject $accessor */
        $accessor = $this->getMockByCalls(AccessorInterface::class, [
            Call::create('getValue')->with($object)->willReturn('2017-01-01 25:00:00'),
        ]);

        $dateTimeFieldNormalizer = new DateTimeFieldNormalizer($accessor);

        self::assertSame(
            '2017-01-01 25:00:00',
            $dateTimeFieldNormalizer->normalizeField(
                'date',
                $object,
                $context
            )
        );
    }

    public function testNormalizeWithNull(): void
    {
        $object = $this->getObject();

        /** @var NormalizerContextInterface|MockObject $context */
        $context = $this->getMockByCalls(NormalizerContextInterface::class);

        /** @var AccessorInterface|MockObject $accessor */
        $accessor = $this->getMockByCalls(AccessorInterface::class, [
            Call::create('getValue')->with($object)->willReturn(null),
        ]);

        $dateTimeFieldNormalizer = new DateTimeFieldNormalizer($accessor);

        self::assertNull(
            $dateTimeFieldNormalizer->normalizeField('date', $object, $context)
        );
    }

    private function getObject()
    {
        return new class() {
            /**
             * @var \DateTime|string|null
             */
            private $date;

            /**
             * @return \DateTime|string|null
             */
            public function getDate()
            {
                return $this->date;
            }

            /**
             * @param \DateTime|string|null $date
             */
            public function setDate($date): self
            {
                $this->date = $date;

                return $this;
            }
        };
    }
}
