<?php
declare(strict_types=1);

namespace FreeElephants\Scheduler;

use DateTimeInterface;

class ScheduledEntity implements TaskInterface, Datable
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

    public function getName(): string
    {
        $name = $this->task->getName();
        return sprintf('%s.%s', $name, $this->datable);
    }

    public function isMatch(DateTimeInterface $dateTime): bool
    {
        return $this->datable->isMatch($dateTime);
    }

    public function execute(): void
    {
        $this->task->execute();
    }

    function __toString(): string
    {
        return $this->getName();
    }

    function isDisposable(): bool
    {
        return $this->datable->isDisposable();
    }

    function getNearest(): \DateTimeInterface
    {
        return $this->datable->getNearest();
    }
}
