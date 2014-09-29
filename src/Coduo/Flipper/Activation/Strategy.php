<?php

namespace Coduo\Flipper\Activation;

use Coduo\Flipper\Feature;
use Coduo\Flipper\User\FeatureAwareUser;

interface Strategy
{
    /**
     * Checks if feature is active for given user
     *
     * @param Feature $feature
     * @param FeatureAwareUser $user
     * @return boolean
     */
    public function isActive(Feature $feature, FeatureAwareUser $user);
}