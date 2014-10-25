<?php

namespace Coduo\Flipper\Activation\Strategy;

use Coduo\Flipper\Activation\Context;
use Coduo\Flipper\Feature;
use Coduo\Flipper\Activation\Strategy;

final class UserIdentifier extends Identifier implements Strategy
{

    /**
     * {@inheritdoc}
     */
    public function isActive(Feature $feature, Context $context)
    {
        foreach ($this->identifiers as $fid) {
            if ($context->getUserIdentifier()->isEqualTo($fid)) {

                return true;
            }
        }

        return false;
    }

    public function supportsClass($class)
    {
        return $class === "Coduo\\Flipper\\User\\Identifier";
    }
}
