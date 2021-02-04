<?php

namespace Tests\Unit;

use App\Mail\CommandsBaseMail;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class GeneralCommandsTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    /** @test */
    public function it_sends_the_general_daily_production_report()
    {
        Mail::fake();

        Log:

        $this->artisan('dainsys:general-rc-production-report')
            ->expectsOutput('General Daily Production Report Sent!')
            ->assertExitCode(0);

        Mail::assertSent(CommandsBaseMail::class);
    }
}
