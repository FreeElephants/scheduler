<?php

namespace FreeElephants\Scheduler;

interface MatchableToDateTime
{
    function isMatch(\DateTimeInterface $dateTime): bool;
}
