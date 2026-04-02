<?php

namespace FreeElephants\Scheduler;

use Econ\World\Domain\Time\TaskInterface;
use Poliander\Cron\CronExpression;

class CronSchedule
{
    /**
     * @var \SplObjectStorage<CronExpression, TaskInterface>
     */
    private \SplObjectStorage $tasks;

    public function __construct()
    {
        $this->tasks = new \SplObjectStorage();
    }

    public function addTask(CronExpression $cronExpression, TaskInterface $task)
    {
        $this->tasks->offsetSet($cronExpression, $task);
    }

    public function hasTasks(\DateTimeInterface $dateTime): bool
    {
        foreach ($this->tasks as $cronExpression) {
            if ($cronExpression->isMatching($dateTime)) {
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
            if ($cronExpression->isMatching($dateTime)) {
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
