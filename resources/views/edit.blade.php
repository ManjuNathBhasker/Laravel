@extends('layouts.master')

@section('content')
    <div class="card m-5">
        <h5 class="card-header">Update Post
            <a href="{{ route('post.index') }}" class="btn btn-primary" style="float: right;">Back</a>
        </h5>
        <div class="card-body">
            <form method="POST" action="{{ route('post.update', $post->id) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-8">
                        <div class="mb-3">
                            <label class="form-label">Image</label>
                            <input type="file" class="form-control" name="image">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <a href="{{ asset('/storage/' . $post->image) }}" target="_blank">
                            <img src="{{ asset('/storage/' . $post->image) }}" alt="" width="150px">
                        </a>
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label">Title</label>
                    <input type="text" class="form-control" name="title" value="{{ $post->title }}">
                </div>
                <div class="mb-3">
                    <label class="form-label">Category</label>
                    <select name="category" id="category" class="form-control">
                        <option disabled="disabled">Select a Category</option>
                        @foreach ($categorys as $category)
                            <option value="{{ $category->id }}" {{ $post->category_id == $category->id ? 'Selected' : '' }}>
                                {{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label">Description</label>
                    <textarea name="description" id="description" cols="20" rows="5" class="form-control">{{ $post->description }}</textarea>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
@endsection
