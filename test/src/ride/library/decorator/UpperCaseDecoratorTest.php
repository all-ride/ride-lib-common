<?php

namespace ride\library\decorator;

use \PHPUnit_Framework_TestCase;

class UpperCaseDecoratorTest extends PHPUnit_Framework_TestCase {

    /**
     * @dataProvider providerDecorate
     */
    public function testDecorate($expected, $value) {
        $decorator = new UpperCaseDecorator();

        $this->assertEquals($expected, $decorator->decorate($value));
    }

    public function providerDecorate() {
        return array(
            array("TEST", "test"),
            array(-500, -500),
            array($this, $this),
        );
    }

}
