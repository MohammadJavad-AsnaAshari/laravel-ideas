<form action="{{ route('users.update', $user->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('put')
    <div class="d-flex align-items-center justify-content-between">
        <div class="d-flex align-items-center">
            <img style="width:150px" class="me-3 avatar-sm rounded-circle"
                 src="{{ $user->getImageURL() }}" alt="Mario Avatar">
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
        <label for="image">Profile picture</label>
        <input name="image" class="form-control" type="file">
    </div>
    <div class="px-2 mt-4">
        <h5 class="fs-5"> About : </h5>
        <div class="mb-3">
            <textarea name="bio" class="form-control" id="bio" rows="3">{{ $user->bio }}</textarea>
            @error('bio')
                <span class="d-block fs-6 text-danger mt-2"> {{ $message }} </span>
            @enderror
        </div>
        @auth()
            @if(auth()->id() === $user->id)
                <div class="">
                    <button type="submit" class="btn btn-dark mb-2 btn-sm"> Update</button>
                </div>
            @endif
        @endauth
        @include('users.shared.user-stats')
        @auth()
            @if(auth()->id() !== $user->id)
                <div class="mt-3">
                    <button class="btn btn-primary btn-sm"> Follow</button>
                </div>
            @endif
        @endauth
    </div>
</form>
