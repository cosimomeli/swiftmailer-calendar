<?php

/**
 * Simple MIME part to handle embedded calendar events
 *
 * @author Cosimo Meli
 */
class Swift_CalendarTest extends \PHPUnit\Framework\TestCase
{

    public function testDefaultMethodIsRequest()
    {
        $calendar = new Swift_Calendar();

        self::assertEquals('REQUEST', $calendar->getMethod());
    }

}