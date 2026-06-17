<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CategoryTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    use RefreshDatabase;

    public function test_login_user_can_view_category_index(): void
    {
        $user = \App\Models\User::factory()->create();

        $response = $this->actingAs($user)->get('/categories');

        $response->assertStatus(200);
    }
    public function test_guest_cannot_view_category_index(): void
    {
        $response = $this->get('/categories');

        $response->assertRedirect('/login');
    }
    public function test_user_can_create_category(): void
    {
        $user = \App\Models\User::factory()->create();

        $response = $this->actingAs($user)->post('/categories', [
            'name' => '洗い物',
        ]);

        $response->assertRedirect('/categories');

        $this->assertDatabaseHas('categories', [
            'name' => '洗い物',
            'user_id' => $user->id,
        ]);
    }
    public function test_user_can_update_category(): void
    {
        $user = \App\Models\User::factory()->create();

        $category = \App\Models\Category::factory()->create([
            'user_id' => $user->id,
            'name' => '洗い物',
        ]);

        $response = $this->actingAs($user)->put(
            route('categories.update', $category),
            [
                'name' => '掃除',
            ]
        );

        $response->assertRedirect('/categories');

        $this->assertDatabaseHas('categories', [
            'id' => $category->id,
            'name' => '掃除',
        ]);
    }
    public function test_user_can_delete_category(): void
    {
        $user = \App\Models\User::factory()->create();

        $category = \App\Models\Category::factory()->create([
            'user_id' => $user->id,
        ]);

        $response = $this->actingAs($user)->delete(
            route('categories.destroy', $category)
        );

        $response->assertRedirect('/categories');

        $this->assertDatabaseMissing('categories', [
            'id' => $category->id,
        ]);
    }
}
