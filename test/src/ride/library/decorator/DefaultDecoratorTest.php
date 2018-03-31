<?php

namespace ride\library\decorator;

use PHPUnit\Framework\TestCase;

class DefaultDecoratorTest extends TestCase {

    /**
     * @dataProvider providerDecorate
     */
    public function testDecorate($expected, $value) {
        $decorator = new DefaultDecorator('default');

        $this->assertEquals($expected, $decorator->decorate($value));
    }

    public function providerDecorate() {
        return array(
            array("test", "test"),
            array($this, $this),
            array('default', false),
            array('default', null),
            array('default', 0),
            array('default', ''),
        );
    }

    public function testGetDefaultValue() {
        $decorator = new DefaultDecorator('default');

        $this->assertEquals('default', $decorator->getDefaultValue());
    }

}
