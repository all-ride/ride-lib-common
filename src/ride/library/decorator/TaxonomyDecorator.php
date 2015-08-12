<?php

namespace ride\library\decorator;

use ride\library\orm\OrmManager;
use ride\web\orm\taxonomy\OrmTagHandler;

/**
 * Decorator which decorates TaxonomyTermEntries from a given string$
 */
class TaxonomyDecorator implements Decorator {

    /**
     * Constructs a new taxonomy decorator
     * Processes terms split by a delimiter into taxonomy terms in a given vocabulary.
     * @param \ride\library\orm\OrmManager $ormManager
     * @param string $vocabulary Id of the vocabulary
     * @param string $delimiter Delimiter on which to explode the values
     * @return null
     */
    public function __construct(OrmManager $ormManager, $vocabulary, $delimiter = false) {
        $this->ormTagHandler =  new OrmTagHandler($ormManager, $vocabulary);
        $this->delimiter = $delimiter;
    }

    /**
     * Decorates the provided value as an entry proxy
     * @param mixed $values Values to decorate
     * @return array Entry proxy for the destination provider of possible,
     */
    public function decorate($value) {
        if (!is_string($value)) {
            return $value;
        } else if (empty($value)) {
            return $this->delimiter == false ? null : array();
        }

        if ($this->delimiter != false) {
            $values = explode($this->delimiter, $value);

            return $this->ormTagHandler->processTags($values);
        }
        $tags = $this->ormTagHandler->processTags(array($value));

        return $tags[$value];
    }

}
