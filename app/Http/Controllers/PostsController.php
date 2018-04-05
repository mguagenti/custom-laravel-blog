<?php

namespace Blog\Http\Controllers;

use function abort;
use Blog\Post;
use Illuminate\View\View;

/**
 * Class PostsController
 *
 * Gets posts and returns views based on post IDs
 *
 * @package Blog\Http\Controllers
 */
class PostsController extends Controller
{

    /**
     * Returns a post based on the slug.
     *
     * @param String $slug The slug of the post to return
     *
     * @return View
     */
    public function post(Post $post)
    {
        if ($post->isPublished()) {
            return view('post', [
                'post' => $post
            ]);
        }

        return abort(404);
    }

    /**
     * Returns the home page with the posts in order by date.
     *
     * @param int $limit The number of posts to return.
     *
     * @return View
     */
    public function home($limit = 5)
    {
        $posts = Post::published()->simplePaginate($limit);

        return view('welcome', [
            'posts' => $posts
        ]);
    }


}
