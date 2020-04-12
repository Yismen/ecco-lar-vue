<?php

namespace Tests\Unit;

use App\Mail\Capillus\CapillusAgentCallDataDumpEmail;
use App\Mail\Capillus\CapillusAgentReportMail;
use App\Mail\Capillus\CapillusCallTypeReportMail;
use App\Mail\Capillus\CapillusDailyPerformanceMail;
use App\Mail\Capillus\CapillusFlashMail;
use App\Mail\Capillus\CapillusLeadsReportMail;
use Carbon\Carbon;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;
use Maatwebsite\Excel\Facades\Excel;

class CapillusCommandsTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    /** @test */
    public function it_sends_the_capillus_flash_report()
    {
        create(\App\Role::class, ['name' => 'admin']);

        Mail::fake();
        Excel::fake();
        $instance = Carbon::now()->format('Ymd_His');
        
        $this->artisan('dainsys:capillus-send-flash-report')
            ->expectsOutput('Capillus Flash report sent!')
            ->assertExitCode(0);

        // Excel::assertStored("KNYC E Flash Report {$instance}.xlsx");
    
        Mail::assertSent(CapillusFlashMail::class);
    }
    
    /** @test */
    public function it_pulls_the_capillus_daily_performance_report()
    {
        create(\App\Role::class, ['name' => 'admin']);
        $date = Carbon::now()->subDay();

        $this->artisan("dainsys:capillus-pull-daily-performance-data")
        ->expectsOutput("Data pulled for date {$date}")
        ->assertExitCode(0);
    }
    
    /** @test */
    
    public function it_sends_the_capillus_daily_performance_report()
    {
        create(\App\Role::class, ['name' => 'admin']);
        Mail::fake();
        Excel::fake();
        $instance = Carbon::now()->format('Ymd_His');
        
        $this->artisan('dainsys:capillus-send-daily-performance-report')
        ->expectsOutput("Capillus Daily Performance sent!")
        ->assertExitCode(0);
        
        // Excel::assertStored("Capillus Daily Performance Report {$instance}.xlsx");
        
        Mail::assertSent(CapillusDailyPerformanceMail::class);
    }

    /** @test */
    public function it_sends_capillus_calls_data_dump_command()
    {
        create(\App\Role::class, ['name' => 'admin']);
        Mail::fake();
        Excel::fake();
        $instance = Carbon::now()->format('Ymd_His');
        
        $this->artisan('dainsys:capillus-send-agent-call-data-dump-report')
            ->expectsOutput('Kipany-Capillus - Agent Call Data Dump sent!')
            ->assertExitCode(0);

        // Excel::assertStored("Kipany-Capillus - Agent Call Data Dump {$instance}.xlsx");
            
        Mail::assertSent(CapillusAgentCallDataDumpEmail::class);
    }

    /** @test */
    public function it_sends_capillus_agent_report()
    {
        create(\App\Role::class, ['name' => 'admin']);
        Mail::fake();
        Excel::fake();

        $instance = Carbon::now()->format('Ymd_His');
        
        $this->artisan('dainsys:capillus-send-agent-report')
            ->expectsOutput('Kipany-Capillus - Agent Report sent!')
            ->assertExitCode(0);
            
        // Excel::assertStored("Kipany-Capillus - Agent Report {$instance}.xlsx");
            
        Mail::assertSent(CapillusAgentReportMail::class, function ($mail) {
            return $mail->hasTo("yismen.jorge@ecco.com.do");
            dd($mail);
        });
    }

    /** @test */
    public function it_sends_capillus_leads_report()
    {
        create(\App\Role::class, ['name' => 'admin']);
        $date = Carbon::now()->subDay();
        Mail::fake();
        Excel::fake();
        
        $this->artisan('dainsys:capillus-send-daily-leads-report')
            ->expectsOutput('Kipany-Capillus - Leads Report Sent!')
            ->assertExitCode(0);

        // Excel::assertStored("Kipany Lead {$date->format('m-d-Y')} ECC.xlsx");
            
        Mail::assertSent(CapillusLeadsReportMail::class);
    }

    /** @test */
    public function it_sends_capillus_calls_type_report()
    {
        create(\App\Role::class, ['name' => 'admin']);
        Mail::fake();
        Excel::fake();
        $this->withExceptionHandling();
        $instance = Carbon::now()->format('Ymd_His');
        
        $this->artisan('dainsys:capillus-send-calls-type-report')
            ->expectsOutput('Kipany-Capillus - Calls Type Report sent!')
            ->assertExitCode(0);
            
        // Excel::assertStored("Kipany-Capillus - Fax Calls Report {$instance}.xlsx");
            
        Mail::assertSent(CapillusCallTypeReportMail::class);
    }
}
