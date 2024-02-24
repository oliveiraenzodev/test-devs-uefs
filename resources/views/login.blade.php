@extends('home')

@section('content')
@if (!auth()->check())


@if (session()->has('success'))
{{ session()->get('success') }} 
@endif

@error('error')
<br>
<span>{{ $message }}</span>
@enderror

<h2>LOGIN</h2>

<form action= "{{ route('login.store') }}" method="post">
    @csrf
    <input type="text" name="username" placeholder="Username">
    <br>
    @error('username')
    <span>{{ $message }}</span>
    <br>
    @enderror
    <br>
    <input type="password" name="password" placeholder="Password">
    <button type="submit">Login</button>
    <a href="{{ route('users.create') }}">Sign up</a>
    @error('password')
    <br>
    <span>{{ $message }}</span>
    @enderror
</form>
@endif
@endsection