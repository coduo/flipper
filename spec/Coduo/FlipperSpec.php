<?php

namespace spec\Coduo;

use Coduo\Flipper\Activation\Context;
use Coduo\Flipper\Activation\Strategy;
use Coduo\Flipper\Exception\ContextNotFoundException;
use Coduo\Flipper\Exception\FeatureNotFoundException;
use Coduo\Flipper\Feature\Repository;
use Coduo\Flipper\Feature;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class FlipperSpec extends ObjectBehavior
{
    function let(Repository $repository, Context $context)
    {
        $this->beConstructedWith($repository, $context);
    }

    function it_can_add_new_features(Repository $repository, Strategy $strategy)
    {
        $repository->add(Argument::type('Coduo\Flipper\Feature'))->shouldBeCalled();
        $feature = new Feature('captcha', $strategy->getWrappedObject());
        $this->add($feature);
    }

    function it_can_find_features_from_its_repository(Repository $repository, Strategy $strategy)
    {
        $feature = new Feature('captcha', $strategy->getWrappedObject());
        $repository->findByName('captcha')->willReturn($feature);
        $this->findByName('captcha')->shouldReturn($feature);
    }

    function it_throws_exception_when_checking_active_for_not_existing_feature(Repository $repository, Strategy $strategy)
    {
        $this->shouldThrow(new FeatureNotFoundException("Feature 'foobar' was not found."))
            ->during('isActive', array('foobar'));
    }

    function it_throws_exception_when_given_context_is_not_found(Repository $repository, Strategy $strategy)
    {
        $feature = new Feature('captcha', $strategy->getWrappedObject());
        $repository->findByName('captcha')->willReturn($feature);
        $this->shouldThrow(new ContextNotFoundException("Context with name 'fffuuuu' was not found."))
            ->during('isActive', array('captcha', 'fffuuuu'));
    }
}
