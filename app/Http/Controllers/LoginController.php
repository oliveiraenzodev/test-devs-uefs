<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Display a login view.
     */
    public function index()
    {
        return view ('login');
    }

    /**
     * Method validates the login request and authenticates the user.
     */
    public function store(Request $request)
    {
        $request->validate([
        'username' => 'required',
        'password' => 'required'
        ], [
        'username.required' => 'Username required',
        'password.required' => 'Password required',
        ]);

        $user = User::where('username', $request->input('username'))->first();

        if (!$user) {
        return redirect()->route('login.index')->withErrors(['error' => 'Username or password invalid']);
        }
        
        if (!password_verify($request->input('password'), $user->password)) {
        return redirect()->route('login.index')->withErrors(['error' => 'Username or password invalid']);
        }

        Auth::loginUsingId($user->id);

        return redirect()->route('posts.index')->with('success');
        
    }

    /**
     * Method that performs user logout.
     */
    public function destroy()
    {
        Auth::logout();

        return redirect()->route('login.index');
    }
}
