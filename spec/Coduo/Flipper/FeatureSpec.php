<?php

namespace spec\Coduo\Flipper;

use Coduo\Flipper\Activation\Strategy;
use Coduo\Flipper\User\FeatureAwareUser;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class FeatureSpec extends ObjectBehavior
{
    public function let(Strategy $strategy)
    {
        $this->beConstructedWith('registration-captcha', $strategy);
    }

    function it_has_a_name_that_identifies_it()
    {
        $this->getName()->shouldReturn('registration-captcha');
    }

}