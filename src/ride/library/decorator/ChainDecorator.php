<?php

namespace ride\library\decorator;

use \InvalidArgumentException;

/**
 * Chains multiple decorator as one
 */
class ChainDecorator implements Decorator {

    /**
     * Chain of decorators
     * @var array
     */
    protected $chain;

    /**
     * Constructs a new chain decorator
     * @param array $chain Initial chain of decorators
     */
    public function __construct(array $chain) {
        $this->setChain($chain);
    }

    /**
     * Sets the decorator chain
     * @param array $chain Chain of decorators
     */
    public function setChain(array $chain) {
        foreach ($chain as $decorator) {
            if (!$decorator instanceof Decorator) {
                throw new InvalidArgumentException('Non decorator instance detected in the chain. Make sure your chain is an array of ride\\library\\decorator\\Decorator instances.');
            }
        }

        $this->chain = $chain;
    }

    /**
     * Adds a decorator to the chain
     * @param ride\library\decorator\Decorator $decorator
     * @param boolean $prepend Set to true to add at the beginning of the chain
     */
    public function addDecorator(Decorator $decorator, $prepend = false) {
        if ($prepend) {
            array_shift($this->chain, $decorator);
        } else {
            array_push($this->chain, $decorator);
        }
    }

    /**
     * Performs the actual decorating on the provided value.
     * @param mixed $value Value to decorate
     * @return mixed Decorated value
     */
    public function decorate($value) {
        foreach ($this->chain as $decorator) {
            $value = $decorator->decorate($value);
        }

        return $value;
    }

}
