<?php

namespace Tests\Feature;

use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class ApiPracticalImprovementsTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_cannot_create_post(): void
    {
        $response = $this->postJson('/api/posts', [
            'title' => 'مقال تجريبي',
            'content' => 'محتوى',
        ]);

        $response->assertUnauthorized();
    }

    public function test_authenticated_user_can_create_post_with_own_user_id(): void
    {
        $user = User::factory()->create();
        Sanctum::actingAs($user);

        $response = $this->postJson('/api/posts', [
            'title' => 'مقال جديد',
            'content' => 'محتوى المقال',
        ]);

        $response->assertCreated();

        $this->assertDatabaseHas('posts', [
            'title' => 'مقال جديد',
            'user_id' => $user->id,
        ]);

        $post = Post::first();
        $this->assertSame($user->id, $post->user_id);
    }

    public function test_guest_cannot_create_disease(): void
    {
        $response = $this->postJson('/api/diseases', [
            'name' => 'Test Disease',
            'symptoms' => 'Leaf spots',
            'treatment' => 'Use proper fungicide',
        ]);

        $response->assertUnauthorized();
    }
}
