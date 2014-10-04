<?php

namespace Coduo\Flipper;

use Coduo\Flipper\Activation\Strategy;
use Coduo\Flipper\User\FeatureAwareUser;

class Feature
{
    private $name;

    private $identifiers;

    /**
     * @var Activation\Strategy
     */
    private $strategy;

    public function __construct($name, Strategy $strategy)
    {
        $this->name = $name;
        $this->identifiers = array();
        $this->strategy = $strategy;
    }

    public function getName()
    {
        return $this->name;
    }

    public function isActive(Identifier $identifier)
    {
        return $this->strategy->isActive($this, $identifier);
    }
}
