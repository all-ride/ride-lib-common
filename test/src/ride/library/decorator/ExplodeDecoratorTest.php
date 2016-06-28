<?php

namespace ride\library\decorator;

use \PHPUnit_Framework_TestCase;

class ExplodeDecoratorTest extends PHPUnit_Framework_TestCase {

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

}
