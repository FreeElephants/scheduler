<?php
declare(strict_types=1);


namespace FreeElephants\Scheduler;

class SpecificDateTime implements Datable
{
    private \DateTimeInterface $dateTime;
    private int $diffSecLimit;

    public function __construct(
        \DateTimeInterface $dateTime,
        int $diffSecLimit = 60
    )
    {
        $this->dateTime = $dateTime;
        $this->diffSecLimit = $diffSecLimit;
    }

    function isMatch(\DateTimeInterface $dateTime): bool
    {
        return $this->diffSecLimit > abs($this->dateTime->getTimestamp() - $dateTime->getTimestamp());
    }

    function getValue(): string
    {
        return (string) $this->dateTime->getTimestamp();
    }


    function isDisposable(): bool
    {
        return true;
    }

    function getNearest(): \DateTimeInterface
    {
        return $this->dateTime;
    }
}
