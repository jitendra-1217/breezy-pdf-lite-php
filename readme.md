## breezy-pdf-lite-php

Php client for [breezy-pdf-lite](https://breezypdf.com), an HTML -> PDF service powered by Google Chrome.

## Usage & Examples

```php
use BreezyPdfLite\BreezyPdfLite;

$breezy = new BreezyPdfLite('http://localhost:5000', 'VERY_RANDOM_SECRET');

// Gets pdf string for given html content
$breezy->readHtml('<h1>Hello, world!</h1>')->getPdfAsString();

// Saves converted pdf file locally for given html content
$breezy->readHtml('<h1>Hello, world!</h1>')->getPdfSavedAs('/home/ubuntu/hello.pdf');

// Saves converted pdf file locally for given local html/view file
$breezy->readHtmlFromFile('/home/ubuntu/example.html')->getPdfSavedAs('/home/ubuntu/hello.pdf');

// // Saves converted pdf file locally for given remote html page/view
$breezy->readHtmlFromRemote('https://example.com')->getPdfSavedAs('/home/ubuntu/example.pdf');
```
