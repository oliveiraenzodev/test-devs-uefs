<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\Post;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public readonly User $user;

    public function __construct()
    {
       $this->user = new User();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Validate and store a newly created resource in storage.
     */
    public function store(UserRequest $request)
    {
        try{
            $request->validated();

            $this->user->name = $request->name;
            $this->user->email = $request->email;
            $this->user->username = $request->username;
            $this->user->password = $request->password;

            $this->user->save();
            
            Auth::loginUsingId($this->user->id);

            return redirect()->route('posts.index')->with('success');
        }
        catch(Exception $exception){
            return redirect()->route('users.create')->withErrors(['error' => $exception->getMessage()]);;
        
        }
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        try{
            $user = User::find($id);

            return view('users.edit',['user' => $user]);
        }
        catch(Exception $exception){
          return redirect()->route('posts.index')->withErrors(['error' => $exception->getMessage()]);;
        
        }
    }

    /**
     * Validate and update the specified resource in storage.
     */
    public function update(UserRequest $request, User $user)
    {
        try{
        $request->validated();

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'username' => $request->username,
            'password' => $request->password
        ]);

        return redirect()->route('posts.index')->with('success','Account edited successfull');
        }
        catch(Exception $exception){
            return redirect()->route('users.edit',['user' =>$user])->withErrors(['error' => $exception->getMessage()]);;
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try{
        $user = User::find($id);
        $posts = Post:: where('user_id', $user->id);
        $posts->delete();
        
        $user->delete();

        Auth::logout();
        
        return view('login');
        }
        catch(Exception $exception){
            return redirect()->route('posts.index')->withErrors(['error' => $exception->getMessage()]);;
        }
    }
}
