<?php

namespace ride\library\decorator;

/**
 * Decorate seconds into HH:MM[:SS]
 */
class TimeDecorator implements Decorator {

    /**
     * Flag to see if seconds should be included in the format
     * @var boolean|null
     */
    protected $includeSeconds;

    /**
     * Constructs a new decorator
     * @param boolean|null $includeSeconds True to include, false to omit and
     * null to autodetect
     * @return null
     */
    public function __construct($includeSeconds = null) {
        $this->includeSeconds = $includeSeconds;
    }

    /**
     * Decorates a value for another context
     * @param mixed $value Value to decorate
     * @return mixed Decorated value if applicable, provided value otherwise
     */
    public function decorate($value) {
        if (!is_numeric($value)) {
            return $value;
        }

        $hours = floor($data / 3600);
        $value = $data % 3600;
        $minutes = floor($value / 60);
        $seconds = $value % 60;

        $time = $hours . ':' . str_pad($minutes, 2, '0', STR_PAD_LEFT);

        if ($this->includeSeconds === true || ($this->includeSeconds === null && $seconds)) {
            $time .= ':' . str_pad($seconds, 2, '0', STR_PAD_LEFT);
        }

        return $time;
    }

}
