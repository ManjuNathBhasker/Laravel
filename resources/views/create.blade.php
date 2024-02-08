@extends('layouts.master')

@section('content')
    <div class="m-5">
        @if ($errors->any())
            @foreach ($errors->all() as $error)
                <div class="alert alert-danger">{{ $error }}</div>
            @endforeach
        @endif
    </div>

    <div class="card m-5">
        <h5 class="card-header">Create Post
            <a href="{{ route('post.index') }}" class="btn btn-primary" style="float: right;">Back</a>
        </h5>
        <div class="card-body">
            <form method="POST" action="{{ route('post.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label class="form-label">Image</label>
                    <input type="file" class="form-control" name="image">
                </div>
                <div class="mb-3">
                    <label class="form-label">Title</label>
                    <input type="text" class="form-control" name="title">
                </div>
                <div class="mb-3">
                    <label class="form-label">Category</label>
                    <select name="category" id="category" class="form-control">
                        <option disabled="disabled">Select a Category</option>
                        @foreach ($categorys as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label">Description</label>
                    <textarea name="description" id="description" cols="20" rows="5" class="form-control"></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
@endsection
