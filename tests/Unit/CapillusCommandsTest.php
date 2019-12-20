<?php

namespace Tests\Unit;

use App\Mail\Capillus\CapillusAgentCallDataDumpEmail;
use App\Mail\Capillus\CapillusAgentReportMail;
use App\Mail\Capillus\CapillusDailyPerformanceMail;
use App\Mail\Capillus\CapillusFlashMail;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;

class CapillusCommandsTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    /** @test */
    public function it_sends_the_capillus_flash_report()
    {
        Mail::fake();
        
        $this->artisan('dainsys:capillus-flash')
            ->expectsOutput('Capillus lash report sent!')
            ->assertExitCode(0);
    
        Mail::assertSent(CapillusFlashMail::class);
    }
    
    /** @test */
    public function it_sends_the_capillus_daily_performance_report()
    {
        Mail::fake();
        
        $this->artisan("dainsys:capillus-pull-daily-permance-data")
            ->assertExitCode(0);
        
        $this->artisan('dainsys:capillus-send-daily-permance-report')
            ->expectsOutput("Capillus Daily Performance sent!")
            ->assertExitCode(0);

        Mail::assertSent(CapillusDailyPerformanceMail::class);
    }

    /** @test */
    public function it_sends_capillus_calls_data_dump_command()
    {
        Mail::fake();
        
        $this->artisan('dainsys:capillus-send-agent-call-data-dump-report')
            ->expectsOutput('Kipany-Capillus - Agent Call Data Dump sent!')
            ->assertExitCode(0);
            
        Mail::assertSent(CapillusAgentCallDataDumpEmail::class);
    }

    /** @test */
    public function it_sends_capillus_agent_report()
    {
        Mail::fake();
        
        $this->artisan('dainsys:capillus-send-agent-report')
            ->expectsOutput('Kipany-Capillus - Agent Report sent!')
            ->assertExitCode(0);
            
        Mail::assertSent(CapillusAgentReportMail::class);
    }
}
