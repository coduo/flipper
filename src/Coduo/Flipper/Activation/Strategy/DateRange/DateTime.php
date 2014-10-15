<?php

namespace Coduo\Flipper\Activation\Strategy\DateRange;

use DateTimeImmutable;

class DateTime
{
    /**
     * default format
     */
    const FORMAT = 'Y-m-d H:i:s';

    /**
     * @var \DateTimeImmutable
     */
    protected $date;

    /**
     * @param $dateString
     */
    public function __construct($dateString)
    {
        $this->date = new DateTimeImmutable($dateString);
    }

    /**
     * @return DateTimeImmutable
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @return mixed
     */
    public function getTimestamp()
    {
        return $this->date->getTimestamp();
    }

    /**
     * @return mixed
     */
    public function __toString()
    {
        return $this->date->format(self::FORMAT);
    }

    /**
     * @param DateTime $date
     * @return bool
     */
    public function isLesserThan(DateTime $date)
    {
        return $this->getTimestamp() < $date->getTimestamp();
    }

    /**
     * @param DateTime $date
     * @return bool
     */
    public function isLesserEqualThan(DateTime $date)
    {
        return $this->getTimestamp() <= $date->getTimestamp();
    }

    /**
     * @param DateTime $date
     * @return bool
     */
    public function isGreaterThan(DateTime $date)
    {
        return $this->getTimestamp() > $date->getTimestamp();
    }

    /**
     * @param DateTime $date
     * @return bool
     */
    public function isGreaterEqualThan(DateTime $date)
    {
        return $this->getTimestamp() >= $date->getTimestamp();
    }
}
