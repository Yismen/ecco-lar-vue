<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CampaignViewTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    /** @test */
    public function guest_users_are_redirected()
    {
        $this->withExceptionHandling();
        $campaign = create('App\Campaign');

        $this->get(route('admin.campaigns.index'))->assertRedirect('/login');
        $this->get(route('admin.campaigns.show', $campaign->id))->assertRedirect('/login');
    }

    /** @test */
    public function it_requires_view_campaigns_permissions_to_view_all_campaigns()
    {
        $this->withExceptionHandling();
        $this->actingAs(create('App\User'));

        $response = $this->get('/admin/campaigns');

        $response->assertStatus(403);
    }

    /** @test */
    public function it_requires_view_campaigns_permissions_to_view_a_campaign_details()
    {
        $this->withExceptionHandling();
        // given
        $campaign = create('App\Campaign');
        $this->actingAs(create('App\User'));

        // when
        $response = $this->get("/admin/campaigns/{$campaign->id}");

        // assert
        $response->assertStatus(403);
    }

    /** @test */
    public function it_allows_users_to_view_campaigns_if_they_have_view_campaigns_permission()
    {
        // $this->withExceptionHandling();
        // given
        $user = $this->userWithPermission('view-campaigns');
        $campaign = create('App\Campaign');

        // when
        $this->actingAs($user);
        $response = $this->get('/admin/campaigns');

        // assert
        $response->assertSee($campaign->name);
    }

    /** @test */
    public function it_allows_users_to_view_a_campaign_if_they_have_view_campaigns_permission()
    {
        // $this->withExceptionHandling();
        // given
        $user = $this->userWithPermission('view-campaigns');
        $campaign = create('App\Campaign');

        // when
        $this->actingAs($user);
        $response = $this->get(route('admin.campaigns.show', $campaign->id));

        // assert
        $response->assertSee($campaign->name);
    }
}
