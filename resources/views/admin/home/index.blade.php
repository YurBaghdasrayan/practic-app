@extends('layouts.app')
@section('content')
    <a href="{{route('admin.users.posts')}}"> all posts</a><br>
    <a href="{{route('admin.users.list')}}"> all users</a>
    <div style="display: flex;justify-content: space-between">
        <a href="{{route('home.create')}}"> create moderator or user</a>
        <a href="{{route('logout')}}">logout</a>
    </div>
@endsection
