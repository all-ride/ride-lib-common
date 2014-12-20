<?php

namespace ride\library\decorator;

/**
 * Decorator to search and replace a static value in a string
 */
class ReplaceDecorator implements Decorator {

    /**
     * Search string
     * @var string
     */
    protected $search;

    /**
     * Replace string
     * @var string
     */
    protected $replace;

    /**
     * Constructs a new replace decorator
     * @param string $search Search string
     * @param string $replace Replace string
     */
    public function __construct($search, $replace) {
        $this->setSearch($search);
        $this->setReplace($replace);
    }

    /**
     * Sets the search string
     * @param string $search
     * @return null
     */
    public function setSearch($search) {
        $this->search = $search;
    }

    /**
     * Gets the search string
     * @return string
     */
    public function getSearch() {
        return $this->search;
    }

    /**
     * Sets the replace string
     * @param string $replace
     * @return null
     */
    public function setReplace($replace) {
        $this->replace = $replace;
    }

    /**
     * Gets the replace string
     * @return string
     */
    public function getReplace() {
        return $this->replace;
    }

    /**
     * Performs a replace if string provided
     * @param mixed $value
     * @return mixed Provided value with the search replaced if applicable
     */
    public function decorate($value) {
        if (is_string($value)) {
            $value = str_replace($this->search, $this->replace, $value);
        }

        return $value;
    }

}
