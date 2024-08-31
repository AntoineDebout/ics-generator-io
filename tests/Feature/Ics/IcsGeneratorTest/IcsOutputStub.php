<?php

namespace adsanchez\Tests\Feature\Ics\IcsGeneratorTest;

use adsanchez\IcsGenerator\Application\IcsOutput;
use Exception;

class IcsOutputStub implements IcsOutput
{
    public function present(string $icsString): mixed
    {
        return $icsString;
    }

    public function error(Exception $exception): mixed
    {
        return $exception->getMessage();
    }
}