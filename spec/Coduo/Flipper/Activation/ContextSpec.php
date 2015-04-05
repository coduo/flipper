<?php

namespace spec\Coduo\Flipper\Activation;

use Coduo\Flipper\User\Identifier;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class ContextSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith('default');
    }

    function it_returns_name()
    {
        $this->getName()->shouldReturn('default');
    }

    function it_can_register_arguments(\Coduo\Flipper\Activation\Argument $argument)
    {
        $this->registerArgument($argument);
        $this->getArguments()->shouldContain($argument);
    }
}
