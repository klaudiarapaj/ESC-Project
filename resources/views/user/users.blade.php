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
                <div class="card-header">{{ __('Users') }}</div>

                <div class="card-body">

                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">User ID</th>
                                <th scope="col">User Name</th>
                                <th scope="col">User Email</th>
                                <th scope="col">Role</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>

                        <tbody>
                            @php
                            $userCount = ($users->currentPage() - 1) * $users->perPage();
                            @endphp
                            @foreach ($users as $user)
                            <tr>
                                <th scope="row">{{ ++$userCount }}</th> <!-- Display user number -->
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->role }}</td>
                                <td>
                                    @if ($user->role == 'user')
                                        <form action="{{ route('users.updateRole', $user->id) }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="role" value="admin">
                                            <button type="submit" class="btn btn-link">Add Admin Role</button>
                                        </form>
                                    @elseif ($user->role == 'admin')
                                        <form action="{{ route('users.updateRole', $user->id) }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="role" value="user">
                                            <button type="submit" class="btn btn-link">Remove Admin Role</button>
                                        </form>
                                    @endif

                                    @if ($user->role != 'admin')
                                        <form action="{{ route('users.delete', $user->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-link">Delete</button>
                                        </form>
                                    @else
                                        <span class="text-muted">Cannot delete admin user</span>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <div class="row justify-content-center mt-4">
                        <div class="col-md-12">
                            {{ $users->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
@endsection


