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
        $response = $this->post('/api/posts', [
            'data' => [
                'type' => 'posts',
                'attributes' => [
                    'body' => 'Testing Body',
                ],
            ]
        ])->assertStatus(201);

        $post = Post::first();
    }
}
