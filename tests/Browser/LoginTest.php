<?php

namespace Tests\Browser;

use App\User;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class LoginTest extends DuskTestCase
{
    use DatabaseMigrations;
    // use WithFaker;
    /** @test */
    public function guest_can_see_login_page()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/login')
                ->assertSee('Sign In')
                ->assertSee('E-Mail Address')
                ->assertSee('Password');
        });
    }
}
