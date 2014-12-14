<?php

namespace spec\Coduo\Flipper\Activation\Strategy;

use Coduo\Flipper\Activation\Argument\UserIdentifier;
use Coduo\Flipper\Activation\Context;
use Coduo\Flipper\Feature;
use Coduo\Flipper\User\Identifier;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class UserIdentifierSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith(array(new UserIdentifier('michal@coduo.pl'), new UserIdentifier('norbert@coduo.pl')));
    }

    function it_is_active_for_user_by_user_identifier(Feature $feature, Context $context)
    {
        $identifier = new UserIdentifier('michal@coduo.pl');
        $context->resolveArgument(Argument::any())->willReturn($identifier);
        $this->isActive($feature, $context)->shouldReturn(true);
    }

    function it_is_not_active_for_users_who_doesnt_belong_to_feature(Feature $feature, Context $context)
    {
        $identifier = new UserIdentifier('claudio@ffuuuuu.com');
        $context->resolveArgument(Argument::any())->willReturn($identifier);
        $this->isActive($feature, $context)->shouldReturn(false);
    }

    function it_can_only_accept_identifiers_as_constructor_parameter()
    {
        $this->shouldThrow(new \InvalidArgumentException("Only instance of UserIdentifier is accepted by UserIdentifier strategy"))
            ->during('__construct', array(array(new \stdClass)));
    }
}
