<?php

namespace Coduo\Flipper;

class Identifier
{
    private $identifier;

    public function __construct($identifier)
    {
        if (null === $identifier || 0 === strlen($identifier)) {
            throw new \InvalidArgumentException("Identifier cannot be empty");
        }

        $this->identifier = $identifier;
    }

    public function __toString()
    {
        return (String)$this->identifier;
    }

    public function isEqualTo(Identifier $id)
    {
        return $this->identifier === (String) $id;
    }
}
