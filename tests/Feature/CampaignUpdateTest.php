<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CampaignUpdateTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    /** @test */
    public function guests_can_not_visit_any_campaigns_route()
    {
        $this->withExceptionHandling();
        $campaign = create('App\Campaign');

        $this->get(route('admin.campaigns.edit', $campaign->id))->assertRedirect('/login');
        $this->put(route('admin.campaigns.update', $campaign->id))->assertRedirect('/login');
        $this->delete(route('admin.campaigns.destroy', $campaign->id))->assertRedirect('/login');
    }

    /** @test */
    public function a_user_can_see_a_form_to_update_a_campaign()
    {
        $this->withExceptionHandling();
        $campaign = create('App\Campaign');

        $this->actingAs($this->userWithPermission('edit-campaigns'))
            ->get(route('admin.campaigns.edit', $campaign->id))
            ->assertSee('Edit Campaign '.$campaign->name);
    }

    /** @test */
    public function it_requires_a_name_to_update_a_campaign()
    {
        $this->withExceptionHandling();
        $campaign = create('App\Campaign');

        $this->actingAs($this->userWithPermission('edit-campaigns'))
            ->put(route('admin.campaigns.update', $campaign->id), $this->formAttributes(['name' => '']))
            ->assertSessionHasErrors('name');
    }

    /** @test */
    public function a_user_can_update_a_campaign()
    {
        $this->withExceptionHandling();
        $campaign = create('App\Campaign');
        $campaign->name = 'New Name';

        $this->actingAs($this->userWithPermission('edit-campaigns'))
            ->put(route('admin.campaigns.update', $campaign->id), $campaign->toArray());

        $this->assertDatabaseHas('campaigns', ['name' => 'New Name']);

        $this->get(route('admin.campaigns.index'))
            ->assertSee('New Name');
    }

    /* @test */
    // public function it_requires_destroy_campaigns_permission_to_destroy_a_permission()
    // {
    //     $this->withExceptionHandling();
    //     // Given
    //     $this->actingAs(create('App\User'));
    //     $campaign = create('App\Campaign');

    //     // When
    //     $response = $this->delete(route('admin.campaigns.destroy', $campaign->id));

    //     // Expect

    //     $response->assertStatus(403);
    // }

    /* @test */
    // public function it_allows_users_with_destroy_campaigns_permission_to_destroy_campaigns()
    // {
    //     // $this->withExceptionHandling();
    //     // given
    //     $user = $this->userWithPermission('destroy-campaigns');
    //     $campaign = create('App\Campaign');

    //     // when
    //     $this->actingAs($user);
    //     $response = $this->delete(route('admin.campaigns.destroy', $campaign->id));

    //     // assert
    //     $response->assertRedirect(route('admin.campaigns.index'));
    //     $this->assertDatabaseMissing('campaigns', ['id' => $campaign->id]);
    // }
}
