<?php
declare(strict_types=1);

namespace FreeElephants\Scheduler;

class InMemoryStorage implements TaskStorageInterface
{
    private array $tasks = [];

    public function addTask(ScheduledEntity $scheduledEntity): void
    {
        $this->tasks[$scheduledEntity->getName()] = $scheduledEntity;
    }

    public function getTasks(): iterable
    {
        return $this->tasks;
    }

    public function removeEntity(ScheduledEntity $scheduledEntity): void
    {
        unset($this->tasks[$scheduledEntity->getName()]);
    }
}
