<?php
declare(strict_types=1);

namespace FreeElephants\Scheduler;

interface TaskExecutorInterface
{
    public function execute(TaskInterface $task): void;
}
