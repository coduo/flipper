<?php

namespace Coduo\Flipper\Activation\Strategy;

use Coduo\Flipper\Activation\Strategy;
use Coduo\Flipper\Feature;
use Coduo\Flipper\Identifier;
use Coduo\Flipper\User\FeatureAwareUser;

class SystemWide implements Strategy
{
    /**
     * @var boolean
     */
    private $isActive;

    public function __construct($isActive)
    {
        $this->isActive = (bool) $isActive;
    }

    public function isActive(Feature $feature, Identifier $identifier)
    {
        return $this->isActive;
    }
}
