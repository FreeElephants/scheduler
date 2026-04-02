<?php

namespace FreeElephants\Scheduler;

interface Datable
{
    function isMatch(\DateTimeInterface $dateTime): bool;
}
