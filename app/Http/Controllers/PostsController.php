<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use Carbon\Carbon as Carbon;
use App\Post;

/**
 * Class PostsController
 *
 * Gets posts and returns views based on post IDs
 *
 * @package App\Http\Controllers
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

    public function home() {
        $posts = Post::where('published_at_date', '<', Carbon::now())
            ->orderBy('published_at_date', 'dsc')
            ->take(10)
            ->get();

        return view('welcome', [
            'posts' => $posts
        ]);
    }


}
