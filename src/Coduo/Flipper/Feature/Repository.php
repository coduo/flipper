<?php

namespace Coduo\Flipper\Feature;

use Coduo\Flipper\Feature;

interface Repository
{

    /**
     * @param  Feature $feature
     * @return null
     */
    public function add(Feature $feature);

    /**
     * @param $name
     * @return Feature|null
     */
    public function findByName($name);
}
