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
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $postCount = ($posts->currentPage() - 1) * $posts->perPage();
                        @endphp
                        @foreach ($posts as $post)
                        @if ($post->reports >= 5)
                        <tr>
                            <th scope="row">{{ ++$postCount }}</th> <!-- Display post number -->
                            <td><a href="{{ route('posts.show', $post->id) }}">{{ $post->title }}</a></td>
                            <td>{{ $post->content }}</td>
                            <td>
                                <form action="{{ route('posts.delete', $post->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" name="action" value="delete" class="btn btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                        @endif
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