<?php

namespace ride\library\decorator;

use PHPUnit\Framework\TestCase;

class ReplaceDecoratorTest extends TestCase {

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

    public function testGetSearch() {
        $decorator = new ReplaceDecorator('Joe', 'John');

        $this->assertSame('Joe', $decorator->getSearch());
    }

    public function testGetReplace() {
        $decorator = new ReplaceDecorator('Joe', 'John');

        $this->assertSame('John', $decorator->getReplace());
    }

}
