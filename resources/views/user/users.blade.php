@extends('layouts.app')

@section('content')

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
                                <th scope="col">Delete</th>
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
                                <td>
                                    <form action="{{ route('users.delete', $user->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-link">Delete</button>
                                    </form>
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
@endsection