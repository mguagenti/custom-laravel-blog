<?php

namespace Blog\Http\Controllers\Api;

use Blog\Http\Requests\StoreBlogPost;
use Blog\Post;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Blog\Http\Controllers\Controller;
use Illuminate\Session\Store;

class PostsController extends Controller
{

    private $post;

    /**
     * PostsController constructor.
     * @param Post $post
     */
    public function __construct(Post $post)
    {
        $this->post = $post;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->post->published()->paginate(5);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreBlogPost                $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBlogPost $request)
    {
        return Post::create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  \Blog\Post  $post
     * @return \Blog\Post
     */
    public function show(Post $post)
    {
        if ($post->published_at_date == null || $post->published_at_date->gt(Carbon::now())) {
            return response()->json(null, 404);
        }

        return $post;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Blog\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(StoreBlogPost $request, Post $post)
    {
        $post->update($request->all());
        $post->save();

        return $post->fresh();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Blog\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        try {
            $post->delete();
        } catch(\Exception $e) {
            return response()->json(null, 410);
        }

        return response()->json(null, 204);
    }
}
