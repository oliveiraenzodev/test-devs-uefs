@extends('master')

@section('content')

@if (session()->has('success'))
{{ session()->get('success') }} 
@endif

@error('error')
<br>
<span>{{ $message }}</span>
@enderror

<h2>CREATE TAG</h2>

<form action= "{{ route('tags.store', ['post'=>$post]) }}" method="post">
    @csrf
    <input type="text" name="name" placeholder="Name">
    <br>
    <button type="submit">Save</button>
    <a href="{{ route('posts.index') }}">Return</a>
    @error('name')
    <span>{{ $message }}</span>
    @enderror
</form>.
@endsection