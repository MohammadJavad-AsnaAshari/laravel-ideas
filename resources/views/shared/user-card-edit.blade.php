<form action="{{ route('users.update', $user->id) }}" method="POST">
    @csrf
    @method('put')
    <div class="d-flex align-items-center justify-content-between">
        <div class="d-flex align-items-center">
            <img style="width:150px" class="me-3 avatar-sm rounded-circle"
                 src="https://api.dicebear.com/6.x/fun-emoji/svg?seed={{ $user->name }}" alt="Mario Avatar">
            <div>
                <input name="name" type="text" value="{{ $user->name }}" class="input-group">
                @error('name')
                <span class="d-block fs-6 text-danger mt-2"> {{ $message }} </span>
                @enderror
                <span class="fs-6 text-muted">@ {{ $user->name }}</span>
            </div>
        </div>
        @auth()
            @if(auth()->id() === $user->id)
                <div>
                    <a class="mx-2" href="{{ route('users.show', $user->id) }}"> Cancel </a>
                </div>
            @endif
        @endauth
    </div>
    <div class="px-2 mt-4">
        <h5 class="fs-5"> About : </h5>
        <div class="mb-3">
            <textarea name="bio" class="form-control" id="bio" rows="3" value="{{ $user->bio }}"></textarea>
            @error('bio')
            <span class="d-block fs-6 text-danger mt-2"> {{ $message }} </span>
            @enderror
        </div>
        @auth()
            @if(auth()->id() === $user->id)
                <div class="">
                    <form action="{{ route('users.update', $user->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-dark mb-2 btn-sm"> Update</button>
                    </form>
                </div>
            @endif
        @endauth
        <div class="d-flex justify-content-start">
            <a href="#" class="fw-light nav-link fs-6 me-3"> <span class="fas fa-user me-1">
                                    </span> 0 Followers </a>
            <a href="#" class="fw-light nav-link fs-6 me-3"> <span class="fas fa-brain me-1">
                                    </span> {{ $user->ideas->count() }} </a>
            <a href="#" class="fw-light nav-link fs-6"> <span class="fas fa-comment me-1">
                                    </span> {{ $user->comments->count() }} </a>
        </div>
        @auth()
            @if(auth()->id() !== $user->id)
                <div class="mt-3">
                    <button class="btn btn-primary btn-sm"> Follow</button>
                </div>
            @endif
        @endauth
    </div>
</form>
