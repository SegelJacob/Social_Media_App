<?php

namespace Tests\Feature;

use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PostToTimelineTest extends TestCase
{
    use RefreshDatabase;

    public function test_a_user_can_post_ext_post()
    {
        $this->withoutExceptionHandling();
        $this->actingAs($user = User::factory()->create(),'api');

        $this->actingAs($user = User::factory()->create(),'api');

        $response = $this->post('/api/posts',[
            'data' => [
                'type' => 'posts',
                'attributes' => [
                    'body' => 'Testing body'
                ]
            ]
        ]);

        $post = Post::first();
        $this->assertCount(1, Post::all());
        $this->assertEquals('Testing body', $post->body);

        $response->assertStatus(201)
            ->assertJson([
                'data' => [
                    'type' => 'posts',
                    'post_id' => $post->id,
                    'attributes' => [
                        'posted_by' => [
                            'data' => [
                                'attributes' => [
                                    'name' => $user->name,
                                ]
                            ]
                        ],
                        'body' => 'Testing body',
                    ]
                ],
                'links' => [
                    'self' => url('/posts/'.$post->id),
                ]
            ]);
    }
}
