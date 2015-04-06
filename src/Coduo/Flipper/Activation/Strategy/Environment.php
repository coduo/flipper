<?php

namespace Coduo\Flipper\Activation\Strategy;

use Coduo\Flipper\Activation\Argument;
use Coduo\Flipper\Activation\Context;
use Coduo\Flipper\Feature;
use Coduo\Flipper\Activation\Strategy;

final class Environment implements Strategy
{
    private $supportedEnvironments;

    public function __construct(array $supportedEnvironments = array())
    {
        foreach ($supportedEnvironments as $supportedEnvironment) {
            if (false === $supportedEnvironment instanceof Argument\Environment) {
                throw new \InvalidArgumentException("Only instance of Argument\\Environment is accepted by Environment strategy");
            }
        }

        $this->supportedEnvironments = $supportedEnvironments;
    }

    /**
     * {@inheritdoc}
     */
    public function isActive(Feature $feature, Context $context)
    {
        $arg = $context->resolveArgument($this);

        foreach ($this->supportedEnvironments as $environment) {
            if ($environment->isEqualTo($arg)) {
                return true;
            }
        }

        return false;
    }

    public function supportsArgument(Argument $argument)
    {
        return $argument->getValue() instanceof Argument\Environment;
    }
}
