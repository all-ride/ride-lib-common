<?php

namespace ride\library\decorator;

/**
 * Decorator which provides a default value for empty fields.
 */
class DefaultDecorator implements Decorator {

    /**
     * Default value when the to decorate value is empty
     * @var mixed
     */
    protected $defaultValue;

    /**
     * Constructs a new default decorator
     * @param mixed $defaultValue Value when the to decorate value is empty
     * @return null
     */
    public function __construct($defaultValue) {
        $this->setDefaultValue($defaultValue);
    }
    /**
     * Sets the default value
     * @param mixed $defaultValue
     * @return null
     */
    public function setDefaultValue($defaultValue) {
        $this->defaultValue = $defaultValue;
    }

    /**
     * Gets the default value
     * @return mixed
     */
    public function getDefaultValue() {
        return $this->defaultValue;
    }

    /**
     * Replaces an empty value with a default value
     * @param mixed $value Value to decorate
     * @return mixed Provided value if not empty, the default value otherwise
     */
    public function decorate($value) {
        if (!empty($value)) {
            return $value;
        }

        return $this->defaultValue;
    }

}
