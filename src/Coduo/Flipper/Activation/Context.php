<?php

namespace Coduo\Flipper\Activation;

class Context
{
    private $arguments;
    private $name;

    public function __construct($name = 'default')
    {
        $this->name = $name;
        $this->arguments = array();
    }

    public function registerArgument(Argument $argument)
    {
        $this->arguments[] = $argument;
    }

    /**
     * @return array
     */
    public function getArguments()
    {
        return $this->arguments;
    }

    public function clear()
    {
        $this->arguments = array();
    }

    public function resolveArgument(Strategy $strategy)
    {
        foreach ($this->arguments as $argument) {
            if ($strategy->supportsArgument($argument)) {
                return $argument;
            }
        }

        throw new \RuntimeException(sprintf("Cannot resolve argument for strategy %s. Please make sure you registered all valid arguments", get_class($strategy)));
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }
}
