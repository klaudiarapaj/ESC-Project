@extends('layouts.app')

@section('content')
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
                        <a href="#" class="list-group-item list-group-item-action">Feedback</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
