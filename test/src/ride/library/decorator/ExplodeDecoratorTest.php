<?php

namespace ride\library\decorator;

use PHPUnit\Framework\TestCase;

class ExplodeDecoratorTest extends TestCase {

    /**
     * @dataProvider providerDecorate
     */
    public function testDecorate($expected, $value) {
        $decorator = new ExplodeDecorator(':');

        $this->assertEquals($expected, $decorator->decorate($value));
    }

    public function providerDecorate() {
        return array(
            array($this, $this),
            array(null, null),
            array(array(), ''),
            array(array('test'), "test"),
            array(array('john', 'jane'), "john:jane"),
        );
    }

    public function testGetGlue() {
        $decorator = new ExplodeDecorator(':');

        $this->assertSame(':', $decorator->getGlue());
    }

}
