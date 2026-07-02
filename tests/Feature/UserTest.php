<?php

declare(strict_types=1);

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Recipe;
use App\Http\Controllers\AuthController;

class UserTest extends TestCase
{
    /**
     * A basic feature test example.
     */

    use RefreshDatabase;
    protected $seed = true;

    public function test_users_can_be_created(): void
    {
        $user = User::factory()->create();
        $this->assertModelExists($user);
    }

    public function test_users_can_be_updated(): void
    {
        $user = User::factory()->create();
        $user->update([
            'username' => 'ThisNameWillNotBeUsed',
        ]);
        $this->assertDatabaseHas('users', [
            'username' => 'ThisNameWillNotBeUsed',
        ]);
    }

    public function test_users_can_follow(): void
    {
        $user = User::factory()->create();
        $userToFollow = User::factory()->create();
        $response = $this->actingAs($user)->post(route('users.follow'), ['id' => $userToFollow->id]);
        $response->assertStatus(200);
        $response->assertContent('"User Followed!"');

    }

    public function test_users_can_unfollow(): void
    {
        $user = User::factory()->create();
        $userToFollow = User::factory()->create();
        $response = $this->actingAs($user)->delete(route('users.unfollow'), ['id' => $userToFollow->id]);
        $response->assertStatus(200);
        $response->assertContent('"User Unfollowed!"');
    }

    public function test_show_returns_user(): void
    {
        $user = User::factory()->create(['bio' => 'Testing bio to be found on the user show route.']);
        $response = $this->actingAs($user)->get(route('users.show', ['user' => $user]));
        $response->assertSee($user->bio);
    }

    public function test_search_returns_user(): void
    {
        $user = User::factory()->create();
        $userToSearch = User::factory()->create(['username' => 'UsernameToLookFor']);
        $response = $this->actingAs($user)->get(route('recipes.search', ['term' => $userToSearch->username]));
        $response->assertSee($userToSearch->username);
    }

    public function test_edit_page(): void
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)->get(route('users.edit'));
        $response->assertStatus(200);
    }
}
