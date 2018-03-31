<?php

namespace ride\library\decorator;

use PHPUnit\Framework\TestCase;

class LowerCaseDecoratorTest extends TestCase {

    /**
     * @dataProvider providerDecorate
     */
    public function testDecorate($expected, $value) {
        $decorator = new LowerCaseDecorator();

        $this->assertEquals($expected, $decorator->decorate($value));
    }

    public function providerDecorate() {
        return array(
            array("test", "TEsT"),
            array(-500, -500),
            array($this, $this),
        );
    }

}
