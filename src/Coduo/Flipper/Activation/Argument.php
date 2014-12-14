<?php

namespace Coduo\Flipper\Activation;

use Coduo\Flipper\Feature;

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
