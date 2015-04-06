<?php

namespace Coduo\Flipper\Activation;

interface Argument
{
    /**
     * Returns value of given argument
     *
     * @return mixed
     */
    public function getValue();

    public function isEqualTo(Argument $argument);
}
