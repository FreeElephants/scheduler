<?php
declare(strict_types=1);


namespace FreeElephants\Scheduler\Poliander;

use FreeElephants\Scheduler\MatchableToDateTime;
use Poliander\Cron\CronExpression;

class MatchableCronExpressionAdapter extends CronExpression implements MatchableToDateTime
{
    function isMatch(\DateTimeInterface $dateTime): bool
    {
        return $this->isMatching($dateTime);
    }
}
