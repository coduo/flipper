<?php

namespace Coduo\Flipper;

use Coduo\Flipper\Activation\Strategy;
use Coduo\Flipper\User\FeatureAwareUser;

class Feature
{
    private $name;

    private $users;

    /**
     * @var Activation\Strategy
     */
    private $strategy;

    public function __construct($name, Strategy $strategy)
    {
        $this->name = $name;
        $this->users = array();
        $this->strategy = $strategy;
    }

    public function getName()
    {
        return $this->name;
    }

    public function addUser(FeatureAwareUser $user)
    {
        $this->users[] = $user;
    }

    public function getUsers()
    {
        return $this->users;
    }

    public function isActive(Identifier $identifier)
    {
        return $this->strategy->isActive($this, $identifier);
    }
}
