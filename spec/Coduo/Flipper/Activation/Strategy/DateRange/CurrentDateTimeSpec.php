<?php

namespace spec\Coduo\Flipper\Activation\Strategy\DateRange;

use Coduo\Flipper\Activation\Strategy\DateRange\CurrentDateTime;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class CurrentDateTimeSpec extends ObjectBehavior
{

    function it_is_now_by_default()
    {
        $now = new \DateTime("now");
        $this->getDate()->shouldBeLike($now);
    }

    /**
     *  @before modifyCurrentDateTime
     */
    function it_can_be_different_if_u_tell_it_to_be()
    {
        $this->__toString()->shouldReturn("2014-10-15 18:00:00");
    }

    function modifyCurrentDateTime()
    {
        $date = new \DateTime("2014-10-15 18:00:00");
        CurrentDateTime::modifyDate($date);
    }
}
