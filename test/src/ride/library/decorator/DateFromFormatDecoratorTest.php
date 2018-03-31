<?php

namespace ride\library\decorator;

use \DateTime;
use PHPUnit\Framework\TestCase;

class DateFromFormatDecoratorTest extends TestCase {

    public function testSetAndGetDateFormat() {
        $decorator = new DateFromFormatDecorator();

        $this->assertEquals(DateFormatDecorator::DEFAULT_DATE_FORMAT, $decorator->getDateFormat());

        $dateFormat = 'Y-m-d';

        $decorator->setDateFormat($dateFormat);

        $this->assertEquals($dateFormat, $decorator->getDateFormat());
    }

    /**
     * @expectedException ride\library\decorator\exception\DecoratorException
     */
    public function testSetDateFormatThrowsExceptionOnInvalidDateFormat() {
        $decorator = new DateFromFormatDecorator();
        $decorator->setDateFormat($this);
    }

    /**
     * @dataProvider providerDecorate
     */
    public function testDecorate($expected, $value, $dateFormat = null, $invalidToNull = null) {
        date_default_timezone_set('UTC');

        $decorator = new DateFromFormatDecorator();
        if ($dateFormat !== null) {
            $decorator->setDateFormat($dateFormat);
        }
        if ($invalidToNull !== null) {
            $decorator->setInvalidToNull($invalidToNull);
        }

        $result = $decorator->decorate($value);

        if (is_numeric($expected)) {
            $this->assertTrue(is_numeric($result));
            $this->assertTrue($expected <= $result && $result <= $expected + 1);
        } else {
            $this->assertEquals($expected, $result);
        }
    }

    public function providerDecorate() {
        return array(
            array($this, $this),
            array("test", "test"),
            array(null, "test", null, true),
            array(-500, "1969-12-31 23:51:40"),
            array(0, "1970-01-01 00:00:00"),
            array(1372582573, "2013-06-30 08:56:13"),
            array(1372550400 + (time() % 86400), "2013-06-30", 'Y-m-d'),
        );
    }

}
