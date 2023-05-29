@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('Reported Posts') }}</div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Title</th>
                                    <th scope="col">Content</th>
                                    <th scope="col">Reports</th>
                                    <th scope="col">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $postCount = 0; // Initialize post count
                                    $uniquePosts = $posts->unique('post_id'); // Remove duplicate posts
                                @endphp
                                @foreach($uniquePosts as $post)
                                    <tr>
                                        <th scope="row">{{ ++$postCount }}</th>
                                        <td><a href="{{ route('post.show', $post->post->id) }}">{{ $post->post->title }}</a></td>
                                        <td>{{ $post->post->content }}</td>
                                        <td>{{ $post->post->reports->count() }}</td>
                                        <td>
                                            <form action="{{ route('posts.delete', $post->post->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" name="action" value="delete" class="btn btn-danger">Delete</button>
                                            </form>
                                            <form action="{{ route('report.clear', $post->post->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" name="action" value="clear" class="btn btn-secondary">Ignore</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <!-- Display pagination links -->
                        <div class="row justify-content-center mt-4">
                            <div class="col-md-12">
                                {{ $posts->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


