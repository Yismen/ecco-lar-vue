<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CreateVipTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    /** test */
    public function it_requries_authentication()
    {
        $this->withExceptionHandling();
        $vip = create('App\Vip');
        $this->get(route('admin.vips.index'))->assertRedirect('/login');
        $this->get(route('admin.vips.show', $vip->id))->assertRedirect('/login');
        $this->get(route('admin.vips.create'))->assertRedirect('/login');
        $this->post(route('admin.vips.store', $vip->toArray()))->assertRedirect('/login');
        $this->get(route('admin.vips.edit', $vip->id))->assertRedirect('/login');
        $this->put(route('admin.vips.update', $vip->id))->assertRedirect('/login');
        $this->delete(route('admin.vips.destroy', $vip->id))->assertRedirect('/login');
    }
}
