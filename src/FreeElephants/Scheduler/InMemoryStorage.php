<?php
declare(strict_types=1);

namespace FreeElephants\Scheduler;

class InMemoryStorage implements TaskStorageInterface
{
    private array $tasks = [];

    public function addTask(ScheduledEntity $scheduledEntity): void
    {
        $this->tasks[$this->buildKey($scheduledEntity)] = $scheduledEntity;
    }

    public function getTasks(): iterable
    {
        return $this->tasks;
    }

    public function removeEntity(ScheduledEntity $scheduledEntity): void
    {
        unset($this->tasks[$this->buildKey($scheduledEntity)]);
    }

    private function buildKey(ScheduledEntity $scheduledEntity)
    {
        return $scheduledEntity->getTask()->getName() . '_' . $scheduledEntity->getDatable()->getValue();
    }
}
