@extends('admin.master')
@section('title', 'categories|' . env('APP_NAME'))
@section('content')
    <h1 class="h3 mb-4 text-grey">All Categories </h1>

    @if (session('msg'))
        <div class="alert alert-{{ session('type') }}">
            {{ session('msg') }}
        </div>
    @endif
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Image</th>
                <th>Parent</th>
                <th>Created at</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($categories as $category)
                <tr>
                    <td>{{ $category->id }}</td>
                    <td>{{ $category->name }}</td>
                    <td><img width="80" src="{{ asset('uploads/categories/'.$category->image) }}" alt=""></td>
                    <td>{{ $category->parent_id }}</td>
                    <td>{{ $category->created_at ? $category->created_at->diffForHumans() : '' }}</td>
                    <td>
                        <a class="btn btn-small btn-primary" href="{{ route('admin.categories.edit', $category->id) }}"><i
                                class="fas fa-edit"></i></a>

                        <form class="d-inline" action="{{ route('admin.categories.destroy', $category->id) }}" method="POST">
                            @csrf
                            @method('delete')
                            <button class="btn btn-small btn-danger" onclick="return confirm('Are you sure?')"><i
                                    class="fa fa-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>

    </table>
@stop
