<?php

require_once __DIR__.'/../vendor/autoload.php';

use BreezyPdfLite\BreezyPdfLite;

$api = 'http://localhost:5000';
$token = 'random_secret';

$breezy = new BreezyPdfLite($api, $token);

$breezy
    ->readHtml('<h1>BreezyPdfLite: Html to pdf :)</h1>')
    ->getPdfSavedAs(__DIR__.'/output/example.pdf');
