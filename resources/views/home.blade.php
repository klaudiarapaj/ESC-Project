@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <form method="POST" action="{{ route('post.create') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="title" class="col-md-4 col-form-label text-md-right">{{ __('Title') }}</label>

                            <div class="col-md-6">
                                <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" required autocomplete="title" autofocus>

                                @error('title')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="content" class="col-md-4 col-form-label text-md-right">{{ __('Content') }}</label>

                            <div class="col-md-6">
                                <textarea id="content" class="form-control @error('content') is-invalid @enderror" name="content" required autocomplete="content"></textarea>

                                @error('content')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="tags" class="col-md-4 col-form-label text-md-right">{{ __('Tags') }}</label>

                            <div class="col-md-6">
                                <div id="tags-input" class="input-group mb-3">
                                    <input id="tags" type="text" class="form-control @error('tags') is-invalid @enderror" name="tags" placeholder="Add up to 5 tags separated by commas" autocomplete="tags">
                                    <div class="input-group-append">
                                        <button id="add-tag-btn" class="btn btn-outline-secondary" type="button" onclick="addTag()">Add</button>
                                    </div>
                                </div>
                                <div id="tags-container"></div>

                                <!-- Hidden input field for tags -->
                                

                                @error('tags')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <input type="hidden" name="tags[]" id="hidden-tags-input" value="">

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Create Post') }}
                                </button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Initialize tags array
    var tags = [];

    // Add tag to the array and update tags container
    function addTag() {
        const input = document.getElementById("tags");
        const container = document.getElementById("tags-container");

        // Get the value of the input and trim any whitespace
        const tagValue = input.value.trim();

        // Don't add a tag if the input is empty
        if (tagValue === "") {
            return;
        }

        // Don't add a tag if it already exists
        if (tags.includes(tagValue)) {
            return;
        }

        // Don't add more than 5 tags
        if (tags.length >= 5) {
            return;
        }

        // Add the tag to the tags array
        tags.push(tagValue);

        // Update the tags container
        const tagBadge = document.createElement("span");
        tagBadge.classList.add("badge", "badge-primary", "mr-1");
        tagBadge.textContent = tagValue;
        const removeBtn = document.createElement("button");
        removeBtn.classList.add("btn", "btn-link", "p-0", "m-0");
        removeBtn.textContent = "x";
        removeBtn.addEventListener("click", () => {
            removeTag(tagValue);
        });
        tagBadge.appendChild(removeBtn);
        container.appendChild(tagBadge);

        // Update the hidden input field with the tags array
        document.getElementById("hidden-tags-input").value = JSON.stringify(tags);



        // Clear the input field
        input.value = "";

        // Disable the input field and add tag button if 5 tags have been added
        if (tags.length >= 5) {
            input.disabled = true;
            document.getElementById("add-tag-btn").disabled = true;
        }
    }

    // Remove tag from the array and update tags container
    function removeTag(tagValue) {
        // Remove the tag from the tags array
        tags = tags.filter((tag) => tag !== tagValue);

        // Update the tags container
        const container = document.getElementById("tags-container");
        container.innerHTML = "";
        tags.forEach((tag) => {
            const tagBadge = document.createElement("span");
            tagBadge.classList.add("badge", "badge-primary", "mr-1");
            tagBadge.textContent = tag;
            const removeBtn = document.createElement("button");
            removeBtn.classList.add("btn", "btn-link", "p-0", "m-0");
            removeBtn.textContent = "x";
            removeBtn.addEventListener("click", () => {
                removeTag(tag);
            });
            tagBadge.appendChild(removeBtn);
            container.appendChild(tagBadge);
        });

        // Enable the input field and add tag button
        document.getElementById("tags").disabled = false;
        document.getElementById("add-tag-btn").disabled = false;

        // Update the hidden input field with the tags array
        document.getElementById("hidden-tags-input").value = JSON.stringify(tags);
        
    }
</script>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @foreach($feed as $post)
            <div class="card mb-3">
                <div class="card-body">
                    <h5 class="card-title">
                        @if ($post->user->id == auth()->user()->id)
                        <h5 class="mb-0" style="margin-left: 0.5rem;"><a href="{{ route('profile.show', $post->user->name) }}">{{ $post->user->name }}</a></h5>
                        @else
                        <h5 class="mb-0" style="margin-left: 0.5rem;"><a href="{{ route('profile.show', $post->user->id) }}">{{ $post->user->name }}</a></h5>
                        @endif
                    </h5>
                    <p class="card-text">{{ $post->content }}</p>
                    <a href="{{ route('post.show', ['post' => $post]) }}" class="btn btn-primary">View Post</a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>

@endsection

<style>
    .badge-primary {
        background-color: #007bff;
        color: #000000;
        /* add this line to change the color of the tags to black */
    }

    #tags-container .btn-link {
        color: #000;
    }
</style>