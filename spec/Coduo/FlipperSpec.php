<?php

namespace spec\Coduo;

use Coduo\Flipper\Activation\Strategy;
use Coduo\Flipper\Feature\Repository;
use Coduo\Flipper\Feature;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class FlipperSpec extends ObjectBehavior
{
    function let(Repository $repository)
    {
        $this->beConstructedWith($repository);
    }

    function it_can_add_new_features(Repository $repository, Strategy $strategy)
    {
        $repository->add(Argument::type('Coduo\Flipper\Feature'))->shouldBeCalled();
        $feature = new Feature('captcha', $strategy->getWrappedObject());
        $this->add($feature);
    }

    function it_can_find_features_from_its_repository(Repository $repository, Strategy $strategy)
    {
        $repository->findByName(Argument::type('string'))->shouldBeCalled();
        $this->findByName('captcha');
    }
}
