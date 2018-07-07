<?php

namespace BreezyPdfLite;

class BreezyPdfLite
{
    /**
     * Base api url of hosted/enterprise breezy application
     * @var string
     */
    protected $api;

    /**
     * Secret auth token
     * @var string
     */
    protected $token;

    public function __construct(string $api, string $token)
    {
        $this->api = $api;
        $this->token = $token;
    }

    public function withOptions(array $options): BreezyPdfLite
    {
        return $this;
    }

    public function readHtml(): BreezyPdfLite
    {
        return $this;
    }

    public function readHtmlFromFile(): BreezyPdfLite
    {
        return $this;
    }

    public function readHtmlFromRemote(): BreezyPdfLite
    {
        return $this;
    }

    public function getPdfAsString(): string
    {
    }

    public function savePdfAt(string $path): BreezyPdfLite
    {
        return $this;
    }
}
