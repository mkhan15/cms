@extends('layouts.app')


@section('content')


<div class="card card-default">
    <div class="card-header">Users</div>
    <div class="card-body">


        <table class="table">
            <thead>
                <th>Image</th>
                <th>Name</th>
                <th>Email</th>
            </thead>
            <tbody>

                @if($users)
                @foreach($users as $user)
                <tr>
                    <td>
                        <img src="{{asset('$posts->image')}}" width="120px" height="120px" alt="mm">

                    </td>

                    <td>
                        {{$user->name}}

                    </td>
                    <td>

                      {{$user->email}}
                    </td>
                    @if(!$user->isAdmin())
                    <td>
                    <form action="{{route('users.make-admin',$user->id)}}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-success btn-sm">Make admin</button>


                    </form>
                    </td>
                    @endif

                    @endforeach

                    @endif

                    @endsection
