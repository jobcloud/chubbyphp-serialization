<?php

declare(strict_types=1);

namespace Chubbyphp\Serialization\Formatter;

final class UrlEncodedFormatter implements FormatterInterface
{
    /**
     * @var string
     */
    private $numericPrefix;

    /**
     * @var string
     */
    private $argSeperator;

    /**
     * @var int
     */
    private $encType;

    /**
     * @param null|string $numericPrefix
     * @param null|string $argSeperator
     * @param int|null    $encType
     */
    public function __construct(
        string $numericPrefix = '',
        string $argSeperator = '&',
        int $encType = PHP_QUERY_RFC1738
    ) {
        $this->numericPrefix = $numericPrefix;
        $this->argSeperator = $argSeperator;
        $this->encType = $encType;
    }

    /**
     * @param array $data
     *
     * @return string
     */
    public function format(array $data): string
    {
        return http_build_query($data, $this->numericPrefix, $this->argSeperator, $this->encType);
    }
}
