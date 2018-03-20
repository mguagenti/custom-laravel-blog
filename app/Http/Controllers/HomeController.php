<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon as Carbon;
use App\Post;

class HomeController extends Controller {

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $posts = Post::paginate(10);
        return view('home', [
            'posts'     => $posts
        ]);
    }

    /**
     * Save and update drafts.
     */
    public function draft() {
        return view('draft');
    }

    /**
     * Save the form data in the database.
     *
     * @param Request $request
     *
     * @return View
     */
    public function save(Request $request) {
        $meta = [
            'title'         => $request->title,
            'author'        => \Auth::user()->name,
            'description'   => $request->description
        ];

        $post = Post::create([
            'slug'              => $request->slug,
            'meta'              => $meta,
            'content'           => $request->content,
            'published_at_date' => Carbon::parse($request->publish_date)
        ]);

        return view('post', [
            'post'  => $post
        ]);
    }

    /**
     * Deletes a post based on its slug.
     *
     * @param $slug The slug of the post to delete.
     *
     * @return Redirect Redirect the user back to the admin page.
     */
    public function trash($slug) {
        Post::where('slug', $slug)->delete();

        return back();
    }


}
