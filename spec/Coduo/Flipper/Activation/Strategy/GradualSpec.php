<?php

namespace spec\Coduo\Flipper\Activation\Strategy;

use Coduo\Flipper\Activation\Argument\UserIdentifier;
use Coduo\Flipper\Activation\Context;
use Coduo\Flipper\Feature;
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

    function it_should_always_return_false_for_zero_percent(Feature $feature, Context $context)
    {
        $this->beConstructedWith(0);

        foreach ([0, 10, 50, 99, 100] as $id) {
            $context->resolveArgument(Argument::any())->willReturn(new UserIdentifier($id));
            $this->isActive($feature, $context)->shouldReturn(false);
        }
    }

    function it_should_always_return_true_for_one_hundered_percent(Feature $feature, Context $context)
    {
        $this->beConstructedWith(100);

        foreach ([0, 10, 50, 99, 100] as $id) {
            $context->resolveArgument(Argument::any())->willReturn(new UserIdentifier($id));
            $this->isActive($feature, $context)->shouldReturn(true);
        }
    }

}
