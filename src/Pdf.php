<?php

namespace BreezyPdfLite;

use RuntimeException;

/**
 * Pdf:
 * Represents pdf content which is output of breezypdf
 */
class Pdf
{
    /**
     * String pdf content
     * @var string
     */
    protected $content;

    /**
     * @param string $content
     */
    public function __construct(string $content)
    {
        $this->content = $content;
    }

    /**
     * Gets pdf content as string
     * @return string
     */
    public function asString(): string
    {
        return $this->content;
    }

    /**
     * Saves pdf content as given file name
     * @param  string $path
     * @return Pdf
     */
    public function saveAs(string $path): Pdf
    {
        if (! file_put_contents($path, $this->content)) {
            throw new RuntimeException('failed to write pdf content at given file path');
        }
        return $this;
    }
}
