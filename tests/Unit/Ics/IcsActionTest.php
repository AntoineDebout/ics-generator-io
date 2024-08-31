<?php

namespace adsanchez\Tests\Unit\Ics;

use adsanchez\IcsGenerator\Application\IcsAction;
use adsanchez\Tests\TestCase;
use Exception;

class IcsActionTest extends TestCase
{
    /**
     * @test
     */
    public function it_can_generate_ics_content()
    {
        app(IcsAction::class)->execute(
            new IcsInputStub(),
            $output = new IcsOutputSpy(),
        );

        $this->assertTrue($output->present('ics'));
    }

    /**
     * @test
     */
    public function it_capable_of_catching_an_error_during_execution (): void
    {
        $this->expectException(Exception::class);

        $errorMessage = app(IcsAction::class)->execute(
            new IcsInputThrowsExeceptionStub(),
            $output = new IcsOutputSpy(),
        );

        $this->assertFalse($output->present('ics'));
        $this->assertSame('Error during processing', $errorMessage);
    }
}