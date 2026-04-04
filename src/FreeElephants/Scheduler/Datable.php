<?php

namespace FreeElephants\Scheduler;

interface Datable
{
    function isMatch(\DateTimeInterface $dateTime): bool;

    function __toString(): string;

    function isDisposable(): bool;

    function getNearest(): \DateTimeInterface;
}
