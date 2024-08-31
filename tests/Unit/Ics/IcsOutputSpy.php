<?php

namespace adsanchez\Tests\Unit\Ics;

use adsanchez\IcsGenerator\Application\IcsOutput;
use Exception;

class IcsOutputSpy implements IcsOutput
{
    private bool $present = false;

    public function present(string $icsString): mixed
    {
        return $this->present = true;
    }

    public function error(Exception $exception): mixed
    {
        return $exception->getMessage();
    }
}