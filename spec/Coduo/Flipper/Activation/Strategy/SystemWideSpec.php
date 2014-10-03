<?php

namespace spec\Coduo\Flipper\Activation\Strategy;

use Coduo\Flipper\Feature;
use Coduo\Flipper\Identifier;
use Coduo\Tests\Flipper\TestUser;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class SystemWideSpec extends ObjectBehavior
{
    function it_is_activate_features_system_wide(Feature $feature)
    {
        $this->beConstructedWith(true);
        $this->isActive($feature, new Identifier('michal'))->shouldReturn(true);
    }

    function it_is_deactivate_features_system_wide(Feature $feature)
    {
        $this->beConstructedWith(false);
        $this->isActive($feature, new Identifier('michal'))->shouldReturn(false);
    }
}
