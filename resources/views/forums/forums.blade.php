@extends('layouts.app')

@section('content')
<head>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" crossorigin="anonymous">
</head>
<body>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Forums') }}</div>

                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Name</th>
                                <th scope="col">Description</th>
                                <th scope="col">Edit</th>
                                <th scope="col">Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                            $forumCount = ($forums->currentPage() - 1) * $forums->perPage();
                            @endphp
                            @foreach ($forums as $forum)
                            <tr>
                                <th scope="row">{{ ++$forumCount }}</th> 
                                <td>{{ $forum->name }}</td>
                                <td>{{ $forum->description }}</td>
                                <td><a href="{{ route('forums.edit', $forum->id) }}">Edit</a></td>
                                <td>
                                    <form action="{{ route('forums.delete', $forum->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-link">Delete</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="row justify-content-center">
                        <div class="col-md-12 text-center">
                            <a href="{{ route('forums.create') }}" class="btn btn-primary btn-lg active" role="button" aria-pressed="true">Add new forum</a>
                        </div>
                    </div>


                    <!-- Display pagination links -->
                    <div class="row justify-content-center mt-4">
                        <div class="col-md-12">
                            {{ $forums->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
@endsection