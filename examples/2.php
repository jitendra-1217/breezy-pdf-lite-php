
<?php

require_once __DIR__.'/../vendor/autoload.php';

use BreezyPdfLite\BreezyPdfLite;

$api = 'http://localhost:5000';
$token = 'random_secret';

$breezy = new BreezyPdfLite($api, $token);

$breezy
    ->withOptions(
        [
            'height' => 5,
            'width' => 5,
        ])
    ->readHtmlFromFile(__DIR__.'/input/example.html')
    ->getPdfSavedAs(__DIR__.'/output/example.pdf');
