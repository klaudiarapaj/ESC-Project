@extends('layouts.app')

@section('content')
@php
use App\Models\Forum;
@endphp

<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" crossorigin="anonymous">

    <title>User Profile</title>
</head>

<body>
    <div class="container text-center">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header d-flex align-items-center">
                        @if($user->profile_picture)
                        <img class="image rounded-circle" src="{{ asset('storage/images/'.$user->profile_picture) }}" alt="profile_image" style="width: 100px; height: 100px;">
                        @else
                        <img src="{{ asset('storage/pfp/default_pfp.png') }}" class="rounded-circle mr-3" width="100" height="100">
                        @endif
                        <h4 class="mb-0 mr-3">{{ $user->name }}</h4>
                        <div class="ml-auto">
                            @if (auth()->user()->isFollowing($user->id))
                            <form action="{{ route('unfollow', $user) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-primary">Unfollow</button>
                            </form>
                            @else
                            <form action="{{ route('follow', $user) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-primary">Follow</button>
                            </form>
                            @endif

                        </div>
                    </div>
                    @if ($user->bio)
                    <div class="row">
                        <div class="col-md-4 font-weight-bold">Bio</div>
                        <div class="col-md-8">{{ $user->bio }}</div>
                    </div>
                    @endif
                    @if ($user->interests)
                    <div class="row">
                        <div class="col-md-4 font-weight-bold">Interests</div>
                        <div class="col-md-8">{{ $user->interests }}</div>
                    </div>
                    @endif
                    @if ($user->department)
                    <div class="row">
                        <div class="col-md-4 font-weight-bold">Department</div>
                        <div class="col-md-8">{{ $user->department }}</div>
                    </div>
                    @endif
                    @if ($user->major)
                    <div class="row">
                        <div class="col-md-4 font-weight-bold">Major</div>
                        <div class="col-md-8">{{ $user->major }}</div>
                    </div>
                    @endif
                </div>
            </div>
        </div>


        <div class="row justify-content-center mt-3">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Latest Posts</div>
                    <div class="card-body">
                    @if ($feed && $feed->count() > 0)
    @foreach($feed as $post)
        <a href="{{ route('post.show', ['post' => $post]) }}" class="text-decoration-none">
            <div class="card mb-3">
                <div class="card-body">
                    <div class="d-flex align-items-start">
                        @if(Auth::user()->profile_picture)
                            <img class="image rounded-circle mr-3" src="{{ asset('storage/images/'.$user->profile_picture) }}" alt="profile_image" style="width: 50px; height: 50px;">
                        @else
                            <img src="{{ asset('storage/pfp/default_pfp.png') }}" class="rounded-circle mr-3" width="50" height="50">
                        @endif
                        <div>
                            @if ($post->user->id == auth()->user()->id)
                                <h5 class="mb-0" style="margin-top: 15px; margin-left: 10px;">
                                    <a href="{{ route('profile.show', Auth::user()) }}">{{ $post->user->name }}</a>
                                </h5>
                            @else
                                <h5 class="mb-0" style="margin-top:15px; margin-left:5px; font-size: 15px; text-align:start">
                                    <a href="{{ route('user.profile', $post->user->name) }}">{{ $post->user->name }}</a>
                                </h5>
                            @endif
                            @if ($post->forum_id)
                                <p class="mb-0" style="font-size: 12px; margin-left:5px;">
                                    @php
                                    $forum = Forum::find($post->forum_id);
                                    @endphp
                                    <a href="{{ route('forums.show', ['name' => $forum->name]) }}">Part of {{ $forum->name }} Forum</a>
                                </p>
                            @endif
                        </div>
                    </div>
                                    <p class="card-text" style="font-size: 20px; font-weight: bold; margin-bottom: 0px; text-align:start">{{ $post->title }}</p>
                                    <div class="d-flex align-items-center">
                                        <div class="text-muted mr-3">{{ $post->likes->count() }} {{ Str::plural('like', $post->likes->count()) }}</div>
                                        @auth
                                        @if (auth()->user()->likedPosts->contains($post))
                                        <form action="{{ route('posts.unlike', $post) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-link text-danger"><i class="fas fa-heart" style="margin-bottom:-20px"></i></button>
                                        </form>
                                        @else
                                        <form action="{{ route('posts.like', $post) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="btn btn-link text-danger"><i class="far fa-heart" style="margin-bottom:-20px"></i></button>
                                        </form>
                                        @endif
                                        @endauth
                                        <button class="btn btn-link"><i class="far fa-comment"></i></button>
                                        @auth
                                        @if (auth()->user()->bookmarks->contains($post))
                                        <form action="{{ route('posts.removeBookmark', ['post' => $post]) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-link"><i class="fas fa-bookmark" style="margin-bottom:-20px"></i></button>
                                        </form>
                                        @else
                                        <form action="{{ route('posts.bookmark', ['post' => $post]) }}" method="POST">
                                            @csrf
                                            @method('POST')
                                            <button type="submit" class="btn btn-link"><i class="far fa-bookmark" style="margin-bottom:-20px"></i></button>
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

</html>
@endsection
<style>
    .card-header {
        border-bottom: 1px solid #e6ecf0;
    }

    .card-body {
        padding: 15px;
    }

    .card-body>.row {
        margin-bottom: 10px;
    }

    .card-body .font-weight-bold {
        font-weight: bold;
    }

    .card-body .btn-primary {
        background-color: #1da1f2;
        border-color: #1da1f2;
    }

    .card-body .btn-primary:hover {
        background-color: #0c8bff;
        border-color: #0c8bff;
    }

    .card-body .btn-primary:focus {
        box-shadow: none;
    }

    /* increase profile picture size */
    .card-header img {
        width: 100px;
        height: 100px;
    }

    /* move edit profile button to right */
    .card-header .ml-auto {
        margin-left: auto;
    }

    .card-header img {
        margin-right: 20px;
    }

    .card.mt-3 {
        margin-top: 0;
    }

    .card-body>.card {
        margin-bottom: 10px;
    }

    .card.mb-3:hover {
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
        transition: box-shadow 0.3s ease-in-out;
    }

    .card-header .ml-auto .btn-primary {
        padding: 5px 15px;
        background-color: #1da1f2;
        border-color: #1da1f2;
    }

    .card-header .ml-auto .btn-primary:hover {
        background-color: #0c8bff;
        border-color: #0c8bff;
    }

    .card-header .ml-auto .btn-primary:focus {
        box-shadow: none;
    }
</style>