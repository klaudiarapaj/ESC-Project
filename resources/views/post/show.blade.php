@extends('layouts.app')

@section('content')
<html>

<head>
    <!-- Other head elements -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.10.2/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.min.js"></script>
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

        .go-back-button {
            background-color: #d1e0ee;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            font-size: 16px;
            position: relative;
        }

        .go-back-button::before {
            content: "";
            position: absolute;
            top: 50%;
            left: 10px;
            transform: translateY(-50%);
            width: 0;
            height: 0;
            border-top: 6px solid transparent;
            border-bottom: 6px solid transparent;
            border-right: 6px solid #333;
        }

        .go-back-button:hover {
            background-color: #245697;
        }

        .go-back-button:hover::before {
            border-right-color: #555;
        }

        .comments-section {
            margin-top: 10px;
        }

        .comments-section h3 {
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .comment {
            margin-bottom: 15px;
            display: flex;
            align-items: flex-start;
        }

        .profile-picture {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            margin-right: 10px;
        }

        .comment .comment-user {
            display: flex;
            align-items: center;
        }

        .comment .comment-author {
            font-size: 14px;
            font-weight: bold;
            color: #657786;
            margin-bottom: 5px;
        }

        .comment .comment-content {
            margin-bottom: 5px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="row justify-content-center mb-3">
            <button onclick="goBack()" class="go-back-button"> Go Back</button>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header d-flex align-items-center">
                        @if(Auth::user()->profile_picture)
                        <img class="image rounded-circle" src="{{ asset('storage/images/'.$user->profile_picture) }}" alt="profile_image" style="width: 80px; height: 80px;  ">
                        @else
                        <img src="{{ asset('storage/pfp/default_pfp.png') }}" class="rounded-circle mr-3" width="80" height="80">
                        @endif

                        @if ($post->user->id == auth()->user()->id)
                        <h5 class="mb-0" style="margin-left: 0.5rem;"><a href="{{ route('profile.show', $post->user->name) }}">{{ $post->user->name }}</a></h5>
                        @else
                        <h5 class="mb-0" style="margin-left: 0.5rem;"><a href="{{ route('user.profile', $post->user->name) }}">{{ $post->user->name }}</a></h5>
                        @endif
                        <div class="text-muted mr-3" style="margin-left: auto;">{{ $post->created_at->diffForHumans() }}</div>
                        <div class="dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre> </a>
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
                                <button type="submit" class="btn btn-link text-danger"><i class="fas fa-heart"></i></button>
                            </form>
                            @else
                            <form action="{{ route('posts.like', $post) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-link text-danger"><i class="far fa-heart"></i></button>
                            </form>
                            @endif
                            @endauth
                            <button class="btn btn-link comment-toggle"><i class="far fa-comment"></i></button>
                            @auth
                            @if (auth()->user()->bookmarks->contains($post))
                            <form action="{{ route('posts.removeBookmark', ['post' => $post]) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-link"><i class="fas fa-bookmark"></i></button>
                            </form>
                            @else
                            <form action="{{ route('posts.bookmark', ['post' => $post]) }}" method="POST">
                                @csrf
                                @method('POST')
                                <button type="submit" class="btn btn-link"><i class="far fa-bookmark"></i></button>
                            </form>
                            @endif
                            @endauth

                        </div>


                    </div>

                    <div class="comment-input" style="margin-left: 15px; display: none;">
    <form action="{{ route('comments.create', $post->id) }}" method="POST">
        @csrf
        <textarea class="form-control" name="content" placeholder="Write a comment"></textarea>
        <button type="submit" class="btn btn-primary mt-2">Reply</button>
    </form>
</div>


                    @if ($post->comments->count() > 0)
                    <div class="comments-section" style="margin-left:15px">
                        <h3>Comments</h3>
                        @foreach ($post->comments as $comment)
                        <div class="comment">
                            <div class="comment-user">
                                @if ($comment->user->profile_picture)
                                <img class="profile-picture" src="{{ asset('storage/images/'.$comment->user->profile_picture) }}" alt="profile_image">
                                @else
                                <img class="profile-picture" src="{{ asset('storage/pfp/default_pfp.png') }}" alt="default_profile_image">
                                @endif
                                @if ($post->user->id == auth()->user()->id)
                                <a class="comment-author" href="{{ route('profile.show', $comment->user->name) }}">{{ $comment->user->name }}</a>
                                @else
                                <a class="comment-author" href="{{ route('user.profile', $comment->user->name) }}">{{ $comment->user->name }}</a>
                                @endif
                            </div>
                            <p class="comment-content" style="margin-left:10px; margin-top:5px;">{{ $comment->content }}</p>
                        </div>
                        @endforeach
                    </div>
                    @endif


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
            <form id="reportForm">
                <ul>
                    <li>
                        <input type="radio" name="reportReason" id="spam" value="spam">
                        <label for="spam">Spam</label>
                    </li>
                    <li>
                        <input type="radio" name="reportReason" id="inappropriate" value="inappropriate">
                        <label for="inappropriate">Inappropriate content</label>
                    </li>
                    <li>
                        <input type="radio" name="reportReason" id="harassment" value="harassment">
                        <label for="harassment">Harassment</label>
                    </li>
                    <li>
                        <input type="radio" name="reportReason" id="falseInfo" value="falseInfo">
                        <label for="falseInfo">False information</label>
                    </li>
                    <li>
                        <input type="radio" name="reportReason" id="other" value="other" onchange="toggleOtherReason()">
                        <label for="other">Other</label>
                        <input type="text" name="otherReason" id="otherReason" placeholder="Please specify" style="display: none;">
                    </li>
                </ul>
                <button class="btn btn-primary" onclick="submitReport()">Submit</button>
            </form>
        </div>
    </div>



    <script>
        function goBack() {
            history.go(-1);
        }


    $(document).ready(function() {
        $('.comment-toggle').click(function() {
            $('.comment-input').toggle();
        });
    });


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

        function toggleOtherReason() {
            var otherReasonInput = document.getElementById("otherReason");
            otherReasonInput.style.display = document.getElementById("other").checked ? "block" : "none";
        }


        // Handle report submission
        function submitReport(event) {
            event.preventDefault(); // Prevent the default form submission behavior

            var selectedReason = document.querySelector('input[name="reportReason"]:checked').value;
            if (selectedReason === "other") {
                var otherReasonInput = document.getElementById("otherReason");
                var otherReason = otherReasonInput.value;

                // Make an AJAX request to store the report
                $.ajax({
                    url: '/reports',
                    type: 'POST',
                    data: {
                        post_id: '{{ $post->id }}', // Pass the ID of the reported post
                        reason: otherReason
                    },
                    success: function(response) {
                        console.log('Report submitted successfully');
                        hideReportModal();
                    },
                    error: function(xhr) {
                        console.error('Error submitting report');
                    }
                });
            } else {
                // Make an AJAX request to store the report
                $.ajax({
                    url: '/reports',
                    type: 'POST',
                    data: {
                        post_id: '{{ $post->id }}', // Pass the ID of the reported post
                        reason: selectedReason
                    },
                    success: function(response) {
                        console.log('Report submitted successfully');
                        hideReportModal();
                    },
                    error: function(xhr) {
                        console.error('Error submitting report');
                    }
                });
            }

            hideReportModal();
        }

        // Find the form element and attach the submitReport function to its submit event
        var reportForm = document.getElementById('reportModal');
        reportForm.addEventListener('submit', submitReport);
    </script>
</body>

</html>
@endsection