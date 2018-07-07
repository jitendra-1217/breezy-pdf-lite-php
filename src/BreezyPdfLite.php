<?php

namespace BreezyPdfLite;

use Requests;
use RuntimeException;

/**
 *
 */
class BreezyPdfLite
{
    /**
     * Base api url of hosted/enterprise breezy application
     * @var string
     */
    protected $api;

    /**
     * Secret bearer auth token
     * @var string
     */
    protected $token;

    /**
     * @var Options
     */
    protected $options;

    /**
     * @var Html
     */
    protected $html;

    /**
     * @var Pdf
     */
    protected $pdf;

    public function __construct(string $api, string $token)
    {
        $this->api = $api;
        $this->token = $token;
    }

    public function withOptions(array $options): BreezyPdfLite
    {
        $this->options = new Options($options);
        return $this;
    }

    public function readHtml(string $content): BreezyPdfLite
    {
        $this->html = Html::fromString($content);
        return $this;
    }

    public function readHtmlFromFile(string $path): BreezyPdfLite
    {
        $this->html = Html::fromFile($path);
        return $this;
    }

    public function readHtmlFromRemote(string $url): BreezyPdfLite
    {
        $this->html = Html::fromRemote($url);
        return $this;
    }

    public function getPdfAsString(): string
    {
        if (! $this->pdf) {
            $this->convert();
        }
        return $this->pdf->asString();
    }

    public function getPdfSavedAs(string $path): BreezyPdfLite
    {
        if (! $this->pdf) {
            $this->convert();
        }
        $this->pdf->saveAs($path);
        return $this;
    }

    public function convert(): BreezyPdfLite
    {
        if (! $this->html) {
            throw new RuntimeException('missing html content');
        }
        $endpoint = "{$this->api}/render/html";
        $headers = ['Authorization' => "Bearer {$this->token}"];
        $options = $this->options ? $this->options->all() : [];
        $body = $this->html->applyOptions($options)->asString();
        $response = Requests::post($endpoint, $headers, $body);
        if ($response->status_code > 201) {
            throw new RuntimeException('remote breezy service returned non 200 response');
        }
        $this->pdf = new Pdf($response->body);
        return $this;
    }
}
