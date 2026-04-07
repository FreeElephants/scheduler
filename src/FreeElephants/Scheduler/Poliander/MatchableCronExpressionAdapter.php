<?php
declare(strict_types=1);


namespace FreeElephants\Scheduler\Poliander;

use DateTime;
use FreeElephants\Scheduler\Datable;
use Poliander\Cron\CronExpression;

class MatchableCronExpressionAdapter implements Datable
{
    private CronExpression $cronExpression;
    private string $rawExpression;

    public function __construct(string $expression)
    {
        $this->cronExpression = new CronExpression($expression);
        $this->rawExpression = $expression;
    }

    function isMatch(\DateTimeInterface $dateTime): bool
    {
        return $this->cronExpression->isMatching($dateTime);
    }

    function getValue(): string
    {
        return $this->rawExpression;
    }

    function isDisposable(): bool
    {
        return false;
    }

    function getNearest(): \DateTimeInterface
    {
        return new DateTime('@' . $this->cronExpression->getNext());
    }
}
