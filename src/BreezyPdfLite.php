<?php

namespace BreezyPdfLite;

use Requests_Session;
use RuntimeException;

/**
 * BreezyPdfLite:
 * Php client interface to convert html to pdf. Depends on self hosted or hosted
 * breezypdf server instance.
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
     * Http client
     * @var Requests_Session
     */
    protected $http;

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

    /**
     * @param string           $api
     * @param string           $token
     * @param Requests_Session $http
     */
    public function __construct(string $api, string $token, $http = null)
    {
        $this->api = $api;
        $this->token = $token;
        $this->http = $http ?: new Requests_Session;
    }

    /**
     * Options to use for conversion, refer Options.php.
     * @param  array  $options
     * @return BreezyPdfLite
     */
    public function withOptions(array $options): BreezyPdfLite
    {
        $this->options = new Options($options);
        return $this;
    }

    /**
     * Reads html content to convert to pdf
     * @param  string $content
     * @return BreezyPdfLite
     */
    public function readHtml(string $content): BreezyPdfLite
    {
        $this->html = Html::fromString($content);
        return $this;
    }

    /**
     * Reads html content from file, to convert to pdf
     * @param  string $path
     * @return BreezyPdfLite
     */
    public function readHtmlFromFile(string $path): BreezyPdfLite
    {
        $this->html = Html::fromFile($path);
        return $this;
    }

    /**
     * Reads html content from a remote url, to convert to pdf
     * @param  string $url
     * @return BreezyPdfLite
     */
    public function readHtmlFromRemote(string $url): BreezyPdfLite
    {
        $this->html = Html::fromRemote($url, $this->http);
        return $this;
    }

    /**
     * Gets converted pdf content as string
     * @return string
     */
    public function getPdfAsString(): string
    {
        if (! $this->pdf) {
            $this->convert();
        }
        return $this->pdf->asString();
    }

    /**
     * Saves converted pdf as given file(absolute) name
     * @param  string $path
     * @return BreezyPdfLite
     */
    public function getPdfSavedAs(string $path): BreezyPdfLite
    {
        if (! $this->pdf) {
            $this->convert();
        }
        $this->pdf->saveAs($path);
        return $this;
    }

    /**
     * Converts read html content to pdf
     * @return BreezyPdfLite
     */
    public function convert(): BreezyPdfLite
    {
        if (! $this->html) {
            throw new RuntimeException('missing html content');
        }
        $endpoint = "{$this->api}/render/html";
        $headers = ['Authorization' => "Bearer {$this->token}"];
        $options = $this->options ? $this->options->all() : [];
        $body = $this->html->applyOptions($options)->asString();
        $response = $this->http->post($endpoint, $headers, $body);
        if ($response->status_code > 201) {
            throw new RuntimeException('remote breezy service returned non 200 response');
        }
        $this->pdf = new Pdf($response->body);
        return $this;
    }
}
