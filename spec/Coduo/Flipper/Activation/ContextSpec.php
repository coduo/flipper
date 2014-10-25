<?php

namespace spec\Coduo\Flipper\Activation;

use Coduo\Flipper\User\Identifier;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class ContextSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith(new Identifier('michal'));
    }
}
