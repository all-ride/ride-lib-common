<?php

namespace ride\library\decorator;

/**
 * Decorate a UNIX timestamp into a human readable date
 */
class DateFromFormatDecorator extends DateFormatDecorator {

    /**
     * Decorates a formatted date into a UNIX timestamp
     * @param mixed $value
     * @return mixed A UNIX timestamp if a valid formatted date has been
     * provided, the original value otherwise
     */
    public function decorate($value) {
        if (!is_string($value)) {
            return $value;
        }

        if ($this->dateFormat) {
            $dateFormat = $this->dateFormat;
        } else {
            $dateFormat = self::DEFAULT_DATE_FORMAT;
        }

        $date = date_create_from_format($dateFormat, $value);
        if ($date === false) {
            return $value;
        }

        return $date->format('U');
    }

}
