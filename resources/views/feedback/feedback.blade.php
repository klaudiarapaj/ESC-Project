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
                    <div class="card-header">{{ __('ESC Feedback - We are always open to your suggestions or complaints.') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('feedback.store') }}">
                            @csrf

                            <div class="form-group">
                                <label for="subject">Subject</label>
                                <input id="subject" type="text" class="form-control" name="subject" required>
                            </div>

                            <div class="form-group">
                                <label for="message">Message</label>
                                <textarea id="message" class="form-control" name="message" rows="4" required></textarea>
                            </div>

                            <button type="submit" class="btn btn-primary" style="margin-top:10px">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
@endsection
