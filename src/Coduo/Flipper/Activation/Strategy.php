<?php

namespace Coduo\Flipper\Activation;

use Coduo\Flipper\Feature;
use Coduo\Flipper\Identifier;
use Coduo\Flipper\User\FeatureAwareUser;

interface Strategy
{
    /**
     * Checks if feature is active for given user
     *
     * @param Feature $feature
     * @param Identifier $identifier
     * @return boolean
     */
    public function isActive(Feature $feature, Identifier $identifier);
}