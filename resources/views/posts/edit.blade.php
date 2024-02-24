@extends('master')

@section('content')

@if (session()->has('success'))
{{ session()->get('success') }} 
@endif

@error('error')
<br>
<span>{{ $message }}</span>
@enderror

<h2>EDIT</h2>

<form action= "{{ route('posts.update',['post' => $post]) }}" method="POST">
    @csrf
    @method("PUT")
    <input type="text" name="title" placeholder="Title" value="{{$post->title}}">
    <br>
    @error('title')
    <span>{{ $message }}</span>
    @enderror
    <br>
    <input type="text" name="description" placeholder="Description" value="{{$post->description}}">
    <button type="submit">Save</button>
    <a href="{{ route('posts.index') }}">Return</a>
    <br>
    @error('description')
    <span>{{ $message }}</span>
    @enderror
</form>
@endsection