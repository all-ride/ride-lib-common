<?php

namespace ride\library\decorator;

use PHPUnit\Framework\TestCase;

class PercentDecoratorTest extends TestCase {

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

    /**
     * @expectedException ride\library\decorator\exception\DecoratorException
     */
    public function testSetPrecisionShouldThrowDecoratorException() {
        $decorator = new PercentDecorator(0);

        $decorator->setPrecision(-1);
    }

}
