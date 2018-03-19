@extends('layouts.blog', [
    'title'             => json_decode($post->meta)->title,
    'meta_description'  => json_decode($post->meta)->description,
    'author'            => json_decode($post->meta)->author
])

@section('content')
    <div class="post">
        <div class="post-hero">
            <div class="container">
                <div class="post-hero-inner">
                    <h1 class="post-title">{{ json_decode($post->meta)->title }}</h1>
                </div>
            </div>
        </div>
        <div class="container">
            <p class="post-body">{{ $post->content }}</p>
            <div class="post-author">
                <p>{{ json_decode($post->meta)->author }} | {{ $post->published_at_date }}</p>
            </div>
        </div>
    </div>
@endsection
