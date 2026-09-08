<?php

namespace Tests\Feature\Admin;

use App\Models\SeoSite;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SeoManagerLoadingTest extends TestCase
{
    use RefreshDatabase;

    public function test_seo_manager_loads_selected_site_and_pages(): void
    {
        $user = User::factory()->create();
        $user->givePermissionTo('seo.view');

        $site = SeoSite::create([
            'name' => 'Example',
            'domain' => 'example.com',
            'scheme' => 'https',
            'active' => true,
        ]);

        $response = $this->actingAs($user)->get(route('admin.seo.manager.index', ['site' => $site->id]));

        $response->assertOk();
        $response->assertViewIs('admin.seo.manager');
        $response->assertViewHas('selectedSite', fn ($selected) => $selected->is($site));
        $response->assertViewHas('selectedPage');
        $this->assertCount(8, $response->viewData('selectedSite')->pages);
    }
}
