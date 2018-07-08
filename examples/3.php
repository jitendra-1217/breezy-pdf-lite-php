
<?php

require_once __DIR__.'/../vendor/autoload.php';

use BreezyPdfLite\BreezyPdfLite;

$api    = 'http://localhost:5000';
$token  = 'random_secret';
$breezy = new BreezyPdfLite($api, $token);

$breezy->readHtmlFromRemote('https://example.com')
       ->getPdfSavedAs(__DIR__.'/output/3.pdf');
