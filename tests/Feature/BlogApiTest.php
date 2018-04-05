<?php

namespace Tests\Feature;

use Blog\Post;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class BlogApiTest extends TestCase
{

    use DatabaseMigrations;

    /** @test */
    public function check_that_a_post_with_null_publish_date_is_unpublished()
    {
        $post = factory(Post::class)->states('unpublished')->create();
        $this::assertEmpty($post->published()->get());

        $response = $this->json('GET', "/api/posts/{$post->slug}");
        $response->assertStatus(404);
    }

    /** @test */
    public function check_that_a_post_with_future_date_is_unpublished()
    {
        $post = factory(Post::class)->create([
            'published_at_date' => Carbon::parse('+2 weeks')
        ]);

        $response = $this->json('GET', "/api/posts/{$post->slug}");
        $response->assertStatus(404);
    }

    /** @test */
    public function can_get_post_by_slug()
    {
        $post = factory(Post::class)->create();

        $response = $this->json('GET', "/api/posts/{$post->slug}");
        $response->assertStatus(200);
    }

    /** @test */
    public function can_create_a_new_post()


}
