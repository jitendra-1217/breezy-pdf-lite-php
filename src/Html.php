<?php

namespace BreezyPdfLite;

use Requests;

/**
 * Html:
 * Represents html content which is input to breezypdf
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

    /**
     * @param  string $content
     * @return Html
     */
    public static function fromString(string $content): Html
    {
        $instance = new static;
        $instance->content = $content;
        return $instance;
    }

    /**
     * @param  string $path
     * @return Html
     */
    public static function fromFile(string $path): Html
    {
        $instance = new static;
        $instance->file = $path;
        $instance->content = file_get_contents($path);
        return $instance;
    }

    /**
     * @param  string $url
     * @return Html
     */
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

    /**
     * Writes meta tags in the read html content against given options
     * @param  array  $options
     * @return Html
     */
    public function applyOptions(array $options): Html
    {
        $meta = '';
        foreach ($options as $key => $value) {
            $meta .= "<meta name=\"breezy-pdf-{$key}\" content=\"{$value}\">";
        }
        $this->content .= $meta;
        return $this;
    }

    /**
     * Returns html content as string
     * @return string
     */
    public function asString(): string
    {
        return $this->content;
    }
}
