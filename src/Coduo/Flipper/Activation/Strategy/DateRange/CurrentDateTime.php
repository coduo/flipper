<?php

namespace Coduo\Flipper\Activation\Strategy\DateRange;

use DateTimeImmutable;

/**
 * @internal Do not init outside DateRange class
 */
class CurrentDateTime extends DateTime
{
    /**
     * @var DateTimeImmutable|null
     */
    private static $modifiedDate;

    /**
     * Generally, use it only for tests :P
     *
     * @param DateTimeImmutable $date
     */
    public static function modifyDate(DateTimeImmutable $date)
    {
        static::$modifiedDate = $date;
    }
    
    /**
     *
     */
    public function __construct()
    {
        $this->date = null === static::$modifiedDate ? new DateTimeImmutable("now") : static::$modifiedDate;
    }
}
