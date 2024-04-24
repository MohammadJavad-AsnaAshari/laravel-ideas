@extends('layouts.layout', ['title' => 'Dashboard'])

@section('content')
    <div class="container py-4">
        <div class="row">
            <div class="col-3">
                @include('shared.left-sidebar')
            </div>
            <div class="col-6">
                @include('shared.success-message')
                @include('shared.error-message')
                @include('shared.submit-idea')
                <hr>
                @if(count($ideas))
                    @foreach($ideas as $idea)
                        <div class="mt-3">
                            @include('shared.idea-card')
                        </div>
                    @endforeach
                @else
                    <p class="text-center mt-4">No Results Found!</p>
                @endif
                <div class="mt-3">
                    {{ $ideas->withQueryString()->links() }}
                </div>
            </div>
            <div class="col-3">
                @include('shared.search-bar')
                @include('shared.follow-box')
            </div>
        </div>
    </div>
@endsection
