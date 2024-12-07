<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AuthController extends Controller
{
    //
    public function register(Request $request)
    {
        // sleep(1);

        // dd('ok');
        //validation
        $fields =  $request->validate([
            'avatar' => 'file|nullable|max:2000',
            'name' => 'required|max:255',
            'email' => 'required|max:255|email|unique:users',
            'password' => 'required|min:3|confirmed'
        ]);

        if ($request->hasFile('avatar')) {
            $fields['avatar'] = Storage::disk('public')->put('avatars', $request->avatar);
        }

        //Register
        $user = User::create($fields);


        //Login
        Auth::login($user);

        //redirect        
        return redirect()->route('dashboard')->with('greet', 'Welcome to laravel Inertia Vue app');
    }

    public function login(Request $request)
    {
        $fields = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($fields, $request->remember)) {
            $request->session()->regenerate();

            return redirect()->intended('dashboard');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
        // dd($fields);
    }

    public function logout(Request $request)
    {

        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('home');
        // dd('ok');
    }
}
