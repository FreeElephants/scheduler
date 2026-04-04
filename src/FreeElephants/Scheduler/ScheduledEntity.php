<?php
declare(strict_types=1);

namespace FreeElephants\Scheduler;

use DateTimeInterface;

class ScheduledEntity implements ScheduledEntityInterface
{
    private Datable $datable;
    private TaskInterface $task;

    public function __construct(
        TaskInterface $task,
        Datable $datable
    )
    {
        $this->datable = $datable;
        $this->task = $task;
    }

    public function isMatch(DateTimeInterface $dateTime): bool
    {
        return $this->datable->isMatch($dateTime);
    }

    function isDisposable(): bool
    {
        return $this->datable->isDisposable();
    }

    public function getTask(): TaskInterface
    {
        return $this->task;
    }

    public function getDatable(): Datable
    {
        return $this->datable;
    }
}
