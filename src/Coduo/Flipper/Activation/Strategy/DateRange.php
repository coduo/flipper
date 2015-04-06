<?php

namespace Coduo\Flipper\Activation\Strategy;

use Coduo\Flipper\Activation\Argument;
use Coduo\Flipper\Activation\Context;
use Coduo\Flipper\Activation\Strategy\DateRange\CurrentDateTime;
use Coduo\Flipper\Activation\Strategy\DateRange\DateTime;
use Coduo\Flipper\Activation\Strategy;
use Coduo\Flipper\Feature;

final class DateRange implements Strategy
{
    /**
     * @var DateTime
     */
    private $from;

    /**
     * @var DateTime
     */
    private $to;

    /**
     * @param  DateTime                  $from
     * @param  DateTime                  $to
     * @throws \InvalidArgumentException
     */
    public function __construct(DateTime $from, DateTime $to)
    {
        if ($to->isLesserThan($from)) {
            throw new \InvalidArgumentException("Date range invalid. End needs to be greater than start.");
        }

        $this->from = $from;
        $this->to = $to;
    }

    /**
     * {@inheritdoc}
     */
    public function isActive(Feature $feature, Context $context)
    {
        $now = new CurrentDateTime();

        return $now->isGreaterEqualThan($this->from) && $now->isLesserEqualThan($this->to);
    }

    /**
     * @return bool
     */
    public function hasStared()
    {
        $now = new CurrentDateTime();

        return $now->isGreaterEqualThan($this->from);
    }

    /**
     * @return bool
     */
    public function hasEnded()
    {
        $now = new CurrentDateTime();

        return $now->isLesserEqualThan($this->to);
    }

    /**
     * {@inheritdoc}
     */
    public function supportsArgument(Argument $argument)
    {
        return true;
    }
}
