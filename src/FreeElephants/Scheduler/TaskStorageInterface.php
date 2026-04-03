<?php
declare(strict_types=1);

namespace FreeElephants\Scheduler;

interface TaskStorageInterface
{
    public function addTask(ScheduledEntity $scheduledEntity): void;

    /**
     * @return ScheduledEntity[]
     */
    public function getTasks(): iterable;

    public function removeEntity(ScheduledEntity $scheduledEntity): void;

}
