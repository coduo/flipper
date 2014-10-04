<?php

namespace Coduo\Flipper\Activation\Strategy;

use Coduo\Flipper\Feature;
use Coduo\Flipper\Activation\Strategy;
use Coduo\Flipper\Identifier;

class UserFlipperIdentifier implements Strategy
{
    public function isActive(Feature $feature, Identifier $identifier)
    {
        foreach ($feature->getIdentifiers() as $fid) {
            if ($identifier->isEqualTo($fid)) {

                return true;
            }
        }

        return false;
    }
}
