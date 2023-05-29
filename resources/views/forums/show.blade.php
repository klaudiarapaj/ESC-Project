@extends('layouts.app')

@section('content')

<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" crossorigin="anonymous">
    <style>

    </style>
</head>
<body>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
            <div class="card-header">{{ $forum->name }}</div>
                <div class="card-body">
                    <p>{{ $forum->description }}</p>
                    <p>Members: {{ $forum->members()->count() }}</p>

                    @if (!$user->forums->contains($forum))
                    <form action="{{ route('forums.join', ['forum' => $forum->id]) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-primary">Join</button>
                    </form>
                    @else
                    <form action="{{ route('forums.leave', ['forum' => $forum->id]) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Leave</button>
                    </form>
                    @endif
                </div>
            </div>
        </div>
    </div>

    @if ($user->forums->contains($forum))
    <div class="row justify-content-center mt-3">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Create Post</div>
                <div class="card-body">
                    <form action="{{ route('post.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="post_title">Title</label>
                            <input type="text" class="form-control" id="post_title" name="title" required>
                        </div>
                        <div class="form-group">
                            <label for="post_content">Content</label>
                            <textarea class="form-control" id="post_content" name="content" rows="3" required></textarea>
                        </div>

                        <input type="hidden" name="forum_id" value="{{ $forum->id }}">
                        <button type="submit" class="btn btn-primary">Create Post</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endif

    <div class="row justify-content-center mt-3">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Latest Posts</div>
                <div class="card-body">
                    @if ($forum->posts->count() > 0)
                    @foreach ($forum->posts->sortByDesc('created_at') as $post)
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
                                        <h5 class="mb-0" style="margin-left:5px; margin-top:15px;">
                                            <a href="{{ route('user.profile', $post->user->name) }}">{{ $post->user->name }}</a>
                                        </h5>
                                    </div>
                                </div>
                                <p class="card-text" style="font-size: 20px; font-weight: bold; margin-bottom: 0px; text-align:none">
                                    {{ $post->title }}
                                </p>
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
                    @else
                    <p>No posts found.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
    </body>

    @endsection