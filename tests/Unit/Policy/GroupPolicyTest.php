<?php

declare(strict_types=1);

namespace Chubbyphp\Tests\Serialization\Unit\Policy;

use Chubbyphp\Mock\MockByCallsTrait;
use Chubbyphp\Serialization\Normalizer\NormalizerContextInterface;
use Chubbyphp\Serialization\Policy\GroupPolicy;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

/**
 * @covers \Chubbyphp\Serialization\Policy\GroupPolicy
 *
 * @internal
 */
final class GroupPolicyTest extends TestCase
{
    use MockByCallsTrait;

    public function testIsCompliantReturnsTrueIfNoGroupsAreSet(): void
    {
        error_clear_last();

        $object = new \stdClass();

        /** @var NormalizerContextInterface|MockObject $context */
        $context = $this->getMockByCalls(NormalizerContextInterface::class);

        $policy = new GroupPolicy([]);

        self::assertTrue($policy->isCompliant($context, $object));

        $error = error_get_last();

        self::assertNotNull($error);

        self::assertSame(E_USER_DEPRECATED, $error['type']);
        self::assertSame('Use "isCompliantIncludingPath()" instead of "isCompliant()"', $error['message']);
    }

    public function testIsCompliantReturnsTrueWithDefaultValues(): void
    {
        error_clear_last();

        $object = new \stdClass();

        /** @var NormalizerContextInterface|MockObject $context */
        $context = $this->getNormalizerContextWithGroupAttribute(null);

        $policy = new GroupPolicy();

        self::assertTrue($policy->isCompliant($context, $object));

        $error = error_get_last();

        self::assertNotNull($error);

        self::assertSame(E_USER_DEPRECATED, $error['type']);
        self::assertSame('Use "isCompliantIncludingPath()" instead of "isCompliant()"', $error['message']);
    }

    public function testIsCompliantReturnsTrueIfOneGroupMatches(): void
    {
        error_clear_last();

        $object = new \stdClass();

        /** @var NormalizerContextInterface|MockObject $context */
        $context = $this->getNormalizerContextWithGroupAttribute(['group2']);

        $policy = new GroupPolicy(['group1', 'group2']);

        self::assertTrue($policy->isCompliant($context, $object));

        $error = error_get_last();

        self::assertNotNull($error);

        self::assertSame(E_USER_DEPRECATED, $error['type']);
        self::assertSame('Use "isCompliantIncludingPath()" instead of "isCompliant()"', $error['message']);
    }

    public function testIsCompliantReturnsFalseIfNoGroupsAreSetInContext(): void
    {
        error_clear_last();

        $object = new \stdClass();

        /** @var NormalizerContextInterface|MockObject $context */
        $context = $this->getNormalizerContextWithGroupAttribute([]);

        $policy = new GroupPolicy(['group1', 'group2']);

        self::assertFalse($policy->isCompliant($context, $object));

        $error = error_get_last();

        self::assertNotNull($error);

        self::assertSame(E_USER_DEPRECATED, $error['type']);
        self::assertSame('Use "isCompliantIncludingPath()" instead of "isCompliant()"', $error['message']);
    }

    public function testIsCompliantReturnsFalseIfNoGroupsMatch(): void
    {
        error_clear_last();

        $object = new \stdClass();

        /** @var NormalizerContextInterface|MockObject $context */
        $context = $this->getNormalizerContextWithGroupAttribute(['unknownGroup']);

        $policy = new GroupPolicy(['group1', 'group2']);

        self::assertFalse($policy->isCompliant($context, $object));

        $error = error_get_last();

        self::assertNotNull($error);

        self::assertSame(E_USER_DEPRECATED, $error['type']);
        self::assertSame('Use "isCompliantIncludingPath()" instead of "isCompliant()"', $error['message']);
    }

    public function testIsCompliantIncludingPathReturnsTrueIfNoGroupsAreSet(): void
    {
        $object = new \stdClass();

        $path = '';

        /** @var NormalizerContextInterface|MockObject $context */
        $context = $this->getMockByCalls(NormalizerContextInterface::class);

        $policy = new GroupPolicy([]);

        self::assertTrue($policy->isCompliantIncludingPath($path, $object, $context));
    }

    public function testIsCompliantIncludingPathReturnsTrueWithDefaultValues(): void
    {
        $object = new \stdClass();

        $path = '';

        /** @var NormalizerContextInterface|MockObject $context */
        $context = $this->getNormalizerContextWithGroupAttribute(null);

        $policy = new GroupPolicy();

        self::assertTrue($policy->isCompliantIncludingPath($path, $object, $context));
    }

    public function testIsCompliantIncludingPathReturnsTrueIfOneGroupMatches(): void
    {
        $object = new \stdClass();

        $path = '';

        /** @var NormalizerContextInterface|MockObject $context */
        $context = $this->getNormalizerContextWithGroupAttribute(['group2']);

        $policy = new GroupPolicy(['group1', 'group2']);

        self::assertTrue($policy->isCompliantIncludingPath($path, $object, $context));
    }

    public function testIsCompliantIncludingPathReturnsFalseIfNoGroupsAreSetInContext(): void
    {
        $object = new \stdClass();

        $path = '';

        /** @var NormalizerContextInterface|MockObject $context */
        $context = $this->getNormalizerContextWithGroupAttribute([]);

        $policy = new GroupPolicy(['group1', 'group2']);

        self::assertFalse($policy->isCompliantIncludingPath($path, $object, $context));
    }

    public function testIsCompliantIncludingPathReturnsFalseIfNoGroupsMatch(): void
    {
        $object = new \stdClass();

        $path = '';

        /** @var NormalizerContextInterface|MockObject $context */
        $context = $this->getNormalizerContextWithGroupAttribute(['unknownGroup']);

        $policy = new GroupPolicy(['group1', 'group2']);

        self::assertFalse($policy->isCompliantIncludingPath($path, $object, $context));
    }

    private function getNormalizerContextWithGroupAttribute(array $groups = null): NormalizerContextInterface
    {
        return new class($groups) implements NormalizerContextInterface {
            private $groups;

            public function __construct($groups)
            {
                $this->groups = $groups;
            }

            public function getGroups(): array
            {
                return [];
            }

            public function getRequest()
            {
                return null;
            }

            public function getAttributes(): array
            {
                return [];
            }

            public function getAttribute(string $name, $default = null)
            {
                return $this->groups ?? $default;
            }

            public function withAttribute(string $name, $value): NormalizerContextInterface
            {
                return $this;
            }
        };
    }
}
