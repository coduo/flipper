<?php

namespace Coduo\Flipper\Activation\Strategy;

use Coduo\Flipper\Activation\Strategy;
use Coduo\Flipper\Feature;
use Coduo\Flipper\Identifier;

final class Gradual implements Strategy
{
    /**
     * @var int
     */
    private $percentage;

    /**
     * @param $percentage
     */
    public function __construct($percentage)
    {
        $this->percentage = (int) $percentage;
    }

    /**
     * {@inheritdoc}
     */
    public function isActive(Feature $feature, Identifier $identifier)
    {
        return abs(crc32((String)$identifier) % 100) < $this->percentage;
    }

    /**
     * @return int
     */
    public function getPercentage()
    {
        return $this->percentage;
    }
}
