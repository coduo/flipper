<?php

namespace Coduo\Tests\Flipper;

use Coduo\Flipper\Identifier;
use Coduo\Flipper\User\FeatureAwareUser;

class TestUser implements FeatureAwareUser
{

    private $id;

    public function __construct($id)
    {
        $this->id = $id;
    }

    public function getFlipperIdentifier()
    {
        return new Identifier($this->id);
    }
}