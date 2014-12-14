<?php

namespace Coduo\Flipper\Activation;

use Coduo\Flipper\Feature;
use Coduo\Flipper\Identifier;

interface Strategy
{
    /**
     * Checks if feature is active for given user
     *
     * @param  Feature    $feature
     * @param  Context $context
     * @return boolean
     */
    public function isActive(Feature $feature, Context $context);

    public function supportsArgument(Argument $argument);
}
