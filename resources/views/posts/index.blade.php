@extends('master')

@section('content')

@if (session()->has('success'))
    {{ session()->get('success') }}
@endif

@error('error')
    <br>
    <span>{{ $message }}</span>
@enderror
<div class="post">
    <div class="title">
        <h2>Posts</h2>
        <a href="{{ route('posts.create') }}">+ Add</a>
    </div>

    <div class="content-wrapper">
        <ul>
            @foreach($posts as $post)
                <li>
                    <h3>{{ $post->title }}</h3>
                    <p class="description">{{ $post->description }}</p>

                    <div class="tags">
                        <h4>Tags:</h4>
                        @foreach ($post->tags as $tag)
                            <span class="tag">{{ $tag->name }}</span>
                        @endforeach
                    </div>
                    <div class="buttons">
                        <form action="{{ route('tags.index',['post' => $post->id]) }}" method="GET">
                            @csrf
                            @method('POST')
                            <button type="submit">See Tags</button>
                        </form>
                        <form action="{{ route('posts.edit',['post' => $post->id]) }}">
                            <button type="submit">Edit</button>
                        </form>
                        <form action="{{ route('posts.destroy',['post' => $post->id]) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Delete</button>
                        </form>
                    </div>
                </li>
                <br>
            @endforeach
        </ul>
    </div>
</div>

@endsection

<style>
.post{
    border-radius: 15px;
    width:70%;
    height: auto;
    padding: 7px 40px;
    background-color: rgba(167, 167, 167, 0.651);
    margin-left: auto;
    margin-right: auto 
}
 .buttons{
    display: flex;
 }
 .buttons button{
    margin-right: 5px;
    height: 25px;
    background-color: rgb(89, 162, 175);
 }
 .tags {
    display: flex;
    flex-wrap: wrap;
    margin-top: 10px;
}
.description{
    text-align: justify;
    text-justify: auto;
    margin: auto;
    width: 800px;
    height:auto;
    text-justify: center;

}
.tag {
    text-align: center;
    margin:auto 5;
    padding: 5px 10px;
    border: 1px solid #bebebe;
    border-radius: 3px;
    font-size: 0.8rem;
}
</style>