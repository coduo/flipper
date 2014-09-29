<?php

namespace Coduo\Flipper\Feature\Repository;

use Coduo\Flipper\Feature\Repository;
use Coduo\Flipper\Feature;

class InMemoryFeatureRepository implements Repository
{
    private $features = array();

    /**
     * {@inheritDoc}
     */
    public function add(Feature $feature)
    {
        $this->features[] = $feature;
    }

    /**
     * {@inheritDoc}
     */
    public function findByName($name)
    {
        foreach ($this->features as $feature) {
            if ($feature->getName() === $name) {
                return $feature;
            }
        }

        return null;
    }
}