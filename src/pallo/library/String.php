<?php

namespace pallo\library;

use \Exception;

/**
 * String helper
 */
class String {

    /**
     * Default character haystack for generating strings
     * @var string
     */
    const GENERATE_HAYSTACK = '123456789bcdfghjkmnpqrstvwxyz';

    /**
     * String
     * @var string
     */
    protected $string;

    /**
     * Constructs a new string
     * @param string $string
     * @return null
     */
    public function __construct($string = null) {
        $this->setString($string);
    }

    /**
     * Gets the string
     * @return string
     */
    public function __toString() {
        return $this->string;
    }

    /**
     * Sets the string
     * @param string $string
     * @return null
     * @throws Exception when a invalid string has been provided
     */
    public function setString($string) {
        if ($string === null) {
            $string = '';
        } elseif (!is_scalar($string) && !method_exists($string, '__toString')) {
            throw new Exception('Could not set the string: invalid string provided');
        }

        $this->string = (string) $string;
    }

    /**
     * Checks whether the string starts with the provided start
     * @param string|array $start String to check as start or an array of strings
     * @return boolean True when the string starts with the provided start
     */
    public function startsWith($start, $isCaseInsensitive = false) {
        if (!is_array($start)) {
            $start = array($start);
        }

        $string = $this->string;
        if ($isCaseInsensitive) {
        	$string = strtoupper($string);
        }

        foreach ($start as $token) {
	        if ($isCaseInsensitive) {
	        	$token = strtoupper($token);
	        }

            $startLength = strlen($token);
            if (strncmp($string, $token, $startLength) == 0) {
                return true;
            }
        }

        return false;
    }

    /**
     * Truncates the provided string
     * @param integer $length Number of characters to keep
     * @param string $etc String to truncate with
     * @param boolean $breakWords Set to true to keep words as a whole
     * @return string Truncated string
     * @throws Exception when the provided length is not a positive integer
     */
    public function truncate($length = 80, $etc = '...', $breakWords = false) {
        if (!$this->string) {
            return '';
        }

        if (!is_numeric($length) || $length <= 0) {
            throw new Exception('Could not truncate the string: provided length is not a positive integer');
        }

        if (strlen($this->string) < $length) {
            return $this->string;
        }

        if (!is_string($etc)) {
            throw new Exception('Could not truncate the string: provided etc is not a string');
        }

        $string = $this->string;

        $length -= strlen($etc);
        if (!$breakWords) {
            $string = preg_replace('/\s+?(\S+)?$/', '', substr($string, 0, $length + 1));
        }

        return substr($string, 0, $length) . $etc;
    }

    /**
     * Gets a safe string for file name and URL usage
     * @param string $replacement Replacement string for all non alpha numeric characters
     * @param boolean $lower Set to false to skip strtolower
     * @return string Safe string for file names and URLs
     */
    public function safeString($replacement = '-', $lower = true) {
        if (!$this->string) {
            return $this->string;
        }

        $string = $this->string;

        $encoding = mb_detect_encoding($string);
        if ($encoding != 'ASCII') {
            $string = iconv($encoding, 'ASCII//TRANSLIT//IGNORE', $string);
        }

        $string = preg_replace("/[\s]/", $replacement, $string);
        $string = preg_replace("/[^A-Za-z0-9._-]/", '', $string);

        if ($lower) {
            $string = strtolower($string);
        }

        return $string;
    }

    /**
     * Adds line numbers to the provided string
     * @param string $string String to add line numbers to
     * @return string String with line numbers added
     */
    public function addLineNumbers() {
        $output = '';
        $lineNumber = 1;
        $lines = explode("\n", $this->string);
        $lineMaxDigits = strlen(count($lines));

        foreach ($lines as $line) {
            $output .= str_pad($lineNumber , $lineMaxDigits, '0', STR_PAD_LEFT) . ': ' . $line . "\n";
            $lineNumber++;
        }

        $output = substr($output, 0, -1);

        return $output;
    }

    /**
     * Generates a random string
     * @param integer $length Number of characters to generate
     * @param string $haystack String with the haystack to pick characters from
     * @return string A random string
     * @throws Exception when an invalid length is provided
     * @throws Exception when an empty haystack is provided
     * @throws Exception when the requested length is greater then the length
     * of the haystack
     */
    public static function generate($length = 8, $haystack = null) {
    	$string = '';
    	if ($haystack === null) {
    		$haystack = self::GENERATE_HAYSTACK;
    	}

    	if (!is_integer($length) || $length <= 0) {
    		throw new Exception('Could not generate a random string: invalid length provided');
    	}

    	if (!is_string($haystack) || !$haystack) {
    		throw new Exception('Could not generate a random string: empty or invalid haystack provided');
    	}

    	$haystackLength = strlen($haystack);
    	if ($length > $haystackLength) {
    		throw new Exception('Length cannot be greater than the length of the haystack. Length is ' . $length . ' and the length of the haystack is ' . $haystackLength);
    	}

    	$i = 0;
    	while ($i < $length) {
    		$index = mt_rand(0, $haystackLength - 1);

    		$string .= $haystack[$index];

    		$i++;
    	}

    	return $string;
    }

}