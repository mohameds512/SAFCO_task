@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="d-flex justify-content-between">
            <h1>User List</h1>
            <h1>
                <a href="#" class="btn btn-success btn-sm" data-toggle="modal" data-target="#addModal">
                    Add User
                </a>
            </h1>

        </div>


        <table class="table table-bordered table-striped text-center">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td>{{ $loop->index + 1 }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                            @foreach ($user->roles as $role )
                            {{ $role->name }},
                            @endforeach
                        </td>
                        <td>
                            <a href="#" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#editModal{{ $user->id }}">
                                <i class="fas fa-edit"></i>
                            </a>

                            <a href="#" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteModal{{ $user->id }}">
                                <i class="fas fa-trash-alt"></i>
                            </a>
                        </td>

                        @include("users.delete")
                        @include("users.edit")

                    </tr>
                @endforeach
            </tbody>
        </table>
        @include('users.add')
    </div>
</div>
@endsection
