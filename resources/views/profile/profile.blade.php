@extends('layouts.app')

@section('content')

<!DOCTYPE html>
<html>

<head>

    <title>My Profile</title>

</head>

<body>
    <div class="container text-center">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header d-flex align-items-center">
                        @if(Auth::user()->profile_picture)
                        <img class="image rounded-circle" src="{{ asset('storage/images/'.Auth::user()->profile_picture) }}" alt="profile_image" style="width: 100px; height: 100px;  ">
                        @else
                        <img src="{{ asset('storage/pfp/default_pfp.png') }}" class="rounded-circle mr-3" width="100" height="100">
                        @endif

                        <h4 class="mb-0 mr-3">{{ $user->name }}</h4>
                        <div class="ml-auto">
                            <a href="{{ route('profile.edit') }}" class="btn btn-primary">Edit Profile</a>
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
                    <div class="card-header font-weight-bold">
                        Posts
                    </div>
                    <div class="card-body">
                        @if ($user->posts && $user->posts->count() > 0)
                        @foreach ($user->posts as $post)
                        <div class="card mb-3">
                            <div class="card-header">
                                <h5 class="card-title">{{ $post->title }}</h5>
                            </div>
                            <div class="card-body">
                                <p class="card-text">{{ $post->content }}</p>
                            </div>
                            <a href="{{ route('post.show', ['post' => $post]) }}" class="btn btn-primary">View Post</a>
                        </div>
                    </div>
                    @endforeach
                    @else
                    <p>No posts found.</p>
                    @endif
                </div>
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