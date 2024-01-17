@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="d-flex justify-content-between">
            <h1>Product List</h1>
            <h1>
                @can('create products')
                    <a href="#" class="btn btn-success btn-sm" data-toggle="modal" data-target="#addModal">
                        Add Product
                    </a>
                @endcan
            </h1>
        </div>

        <table class="table table-bordered table-striped text-center">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th style="max-width: 200px;">Description</th>
                    <th>Price</th>
                    <th>Added By</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $product)
                    <tr>
                        <td>{{ $loop->index + 1}}</td>
                        <td>{{ $product->name }}</td>
                        <td style="max-width: 200px; overflow: hidden; text-overflow: ellipsis;">{{ $product->description }}</td>
                        <td>{{ $product->price }}</td>
                        <td>{{ $product->user->name }}</td>
                        <td>
                            @can('edit products')
                                <a href="#" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#editModal{{ $product->id }}">
                                    <i class="fas fa-edit"></i>
                                </a>
                            @endcan

                            @can('delete products')
                                <a href="#" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteModal{{ $product->id }}">
                                    <i class="fas fa-trash-alt"></i>
                                </a>
                            @endcan

                        </td>

                        @include("products.delete")
                        @include("products.edit")

                    </tr>
                @endforeach
            </tbody>
        </table>
        @include('products.add')

    </div>
</div>
@endsection
