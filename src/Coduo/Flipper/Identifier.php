<?php

namespace Coduo\Flipper;

class Identifier
{
    private $identifier;

    public function __construct($identifier)
    {
        $this->identifier = $identifier;
    }

    public function __toString()
    {
        return (String)$this->identifier;
    }
}