<?php

namespace Coduo\Flipper\Activation\Argument;

use Coduo\Flipper\Activation\Argument;

final class UserIdentifier implements Argument
{
    /**
     * @var mixed
     */
    private $identifier;

    /**
     * @param $identifier
     * @throws \InvalidArgumentException
     */
    public function __construct($identifier)
    {
        if (null === $identifier) {
            throw new \InvalidArgumentException("Identifier cannot be empty");
        }

        $this->identifier = $identifier;
    }

    /**

     */
    public function isEqualTo(Argument $argument)
    {
        return get_class($argument) === get_class($this) && $this->getValue() === $argument->getValue();
    }

    /**
     * Returns value of given argument
     *
     * @return mixed
     */
    public function getValue()
    {
        return $this->identifier;
    }
}
