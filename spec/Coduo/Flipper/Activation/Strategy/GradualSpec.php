<?php

namespace spec\Coduo\Flipper\Activation\Strategy;

use Coduo\Flipper\Feature;
use Coduo\Flipper\Identifier;
use Coduo\Tests\Flipper\TestUser;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class GradualSpec extends ObjectBehavior
{

    function it_is_initializable_with_percentage_number()
    {
        $this->beConstructedWith(10);
        $this->getPercentage()->shouldReturn(10);
    }

    function it_should_always_return_false_for_zero_percent(Feature $feature)
    {
        $this->beConstructedWith(0);
        $this->isActive($feature, new Identifier(0))->shouldReturn(false);
        $this->isActive($feature, new Identifier(10))->shouldReturn(false);
        $this->isActive($feature, new Identifier(50))->shouldReturn(false);
        $this->isActive($feature, new Identifier(99))->shouldReturn(false);
        $this->isActive($feature, new Identifier(100))->shouldReturn(false);
    }

    function it_should_always_return_true_for_one_hundered_percent(Feature $feature)
    {
        $this->beConstructedWith(100);
        $this->isActive($feature, new Identifier(0))->shouldReturn(true);
        $this->isActive($feature, new Identifier(10))->shouldReturn(true);
        $this->isActive($feature, new Identifier(50))->shouldReturn(true);
        $this->isActive($feature, new Identifier(99))->shouldReturn(true);
        $this->isActive($feature, new Identifier(100))->shouldReturn(true);
    }

}
