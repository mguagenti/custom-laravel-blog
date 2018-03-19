@extends('layouts.blog', [
    'title'             => 'Home',
    'author'            => null,
    'meta_description'  => 'An awesome blog.'

])

@section('content')
    <div class="post-hero">
        <div class="container">
            <div class="post-hero-inner">
                <h1 class="post-title">Welcome to... Awesome Blog!</h1>
            </div>
        </div>
    </div>
    <div class="container">
        @foreach($posts as $post)
            <div class="post-single">
                <h2>{{ json_decode($post->meta)->title }}</h2>
                <p class="publish-date">{{ $post->published_at_date }}</p>
                <p class="excerpt">{{ substr(strip_tags($post->content), 0, 460) . '...' }}</p>
                <a href="/post/{{ $post->slug }}" class="link">Read more</a>
            </div>
        @endforeach
    </div>
@endsection