@extends('layouts.app')
@section('content')
    create moderator or user
    <form action="{{route('home.store')}}" class="" style="width: 500px;margin: 0 auto" method="post">
        @csrf
        <div class="form-group">
            <label for="exampleInputEmail1">Email address</label>
            <input name="email" type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
            @if($errors->has('email'))
                <div class="alert alert-danger">{{$errors->first('email') }}</div>
            @endif
            <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Name</label>
            <input name="name" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
            @if($errors->has('name'))
                <div class="alert alert-danger">{{$errors->first('name') }}</div>
            @endif
            <small id="emailHelp" class="form-text text-muted">We'll never share your name with anyone else.</small>
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Password</label>
            <input name="password" type="password" class="form-control" id="exampleInputPassword1">
            @if($errors->has('password'))
                <div class="alert alert-danger">{{$errors->first('password') }}</div>
            @endif
            <small id="emailHelp" class="form-text text-muted">We'll never share your password with anyone else.</small>
        </div>
        <label for="exampleInputPassword1">Role</label>
        <select name="role_id" class="form-control">
            @foreach($userRole as $roles)
                <option value="{{$roles->id}}">{{$roles->name}}</option>
            @endforeach
        </select>
        <button type="submit" class="btn btn-primary">Submit</button>

    </form>
@endsection
