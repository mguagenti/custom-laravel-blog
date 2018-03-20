@extends('layouts.blog', [
    'title'             => $post->meta['title'],
    'meta_description'  => $post->meta['description'],
    'author'            => $post->meta['author']
])

@section('content')
    <div class="post">
        <div class="post-hero">
            <div class="container">
                <div class="post-hero-inner">
                    <h1 class="post-title">{{ $post->meta['title'] }}</h1>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="post-body">{!! $post->content !!}</div>
        </div>
        <div class="post-author">
            <p>{{ $post->meta['author'] }} | {{ $post->published_at_date }}</p>
        </div>
    </div>
@endsection
