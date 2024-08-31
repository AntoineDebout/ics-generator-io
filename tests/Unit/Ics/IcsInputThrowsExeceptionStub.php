<?php

namespace adsanchez\Tests\Unit\Ics;

use adsanchez\IcsGenerator\Application\IcsInput;
use DateTime;
use Exception;

class IcsInputThrowsExeceptionStub implements IcsInput
{
    public function summary(): string
    {
        throw new Exception('Error during processing');
    }

    public function description(): string
    {
        return 'Test Description';
    }

    public function startTime(): \DateTimeInterface
    {
        return DateTime::createFromFormat('Y/m/d H:i:s', '2024/02/03 13:30:00');
    }

    public function endTime(): \DateTimeInterface
    {
        return DateTime::createFromFormat('Y/m/d H:i:s', '2024/02/03 14:30:00');
    }

    public function location(): string
    {
        return 'Paris';
    }

    public function attendees(): array
    {
        return [
            'mail-one@test.com',
            'mail-two@test.com',
        ];
    }
}