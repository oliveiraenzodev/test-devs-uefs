<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DayTrend</title>
</head>
<body>
    <div class="header">
        <h1>DayTrend</h1>
        @if (auth()->check())
        <div class="logged-in-info">
            <span>Logged in {{ auth()->user()->name }}</span>    
            <form action="{{ route('login.destroy') }}" >
                @csrf
                <button type="submit">Logout</button>
            </form>
            <form action="{{ route('users.edit',['user' => auth()->user()->id]) }}" >
                @csrf
                <button type="submit">Edit</button>
            </form>
            <form action="{{ route('users.destroy',['user' => auth()->user()->id]) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit">Delete</button>
            </form>
            <form action="{{ route('posts.index') }}" >
                @csrf
                <button type="submit">Home</button>
            </form>
        </div>
        
        @endif
    </div>
    <div class="container">
        @yield('content')
    </div>
</body>
</html>
<style>
    body {
    margin: 0;
    padding: 0;
    font-family: sans-serif;
}

.header {
    width: auto;
    height: 80px;
    background-color: rgb(89, 162, 175);
    display: flex;
    justify-content:;
    align-items: center;
    padding: 0 20px;
    font-size: 14px;
    justify-content: space-between;
    border:0.2px solid rgb(82, 144, 163);
}

.header h1 {
    color: #fff;
    font-size: 24px;
    margin: 0;
}

.logged-in-info {
    justify-content: space-between;
    display: flex;
    align-items: center;
    color: #fff;
}

.logged-in-info button {
    margin-left: 10px;
    text-decoration: none;
    color: #fff;
    border: 1px solid black
}

.logged-in-info button {
    background-color: transparent;
    border: none;
    cursor: pointer;
}

a {
    color: #000;
}

.container {
    padding: 20px;
}
button{
    margin-right: 5px;
    height: 25px;
    background-color: rgb(89, 162, 175);
 }
</style>