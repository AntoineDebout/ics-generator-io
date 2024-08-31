<?php

namespace adsanchez\Tests\Feature\Ics\IcsGeneratorTest;

use adsanchez\IcsGenerator\Application\IcsInput;


class IcsInputFromDtoStub implements IcsInput
{
    public function __construct(
        public IcsDto $icsDto)
    {
    }

    public function summary(): string
    {
        return $this->icsDto->summary;
    }

    public function description(): string
    {
        return $this->icsDto->description;
    }

    public function startTime(): \DateTimeInterface
    {
        return $this->icsDto->startTime;
    }

    public function endTime(): \DateTimeInterface
    {
        return $this->icsDto->endTime;
    }

    public function location(): string
    {
        return $this->icsDto->location;
    }

    public function attendees(): array
    {
        return $this->icsDto->attendees;
    }
}