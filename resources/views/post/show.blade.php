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
        <div class="row justify-content-center mb-3">
            <button onclick="goBack()" class="go-back-button"> Go Back</button>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header d-flex align-items-center">
                        @if(Auth::user()->profile_picture)
                        <img class="image rounded-circle" src="{{ asset('storage/images/'.$user->profile_picture) }}" alt="profile_image" style="width: 80px; height: 80px;  ">
                        @else
                        <img src="{{ asset('storage/pfp/default_pfp.png') }}" class="rounded-circle mr-3" width="80" height="80">
                        @endif

                        @if ($post->user->id == auth()->user()->id)
                        <h5 class="mb-0" style="margin-left: 0.5rem;"><a href="{{ route('profile.show', $post->user->name) }}">{{ $post->user->name }}</a></h5>
                        @else
                        <h5 class="mb-0" style="margin-left: 0.5rem;"><a href="{{ route('user.profile', $post->user->name) }}">{{ $post->user->name }}</a></h5>
                        @endif

                        @if ($post->forum_id)
                        <p class="mb-0" style="font-size: 12px; margin-left:5px;">
                            @php
                            $forum = Forum::find($post->forum_id);
                            @endphp
                            <a href="{{ route('forums.show', ['name' => $forum->name]) }}">Part of {{ $forum->name }} Forum</a>
                        </p>
                        @endif

                        <div class="text-muted mr-3" style="margin-left: auto; margin-right:10px">{{ $post->created_at->diffForHumans() }}</div>


                        <div class="dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre> </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <!-- Show "Report" option to non-authenticated user -->

                                @if (Auth::user()->id != $post->user->id)
                                <a class="dropdown-item" href="{{ route('post.report', ['post' => $post->id]) }}">Report</a>

                                <!-- Show "Delete" option to authenticated user -->
                                @elseif (Auth::user()->id == $post->user->id)
                                <a class="dropdown-item" href="{{ route('post.delete', ['post' => $post->id]) }}" onclick="event.preventDefault(); if (confirm('Are you sure you want to delete this post?')) { document.getElementById('delete-post-form').submit(); }">
                                    Delete
                                </a>
                                <form id="delete-post-form" action="{{ route('post.delete', ['post' => $post->id]) }}" method="POST" style="display: none;">
                                    @csrf
                                    @method('DELETE')
                                </form>

                                @endif
                            </div>
                        </div>


                    </div>

                    <div class="card-body">
                        <h2 class="card-title">{{ $post->title }}</h2>
                        <p class="card-text">{{ $post->content }}</p>
                    </div>
                    <div class="card-footer d-flex justify-content-between align-items-center" style="padding:0px 15px">

                        <div class="d-flex align-items-center">
                            <div class="text-muted mr-3">{{ $post->likes->count() }} {{ Str::plural('like', $post->likes->count()) }}</div>
                            @auth
                            @if (auth()->user()->likedPosts->contains($post))
                            <form action="{{ route('posts.unlike', $post) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-link text-danger" style="margin-top:13px"><i class="fas fa-heart"></i></button>
                            </form>
                            @else
                            <form action="{{ route('posts.like', $post) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-link text-danger" style="margin-top:13px"><i class="far fa-heart"></i></button>
                            </form>
                            @endif
                            @endauth
                            <button class="btn btn-link comment-toggle"><i class="far fa-comment"></i></button>
                            @auth
                            @if (auth()->user()->bookmarks->contains($post))
                            <form action="{{ route('posts.removeBookmark', ['post' => $post]) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-link" style="margin-top:15px"><i class="fas fa-bookmark"></i></button>
                            </form>
                            @else
                            <form action="{{ route('posts.bookmark', ['post' => $post]) }}" method="POST">
                                @csrf
                                @method('POST')
                                <button type="submit" class="btn btn-link" style="margin-top:15px"><i class="far fa-bookmark"></i></button>
                            </form>
                            @endif
                            @endauth

                        </div>

                    </div>

                    <div class="comment-input" style="margin-left: 15px; display: none;">
                        <form action="{{ route('comments.create', $post->id) }}" method="POST">
                            @csrf
                            <textarea class="form-control" name="content" placeholder="Write a comment"></textarea>
                            <button type="submit" class="btn btn-primary mt-2">Reply</button>
                        </form>
                    </div>


                    @if ($post->comments->count() > 0)
                    <div class="comments-section" style="margin-left:15px">
                        <h3>Comments</h3>
                        @foreach ($post->comments as $comment)
                        <div class="comment">
                            <div class="comment-user">
                                @if ($comment->user->profile_picture)
                                <img class="profile-picture" src="{{ asset('storage/images/'.$comment->user->profile_picture) }}" alt="profile_image">
                                @else
                                <img class="profile-picture" src="{{ asset('storage/pfp/default_pfp.png') }}" alt="default_profile_image">
                                @endif
                                @if ($comment->user->id == auth()->user()->id)
                                <a class="comment-author" href="{{ route('profile.show', $comment->user->name) }}">{{ $comment->user->name }}</a>
                                @else
                                <a class="comment-author" href="{{ route('user.profile', $comment->user->name) }}">{{ $comment->user->name }}</a>
                                @endif
                            </div>
                            <p class="comment-content" style="margin-left:10px; margin-top:5px;">{{ $comment->content }}</p>
                        </div>
                        @endforeach
                    </div>
                    @endif


                </div>

            </div>
        </div>
    </div>




    <script type="text/javascript" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.10.2/umd/popper.min.js"></script>


    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

    <script>
        function goBack() {
            history.go(-1);
        }


        $(document).ready(function() {
            $('.comment-toggle').click(function() {
                $('.comment-input').toggle();
            });
        });
    </script>

</body>
@endsection

<style>
    .card-header img {
        object-fit: cover;
    }

    .card-header h5 {
        font-size: 1.2rem;
        font-weight: bold;
        margin-bottom: 0;
    }

    .card-body h2 {
        font-size: 1.5rem;
        font-weight: bold;
        margin-bottom: 0.5rem;
    }

    .card-footer ul li {
        font-size: 0.9rem;
        margin-right: 0.5rem;
    }

    .go-back-button {
        background-color: #d1e0ee;
        border: none;
        padding: 10px 20px;
        cursor: pointer;
        font-size: 16px;
        position: relative;
    }

    .go-back-button::before {
        content: "";
        position: absolute;
        top: 50%;
        left: 10px;
        transform: translateY(-50%);
        width: 0;
        height: 0;
        border-top: 6px solid transparent;
        border-bottom: 6px solid transparent;
        border-right: 6px solid #333;
    }

    .go-back-button:hover {
        background-color: #245697;
    }

    .go-back-button:hover::before {
        border-right-color: #555;
    }

    .comments-section {
        margin-top: 10px;
    }

    .comments-section h3 {
        font-size: 18px;
        font-weight: bold;
        margin-bottom: 10px;
    }

    .comment {
        margin-bottom: 15px;
        display: flex;
        align-items: flex-start;
    }

    .profile-picture {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        margin-right: 10px;
    }

    .comment .comment-user {
        display: flex;
        align-items: center;
    }

    .comment .comment-author {
        font-size: 14px;
        font-weight: bold;
        color: #657786;
        margin-bottom: 5px;
    }

    .comment .comment-content {
        margin-bottom: 5px;
    }
</style>