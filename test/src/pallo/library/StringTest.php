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
		$string = new String();
		$string = $string->generate();

		$this->assertNotNull($string);
		$this->assertTrue(!empty($string));
		$this->assertTrue(strlen($string) == 8);
	}

	public function testGenerateThrowsExceptionWhenLengthOfHaystackIsLessThenRequestedLength() {
		$string = new String();

		try {
			$string->generate(155);
		} catch (Exception $e) {
			return;
		}

		$this->fail();
	}

	public function testGenerateThrowsExceptionWhenInvalidLengthProvided() {
		$string = new String();

		try {
			$string->generate('test');
		} catch (Exception $e) {
			return;
		}

		$this->fail();
	}

	public function testGenerateThrowsExceptionWhenInvalidHaystackProvided() {
		$string = new String();

		try {
			$string->generate(8, $this);
		} catch (Exception $e) {
			return;
		}

		$this->fail();
	}

	/**
	 * @dataProvider providerStartsWith
	 */
	public function testStartsWith($expected, $value, $start) {
		$string = new String($value);
		$result = $string->startsWith($start);

		$this->assertEquals($expected, $result);
	}

	public function providerStartsWith() {
		return array(
			array(true, 'This is Joe', 'This'),
			array(false, 'Thi', 'this'),
			array(false, 'This is Joe', array('no', 'yes')),
			array(true, 'This is Joe', array('no', 'This')),
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
			array('This...', 'This is a test', 9, '...', false),
			array('This is a test', 'This is a test', 15, '...', true),
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