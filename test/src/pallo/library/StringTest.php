<?php

namespace pallo\library;

use \Exception;
use \PHPUnit_Framework_TestCase;

class StringTest extends PHPUnit_Framework_TestCase {

    /**
     * @dataProvider providerSetStringThrowsExceptionWhenInvalidArgumentProvided
     */
    public function testSetStringThrowsExceptionWhenInvalidArgumentProvided($string) {
        try {
            new String($string);
        } catch (Exception $e) {
            return;
        }

        $this->fail();
    }

    public function providerSetStringThrowsExceptionWhenInvalidArgumentProvided() {
        return array(
            array(array()),
            array($this),
        );
    }

    public function testGenerate() {
        $string = String::generate();

        $this->assertNotNull($string);
        $this->assertTrue(!empty($string));
        $this->assertTrue(strlen($string) == 8);
    }

    public function testGenerateThrowsExceptionWhenLengthOfHaystackIsLessThenRequestedLength() {
        try {
            String::generate(155);
        } catch (Exception $e) {
            return;
        }

        $this->fail();
    }

    public function testGenerateThrowsExceptionWhenInvalidLengthProvided() {
        try {
            String::generate('test');
        } catch (Exception $e) {
            return;
        }

        $this->fail();
    }

    public function testGenerateThrowsExceptionWhenInvalidHaystackProvided() {
        try {
            String::generate(8, $this);
        } catch (Exception $e) {
            return;
        }

        $this->fail();
    }

    /**
     * @dataProvider providerStartsWith
     */
    public function testStartsWith($expected, $value, $start, $isCaseInsensitive) {
        $string = new String($value);
        $result = $string->startsWith($start, $isCaseInsensitive);

        $this->assertEquals($expected, $result);
    }

    public function providerStartsWith() {
        return array(
            array(true, 'This is Joe', 'This', false),
            array(false, 'This is joe', 'this', false),
            array(false, 'Thi', 'this', false),
            array(false, 'This is Joe', array('no', 'yes'), false),
            array(true, 'This is Joe', array('no', 'This'), false),
            array(false, 'This is Joe', array('no', 'this'), false),
            array(true, 'This is Joe', array('no', 'this'), true),
        );
    }

    /**
     * @dataProvider providerTruncate
     */
    public function testTruncate($expected, $value, $length, $etc, $breakWords) {
        $string = new String($value);
        $result = $string->truncate($length, $etc, $breakWords);

        $this->assertEquals($expected, $result);
    }

    public function providerTruncate() {
        return array(
            array('', '', 9, '...', false),
            array('Let\'s...', 'Let\'s create a stràngé STRING', 12, '...', false),
            array('Let\'s cre...', 'Let\'s create a stràngé STRING', 12, '...', true),
        );
    }

    /**
     * @dataProvider providerTruncateThrowsExceptionWhenInvalidArgumentProvided
     */
    public function testTruncateThrowsExceptionWhenInvalidArgumentProvided($length, $etc) {
        $string = new String('abcdefghijklmnopqrstuvwxyz');

        try {
            $string->truncate($length, $etc);
        } catch (Exception $e) {
            return;
        }

        $this->fail();
    }

    public function providerTruncateThrowsExceptionWhenInvalidArgumentProvided() {
        return array(
            array(array(), '...'),
            array($this, '...'),
            array(-2, '...'),
            array(0, '...'),
            array(1, array()),
            array(1, $this),
        );
    }

    /**
     * @dataProvider providerSafeString
     */
    public function testSafeString($expected, $value) {
        $locale = setlocale(LC_ALL, 'en_IE.utf8', 'en_IE', 'en');

        $string = new String($value);
        $result = $string->safeString();

        $this->assertEquals($expected, $result);
    }

    public function providerSafeString() {
        return array(
            array('', ''),
            array('simple-test', 'Simple test'),
            array('internet-explorer-pocket', 'Internet Explorer (Pocket)'),
            array('jefs-book', 'Jef\'s book'),
            array('test', '##tEst@|"'),
            array('a-image.jpg', 'a-image.jpg'),
            array('lets-test-with-some-strange-chars', 'Let\'s test with some stràngé chars'),
        );
    }

    public function testAddLineNumbers() {
        $text = "Line1\nLine2\nLine3";
        $expected = "1: Line1\n2: Line2\n3: Line3";

        $string = new String($text);
        $result = $string->addLineNumbers();

        $this->assertEquals($expected, $result);
    }

}