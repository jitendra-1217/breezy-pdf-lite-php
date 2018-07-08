## breezy-pdf-lite-php

Php client for [breezy-pdf-lite](https://breezypdf.com), an HTML -> PDF service powered by Google Chrome.

## Dependencies

- [breezy-pdf-lite](https://github.com/danielwestendorf/breezy-pdf-lite)

  BreezyPDF Lite: HTML to PDF generation as a Service

## Installation

```sh
composer require jitendra/breezy-pdf-lite-php
```

## Usage & Examples

```php
use BreezyPdfLite\BreezyPdfLite;

$breezy = new BreezyPdfLite('http://localhost:5000', 'VERY_RANDOM_SECRET');

// Gets pdf string for given html content
$breezy->readHtml('<h1>Hello, world!</h1>')
       ->getPdfAsString();

// Saves converted pdf file locally for given html content
$breezy->readHtml('<h1>Hello, world!</h1>')
       ->getPdfSavedAs('/home/ubuntu/hello.pdf');

// Saves converted pdf file locally for given local html/view file
$breezy->readHtmlFromFile('/home/ubuntu/hello.html')
       ->getPdfSavedAs('/home/ubuntu/hello.pdf');

// Saves converted pdf file locally for given remote html page/view
$breezy->readHtmlFromRemote('https://example.com')
       ->getPdfSavedAs('/home/ubuntu/example.pdf');

// Saves converted pdf file locally for given local html page/view
// Also accepts additional print options, ref https://github.com/jitendra-1217/breezy-pdf-lite-php/blob/master/src/Options.php for all available options
// Please note that these options can be provided as part of html meta tags from the html page/view itself (as in /example/2.php file)
// Following options are actually appended in html content as meta tags
$breezy->withOptions(['height' => 5, 'width' => 5])
       ->readHtmlFromFile(__DIR__.'/input/example.html')
       ->getPdfSavedAs(__DIR__.'/output/example.pdf');

```

Additionally, refer to [/examples/*](https://github.com/jitendra-1217/breezy-pdf-lite-php/tree/master/examples) folder for quick start & experiment with options etc.
