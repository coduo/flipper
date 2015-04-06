<?php

namespace Coduo\Flipper\Activation\Strategy;

use Coduo\Flipper\Activation\Context;
use Coduo\Flipper\Feature;
use Coduo\Flipper\Activation\Strategy;
use Coduo\Flipper\Activation\Argument;

final class UserIdentifier implements Strategy
{
    /**
     * @var Argument\UserIdentifier[]
     */
    private $supportedUserIdentifiers;

    /**
     * @param  array                     $supportedUserIdentifiers
     * @throws \InvalidArgumentException
     */
    public function __construct(array $supportedUserIdentifiers = array())
    {
        foreach ($supportedUserIdentifiers as $identifier) {
            if (false === $identifier instanceof Argument\UserIdentifier) {
                throw new \InvalidArgumentException("Only instance of UserIdentifier is accepted by UserIdentifier strategy");
            }
        }

        $this->supportedUserIdentifiers = $supportedUserIdentifiers;
    }

    /**
     * @param \Coduo\Flipper\Activation\Argument\UserIdentifier $supportedIdentifier
     */
    public function addIdentifier(Argument\UserIdentifier $supportedIdentifier)
    {
        $this->supportedUserIdentifiers[] = $supportedIdentifier;
    }

    /**
     * {@inheritdoc}
     */
    public function isActive(Feature $feature, Context $context)
    {
        $arg = $context->resolveArgument($this);

        foreach ($this->supportedUserIdentifiers as $userIdentifier) {
            if ($userIdentifier->isEqualTo($arg)) {
                return true;
            }
        }

        return false;
    }

    public function supportsArgument(Argument $argument)
    {
        return $argument instanceof Argument\UserIdentifier;
    }
}
