@extends('layouts.app')

@section('content')

<head>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" crossorigin="anonymous">
</head>
<body>
    
<h2>Search Results</h2>

@if ($users->isNotEmpty())
    <h3>Users</h3>
    <ul>
        @foreach ($users as $user)
        @if ($user->id === Auth::user()->id)
                <li><a href="{{ route('profile') }}">{{ $user->name }}</a></li>
            @else
                <li><a href="{{ route('user.profile', ['user' => $user->name]) }}">{{ $user->name }}</a></li>
            @endif
        @endforeach
    </ul>
@endif

@if ($forums->isNotEmpty())
    <h3>Forums</h3>
    <ul>
        @foreach ($forums as $forum)
            <li><a href="{{ route('forums.show', $forum->name) }}">{{ $forum->name }}</a></li>
        @endforeach
    </ul>
@endif

@if ($posts->isNotEmpty())
    <h3>Posts</h3>
    <ul>
        @foreach ($posts as $post)
            <li>
                <h4>{{ $post->title }}</h4>
                <p>{{ Str::limit($post->content, 100) }}</p>
                <a href="{{ route('post.show', ['post' => $post->id]) }}">Read More</a>
            </li>
        @endforeach
    </ul>
@endif




@if ($users->isEmpty() && $forums->isEmpty() && $posts->isEmpty())
    <p>No results</p>
@endif

</body>
@endsection
