<?php

namespace FreeElephants\Scheduler;

interface TaskInterface
{
    public function execute(): void;

    public function getName(): string;
}
