<?php

namespace Coduo\Flipper;

use Coduo\Flipper\Activation\Strategy;
use Coduo\Flipper\User\FeatureAwareUser;

class Feature
{
    /**
     * @var
     */
    private $name;

    /**
     * @var Activation\Strategy
     */
    private $strategy;

    /**
     * @param $name
     * @param Strategy $strategy
     */
    public function __construct($name, Strategy $strategy)
    {
        $this->name = (string) $name;
        $this->strategy = $strategy;
    }

    /**
     * @return sting
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param Identifier $identifier
     * @return bool
     */
    public function isActive(Identifier $identifier)
    {
        return $this->strategy->isActive($this, $identifier);
    }
}
