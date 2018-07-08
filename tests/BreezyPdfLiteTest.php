<?php

namespace BreezyPdfLite\Tests;

use Requests_Session;
use BreezyPdfLite\BreezyPdfLite;

class BreezyPdfLiteTest extends TestCase
{
    public function testHtmlContentToPdf()
    {
        // Todo
    }

    public function testHtmlFileToPdf()
    {
        // Todo
    }

    public function testHtmlRemoteFileToPdf()
    {
        // Todo
    }

    public function testHtmlContentToPdfAsString()
    {
        // Todo
    }

    public function testHtmlContentWithOptionsToPdf()
    {
        // Todo
    }

    /**
     * Creates mocked http and BreezyPdfLite instance with it
     * @param  array $methods
     * @return array
     */
    protected function createMockedClient(array $methods = []): array
    {
        $http = $this->createMockedHttpClient($methods);
        $client = new BreezyPdfLite('http://localhost', 'token', $http);
        return [$http, $client];
    }

    /**
     * Creates mocked http client
     * @param  array  $methods
     * @return Requests_Session
     */
    protected function createMockedHttpClient(array $methods = [])
    {
        return $this->getMockBuilder(Requests_Session::class)->setMethods($methods)->getMock();
    }
}
