@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <h1>Bookmarked Posts</h1>

            @foreach ($posts as $post)
            <div class="post" style="margin-top:10px">
                <!-- Display post details with user name -->
                <div class="d-flex justify-content-between align-items-center">
                    <h4><a href="{{ route('post.show', ['post' => $post]) }}">{{ $post->title }}</a></h4>
                    <p>Posted by: {{ $post->user->name }}</p>
                </div>

                <div class="text-right">
                    <!-- Bookmark button or link -->
                    @if (auth()->check() && auth()->user()->bookmarks->contains($post))
                    <form action="{{ route('posts.removeBookmark', ['post' => $post]) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Remove Bookmark</button>
                    </form>
                    @else
                    <form action="{{ route('posts.bookmark', ['post' => $post]) }}" method="POST">
                        @csrf
                        @method('POST')
                        <button type="submit" class="btn btn-primary">Bookmark</button>
                    </form>
                    @endif
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>

@endsection