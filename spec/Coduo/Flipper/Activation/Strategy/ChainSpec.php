<?php

namespace spec\Coduo\Flipper\Activation\Strategy;

use Coduo\Flipper\Activation\Context;
use Coduo\Flipper\Activation\Strategy;
use Coduo\Flipper\Feature;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

final class ChainSpec extends ObjectBehavior
{
    function let(Strategy $strategy1, Strategy $strategy2)
    {
        $this->beConstructedWith(array($strategy1, $strategy2));
    }

    function it_throws_exception_when_constructor_parameter_isnt_strategy(Strategy $strategy)
    {
        $this->shouldThrow(new \InvalidArgumentException("Only instances of Strategy are accepted by Chain strategy."))
            ->during('__construct', array(array($strategy, new \stdClass())));
    }

    function it_can_add_other_strategies(Strategy $strategy3)
    {
        $this->addStrategy($strategy3);
        $this->getStrategies()->shouldContain($strategy3);
    }

    function it_is_active_when_first_strategy_returns_active_true(Strategy $strategy1, Strategy $strategy2, Feature $feature)
    {
        $id = Context::createFromUserIdentifier('michal@coduo.pl');
        $strategy1->isActive($feature, $id)->willReturn(true);
        $strategy2->isActive($feature, $id)->willReturn(false);
        $this->isActive($feature, $id)->shouldReturn(true);
    }

    function it_is_active_when_any_of_element_returns_active_true(Strategy $strategy1, Strategy $strategy2, Strategy $strategy3, Feature $feature)
    {
        $id = Context::createFromUserIdentifier('michal@coduo.pl');
        $strategy1->isActive($feature, $id)->willReturn(false);
        $strategy2->isActive($feature, $id)->willReturn(true);
        $strategy3->isActive($feature, $id)->willReturn(false);
        $this->isActive($feature, $id)->shouldReturn(true);
    }

    function it_is_not_active_when_non_of_strategies_arent_active(Strategy $strategy1, Strategy $strategy2, Feature $feature)
    {
        $id = Context::createFromUserIdentifier('michal@coduo.pl');
        $strategy1->isActive($feature, $id)->willReturn(false);
        $strategy2->isActive($feature, $id)->willReturn(false);
        $this->isActive($feature, $id)->shouldReturn(false);
    }
}
