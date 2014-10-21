<?php

namespace Coduo\Flipper\Activation\Strategy;

use Coduo\Flipper\Activation\Strategy\DateRange\CurrentDateTime;
use Coduo\Flipper\Activation\Strategy\DateRange\DateTime;
use Coduo\Flipper\Activation\Strategy;
use Coduo\Flipper\Feature;
use Coduo\Flipper\Identifier;

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
     * @param DateTime $from
     * @param DateTime $to
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
    public function isActive(Feature $feature, Identifier $identifier)
    {
        $now = new CurrentDateTime();
        return $now->isGreaterEqualThan($this->from) && $now->isLesserEqualThan($this->to);
    }
}
