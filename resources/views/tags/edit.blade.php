@extends('master')

@section('content')

@if (session()->has('success'))
{{ session()->get('success') }} 
@endif

@error('error')
<br>
<span>{{ $message }}</span>
@enderror

<h2>EDIT TAG</h2>

<form action= "{{ route('tags.update', ['tag' => $tag, 'post'=>$post]) }}" method="POST">
    @csrf
    @method("PUT")
    <input type="text" name="name" placeholder="Name" value="{{$tag->name}}">
    <button type="submit">Save</button>
    <a href="{{ route('posts.index') }}">Return</a>
    <br>
    @error('name')
    <span>{{ $message }}</span>
    @enderror
</form>
@endsection