<?php

namespace Coduo\Flipper\Activation\Strategy;

use Coduo\Flipper\Feature;
use Coduo\Flipper\Activation\Strategy;
use Coduo\Flipper\Identifier;

class UserIdentifier implements Strategy
{
    /**
     * @var Identifier[]
     */
    private $identifiers;

    public function __construct(array $identifiers = array())
    {
        foreach ($identifiers as $identifier) {
            if (false === $identifier instanceof Identifier) {
                throw new \InvalidArgumentException("Only instance of Identifier is accepted by UserIdentifier strategy");
            }
        }
        $this->identifiers = $identifiers;
    }

    public function addIdentifier(Identifier $identifier)
    {
        $this->identifiers[] = $identifier;
    }

    public function isActive(Feature $feature, Identifier $identifier)
    {
        foreach ($this->identifiers as $fid) {
            if ($identifier->isEqualTo($fid)) {

                return true;
            }
        }

        return false;
    }
}
