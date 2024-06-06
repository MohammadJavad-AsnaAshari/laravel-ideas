@extends('layouts.layout', ['title' => 'Ideas | Admin Dashboard'])

@section('content')
    <div class="container py-4">
        <div class="row">
            <div class="col-3">
                @include('admin.shared.left-sidebar')
            </div>
            <div class="col-9">
                <h1>Ideas</h1>

                <table class="table table-striped mt-3">
                    <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>User</th>
                        <th>Content</th>
                        <th>Created At</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($ideas as $idea)
                        <tr>
                            <th>{{ $idea->id }}</th>
                            <th><a href="{{ route('users.show', $idea->user) }}">{{ $idea->user->name }}</a></th>
                            <th>{{ $idea->content }}</th>
                            <th>{{ $idea->created_at->toDateString() }}</th>
                            <th>
                                <a class="btn btn-info" href="{{ route('ideas.show', $idea) }}">View</a>
                                <a class="btn btn-warning text-black" href="{{ route('ideas.edit', $idea) }}">Edit</a>
                            </th>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <div>
                    {{ $ideas->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
