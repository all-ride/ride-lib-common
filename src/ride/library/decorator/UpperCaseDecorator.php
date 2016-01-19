<?php

namespace ride\library\decorator;

/**
 * Decorator to transform a string to upper case
 */
class UpperCaseDecorator implements Decorator {

    /**
     * Transforms a string to upper case
     * @param mixed $value Value to decorate
     * @return mixed Upper case string if value is a string, provided value
     * otherwise
     */
    public function decorate($value) {
        if (!is_string($value)) {
            return $value;
        }

        return strtoupper($value);
    }

}
