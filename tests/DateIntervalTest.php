<?php
namespace Tests;

use Ealore\DateInterval\DateInterval;

class DateIntervalTest extends \PHPUnit_Framework_TestCase
{
    public function testDateIntervalConstructorYear()
    {
        $date_interval = new DateInterval('P1Y');

        $this->assertEquals(1, $date_interval->y);
    }

    public function testDateIntervalConstructorMonth()
    {
        $date_interval = new DateInterval('P2M');

        $this->assertEquals(2, $date_interval->m);
    }

    public function testDateIntervalConstructorWeek()
    {
        $date_interval = new DateInterval('P3W');

        $this->assertEquals(3, $date_interval->w);
    }

    public function testDateIntervalConstructorDay()
    {
        $date_interval = new DateInterval('P4D');

        $this->assertEquals(4, $date_interval->d);
    }

    public function testDateIntervalConstructorHour()
    {
        $date_interval = new DateInterval('PT5H');

        $this->assertEquals(5, $date_interval->h);
    }

    public function testDateIntervalConstructorMinute()
    {
        $date_interval = new DateInterval('PT6M');

        $this->assertEquals(6, $date_interval->i);
    }

    public function testDateIntervalConstructorSecond()
    {
        $date_interval = new DateInterval('PT7S');

        $this->assertEquals(7, $date_interval->s);
    }


    public function testDateIntervalConstructorInvertTrue()
    {
        $date_interval = new DateInterval('-P1Y2M');

        $this->assertEquals(1, $date_interval->invert);
    }

    public function testDateIntervalConstructorInvertFalse()
    {
        $date_interval = new DateInterval('P1Y2M');

        $this->assertEquals(0, $date_interval->invert);
    }

    public function testGetLegacyIntervalWeeksAndDays()
    {
        $date_interval = new DateInterval('P1W1D');

        $legacy_interval = $date_interval->legacy();

        $this->assertEquals(8, $legacy_interval->d);
        $this->assertEquals(0, $legacy_interval->w);
        $this->assertEquals(0, $legacy_interval->invert);

        $this->assertEquals(1, $date_interval->d);
        $this->assertEquals(1, $date_interval->w);
        $this->assertEquals(0, $date_interval->invert);
    }

    public function testGetLegacyIntervalNegativeWeeksAndDays()
    {
        $date_interval = new DateInterval('-P1W1D');

        $legacy_interval = $date_interval->legacy();

        $this->assertEquals(8, $legacy_interval->d);
        $this->assertEquals(0, $legacy_interval->w);
        $this->assertEquals(1, $legacy_interval->invert);

        $this->assertEquals(1, $date_interval->d);
        $this->assertEquals(1, $date_interval->w);
        $this->assertEquals(1, $date_interval->invert);
    }

    public function testGetLegacyIntervalFullString()
    {
        $date_interval = new DateInterval('P1Y2M3W4DT5H6M7S');

        $legacy_interval = $date_interval->legacy();

        $this->assertEquals(1, $legacy_interval->y);
        $this->assertEquals(2, $legacy_interval->m);
        $this->assertEquals(0, $legacy_interval->w);
        $this->assertEquals(25, $legacy_interval->d);
        $this->assertEquals(5, $legacy_interval->h);
        $this->assertEquals(6, $legacy_interval->i);
        $this->assertEquals(7, $legacy_interval->s);
        $this->assertEquals(0, $legacy_interval->invert);

        $this->assertEquals(1, $date_interval->y);
        $this->assertEquals(2, $date_interval->m);
        $this->assertEquals(3, $date_interval->w);
        $this->assertEquals(4, $date_interval->d);
        $this->assertEquals(5, $date_interval->h);
        $this->assertEquals(6, $date_interval->i);
        $this->assertEquals(7, $date_interval->s);
        $this->assertEquals(0, $date_interval->invert);
    }

    public function testGetLegacyIntervalInvertedFullString()
    {
        $date_interval = new DateInterval('-P1Y2M3W4DT5H6M7S');

        $legacy_interval = $date_interval->legacy();

        $this->assertEquals(1, $legacy_interval->y);
        $this->assertEquals(2, $legacy_interval->m);
        $this->assertEquals(0, $legacy_interval->w);
        $this->assertEquals(25, $legacy_interval->d);
        $this->assertEquals(5, $legacy_interval->h);
        $this->assertEquals(6, $legacy_interval->i);
        $this->assertEquals(7, $legacy_interval->s);
        $this->assertEquals(1, $legacy_interval->invert);

        $this->assertEquals(1, $date_interval->y);
        $this->assertEquals(2, $date_interval->m);
        $this->assertEquals(3, $date_interval->w);
        $this->assertEquals(4, $date_interval->d);
        $this->assertEquals(5, $date_interval->h);
        $this->assertEquals(6, $date_interval->i);
        $this->assertEquals(7, $date_interval->s);
        $this->assertEquals(1, $date_interval->invert);
    }

    public function testNegativeIntevalSpecWeekAgainstLegacy()
    {
        $date_interval = new DateInterval('-P1W');

        $this->assertEquals(0, $date_interval->y);
        $this->assertEquals(0, $date_interval->m);
        $this->assertEquals(1, $date_interval->w);
        $this->assertEquals(0, $date_interval->d);
        $this->assertEquals(1, $date_interval->invert);

        $legacy_interval = $date_interval->legacy();

        $this->assertEquals(0, $legacy_interval->y);
        $this->assertEquals(0, $legacy_interval->m);
        $this->assertEquals(0, $legacy_interval->w);
        $this->assertEquals(7, $legacy_interval->d);
        $this->assertEquals(1, $legacy_interval->invert);
    }

    public function testGetIntervalSpec()
    {
        $date_interval = new DateInterval('P1Y2M3W4DT5H6M7S');
        $this->assertEquals('P1Y2M3W4DT5H6M7S', $date_interval->getIntervalSpec());
    }

    public function testGetNegativeIntervalSpec()
    {
        $date_interval = new DateInterval('-P1Y2M3W4DT5H6M7S');
        $this->assertEquals('-P1Y2M3W4DT5H6M7S', $date_interval->getIntervalSpec());
    }
}
