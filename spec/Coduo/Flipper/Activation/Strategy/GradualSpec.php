<?php

namespace spec\Coduo\Flipper\Activation\Strategy;

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

    function it_should_always_return_false_for_zero_percent(Feature $feature)
    {
        $this->beConstructedWith(0);
        $this->isActive($feature, new TestUser(0))->shouldReturn(false);
        $this->isActive($feature, new TestUser(10))->shouldReturn(false);
        $this->isActive($feature, new TestUser(50))->shouldReturn(false);
        $this->isActive($feature, new TestUser(99))->shouldReturn(false);
        $this->isActive($feature, new TestUser(100))->shouldReturn(false);
    }

    function it_should_always_return_true_for_one_hundered_percent(Feature $feature)
    {
        $this->beConstructedWith(100);
        $this->isActive($feature, new TestUser(0))->shouldReturn(true);
        $this->isActive($feature, new TestUser(10))->shouldReturn(true);
        $this->isActive($feature, new TestUser(50))->shouldReturn(true);
        $this->isActive($feature, new TestUser(99))->shouldReturn(true);
        $this->isActive($feature, new TestUser(100))->shouldReturn(true);
    }

    function it_should_work_for_percentage_of_users(Feature $feature)
    {
        $this->beConstructedWith(50);

        $activated = 0;
        foreach (range(0, 120) as $id) {
            if ($this->getWrappedObject()->isActive($feature->getWrappedObject(), new TestUser($id))) {
                $activated++;
            }
        }

        if ($activated < 58) {
            throw new \Exception('Value too low');
        }

        if ($activated > 62) {
            throw new \Exception('Value too high');
        }
    }
}
