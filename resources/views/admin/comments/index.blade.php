@extends('layouts.layout', ['title' => 'Comments | Admin Dashboard'])

@section('content')
    <div class="container py-4">
        <div class="row">
            <div class="col-3">
                @include('admin.shared.left-sidebar')
            </div>
            <div class="col-9">
                <h1>Comments</h1>
                @include('shared.success-message')
                <table class="table table-striped mt-3">
                    <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>User</th>
                        <th>Idea</th>
                        <th>Content</th>
                        <th>Joined At</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($comments as $comment)
                        <tr>
                            <th>{{ $comment->id }}</th>
                            <th>
                                <a href="{{ route('users.show', $comment->user) }}">{{ $comment->user->name }}</a>
                            </th>
                            <th>
                                <a href="{{ route('ideas.show', $comment->idea) }}">{{ $comment->idea->id }}</a>
                            </th>
                            <th>{{ $comment->content }}</th>
                            <th>{{ $comment->created_at->toDateString() }}</th>
                            <th>
                                <form action="{{ route('admin.comments.destroy', $comment) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger" type="submit">Delete</button>
                                </form>
                            </th>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <div>
                    {{ $comments->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
