@extends('layouts.app')

@section('content')
<html>

<head>
    <!-- Other head elements -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.10.2/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <style>
        /* Modal styling */
        .modal {
            display: none;
            /* Hide the modal by default */
            position: fixed;
            /* Stay in place */
            z-index: 1;
            /* Sit on top */
            padding-top: 100px;
            /* Location of the modal */
            left: 0;
            top: 0;
            width: 100%;
            /* Full width */
            height: 100%;
            /* Full height */
            overflow: auto;
            /* Enable scroll if needed */
            background-color: rgb(0, 0, 0);
            /* Fallback color */
            background-color: rgba(0, 0, 0, 0.4);
            /* Black w/ opacity */
        }

        .modal-content {
            background-color: #fefefe;
            margin: auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
            max-width: 400px;
        }

        .modal-close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
            cursor: pointer;
        }

        .modal-close:hover,
        .modal-close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }

        .card-header img {
            object-fit: cover;
        }

        .card-header h5 {
            font-size: 1.2rem;
            font-weight: bold;
            margin-bottom: 0;
        }

        .card-body h2 {
            font-size: 1.5rem;
            font-weight: bold;
            margin-bottom: 0.5rem;
        }

        .card-footer ul li {
            font-size: 0.9rem;
            margin-right: 0.5rem;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="row justify-content-center mb-3">
            <a href="{{ route('home') }}" class="btn btn-secondary btn-sm"><i class="fas fa-arrow-left"></i> Go back</a>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header d-flex align-items-center">
                        @if(Auth::user()->profile_picture)
                        <img class="image rounded-circle" src="{{ asset('storage/images/'.Auth::user()->profile_picture) }}" alt="profile_image" style="width: 80px; height: 80px;  ">
                        @else
                        <img src="{{ asset('storage/pfp/default_pfp.png') }}" class="rounded-circle mr-3" width="80" height="80">
                        @endif

                        @if ($post->user->id == auth()->user()->id)
                        <h5 class="mb-0" style="margin-left: 0.5rem;"><a href="{{ route('profile.show', $post->user->name) }}">{{ $post->user->name }}</a></h5>
                        @else
                        <h5 class="mb-0" style="margin-left: 0.5rem;"><a href="{{ route('profile.show', $post->user->id) }}">{{ $post->user->name }}</a></h5>
                        @endif
                        <div class="text-muted mr-3" style="margin-left: auto;">{{ $post->created_at->diffForHumans() }}</div>
                        <div class="dropdown">
                            <button class="btn btn-link dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

                            </button>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="#" onclick="showReportModal()">Report</a>
                            </div>
                        </div>

                    </div>

                    <div class="card-body">
                        <h2 class="card-title">{{ $post->title }}</h2>
                        <p class="card-text">{{ $post->content }}</p>
                    </div>
                    <div class="card-footer d-flex justify-content-between align-items-center">

                        <div class="d-flex align-items-center">
                            <div class="text-muted mr-3">{{ $post->likes->count() }} {{ Str::plural('like', $post->likes->count()) }}</div>
                            @auth
                            @if (auth()->user()->likedPosts->contains($post))
                            <form action="{{ route('posts.unlike', $post) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-link text-danger"><i class="fas fa-heart"></i> Unlike</button>
                            </form>
                            @else
                            <form action="{{ route('posts.like', $post) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-link text-danger"><i class="far fa-heart"></i> Like</button>
                            </form>
                            @endif
                            @endauth
                            <button class="btn btn-link"><i class="far fa-comment"></i> Comment</button>
                            <button class="btn btn-link"><i class="far fa-bookmark"></i> Bookmark</button>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal HTML -->
    <div id="reportModal" class="modal">
        <div class="modal-content">
            <span class="modal-close" onclick="hideReportModal()">&times;</span>
            <h3>Report Post</h3>
            <p>Please select the reason for reporting this post:</p>
            <ul>
                <li>Spam</li>
                <li>Inappropriate content</li>
                <li>Harassment</li>
                <li>False information</li>
                <li>Other</li>
            </ul>
            <button class="btn btn-primary" onclick="submitReport()">Submit</button>
        </div>
    </div>

    <script>
        // Show the report modal
        function showReportModal() {
            var modal = document.getElementById("reportModal");
            modal.style.display = "block";
        }

        // Hide the report modal
        function hideReportModal() {
            var modal = document.getElementById("reportModal");
            modal.style.display = "none";
        }

        // Handle report submission
        function submitReport() {
            // Perform the necessary actions to submit the report
            // You can make an AJAX request here to handle the reporting functionality
            hideReportModal();
        }
    </script>
</body>

</html>
@endsection