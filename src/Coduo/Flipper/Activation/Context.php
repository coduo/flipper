<?php

namespace Coduo\Flipper\Activation;

use Coduo\Flipper\Feature;
use Coduo\Flipper\User\Identifier as UserIdentifier;

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
