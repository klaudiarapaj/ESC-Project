@extends('layouts.app')

@section('content')

@php
use App\Models\Forum;
@endphp

<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <form method="POST" action="{{ route('post.create') }}">
                            @csrf

                            <div class="form-group row">
                                <label for="title" class="col-md-4 col-form-label text-md-right">{{ __('Title') }}</label>

                                <div class="col-md-6">
                                    <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" required autocomplete="title" autofocus>

                                    @error('title')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="content" class="col-md-4 col-form-label text-md-right">{{ __('Content') }}</label>

                                <div class="col-md-6">
                                    <textarea id="content" style="margin-top:10px" class="form-control @error('content') is-invalid @enderror" name="content" required autocomplete="content"></textarea>

                                    @error('content')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary" style="margin-top:20px">
                                        {{ __('Create Post') }}
                                    </button>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="container" style="margin-top:20px;">
        <div class="row justify-content-center">
            <div class="col-md-8">
                @foreach($feed as $post)
                <a href="{{ route('post.show', ['post' => $post]) }}" class="text-decoration-none">
                    <div class="card mb-3">
                        <div class="card-body">
                            <div class="d-flex align-items-start">
                                @if($post->user->profile_picture)
                                <img class="image rounded-circle" src="{{ asset('storage/images/'.$post->user->profile_picture) }}" alt="profile_image" style="width: 50px; height: 50px;">
                                @else
                                <img src="{{ asset('storage/pfp/default_pfp.png') }}" class="rounded-circle mr-3" width="50" height="50">
                                @endif
                                <div>
                                    @if ($post->user->id == auth()->user()->id)
                                    <h5 class="mb-0" style="margin-left:5px; margin-top:15px;"><a href="{{ route('profile.show', $post->user->name) }}">{{ $post->user->name }}</a></h5>
                                    @else
                                    <h5 class="mb-0" style="margin-left:5px; margin-top:15px;"><a href="{{ route('user.profile', $post->user->name) }}">{{ $post->user->name }}</a></h5>
                                    @endif
                                    @if ($post->forum_id)
                                    <p class="mb-0" style="font-size: 12px; margin-left:5px;">
                                        @php
                                        $forum = Forum::find($post->forum_id);
                                        @endphp
                                        <a href="{{ route('forums.show', ['name' => $forum->name]) }}"> Part of {{ $forum->name }} Forum </a>
                                    </p>
                                    @endif
                                </div>
                            </div>
                            <p class="card-text" style="font-size: 20px; font-weight: bold; margin-bottom: 0px; text-align:none">{{ $post->title }}</p>

                            <div class="d-flex align-items-center">
                                <div class="text-muted mr-3">{{ $post->likes->count() }} {{ Str::plural('like', $post->likes->count()) }}</div>
                                @auth
                                @if (auth()->user()->likedPosts->contains($post))
                                <form action="{{ route('posts.unlike', $post) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-link text-danger"><i class="fas fa-heart"></i></button>
                                </form>
                                @else
                                <form action="{{ route('posts.like', $post) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-link text-danger"><i class="far fa-heart" style="margin-bottom:0px"></i></button>
                                </form>
                                @endif
                                @endauth
                                <button class="btn btn-link"><i class="far fa-comment"></i></button>
                                @auth
                                @if (auth()->user()->bookmarks->contains($post))
                                <form action="{{ route('posts.removeBookmark', ['post' => $post]) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-link"><i class="fas fa-bookmark"></i></button>
                                </form>
                                @else
                                <form action="{{ route('posts.bookmark', ['post' => $post]) }}" method="POST">
                                    @csrf
                                    @method('POST')
                                    <button type="submit" class="btn btn-link"><i class="far fa-bookmark"></i></button>
                                </form>
                                @endif
                                @endauth
                            </div>
                        </div>
                        <div class="card-footer d-flex justify-content-between align-items-center">
                            <a href="{{ route('post.show', ['post' => $post]) }}" class="btn btn-primary btn-sm">View</a>
                        </div>

                    </div>
                </a>
                @endforeach
            </div>
        </div>
    </div>

</body>
@endsection