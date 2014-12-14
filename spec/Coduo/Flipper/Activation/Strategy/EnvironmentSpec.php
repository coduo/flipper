<?php

namespace spec\Coduo\Flipper\Activation\Strategy;

use Coduo\Flipper\Activation\Argument\Environment;
use Coduo\Flipper\Activation\Context;
use Coduo\Flipper\Feature;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class EnvironmentSpec extends ObjectBehavior
{
    public function let()
    {
        $this->beConstructedWith(array(new Environment('staging'), new Environment('production')));
    }

    function it_is_active_when_context_resolves_given_argument(Feature $feature, Context $context)
    {
        $identifier = new Environment('staging');
        $context->resolveArgument(Argument::any())->willReturn($identifier);
        $this->isActive($feature, $context)->shouldReturn(true);
    }

    function it_is_not_active_when_context_environment_argument_is_different(Feature $feature, Context $context)
    {
        $identifier = new Environment('local');
        $context->resolveArgument(Argument::any())->willReturn($identifier);
        $this->isActive($feature, $context)->shouldReturn(false);
    }

    function it_can_only_accept_environement_as_constructor_parameter()
    {
        $this->shouldThrow(new \InvalidArgumentException("Only instance of Argument\\Environment is accepted by Environment strategy"))
            ->during('__construct', array(array(new \stdClass)));
    }
}
