<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;
use Blog\Post;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BlogApiTest extends TestCase {

    use DatabaseMigrations;

    /** @test */
    public function check_that_a_post_with_null_publish_date_is_unpublished() {
        $post = factory(Post::class)->states('unpublished')->create();
        $this::assertEmpty($post->published()->get());

        $response = $this->json('GET', "/api/posts/{$post->id}");
        $response->assertStatus(404);
    }

    /** @test */
    public function check_that_a_post_with_future_date_is_unpublished() {
        $post = factory(Post::class)->create([
            'published_at_date' => Carbon::parse('+2 weeks')
        ]);

        $response = $this->json('GET', "/api/posts/{$post->id}");
        $response->assertStatus(404);
    }

    /** @test */
    public function can_retrieve_published_post_by_id() {
        $post = factory(Post::class)->create();

        $response = $this->json('GET', "/api/posts/{$post->id}");
        $response->assertStatus(200);

    }


}
