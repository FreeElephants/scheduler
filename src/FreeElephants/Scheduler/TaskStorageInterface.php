<?php
declare(strict_types=1);

namespace FreeElephants\Scheduler;

interface TaskStorageInterface
{
    public function addTask(ScheduledEntityInterface $scheduledEntity): void;

    /**
     * @return ScheduledEntityInterface[]
     */
    public function getTasks(): iterable;

    public function removeEntity(ScheduledEntityInterface $scheduledEntity): void;

}
