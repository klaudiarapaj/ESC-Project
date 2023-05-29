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
                    <div class="card-header">{{ __('Feedback Details') }}</div>

                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>ID</th>
                                    <th>Subject</th>
                                    <th>Message</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $feedbackCount = ($feedbacks->currentPage() - 1) * $feedbacks->perPage(); // Calculate the feedback count based on the current page
                                @endphp

                                @foreach ($feedbacks as $feedback)
                                    <tr>
                                        <td>{{ ++$feedbackCount }}</td>
                                        <td>{{ $feedback->id }}</td>
                                        <td>{{ $feedback->subject }}</td>
                                        <td>{{ $feedback->message }}</td>
                                        <td>
                                            <form action="{{ route('feedback.delete', $feedback->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">Read</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <!-- Display pagination links -->
                        <div class="mt-4">
                            {{ $feedbacks->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
@endsection


