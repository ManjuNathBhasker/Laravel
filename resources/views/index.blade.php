@extends('layouts.master')

@section('content')
    <div class="card mt-5">
        <h5 class="card-header">
            @if ($trash != true)
                All Posts
                <a href="{{ route('post.trash') }}" class="btn btn-warning" style="float: right;">Trash</a>
                <a href="{{ route('post.create') }}" class="btn btn-success" style="float: right; margin-right: 10px;">Add</a>
            @else
                Trash
                <a href="{{ route('post.index') }}" class="btn btn-primary" style="float: right;">Back</a>
            @endif
        </h5>

        <div class="card-body">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Image</th>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Category</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($posts as $post)
                        <tr>
                            <td><img src="{{ asset('/storage/' . $post->image) }}" alt="" style="width:150px;">
                            </td>
                            <td>{{ $post->title }}</td>
                            <td>{{ $post->description }}</td>
                            <td>{{ $post->category->name }}</td>
                            <td class="text-center">
                                @if ($trash != true)
                                    <div class="d-flex" style="justify-content: center;">
                                        <a href="{{ route('post.show', $post->id) }}" class="btn btn-primary m-1">Show</a>
                                        <a href="{{ route('post.edit', $post->id) }}" class="btn btn-info m-1">Edit</a>
                                        <a href="{{ route('post.duplicate', $post->id) }}"
                                            class="btn btn-secondary m-1">Duplicate</a>
                                        <form action="{{ route('post.destroy', $post->id) }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger m-1">Delete</button>
                                        </form>
                                    </div>
                                @else
                                    <div class="d-flex" style="justify-content: center;">
                                        <a href="{{ route('post.restore', $post->id) }}"
                                            class="btn btn-info m-1">Restore</a>
                                        <form action="{{ route('post.forceDelete', $post->id) }}" method="get">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger m-1">Delete</button>
                                        </form>
                                    </div>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center">No Data Found</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            <div class="mt-4">{{ $posts->links() }}</div>
        </div>
    </div>
@endsection
