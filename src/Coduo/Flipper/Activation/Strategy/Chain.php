<?php

namespace Coduo\Flipper\Activation\Strategy;

use Coduo\Flipper\Activation\Argument;
use Coduo\Flipper\Activation\Context;
use Coduo\Flipper\Activation\Strategy;
use Coduo\Flipper\Feature;

class Chain implements Strategy
{
    /**
     * @var Strategy[]
     */
    private $strategies;

    /**
     * @param  Strategy[]                $strategies
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
     * @return Strategy[]
     */
    public function getStrategies()
    {
        return $this->strategies;
    }

    /**
     * {@inheritdoc}
     */
    public function isActive(Feature $feature, Context $context)
    {
        foreach ($this->strategies as $strategy) {
            if ($strategy->isActive($feature, $context)) {
                return true;
            }
        }

        return false;
    }

    public function supportsArgument(Argument $argument)
    {
        return true;
    }
}
