<?php

namespace Tests\Feature;

use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PostTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function testStorePost()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post(route('post'), [
            'title' => 'Test Title',
            'content' => 'Test Content',
        ]);

        $response->assertRedirect(route('dashboard'));
        $this->assertDatabaseHas('posts', [
            'title' => 'Test Title',
            'content' => 'Test Content',
            'user_id' => $user->user_id,
        ]);
    }

    /** @test */
    public function testShowPost()
    {
        $user = User::factory()->create();

        $this->actingAs($user);

        $post = Post::factory()->create(['user_id' => $user->user_id]);

        $response = $this->get(route('post.show', ['id' => $post->post_id]));

        $response->assertSuccessful();
        $response->assertViewIs('post.show');
        $response->assertViewHas('post', $post);
    }

    /** @test */
    public function testDeletePost()
    {
        $user = User::factory()->create();
        $post = Post::factory()->create(['user_id' => $user->user_id]);

        $response = $this->actingAs($user)->delete(route('post.delete', ['id' => $post->post_id]));

        $response->assertRedirect(route('dashboard'));
        $this->assertDatabaseMissing('posts', ['post_id' => $post->post_id]);
    }

    /** @test */
    public function testUpdatePost()
    {
        $user = User::factory()->create();
        $post = Post::factory()->create(['user_id' => $user->user_id]);

        $response = $this->actingAs($user)->put(route('post.update', ['id' => $post->post_id]), [
            'title' => 'Updated Title',
            'content' => 'Updated Content',
        ]);

        $response->assertRedirect(route('dashboard'));
        $this->assertDatabaseHas('posts', [
            'post_id' => $post->post_id,
            'title' => 'Updated Title',
            'content' => 'Updated Content',
        ]);
    }
}
