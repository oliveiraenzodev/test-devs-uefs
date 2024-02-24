@extends('master')

@section('content')

@if (session()->has('success'))
{{ session()->get('success') }} 
@endif

@error('error')
<br>
<span>{{ $message }}</span>
@enderror

<h2>Tags</h2>
<form action="{{ route('tags.create',['post' => $post]) }}" method="GET">
    @csrf 
    <button type="submit">+Add</button>
    <a  href="{{ route('posts.index',['post' => $post]) }}">Returns</a>
</form>

<ul>
    @foreach($tags as $tag)
        <li>
            <p>{{$tag->name}}</p>
            <a  href="{{ route('tags.joinPost',['tag' => $tag, 'post' => $post]) }}">Link</a>
            <a  href="{{ route('tags.destroyJoinPost',['tag' => $tag, 'post' => $post]) }}">Unlink</a>
            <a  href="{{ route('tags.edit',['tag' => $tag->id, 'post' => $post]) }}">Edit</a>
            <form action="{{ route('tags.destroy',['tag' => $tag, 'post' => $post]) }}" method="POST">
                @csrf 
                @method('DELETE')
                <button type="submit">Delete</button>
            </form>
        </li>
        <br>
    @endforeach
</ul>

@endsection