<?php

namespace Coduo\Flipper\Activation\Strategy;

use Coduo\Flipper\Activation\Argument;
use Coduo\Flipper\Activation\Context;
use Coduo\Flipper\Activation\Strategy;
use Coduo\Flipper\Feature;

final class SystemWide implements Strategy
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
    public function isActive(Feature $feature, Context $context)
    {
        return $this->isActive;
    }

    public function supportsArgument(Argument $argument)
    {
        return true;
    }
}
