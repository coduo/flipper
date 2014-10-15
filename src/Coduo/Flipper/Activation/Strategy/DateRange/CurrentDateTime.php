<?php

namespace Coduo\Flipper\Activation\Strategy\DateRange;

/**
 * @internal Do not init outside DateRange class
 */
class CurrentDateTime extends DateTime
{
    /**
     * @var DateTime|null
     */
    private static $modifiedDate;

    /**
     * Generally, use it only for tests :P
     *
     * @param DateTime $date
     */
    public static function modifyDate(\DateTime $date)
    {
        static::$modifiedDate = $date;
    }

    /**
     *
     */
    public function __construct()
    {
        $this->date = null === static::$modifiedDate ? new \DateTime("now") : static::$modifiedDate;
    }
}
