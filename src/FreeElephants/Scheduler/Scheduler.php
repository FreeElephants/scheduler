<?php

namespace FreeElephants\Scheduler;

class Scheduler
{
    private TaskStorageInterface $tasksStorage;
    private TaskExecutorInterface $taskExecutor;

    public function __construct(
        TaskExecutorInterface $taskExecutor,
        ?TaskStorageInterface $taskStorage = null
    )
    {
        $this->taskExecutor = $taskExecutor;
        $this->tasksStorage = $taskStorage ?: new InMemoryStorage();
    }

    /**
     * @return ScheduledEntityInterface[]
     */
    public function execute(\DateTime $dateTime): array
    {
        $executed = [];
        foreach ($this->tasksStorage->getTasks() as $entity) {
            if ($entity->isMatch($dateTime)) {
                $this->taskExecutor->execute($entity->getTask());
                $executed[] = $entity;
                if ($entity->isDisposable()) {
                    $this->tasksStorage->removeEntity($entity);
                }
            }
        }

        return $executed;
    }
}
