<?php

namespace spec\Coduo\Flipper\Activation\Strategy;

use Coduo\Flipper\Activation\Context;
use Coduo\Flipper\Feature;
use Coduo\Flipper\User\Identifier;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class UserIdentifierSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Coduo\Flipper\Activation\Strategy\UserIdentifier');
    }

    function it_is_active_for_user_by_flipper_identifier(Feature $feature, Context $context)
    {
        $identifier = new Identifier('michal');
        $context->getUserIdentifier()->willReturn($identifier);
        $this->addIdentifier($identifier);
        $this->isActive($feature, $context)->shouldReturn(true);
    }

    function it_is_not_active_for_users_who_doesnt_belong_to_feature(Feature $feature, Context $context)
    {
        $identifier = new Identifier('michal');
        $context->getUserIdentifier()->willReturn($identifier);
        $this->addIdentifier($identifier);
        $this->isActive($feature, Context::createFromUserIdentifier('claudio'))->shouldReturn(false);
    }

    function it_can_only_accept_identifiers_as_constructor_parameter()
    {
        $this->shouldThrow(new \InvalidArgumentException("Identifier class not accepted"))
            ->during('__construct', array(array(new \stdClass)));
    }
}
