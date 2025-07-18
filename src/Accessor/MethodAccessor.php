<?php

declare(strict_types=1);

namespace Jobcloud\Serialization\Accessor;

use Jobcloud\Serialization\SerializerLogicException;

final class MethodAccessor implements AccessorInterface
{
    public function __construct(private string $property) {}

    /**
     * @return mixed
     *
     * @throws SerializerLogicException
     */
    public function getValue(object $object)
    {
        $get = 'get'.ucfirst($this->property);
        $has = 'has'.ucfirst($this->property);
        $is = 'is'.ucfirst($this->property);

        if (method_exists($object, $get)) {
            return $object->{$get}();
        }

        if (method_exists($object, $has)) {
            return $object->{$has}();
        }

        if (method_exists($object, $is)) {
            return $object->{$is}();
        }

        throw SerializerLogicException::createMissingMethod($object::class, [$get, $has, $is]);
    }
}
