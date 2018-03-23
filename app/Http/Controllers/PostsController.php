<?php

namespace Blog\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use Carbon\Carbon as Carbon;
use Blog\Post;

/**
 * Class PostsController
 *
 * Gets posts and returns views based on post IDs
 *
 * @package Blog\Http\Controllers
 */
class PostsController extends Controller {

    /**
     * Returns a post based on the slug.
     *
     * @param String $slug The slug of the post to return
     *
     * @return View
     */
    public function post(String $slug) {
        $post = Post::where('slug', $slug)->firstOrFail();

        return view('post', [
            'post' => $post
        ]);
    }

    /**
     * Returns the home page with the posts in order by date.
     *
     * @param int $limit The number of posts to return.
     *
     * @return View
     */
    public function home($limit = 5) {
        $posts = Post::where('published_at_date', '<', Carbon::now())
            ->orderBy('published_at_date', 'dsc')
            ->simplePaginate($limit);

        return view('welcome', [
            'posts' => $posts
        ]);
    }


}
