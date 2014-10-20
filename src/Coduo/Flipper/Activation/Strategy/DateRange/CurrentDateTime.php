<?php

namespace Coduo\Flipper\Activation\Strategy\DateRange;

/**
 * @internal Do not init outside DateRange class
 */
final class CurrentDateTime extends DateTime
{
    /**
     * @var \DateTime|null
     */
    private static $modifiedDate;

    /**
     * Generally, use it only for tests :P
     *
     * @param \DateTime $date
     */
    public static function modifyDate(\DateTime $date)
    {
        self::$modifiedDate = $date;
    }

    public static function reset()
    {
        self::$modifiedDate = null;
    }

    /**
     *
     */
    public function __construct()
    {
        $this->date = null === self::$modifiedDate ? new \DateTime("now") : self::$modifiedDate;
    }
}
