@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ $forum->title }}</div>

                    <div class="card-body">
                        <p>{{ $forum->description }}</p>
                        <p>Members: {{ $forum->members_count }}</p>
                        <form action="{{ route('forums.join', $forum->name) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-primary">Join Forum</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

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

        <div class="row justify-content-center mt-3">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Latest Posts</div>
                    <div class="card-body">
                        @if ($forum->posts->count() > 0)
                            @foreach ($forum->posts->sortByDesc('created_at') as $post)
                                <div class="card mb-3">
                                    <div class="card-header">
                                        <h5 class="card-title">{{ $post->title }}</h5>
                                    </div>
                                    <div class="card-body">
                                        <p class="card-text">{{ $post->content }}</p>
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
@endsection
