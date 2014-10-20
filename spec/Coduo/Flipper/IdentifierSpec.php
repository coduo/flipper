<?php

namespace spec\Coduo\Flipper;

use Coduo\Flipper\Identifier;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class IdentifierSpec extends ObjectBehavior
{

    function it_can_be_anything()
    {
        $this->beConstructedWith('whateva');
        $this->__toString()->shouldReturn('whateva');
    }

    function it_can_compare_succesfully_to_other_ids()
    {
        $this->beConstructedWith('whateva');
        $id = new Identifier('whateva');
        $this->isEqualTo($id)->shouldReturn(true);
    }

    function it_can_compare_succesfully_to_numeric_ids()
    {
        $this->beConstructedWith(1);
        $id = new Identifier(1);
        $this->isEqualTo($id)->shouldReturn(true);
    }

    function it_can_compare_unsuccesfully_if_id_is_different()
    {
        $this->beConstructedWith('whateva');
        $id = new Identifier('foo');
        $this->isEqualTo($id)->shouldReturn(false);
    }

    function it_cannot_be_empty()
    {
        $this->shouldThrow(new \InvalidArgumentException("Identifier cannot be empty"))
            ->during('__construct', array(null));

        $this->shouldThrow(new \InvalidArgumentException("Identifier cannot be empty"))
            ->during('__construct', array(""));
    }
}