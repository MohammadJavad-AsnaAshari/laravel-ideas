<div class="card">
    <div class="px-3 pt-4 pb-2">
        @if($editing ?? false)
            @include('shared.user-card-edit')
        @else
            @include('shared.user-card-show')
        @endif
    </div>
</div>
