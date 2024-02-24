@extends('master')

@section('content')

<h2>EDIT</h2>

<form action= "{{ route('users.update',['user' => $user]) }}" method="POST">
    @csrf
    @method("PUT")
    <input type="text" name="name" placeholder="Name" value="{{$user->name}}">
    <br>
    @error('name')
    <span>{{ $message }}</span>
    @enderror
    <br>
    <input type="email" name="email" placeholder="Email" value="{{$user->email}}">
    <br>
    @error('email')
    <span>{{ $message }}</span>
    @enderror
    <br>
    <input type="text" name="username" placeholder="Username" value="{{$user->username}}">
    <br>
    @error('username')
    <span>{{ $message }}</span>
    @enderror
    <br>
    <input type="password" name="password" placeholder="Password" value="{{$user->password}}">
    <button type="submit">Edit</button>
    <a href="{{ route('login.index') }}">Return</a>
    @error('password')
    <br>
    <span>{{ $message }}</span>
    @enderror
</form>
@endsection