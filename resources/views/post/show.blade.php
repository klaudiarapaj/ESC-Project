@extends('layouts.app')

@section('content')
<html>
<head>
  <!-- Other head elements -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-6hpLgmZRfJl5yPYZDc9+eZf/v1aAItji3ll+vy/WLlBsxVg3e7FHJBz+JJPO2+nQ27yc6N6oyJ6y2qqzL+qBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
<div class="container">
    <div class="row justify-content-center mb-3">
        <a href="{{ route('home') }}" class="btn btn-secondary btn-sm"><i class="fas fa-arrow-left"></i> Go back</a>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex align-items-center">
                    <img src="{{ asset($post->user->profile_picture) }}" alt="Avatar" class="mr-3 rounded-circle" width="50">
                    @if ($post->user->id == auth()->user()->id)
                    <h5 class="mb-0" style="margin-left: 0.5rem;"><a href="{{ route('profile.show', $post->user->name) }}">{{ $post->user->name }}</a></h5>
                    @else
                    <h5 class="mb-0" style="margin-left: 0.5rem;"><a href="{{ route('profile.show', $post->user->id) }}">{{ $post->user->name }}</a></h5>
                    @endif
                    <div class="text-muted mr-3" style="margin-left: auto;">{{ $post->created_at->diffForHumans() }}</div>
                </div>
                
                <div class="card-body">
                    <h2 class="card-title">{{ $post->title }}</h2>
                    <p class="card-text">{{ $post->content }}</p>
                </div>
                <div class="card-footer d-flex justify-content-between align-items-center">
                    <div>
                        @if (is_array($post->tags) || is_object($post->tags))
                        <ul class="list-inline mb-0">
                            @foreach ($post->tags as $tag)
                            <li class="list-inline-item">#{{ $tag }}</li>
                            @endforeach
                        </ul>
                        @endif
                    </div>
                    <div class="d-flex align-items-center">
                        <div class="text-muted mr-3">{{ $post->likes->count() }} {{ Str::plural('like', $post->likes->count()) }}</div>
                        @auth
                        @if (auth()->user()->likedPosts->contains($post))
                        <form action="{{ route('posts.unlike', $post) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-link text-danger"><i class="fas fa-heart"></i> Unlike</button>
                        </form>
                        @else
                        <form action="{{ route('posts.like', $post) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-link text-danger"><i class="far fa-heart"></i> Like</button>
                        </form>
                        @endif
                        @endauth
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
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
</style>