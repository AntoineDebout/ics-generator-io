<?php

namespace adsanchez\Tests\Feature\Ics\IcsGeneratorTest;

class IcsDto
{
 public function __construct(
     public string $summary,
     public string $description,
     public \DateTimeInterface $startTime,
     public \DateTimeInterface $endTime,
     public string $location,
     public array $attendees,
 )
 {
 }
}