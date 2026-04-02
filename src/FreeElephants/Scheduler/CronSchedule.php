<?php

namespace FreeElephants\Scheduler;

class CronSchedule
{
    /**
     * @var \SplObjectStorage<Datable, TaskInterface>
     */
    private \SplObjectStorage $tasks;

    public function __construct()
    {
        $this->tasks = new \SplObjectStorage();
    }

        public function addTask(Datable $datable, TaskInterface $task)
    {
        $this->tasks->offsetSet($datable, $task);
    }

    public function hasTasks(\DateTimeInterface $dateTime): bool
    {
        foreach ($this->tasks as $cronExpression) {
            if ($cronExpression->isMatch($dateTime)) {
                return true;
            }
        }

        return false;
    }

    /**
     * @return TaskInterface[]
     */
    public function getTasks(\DateTimeInterface $dateTime): array
    {
        $matchedTasks = [];
        foreach ($this->tasks as $cronExpression) {
            if ($cronExpression->isMatch($dateTime)) {
                $matchedTasks[] = $this->tasks->offsetGet($cronExpression);
            }
        }

        return $matchedTasks;
    }

    public function execute(\DateTime $dateTime): array
    {
        $tasks = $this->getTasks($dateTime);
        foreach ($tasks as $task) {
            $task->execute();
        }

        return $tasks;
    }
}
