<?php

namespace ride\library\decorator;

use \PHPUnit_Framework_TestCase;

class TypeOrDecoratorTest extends PHPUnit_Framework_TestCase {

    /**
     * @dataProvider providerDecorate
     */
    public function testDecorate($expected, $value, $type, $default, $resolveObject) {
        $decorator = new TypeOrDecorator($type, $default, $resolveObject);

        $this->assertEquals($expected, $decorator->decorate($value));
    }

    public function providerDecorate() {
        return array(
            array('test', 'test', 'string', null, false),
            array(null, 'test', 'integer', null, false),
            array(array('test'), array('test'), 'array', null, false),
            array('default', $this, 'array', 'default', false),
            array($this, $this, 'object', 'default', false),
            array($this, $this, 'ride\\library\\decorator\\TypeOrDecoratorTest', 'default', true),
        );
    }

}
