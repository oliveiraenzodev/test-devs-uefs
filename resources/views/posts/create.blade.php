@extends('master')

@section('content')

@if (session()->has('success'))
{{ session()->get('success') }} 
@endif

@error('error')
<br>
<span>{{ $message }}</span>
@enderror

<h2>CREATE POST</h2>

<form action= "{{ route('posts.store') }}" method="post">
    @csrf
    <input type="text" name="title" placeholder="Title">
    <br>
    @error('title')
    <span>{{ $message }}</span>
    @enderror
    <br>
    <input type="text" name="description" placeholder="Description">
    <button type="submit">Save</button>
    <a href="{{ route('posts.index') }}">Return</a>
    @error('description')
    <span>{{ $message }}</span>
    @enderror
</form>.
@endsection