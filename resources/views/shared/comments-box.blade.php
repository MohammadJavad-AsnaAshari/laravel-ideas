<div>
    <form action="{{ route('idea.comments.store', $idea->id) }}" method="POST">
        @csrf
        <div class="mb-3">
            <textarea name="comment-content" class="fs-6 form-control" rows="1"></textarea>
            @error('comment-content')
            <span class="d-block fs-6 text-danger mt-2"> {{ $message }} </span>
            @enderror
        </div>
        <div>
            <button type="submit" class="btn btn-primary btn-sm"> Post Comment</button>
        </div>
    </form>
    <hr>
    @forelse($idea->comments->sortByDesc('created_at') as $comment)
        <div class="d-flex align-items-start">
            <img style="width:35px" class="me-2 avatar-sm rounded-circle"
                 src="{{ $comment->user->getImageURL() }}" alt="Luigi Avatar">
            <div class="w-100">
                <div class="d-flex justify-content-between">
                    <h6 class="">
                        <a href="{{ route('users.show', ['user' => $comment->user->id]) }}">
                            {{ $comment->user->name }}
                        </a>
                    </h6>
                    <small class="fs-6 fw-light text-muted"> {{ $comment->created_at->diffForHumans() }} </small>
                </div>
                <p class="fs-6 mt-3 fw-light">
                    {{ $comment->content }}
                </p>
            </div>
        </div>
        <br>
    @empty
        <p class="text-center mt-4">No Comments Found!</p>
    @endforelse
</div>
