<?php

namespace spec\Coduo\Flipper\Activation\Strategy;

use Coduo\Flipper\Activation\Strategy\DateRange\CurrentDateTime;
use Coduo\Flipper\Activation\Strategy\DateRange\DateTime;
use Coduo\Flipper\Feature;
use Coduo\Flipper\Identifier;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class DateRangeSpec extends ObjectBehavior
{
    function it_is_initialized_with_two_dates()
    {
        $from = new DateTime("2014-01-01");
        $to = new DateTime("2014-01-15");
        $this->beConstructedWith($from, $to);
    }

    function it_throws_exception_when_to_is_lesser_than_from()
    {
        $this->shouldThrow(new \InvalidArgumentException("Date range invalid. End needs to be greater than start."))
            ->during('__construct', array(new DateTime("2014-02-01"), new DateTime("2014-01-01")));
    }

    /**
     * @before modifyCurrentDate
     */
    function it_checks_active_when_its_over(Feature $feature)
    {
        $this->beConstructedWith(new DateTime("2014-10-15 17:00:00"), new DateTime("2014-10-16 19:00:00"));
        $this->isActive($feature, new Identifier('michal'))->shouldReturn(true);
    }

    /**
     * @before modifyCurrentDate
     */
    function it_checks_active_for_invalid_range(Feature $feature)
    {
        $this->beConstructedWith(new DateTime("2014-10-15 16:00:00"), new DateTime("2014-10-15 17:00:00"));
        $this->isActive($feature, new Identifier('michal'))->shouldReturn(false);
    }

    /**
     * @before modifyCurrentDate
     */
    function it_checks_active_when_its_hasnt_started_yet(Feature $feature)
    {
        $this->beConstructedWith(new DateTime("2014-10-15 19:00:00"), new DateTime("2014-10-15 21:00:00"));
        $this->isActive($feature, new Identifier('michal'))->shouldReturn(false);
    }

    /**
     * @before modifyCurrentDate
     */
    function it_can_check_if_feature_has_started_positively(Feature $feature)
    {
        $this->beConstructedWith(new DateTime("2014-10-15 17:00:00"), new DateTime("2014-10-15 21:00:00"));
        $this->hasStared()->shouldReturn(true);
    }

    /**
     * @before modifyCurrentDate
     */
    function it_can_check_if_feature_has_started_negatively(Feature $feature)
    {
        $this->beConstructedWith(new DateTime("2014-10-15 19:00:00"), new DateTime("2014-10-15 21:00:00"));
        $this->hasStared()->shouldReturn(false);
    }

    /**
     * @before modifyCurrentDate
     */
    function it_can_check_if_feature_has_ended_positively(Feature $feature)
    {
        $this->beConstructedWith(new DateTime("2014-10-15 17:00:00"), new DateTime("2014-10-15 21:00:00"));
        $this->hasEnded()->shouldReturn(true);
    }

    /**
     * @before modifyCurrentDate
     */
    function it_can_check_if_feature_has_ended_negatively(Feature $feature)
    {
        $this->beConstructedWith(new DateTime("2014-10-15 19:00:00"), new DateTime("2014-10-15 21:00:00"));
        $this->hasEnded()->shouldReturn(true);
    }

    function modifyCurrentDate()
    {
        $date = new \DateTime("2014-10-15 18:00:00");
        CurrentDateTime::modifyDate($date);
    }

    function letgo()
    {
        CurrentDateTime::reset();
    }
}
