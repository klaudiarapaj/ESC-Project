@extends('layouts.app')

@section('content')

<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" crossorigin="anonymous">
    <style>
        /* Add custom styling here */
        .search-results {
            margin-bottom: 20px;
        }

        .search-results h3 {
            font-size: 1.2rem;
            margin-bottom: 10px;
        }

        .search-results .card {
            margin-bottom: 10px;
        }

        .search-results .card-body {
            padding: 10px;
        }

        .search-results .card-title {
            margin-bottom: 5px;
        }

        .search-results .card-text {
            margin-bottom: 5px;
        }

        .search-results .card-link {
            text-decoration: none;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="search-results">
                    <h2>Search Results</h2>

                    @if ($users->isNotEmpty())
                        <h3 style="margin-top:10px;">Users</h3>
                        @foreach ($users as $user)
                            @if ($user->id === Auth::user()->id)
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title"><a href="{{ route('profile') }}">{{ $user->name }}</a></h5>
                                    </div>
                                </div>
                            @else
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title"><a href="{{ route('user.profile', ['user' => $user->name]) }}">{{ $user->name }}</a></h5>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    @endif

                    @if ($forums->isNotEmpty())
                        <h4 style="margin-top:10px;">Forums</h4>
                        @foreach ($forums as $forum)
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title"><a href="{{ route('forums.show', $forum->name) }}">{{ $forum->name }}</a></h5>
                                </div>
                            </div>
                        @endforeach
                    @endif

                    @if ($posts->isNotEmpty())
                        <h4 style="margin-top:10px;">Posts</h4>
                        @foreach ($posts as $post)
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $post->title }}</h5>
                                    <a href="{{ route('post.show', ['post' => $post->id]) }}" class="card-link">View More</a>
                                </div>
                            </div>
                        @endforeach
                    @endif

                    @if ($users->isEmpty() && $forums->isEmpty() && $posts->isEmpty())
                        <h4>No results</h4>
                    @endif
                </div>
            </div>
        </div>
    </div>
</body>

@endsection


