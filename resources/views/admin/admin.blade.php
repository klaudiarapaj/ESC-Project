@extends('layouts.app')

@section('content')

<head>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" crossorigin="anonymous">
</head>
<body>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Admin Panel</div>

                <div class="card-body">
                    <div class="list-group">
                        <a href="{{route ('admin.forums') }}" class="list-group-item list-group-item-action">Forums</a>
                        <a href="{{route ('admin.users') }}" class="list-group-item list-group-item-action">Users</a>
                        <a href="{{route ('admin.posts') }}" class="list-group-item list-group-item-action">Posts</a>
                        <a href="{{route ('admin.feedbacks') }}" class="list-group-item list-group-item-action">Feedback</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
@endsection
