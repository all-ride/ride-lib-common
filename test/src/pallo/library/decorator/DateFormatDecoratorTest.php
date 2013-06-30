<?php

namespace pallo\library\decorator;

use \PHPUnit_Framework_TestCase;

class DateFormatDecoratorTest extends PHPUnit_Framework_TestCase {

	/**
	 * @dataProvider providerDecorate
	 */
    public function testDecorate($expected, $value) {
        $decorator = new DateFormatDecorator();

        $this->assertEquals($expected, $decorator->decorate($value));
    }

    public function providerDecorate() {
    	return array(
    		array("test", "test"),
    		array(-500, -500),
    		array("1970-01-01 00:00:00", 0),
    	);
    }

}