<?php

namespace FreeElephants\Scheduler;

interface Datable
{
    function isMatch(\DateTimeInterface $dateTime): bool;

    function getValue(): string;

    function isDisposable(): bool;

    function getNearest(): \DateTimeInterface;
}
