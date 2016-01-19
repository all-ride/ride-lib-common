<?php

namespace ride\library\decorator;

/**
 * Decorator to transform a string to lower case
 */
class LowerCaseDecorator implements Decorator {

    /**
     * Transforms a string to lower case
     * @param mixed $value Value to decorate
     * @return mixed Lower case string if value is a string, provided value
     * otherwise
     */
    public function decorate($value) {
        if (!is_string($value)) {
            return $value;
        }

        return strtolower($value);
    }

}
