<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Raleway', sans-serif;
                font-weight: 100;
                margin: 0px auto;
                width: 80%;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: left;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 12px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .link {
                text-transform: uppercase;
                text-decoration: none;
                font-weight: 600;
                color: #005cbf;
            }

            .link:after {
                content: ' →';
            }

            .post-title {
                margin-top: 35px;
            }

            .publish-date {
                font-size: 12px;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>
                        <a href="{{ route('register') }}">Register</a>
                    @endauth
                </div>
            @endif

            <div class="content">
                <h1 class="title">Awesome blog.</h1>
                @foreach($posts as $post)
                    <span>
                        <h2 class="post-title">{{ json_decode($post->meta)->title }}</h2>
                        <p class="publish-date">{{ $post->published_at_date }}</p>
                    </span>
                    <p>{{ $post->content }}</p>
                    <a href="/post/{{ $post->slug }}" class="link">Read more</a>
                @endforeach
            </div>
        </div>
    </body>
</html>
