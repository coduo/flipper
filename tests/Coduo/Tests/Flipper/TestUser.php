<?php

namespace Coduo\Tests\Flipper;

use Coduo\Flipper\Activation\Argument\UserIdentifier;
use Coduo\Flipper\Identifier;

class TestUser
{

    private $id;

    public function __construct($id)
    {
        $this->id = $id;
    }

    public function getId()
    {
        return $this->id;
    }
}
