<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Database\Factories\UserFactory;
use Database\Factories\PostFactory;
use Database\Factories\CommentFactory;

class CommmentTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function testCommentCreate()
    {
        $user = UserFactory::new()->create();
        $post = PostFactory::new()->create();


        $response = $this->actingAs($user)
            ->post(route('comment'), [
                'comment_content' => 'A test comment',
                'post_id' => (string) $post->post_id,
            ]);

        $response->assertRedirect(route('post.show', ['id' => $post->post_id]))
            ->assertSessionHas('success', 'コメントが作成されました！');
    }

    /** @test */
    public function testCommentDelete()
    {
        $user = UserFactory::new()->create();
        $post = PostFactory::new()->create();
        $comment = CommentFactory::new()->create();

        $this->actingAs($user);

        $this->assertDatabaseHas('comments', ['comment_id' => $comment->comment_id]);

        $response = $this->actingAs($user)
            ->delete(route('comment.delete', [
                'id' => (int) $comment->comment_id,
                'post_id' => $post->post_id
            ]));

        $this->assertDatabaseMissing('comments', ['comment_id' => $comment->comment_id]);
        $response->assertRedirect(route('post.show', ['id' => $post->post_id]))
            ->assertSessionHas('success', '削除できました！');
    }

    /** @test */
    public function testCommentUpdate()
    {
        $user = UserFactory::new()->create();
        $post = PostFactory::new()->create();
        $comment = CommentFactory::new()->create();
        $updatedContent = 'Updated comment content';

        $this->actingAs($user);

        $response = $this->actingAs($user)
            ->put(route('comment.update', ['id' => $comment->comment_id]), [
                'comment_content' => $updatedContent,
                'post_id' => $comment->post_id,
            ]);

        $response->assertRedirect(route('post.show', ['id' => $post->post_id]))
            ->assertSessionHas('success', '修正できました！');

        $this->assertDatabaseHas('comments', [
            'comment_id' => $comment->comment_id,
            'comment_content' => $updatedContent,
        ]);
    }
}
