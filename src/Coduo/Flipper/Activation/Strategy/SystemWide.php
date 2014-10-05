<?php

namespace Coduo\Flipper\Activation\Strategy;

use Coduo\Flipper\Activation\Strategy;
use Coduo\Flipper\Feature;
use Coduo\Flipper\Identifier;

class SystemWide implements Strategy
{
    /**
     * @var boolean
     */
    private $isActive;

    /**
     * @param $isActive
     */
    public function __construct($isActive)
    {
        $this->isActive = (bool) $isActive;
    }

    /**
     * {inheritdoc}
     */
    public function isActive(Feature $feature, Identifier $identifier)
    {
        return $this->isActive;
    }
}
