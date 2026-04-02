<?php
declare(strict_types=1);


namespace FreeElephants\Scheduler;

use FreeElephants\Scheduler\Poliander\MatchableCronExpressionAdapter;
use PHPUnit\Framework\TestCase;

class CronScheduleTest extends TestCase
{
    public function testExecute(): void
    {
        $scheduleExecutor = new CronSchedule();
        $minuteTask = new TestTask();
        $hourTask = new TestTask();
        $notCalledTask = new TestTask();

        $scheduleExecutor->addTask(new MatchableCronExpressionAdapter('* * * * *'), $minuteTask);
        $scheduleExecutor->addTask(new MatchableCronExpressionAdapter('1 * * * *'), $minuteTask);
        $scheduleExecutor->addTask(new MatchableCronExpressionAdapter('1 1 * * *'), $hourTask);
        $scheduleExecutor->addTask(new MatchableCronExpressionAdapter('5 5 * * *'), $notCalledTask);

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
