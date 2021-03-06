@extends('layouts.app')


@section('content')

<div class="d-flex justify-content-end mb-2">

    <a href="{{route('posts.create')}}" class="btn btn-success">Add Posts</a>
</div>

<div class="card card-default">
    <div class="card-header">Posts</div>
    <div class="card-body">


        <table class="table">
            <thead>
                <th>Image</th>
                <th>Title</th>
                <th>Category</th>
            </thead>
            <tbody>

                @if($post)
                @foreach($post as $posts)
                <tr>
                    <td>
                        <img src="{{URL::asset('public/storage/posts/{posts->image}')}}" width="120px" height="120px" alt="no pic">

                    </td>

                    <td>
                        {{$posts->title}}

                    </td>
                    <td>

                        <a href="{{route('categories.edit',$posts->category->id)}}">

                            {{$posts->category->name}}
                        </a>
                    </td>
                    <td>

                        @if($posts->trashed())
                        <form action="{{route('restore-posts',$posts->id)}}" method="POST">
                            @csrf
                            @method('PUT')

                            <button type="submit" class="btn btn-info btn-sm">Restore</a>
                        </form>
                    </td>

                    @else
                    <td>
                        <a href="{{route('posts.edit',$posts->id)}}" class="btn btn-info btn-sm">Edit</a>
                    </td>
                    @endif
                    <td>
                        <form action="{{route('posts.destroy',$posts->id)}}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">
                                {{$posts->trashed() ? 'Delete':'Trash'}}</button>
                        </form>
                    </td>


                    @endforeach

                    @endif

                    @endsection
