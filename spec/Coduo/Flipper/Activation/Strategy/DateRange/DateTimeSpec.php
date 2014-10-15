<?php

namespace spec\Coduo\Flipper\Activation\Strategy\DateRange;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class DateTimeSpec extends ObjectBehavior
{
    function it_can_be_created_with_valid_format()
    {
        $this->beConstructedWith("2014-01-01 18:00:00");
        $this->__toString()->shouldReturn("2014-01-01 18:00:00");
    }
}
