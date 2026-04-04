<?php

namespace FreeElephants\Scheduler;

class Scheduler
{
    private TaskStorageInterface $tasksStorage;

    public function __construct(
        ?TaskStorageInterface $taskStorage = null
    )
    {
        $this->tasksStorage = $taskStorage ?: new InMemoryStorage();
    }

    public function execute(\DateTime $dateTime): array
    {
        $executed = [];
        foreach ($this->tasksStorage->getTasks() as $entity) {
            if ($entity->isMatch($dateTime)) {
                $entity->getTask()->execute();
                $executed[] = $entity;
                if ($entity->isDisposable()) {
                    $this->tasksStorage->removeEntity($entity);
                }
            }
        }

        return $executed;
    }
}
