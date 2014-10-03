<?php

namespace Coduo\Flipper\Activation\Strategy;

use Coduo\Flipper\Activation\Strategy;
use Coduo\Flipper\Feature;
use Coduo\Flipper\Identifier;

class Gradual implements Strategy
{
    private $percentage;

    public function __construct($percentage)
    {
        $this->percentage = (int) $percentage;
    }

    public function isActive(Feature $feature, Identifier $identifier)
    {
        return abs(crc32((String)$identifier) % 100) < $this->percentage;
    }

    public function getPercentage()
    {
        return $this->percentage;
    }
}
