<?php

namespace Coduo\Flipper\Activation\Argument;

use Coduo\Flipper\Activation\Argument;

final class Environment implements Argument
{
    private $name;

    public function __construct($name)
    {
        if (null === $name || 0 === strlen($name)) {
            throw new \InvalidArgumentException("Environment cannot be empty");
        }
        $this->name = $name;
    }

    public function __toString()
    {
        return $this->name;
    }

    public function getValue()
    {
        return $this->name;
    }

    public function isEqualTo(Argument $argument)
    {
        return get_class($argument) === get_class($this) && $this->getValue() === $argument->getValue();
    }
}
