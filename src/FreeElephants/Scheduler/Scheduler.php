<?php

namespace FreeElephants\Scheduler;

class Scheduler
{
    private TaskStorageInterface $tasksStorage;
    private ?TaskExecutorInterface $taskExecutor;

    public function __construct(
        ?TaskStorageInterface $taskStorage = null,
        ?TaskExecutorInterface $taskExecutor = null
    )
    {
        $this->tasksStorage = $taskStorage ?: new InMemoryStorage();
        $this->taskExecutor = $taskExecutor;
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
