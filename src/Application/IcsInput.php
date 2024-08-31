<?php

namespace adsanchez\IcsGenerator\Application;

use DateTimeInterface;

interface IcsInput
{
    public function summary(): string;
    public function description(): string;
    public function startTime(): DateTimeInterface;
    public function endTime(): DateTimeInterface;
    public function location(): string;
    public function attendees(): array;
}