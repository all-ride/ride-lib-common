<?php

namespace ride\library\decorator;

use \PHPUnit_Framework_TestCase;

class PercentDecoratorTest extends PHPUnit_Framework_TestCase {

    /**
     * @dataProvider providerDecorate
     */
    public function testDecorate($expected, $value, $precision) {
        $decorator = new PercentDecorator($precision);

        $this->assertEquals($expected, $decorator->decorate($value));
    }

    public function providerDecorate() {
        return array(
            array("test", "test", 0),
            array('85 %', 85.212325, 0),
            array('85.21 %', 85.212325, 2),
        );
    }

}
