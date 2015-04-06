<?php

namespace Coduo\Flipper\Activation;

use Coduo\Flipper\Feature;

interface Strategy
{
    /**
     * Checks if feature is active for given user
     *
     * @param  Feature $feature
     * @param  Context $context
     * @return boolean
     */
    public function isActive(Feature $feature, Context $context);

    /**
     * Checks if given argument is supported by strategy
     *
     * @param  Argument $argument
     * @return mixed
     */
    public function supportsArgument(Argument $argument);
}
