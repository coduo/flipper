<?php

namespace Coduo\Flipper\Activation;

use Coduo\Flipper\Feature;
use Coduo\Flipper\User\Identifier as UserIdentifier;
use Coduo\Flipper\Environment\Identifier as EnvironmentIdentifier;


class Context
{
    /**
     * @var \Coduo\Flipper\User\Identifier
     */
    private $identifier;

    private $environment;

    public function __construct(UserIdentifier $identifier)
    {
        $this->identifier = $identifier;
        $this->environment = new EnvironmentIdentifier('default');
    }

    public function registerCurrentEnvironment(EnvironmentIdentifier $environment)
    {
        $this->environment = $environment;
    }

    public function getUserIdentifier()
    {
        return $this->identifier;
    }

    public function getEnvironmentIdentifier()
    {
        return $this->environment;
    }

    public static function createFromUserIdentifier($identifier)
    {
        return new static(new UserIdentifier($identifier));
    }

}
