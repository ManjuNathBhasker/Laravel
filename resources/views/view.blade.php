@extends('layouts.master')

@section('content')
    <div class="card m-5" style="margin-left: 150px; margin-right: 150px;">
        <h5 class="card-header">View Post
            <a href="{{ route('post.index') }}" class="btn btn-primary" style="float: right;">Back</a>
        </h5>
        <div class="card-body">
            <table class="table table-striped">
                <tr>
                    <td>ID</td>
                    <td>{{$post->id}}</td>
                </tr>
                <tr>
                    <td>Image</td>
                    <td><a href="{{asset('/storage/' . $post->image)}}" target="_blank"><img src="{{asset('/storage/' . $post->image)}}" alt="" width="350px"></a></td>
                </tr>
                <tr>
                    <td>Title</td>
                    <td>{{$post->title}}</td>
                </tr>
                <tr>
                    <td>Category</td>
                    <td>{{$post->category_id}}</td>
                </tr>
                <tr>
                    <td>Description</td>
                    <td>{{$post->description}}</td>
                </tr>
            </table>
        </div>
    </div>
@endsection
