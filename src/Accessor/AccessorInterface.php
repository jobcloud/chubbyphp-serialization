<?php

declare(strict_types=1);

namespace Jobcloud\Serialization\Accessor;

use Jobcloud\Serialization\SerializerLogicException;

interface AccessorInterface
{
    /**
     * @return mixed
     *
     * @throws SerializerLogicException
     */
    public function getValue(object $object);
}
