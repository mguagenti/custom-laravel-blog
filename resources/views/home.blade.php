@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in!

                    <a class="btn-light" href="/admin/draft">New post</a>

                    <hr />

                    @foreach($posts as $post)
                        <h3>{{ $post->meta['title'] }}</h3>
                        <a class="btn-light" href="/admin/draft">Edit</a>
                        <a class="btn-light" href="/admin/trash/{{ $post->slug }}">Trash</a>
                        <hr />
                    @endforeach

                    {{ $posts->render() }}

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
