<?php
declare(strict_types=1);

namespace FreeElephants\Scheduler;

use DateTimeInterface;

interface ScheduledEntityInterface
{
    public function isMatch(DateTimeInterface $dateTime): bool;

    function isDisposable(): bool;

    public function getTask(): TaskInterface;

    public function getDatable(): Datable;
}
