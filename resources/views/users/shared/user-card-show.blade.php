<div class="d-flex align-items-center justify-content-between">
    <div class="d-flex align-items-center">
        <img style="width:150px" class="me-3 avatar-sm rounded-circle"
             src="{{ $user->getImageURL() }}" alt="Mario Avatar">
        <div>
            <h3 class="card-title mb-0"><a href="#"> {{ $user->name }} </a></h3>
            <span class="fs-6 text-muted">@ {{ $user->name }}</span>
        </div>
    </div>
    @auth()
        @if(auth()->id() === $user->id)
            <div>
                <a class="mx-2" href="{{ route('users.edit', $user->id) }}"> Edit </a>
            </div>
        @endif
    @endauth
</div>
<div class="px-2 mt-4">
    <h5 class="fs-5"> About : </h5>
    <p class="fs-6 fw-light"> {{ $user->bio }} </p>
    @include('users.shared.user-stats')
    @auth()
        @if(auth()->id() !== $user->id)
            @if(auth()->user()->follows($user))
                <div class="mt-3">
                    <form action="{{ route('users.unfollow', $user->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-danger btn-sm"> UnFollow</button>
                    </form>
                </div>
            @else
                <div class="mt-3">
                    <form action="{{ route('users.follow', $user->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-primary btn-sm"> follow</button>
                    </form>
                </div>
            @endif
        @endif
    @endauth
</div>
