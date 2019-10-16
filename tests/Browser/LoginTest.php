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

    /** @test */
    public function a_user_can_sign_in()
    {
        $user = create(User::class);

        $this->browse(function (Browser $browser) use ($user) {
            $browser->visit('/login')
                ->type('email', $user->email)
                ->type('password', 'secret')
                ->press('Sign In')
                ->assertPathIs('/admin');
        });
    }
}
