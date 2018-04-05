<?php

namespace Blog\Http\Controllers;

use Blog\Http\Requests\StoreBlogPost;
use Blog\Post;
use Carbon\Carbon as Carbon;

/**
 * Class AdminController
 * @package Blog\Http\Controllers
 */
class AdminController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return View
     */
    public function index()
    {
        $posts = Post::paginate(10);

        return view('home', [
            'posts' => $posts
        ]);
    }

    /**
     * Save and update drafts.
     */
    public function draft()
    {
        return view('draft');
    }

    /**
     * Save the form data in the database.
     *
     * @param StoreBlogPost $request
     *
     * @return Redirect
     */
    public function save(StoreBlogPost $request)
    {
        $meta = [
            'title' => $request->title,
            'author' => \Auth::user()->name,
            'description' => $request->description
        ];

        $post = Post::create([
            'slug' => $request->slug,
            'user_id' => \Auth::user()->id,
            'meta' => $meta,
            'content' => $request->content,
            'published_at_date' => Carbon::parse($request->post_date)
        ]);

        return redirect()->route('post', [$post]);
    }


}
