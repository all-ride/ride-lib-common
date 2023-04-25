<?php

namespace ride\library\decorator;

use PHPUnit\Framework\TestCase;

class TimeDecoratorTest extends TestCase {

    /**
     * @dataProvider providerDecorate
     */
    public function testDecorate($expected, $value, $includeSeconds = null, $includeHours = null) {
        $decorator = new TimeDecorator($includeSeconds, $includeHours);

        $this->assertEquals($expected, $decorator->decorate($value));
    }

    public function providerDecorate() {
        return array(
            array('01', 72, false, false),
            array('01:12', 72, true, false),
            array('0:01:12', 72, true, true),
            array('61:12', 3672, true, false),
            array('1:01:12', 3672, true, true),
            array('test', 'test', null, null),
        );
    }

}
