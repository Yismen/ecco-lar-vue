<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CampaignCreateTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    /** @test */
    public function guests_can_not_visit_any_campaigns_route()
    {
        $this->withExceptionHandling();
        $campaign = create('App\Campaign');

        $this->get(route('admin.campaigns.create'))->assertRedirect('/login');
        $this->post(route('admin.campaigns.store', $campaign->toArray()))->assertRedirect('/login');
    }

    /** @test */
    public function it_requires_create_campaigns_permission_to_add_a_campaign()
    {
        $this->withExceptionHandling();
        // Given
        $user = create('App\User');
        $this->actingAs($user);

        // When
        $response = $this->get(route('admin.campaigns.create'));
        // Expect

        $response->assertStatus(403);
    }

    /** @test */
    public function it_allows_with_create_campaigns_permission_to_create_campaigns()
    {
        // $this->withExceptionHandling();
        // given
        $user = $this->userWithPermission('create-campaigns');

        // when
        $this->actingAs($user);
        $response = $this->get(route('admin.campaigns.create'));

        // assert
        $response->assertStatus(200);
    }

    /** @test */
    public function it_requires_a_all_fields_to_create_a_campaign()
    {
        $this->withExceptionHandling();

        $this->actingAs($this->userWithPermission('create-campaigns'))
            ->post(
                route('admin.campaigns.store'),
                [
                    'name' => '',
                    'project_id' => '',
                    'source_id' => '',
                    'revenue_type_id' => '',
                    'sph_goal' => '',
                    'revenue_rate' => '',
                ]
            )
            ->assertSessionHasErrors('name')
            ->assertSessionHasErrors('project_id')
            ->assertSessionHasErrors('source_id')
            ->assertSessionHasErrors('revenue_type_id')
            ->assertSessionHasErrors('sph_goal')
            ->assertSessionHasErrors('revenue_rate')
            ;
    }

    /** @test */
    public function a_user_can_create_a_campaign()
    {
        // $this->withExceptionHandling();
        $campaign = make('App\Campaign');

        $this->actingAs($this->userWithPermission('create-campaigns'))
            ->post(route('admin.campaigns.store', $campaign->toArray()));

        $this->assertDatabaseHas('campaigns', ['name' => $campaign->name]);

        $this->get(route('admin.campaigns.index'))
            ->assertSee($campaign->name);
    }
}
