<?php

namespace adsanchez\IcsGenerator\Application;

use Exception;

class IcsAction
{
    public function execute(IcsInput $icsInput, IcsOutput $icsOutput)
    {
        try {
            $icsContent = $this->generateIcsString($icsInput);

            return $icsOutput->present($icsContent);

        } catch (Exception $exception) {
            $icsOutput->error($exception);
        }
    }

    private function generateIcsString(IcsInput $icsInput) : string
    {
        $icsContent = "BEGIN:VCALENDAR\r\n";
        $icsContent .= "VERSION:2.0\r\n";
        $icsContent .= "PRODID:-//adsanchez//IcsGenerator//FR\r\n";
        $icsContent .= "CALSCALE:GREGORIAN\r\n";
        $icsContent .= "BEGIN:VEVENT\r\n";
        $icsContent .= "UID:" . uniqid() . "\r\n";
        $icsContent .= "DTSTAMP:" . gmdate('Ymd\THis\Z') . "\r\n";
        $icsContent .= "DTSTART:" . $icsInput->startTime()->format('Ymd\THis\Z') . "\r\n";
        $icsContent .= "DTEND:" . $icsInput->endTime()->format('Ymd\THis\Z') . "\r\n";
        $icsContent .= "SUMMARY:" . $icsInput->summary() . "\r\n";
        $icsContent .= "DESCRIPTION:" . $icsInput->description() . "\r\n";
        $icsContent .= "LOCATION:" . $icsInput->location() . "\r\n";

        $icsContent = $this->addAttendees($icsContent, $icsInput);

        $icsContent .= "END:VEVENT\r\n";

        $icsContent .= "END:VCALENDAR\r\n";

        return $icsContent;
    }

    private function addAttendees(string $icsContent, IcsInput $icsInput): string
    {
        if ($this->hasNoAttendees($icsInput))
        {
            return $icsContent;
        }

        foreach ($icsInput->attendees() as $attendee) {
            $icsContent .= "ATTENDEE:mailto:" . $attendee . "\r\n";
        }

        return $icsContent;
    }

    private function hasNoAttendees(IcsInput $icsInput): bool
    {
        return empty($icsInput->attendees());
    }
}