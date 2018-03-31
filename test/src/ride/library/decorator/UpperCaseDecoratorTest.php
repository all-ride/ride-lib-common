<?php

namespace ride\library\decorator;

use PHPUnit\Framework\TestCase;

class UpperCaseDecoratorTest extends TestCase {

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
