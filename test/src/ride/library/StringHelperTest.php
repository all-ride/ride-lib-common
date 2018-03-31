<?php

namespace ride\library;

use PHPUnit\Framework\TestCase;

class StringHelperTest extends TestCase {

    public function testGenerate() {
        $string = StringHelper::generate();

        $this->assertNotNull($string);
        $this->assertTrue(!empty($string));
        $this->assertTrue(strlen($string) == 8);
    }

    /**
     * @expectedException \Exception
     * @ExcpectedExceptionMessage Length cannot be greater than the length of the haystack. Length is 155 and the length of the haystack is 29
     */
    public function testGenerateThrowsExceptionWhenLengthOfHaystackIsLessThenRequestedLength() {
        StringHelper::generate(155);
    }

    /**
     * @expectedException \Exception
     * @expectedExceptionMessage Could not generate a random string: invalid length provided
     */
    public function testGenerateThrowsExceptionWhenInvalidLengthProvided() {
        StringHelper::generate('test');
    }

    /**
     * @expectedException \Exception
     * @expectedExceptionMessage Could not generate a random string: empty or invalid haystack provided
     */
    public function testGenerateThrowsExceptionWhenInvalidHaystackProvided() {
        StringHelper::generate(8, $this);
    }

    /**
     * @dataProvider providerStartsWith
     */
    public function testStartsWith($expected, $value, $start, $isCaseInsensitive) {
        $result = StringHelper::startsWith($value, $start, $isCaseInsensitive);

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
        $result = StringHelper::truncate($value, $length, $etc, $breakWords);

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
     * @expectedException \Exception
     */
    public function testTruncateThrowsExceptionWhenInvalidArgumentProvided($length, $etc) {
        $string = 'abcdefghijklmnopqrstuvwxyz';
        StringHelper::truncate($string, $length, $etc);
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

        $result = StringHelper::safeString($value);

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
            array('categorien', 'Categoriën'),
        );
    }

    public function testAddLineNumbers() {
        $text = "Line1\nLine2\nLine3";
        $expected = "1: Line1\n2: Line2\n3: Line3";

        $result = StringHelper::addLineNumbers($text);

        $this->assertEquals($expected, $result);
    }

    public function testTruncateShouldReturnOriginalString() {
        $string = 'test';

        $this->assertSame($string, StringHelper::truncate($string));
    }

}
