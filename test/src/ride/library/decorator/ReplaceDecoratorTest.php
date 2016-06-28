<?php

namespace ride\library\decorator;

use \PHPUnit_Framework_TestCase;

class ReplaceDecoratorTest extends PHPUnit_Framework_TestCase {

    /**
     * @dataProvider providerDecorate
     */
    public function testDecorate($expected, $value, $search, $replace) {
        $decorator = new ReplaceDecorator($search, $replace);

        $this->assertEquals($expected, $decorator->decorate($value));
    }

    public function providerDecorate() {
        return array(
            array('Hello John', 'Hello Joe', 'Joe', 'John'),
        );
    }

}
