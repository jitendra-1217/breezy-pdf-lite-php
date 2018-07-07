<?php

namespace BreezyPdfLite;

/**
 *
 */
class Options
{
    /**
     * @var array
     */
    protected $options;

    public function __construct(array $options)
    {
        $this->options = $options;
        $this->validate();
    }

    public function all(): array
    {
        return $this->options;
    }

    protected function validate()
    {
        // Todo
    }
}
