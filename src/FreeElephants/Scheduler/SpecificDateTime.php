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
        return $this->dateTime->diff($dateTime, true)->s < $this->diffSecLimit;
    }
}
