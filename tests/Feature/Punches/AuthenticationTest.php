<?php

namespace Tests\Feature\Punchs;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AuthenticationTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    public function testGuestCantViewPunchs()
    {
        $punch = create('App\Punch');
        
        $this->get(route('admin.punches.index'))
            ->assertStatus(302)
            ->assertRedirect(route('login'));

        $this->get(route('admin.punches.show', $punch->punch))
            ->assertStatus(302)    
            ->assertRedirect(route('login'));
    }

    public function testGuestCantCreatePunchs()
    {
        $punch = create('App\Punch');
        
        $this->get(route('admin.punches.create'))
            ->assertStatus(302)    
            ->assertRedirect(route('login'));

        $this->post(route('admin.punches.store'), $punch->toArray())
            ->assertStatus(302)    
            ->assertRedirect(route('login'));
    }

    public function testGuestCantUpdatePunch()
    {
        $punch = create('App\Punch');        
        
        $this->get(route('admin.punches.edit', $punch->punch))
            ->assertStatus(302)    
            ->assertRedirect(route('login'));
            
        $this->put(route('admin.punches.update', $punch->punch), $punch->toArray())
            ->assertStatus(302)    
            ->assertRedirect(route('login'));
    }

    public function testGuestCantDestroyPunch()
    {
        $punch = create('App\Punch');        
        
        $this->delete(route('admin.punches.destroy', $punch->punch))
            ->assertStatus(302)    
            ->assertRedirect(route('login'));
    }
}
