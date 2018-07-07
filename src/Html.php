<?php

namespace BreezyPdfLite;

use Requests;

/**
 *
 */
class Html
{
    /**
     * Html content
     * @var string
     */
    protected $content;

    /**
     * Local file name from where to get the Html content
     * @var string
     */
    protected $file;

    /**
     * Remote url from where to get the Html content
     * @var string
     */
    protected $remoteUrl;

    public static function fromString(string $content): Html
    {
        $instance = new static;
        $instance->content = $content;
        return $instance;
    }

    public static function fromFile(string $path): Html
    {
        $instance = new static;
        $instance->file = $path;
        $instance->content = file_get_contents($path);
        return $instance;
    }

    public static function fromRemote(string $url): Html
    {
        $response = Requests::get($url);
        if ($response->status_code > 200) {
            throw new RuntimeException("failed to read html content from remote url: {$url}");
        }
        $instance = new static;
        $instance->remoteUrl = $url;
        $instance->content = $response->body;
        return $instance;
    }

    public function applyOptions(array $options): Html
    {
        return $this;
    }

    public function asString(): string
    {
        return $this->content;
    }
}
