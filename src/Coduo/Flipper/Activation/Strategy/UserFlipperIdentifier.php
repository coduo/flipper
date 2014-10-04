<?php

namespace Coduo\Flipper\Activation\Strategy;

use Coduo\Flipper\Feature;
use Coduo\Flipper\Activation\Strategy;
use Coduo\Flipper\Identifier;

class UserFlipperIdentifier implements Strategy
{
    /**
     * @var Identifier[]
     */
    private $identifiers;

    public function __construct(array $identifiers = array())
    {
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
