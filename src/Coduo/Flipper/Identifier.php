<?php

namespace Coduo\Flipper;

final class Identifier
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
        if (null === $identifier || 0 === strlen($identifier)) {
            throw new \InvalidArgumentException("Identifier cannot be empty");
        }

        $this->identifier = $identifier;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return (String) $this->identifier;
    }

    /**
     * @param Identifier $id
     * @return bool
     */
    public function isEqualTo(Identifier $id)
    {
        return (String) $this->identifier === (String) $id;
    }
}
