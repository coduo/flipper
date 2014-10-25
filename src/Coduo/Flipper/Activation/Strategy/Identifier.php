<?php

namespace Coduo\Flipper\Activation\Strategy;

use Coduo\Flipper\Identifier as FlipperIdentifier;

abstract class Identifier
{
    /**
     * @var Identifier[]
     */

    protected  $identifiers;

    /**
     * @param Identifier[] $identifiers
     *
     * @throws \InvalidArgumentException
     */
    public function __construct(array $identifiers = array())
    {
        foreach ($identifiers as $identifier) {
            if (false === $this->supportsClass(get_class($identifier))) {
                throw new \InvalidArgumentException("Identifier class not accepted");
            }
        }

        $this->identifiers = $identifiers;
    }

    /**
     * @param FlipperIdentifier $identifier
     *
     * @throws \InvalidArgumentException
     */
    public function addIdentifier(FlipperIdentifier $identifier)
    {
        if (false === $this->supportsClass(get_class($identifier))) {
            throw new \InvalidArgumentException("Identifier class not accepted");
        }

        $this->identifiers[] = $identifier;
    }

    abstract public function supportsClass($class);

}