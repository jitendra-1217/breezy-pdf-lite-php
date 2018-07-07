<?php

namespace BreezyPdfLite;

use RuntimeException;

/**
 *
 */
class Pdf
{
    /**
     * String pdf content
     * @var string
     */
    protected $content;

    public function __construct(string $content)
    {
        $this->content = $content;
    }

    public function asString(): string
    {
        return $this->content;
    }

    public function saveAs(string $path): Pdf
    {
        if (! file_put_contents($path, $this->content)) {
            throw new RuntimeException('failed to write pdf content at given file path');
        }
        return $this;
    }
}
