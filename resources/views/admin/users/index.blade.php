@extends('layouts.layout', ['title' => 'Admin Dashboard'])

@section('content')
    <div class="container py-4">
        <div class="row">
            <div class="col-3">
                @include('admin.shared.left-sidebar')
            </div>
            <div class="col-9">
                <h1>Users</h1>

                <table class="table table-striped mt-3">
                    <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Joined At</th>
                        <th>#</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($users as $user)
                        <tr>
                            <th>{{ $user->id }}</th>
                            <th>{{ $user->name }}</th>
                            <th>{{ $user->email }}</th>
                            <th>{{ $user->created_at->toDateString() }}</th>
                            <th>
                                <a class="btn btn-info" href="{{ route('users.show', $user) }}">View</a>
                                <a class="btn btn-warning text-black" href="{{ route('users.edit', $user) }}">Edit</a>
                            </th>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <div>
                    {{ $users->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
