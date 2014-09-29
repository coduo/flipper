<?php

namespace Coduo\Flipper\Activation\Strategy;

use Coduo\Flipper\Feature;
use Coduo\Flipper\Activation\Strategy;
use Coduo\Flipper\User\FeatureAwareUser;

class UserFlipperIdentifier implements Strategy
{
    public function isActive(Feature $feature, FeatureAwareUser $user)
    {
        foreach ($feature->getUsers() as $featureUser) {
            if ($user->getFlipperIdentifier() === $featureUser->getFlipperIdentifier()) {
                return true;
            }
        }

        return false;
    }
}
