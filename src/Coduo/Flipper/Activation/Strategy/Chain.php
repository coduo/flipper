<?php

namespace Coduo\Flipper\Activation\Strategy;

use Coduo\Flipper\Activation\Strategy;
use Coduo\Flipper\Feature;
use Coduo\Flipper\Identifier;

class Chain implements Strategy
{
    /**
     * @var Strategy[]
     */
    private $strategies;

    /**
     * @param array $strategies
     * @throws \InvalidArgumentException
     */
    public function __construct(array $strategies = array())
    {
        foreach ($strategies as $strategy) {
            if (false === $strategy instanceof Strategy) {
                throw new \InvalidArgumentException("Only instances of Strategy are accepted by Chain strategy.");
            }
        }

        $this->strategies = $strategies;
    }

    /**
     * @param Strategy $strategy
     */
    public function addStrategy(Strategy $strategy)
    {
        $this->strategies[] = $strategy;
    }

    /**
     * @return []
     */
    public function getStrategies()
    {
        return $this->strategies;
    }

    /**
     * {@inheritdoc}
     */
    public function isActive(Feature $feature, Identifier $identifier)
    {
        foreach ($this->strategies as $strategy) {
            if ($strategy->isActive($feature, $identifier)) {
                return true;
            }
        }

        return false;
    }
}
