<?php

namespace Tests\Unit;

use App\Mail\Political\PoliticalFlashMail;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;

class PoliticalCommandsTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    // /** @test */
    public function it_sends_the_political_flash_report()
    {
        Mail::fake();
        
        $this->artisan('dainsys:political-send-hourly-flash')
            ->expectsOutput('Political Hourly Flash sent!')
            ->assertExitCode(0);
    
        Mail::assertSent(PoliticalFlashMail::class);
    }
}
