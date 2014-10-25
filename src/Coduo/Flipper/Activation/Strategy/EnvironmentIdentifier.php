<?php

namespace Coduo\Flipper\Activation\Strategy;

use Coduo\Flipper\Activation\Context;
use Coduo\Flipper\Feature;
use Coduo\Flipper\Activation\Strategy;

final class Environment extends Identifier implements Strategy
{
    /**
     * {@inheritdoc}
     */
    public function isActive(Feature $feature, Context $context)
    {
        foreach ($this->identifiers as $fid) {
            if ($context->getEnvironmentIdentifier()->isEqualTo($fid)) {

                return true;
            }
        }

        return false;
    }

    public function supportsClass($class)
    {
        return $class === "Coduo\\Flipper\\Environment\\Identifier";
    }
}
