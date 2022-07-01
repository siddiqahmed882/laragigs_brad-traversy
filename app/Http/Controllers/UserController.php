<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    // show register form
    public function register() {
        return view('users.register');
    }

    // store new user
    public function store(Request $request) {
        $formFields = $request->validate([
            'name' => ['required', 'min:3'],
            'email' => ['required', 'email', Rule::unique('users', 'email')],
            'password' => 'required|confirmed|min:6',
        ]);

        // hash password
        $formFields['password'] = bcrypt($formFields['password']);

        // create user
        $user = User::create($formFields);

        // login
        auth()->login($user);
        return redirect('/')->with('message', 'user created and logged in!');
    }

    // show login form
    public function login() {
        return view('users.login');
    }

    // login user and create session
    public function authenticate(Request $request) {
        $formFields = $request->validate([
            'email' => ['required', 'email'],
            'password' => 'required',
        ]);

        if(auth()->attempt($formFields)) {
            $request->session()->regenerate();
            return redirect('/')->with('message', 'You are logged in!');
        }

        return back()->withErrors(['email' => 'invalid credentials'])->onlyInput('email');
    }

    // logout
    public function logout(Request $request) {
        // remove authentication information from the users session
        auth()->logout();


        // invalidate users session and regenerate csrf token
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/')->with('message', 'you have been logged out');
    }
}
