<?php

namespace BreezyPdfLite;

use InvalidArgumentException;

/**
 * Options:
 * Represents options for breezypdf
 */
class Options
{
    // List of valid options
    const ALL_OPTIONS = [
        'cssPageSize',
        'width',
        'height',
        'marginTop',
        'marginBottom',
        'marginLeft',
        'marginRight',
        'landscape',
        'scale',
        'displayBackground',
        'pageRanges',
        'headerTemplate',
        'footerTemplate',
        'headerTemplate',
        'footerTemplate',
    ];

    /**
     * @var array
     */
    protected $options;

    /**
     * @param array $options
     */
    public function __construct(array $options)
    {
        $this->options = $options;
        $this->validate();
    }

    /**
     * @return array
     */
    public function all(): array
    {
        return $this->options;
    }

    /**
     * Validates options keys
     * @return Options
     */
    protected function validate()
    {
        if (($extra = array_diff(array_keys($this->options), self::ALL_OPTIONS))) {
            throw new InvalidArgumentException('invalid/extra options provided: '.implode(',', $extra));
        }
        return $this;
    }
}
