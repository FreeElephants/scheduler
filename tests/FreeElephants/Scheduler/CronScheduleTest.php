<?php
declare(strict_types=1);


namespace FreeElephants\Scheduler;

use FreeElephants\Scheduler\Poliander\MatchableCronExpressionAdapter;
use PHPUnit\Framework\TestCase;

class CronScheduleTest extends TestCase
{
    public function testExecute(): void
    {
        $taskStorage = new InMemoryStorage();
        $scheduleExecutor = new Scheduler($taskStorage);
        $minuteTask = new TestTask();
        $hourTask = new TestTask();
        $notCalledTask = new TestTask();

        $taskStorage->addTask(new ScheduledEntity($minuteTask, new MatchableCronExpressionAdapter('* * * * *')));
        $taskStorage->addTask(new ScheduledEntity($minuteTask, new MatchableCronExpressionAdapter('1 * * * *')));
        $taskStorage->addTask(new ScheduledEntity($hourTask, new MatchableCronExpressionAdapter('1 1 * * *')));
        $taskStorage->addTask(new ScheduledEntity($notCalledTask, new MatchableCronExpressionAdapter('5 5 * * *')));

        $tasks = $scheduleExecutor->execute(new \DateTime('2024-12-06 01:01:01'));

        $this->assertCount(3, $tasks);
        $this->assertSame(2, $minuteTask->getExecuted());
        $this->assertSame(1, $hourTask->getExecuted());
        $this->assertSame(0, $notCalledTask->getExecuted());
    }
}

class TestTask implements TaskInterface
{
    private int $executed = 0;

    public function execute(): void
    {
        ++$this->executed;
    }

    public function getExecuted(): int
    {
        return $this->executed;
    }

    public function getName(): string
    {
        return '';
    }
}
