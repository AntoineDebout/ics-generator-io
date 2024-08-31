<?php

namespace adsanchez\Tests\Feature\Ics;

use adsanchez\IcsGenerator\Application\IcsAction;
use adsanchez\Tests\Feature\Ics\IcsGeneratorTest\IcsDto;
use adsanchez\Tests\Feature\Ics\IcsGeneratorTest\IcsInputFromDtoStub;
use adsanchez\Tests\Feature\Ics\IcsGeneratorTest\IcsOutputStub;
use adsanchez\Tests\TestCase;
use DateTime;

class IcsGeneratorTests extends TestCase
{
    /** @test */
    public function it_generates_ics_content_correctly_without_attendees()
    {
        $icsDto = new IcsDto(
            summary: 'Test',
            description: 'Test',
            startTime: DateTime::createFromFormat('Y/m/d H:i:s', '2024/02/03 13:30:00'),
            endTime: DateTime::createFromFormat('Y/m/d H:i:s', '2024/02/03 14:30:00'),
            location: 'Paris',
            attendees: []
        );

        $icsString = resolve(IcsAction::class)->execute(
            new IcsInputFromDtoStub($icsDto),
            new IcsOutputStub()
        );

        $this->assertStringContainsString('DTSTART:20240203T133000Z', $icsString);
        $this->assertStringContainsString('DTEND:20240203T143000Z', $icsString);
        $this->assertStringContainsString('SUMMARY:Test', $icsString);
        $this->assertStringContainsString('DESCRIPTION:Test', $icsString);
        $this->assertStringContainsString('LOCATION:Paris', $icsString);
        $this->assertStringNotContainsString('ATTENDEES:', $icsString);
    }

    /** @test */
    public function it_generates_ics_content_correctly_with_attendees()
    {
        $icsDto = new IcsDto(
            summary: 'Test',
            description: 'Test',
            startTime: DateTime::createFromFormat('Y/m/d H:i:s', '2024/02/03 13:30:00'),
            endTime: DateTime::createFromFormat('Y/m/d H:i:s', '2024/02/03 14:30:00'),
            location: 'Paris',
            attendees: [
                'mail.one@test.com',
                'mail.two@test.com',
            ]
        );

        $icsString = resolve(IcsAction::class)->execute(
            new IcsInputFromDtoStub($icsDto),
            new IcsOutputStub()
        );

        $this->assertStringContainsString('DTSTART:20240203T133000Z', $icsString);
        $this->assertStringContainsString('DTEND:20240203T143000Z', $icsString);
        $this->assertStringContainsString('SUMMARY:Test', $icsString);
        $this->assertStringContainsString('DESCRIPTION:Test', $icsString);
        $this->assertStringContainsString('LOCATION:Paris', $icsString);
        $this->assertStringContainsString('ATTENDEE:mailto:mail.one@test.com', $icsString);
        $this->assertStringContainsString('ATTENDEE:mailto:mail.two@test.com', $icsString);
    }
}