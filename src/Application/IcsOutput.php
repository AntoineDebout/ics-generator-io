<?php

namespace adsanchez\IcsGenerator\Application;

use Exception;

interface IcsOutput
{
    public function present(string $icsString): mixed;
    public function error(Exception $exception): mixed;
}