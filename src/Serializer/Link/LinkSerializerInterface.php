<?php

declare(strict_types=1);

namespace Chubbyphp\Serialization\Serializer\Link;

use Chubbyphp\Serialization\Link\LinkInterface;
use Psr\Http\Message\ServerRequestInterface as Request;

interface LinkSerializerInterface
{
    /**
     * @param string  $path
     * @param Request $request
     * @param object  $object
     * @param array   $fields
     *
     * @return LinkInterface
     */
    public function serializeLink(
        string $path,
        Request $request,
        $object,
        array $fields
    ): LinkInterface;
}