<?php
declare(strict_types=1);

namespace FreeElephants\Scheduler;

class InMemoryStorage implements TaskStorageInterface
{
    private array $tasks = [];

    public function addTask(ScheduledEntityInterface $scheduledEntity): void
    {
        $this->tasks[$this->buildKey($scheduledEntity)] = $scheduledEntity;
    }

    public function getTasks(): iterable
    {
        return $this->tasks;
    }

    public function removeEntity(ScheduledEntityInterface $scheduledEntity): void
    {
        unset($this->tasks[$this->buildKey($scheduledEntity)]);
    }

    private function buildKey(ScheduledEntityInterface $scheduledEntity)
    {
        return $scheduledEntity->getTask()->getName() . '_' . $scheduledEntity->getDatable()->getValue();
    }
}
