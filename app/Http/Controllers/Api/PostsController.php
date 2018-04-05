<?php

namespace Blog\Http\Controllers\Api;

use Blog\Http\Controllers\Controller;
use Blog\Http\Requests\StoreBlogPost;
use Blog\Post;
use Carbon\Carbon;

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
     * @param  StoreBlogPost $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBlogPost $request)
    {
        return Post::create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  \Blog\Post $post
     * @return \Blog\Post
     */
    public function show(Post $post)
    {
        if ($post->isPublished()) {
            return $post;
        }

        return response()->json(null, 404);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  StoreBlogPost $request
     * @param  \Blog\Post $post
     * @return \Blog\Post
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
     * @param  \Blog\Post $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        try {
            $post->delete();
        } catch (\Exception $e) {
            return response()->json(null, 410);
        }

        return response()->json(null, 204);
    }


}
