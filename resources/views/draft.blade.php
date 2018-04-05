@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Draft post</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif
                        {!! Form::open(['url' => '/admin/draft/']) !!}

                            {!! Form::label('title', 'Post title'); !!}
                            {!! Form::text('title', null, ['class' => 'form-control']); !!}

                            {!! Form::label('slug', 'Post slug'); !!}
                            {!! Form::text('slug', null, ['class' => 'form-control']); !!}

                            {!! Form::label('post_date', 'Post date'); !!}
                            {!! Form::text('post_date', null, ['class' => 'form-control']); !!}

                            {!! Form::label('description', 'Post meta description'); !!}
                            {!! Form::text('description', null, ['class' => 'form-control']); !!}

                            {!! Form::label('content', 'Post body'); !!}
                            {!! Form::textarea('content', null, ['class' => 'form-control']); !!}

                            {!! Form::submit('Submit', ['class' => 'btn btn-lg btn-success form-control']) !!}

                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
