@extends('master')

@section('content')

@if (session()->has('success'))
{{ session()->get('success') }} 
@endif

@error('error')
<br>
<span>{{ $message }}</span>
@enderror

<h2>SIGN UP</h2>

<form action= "{{ route('users.store') }}" method="post">
    @csrf
    <input type="text" name="name" placeholder="Name">
    <br>
    @error('name')
    <span>{{ $message }}</span>
    @enderror
    <br>
    <input type="email" name="email" placeholder="Email">
    <br>
    @error('email')
    <span>{{ $message }}</span>
    @enderror
    <br>
    <input type="text" name="username" placeholder="Username">
    <br>
    @error('username')
    <span>{{ $message }}</span>
    @enderror
    <br>
    <input type="password" name="password" placeholder="Password">
    <button type="submit">Sign up</button>
    <a href="{{ route('login.index') }}">Return</a>
    @error('password')
    <br>
    <span>{{ $message }}</span>
    @enderror
</form>
@endsection