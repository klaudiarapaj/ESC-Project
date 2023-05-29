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
                    <div class="card-header">Notifications</div>

                    <div class="card-body">
                        @if ($notifications->isEmpty())
                            <p>No notifications found.</p>
                        @else
                            <ul class="list-group">
                                @foreach ($notifications as $notification)
                                    <li class="list-group-item{{ $notification->read_at ? '' : ' font-weight-bold' }}">
                                        <a href="{{ $notification->url }}">{{ $notification->message }}</a>
                                        <span class="float-right" >{{ $notification->created_at->diffForHumans() }}</span>
                                    </li>
                                @endforeach
                            </ul>

                            {{ $notifications->links() }}
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    </body>
    </html>
@endsection
