<?php

namespace Tests\Unit;

use Blog\Post;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class PostTest extends TestCase
{

    use DatabaseMigrations;

    /** @test */
    public function get_formatted_date_attribute()
    {
        $post = factory(Post::class)->states('published')->create();

        $this->assertEquals('March 24, 2018', $post->post_date);
    }

    /** @test */
    public function get_slug_attribute()
    {
        $post = factory(Post::class)->states('published')->create();

        $this->assertEquals('test-post', $post->slug);
    }

    /** @test */
    public function check_is_published_returns_true_false()
    {
        $post = factory(Post::class)->states('published')->create();

        $this->assertTrue($post->isPublished());

        $post->published_at_date = null;
        $post->save();

        $this->assertFalse($post->isPublished());

        $post->published_at_date = Carbon::parse('+2 weeks');
        $post->save();

        $this->assertFalse($post->isPublished());
    }


}
