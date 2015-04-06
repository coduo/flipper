<?php

namespace Coduo\Flipper;

use Coduo\Flipper\Activation\Context;
use Coduo\Flipper\Activation\Strategy;

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
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    public function getStrategy()
    {
        return $this->strategy;
    }

    /**
     * @param Context $context
     * @return bool
     */
    public function isActive(Context $context)
    {
        return $this->strategy->isActive($this, $context);
    }
}
