<?php
declare(strict_types=1);


namespace FreeElephants\Scheduler\Poliander;

use DateTime;
use FreeElephants\Scheduler\Datable;
use Poliander\Cron\CronExpression;

class MatchableCronExpressionAdapter extends CronExpression implements Datable
{
    function isMatch(\DateTimeInterface $dateTime): bool
    {
        return $this->isMatching($dateTime);
    }

    function __toString(): string
    {
        return $this->expression;
    }

    function isDisposable(): bool
    {
        return false;
    }

    function getNearest(): \DateTimeInterface
    {
        return new DateTime('@' . $this->getNext());
    }
}
