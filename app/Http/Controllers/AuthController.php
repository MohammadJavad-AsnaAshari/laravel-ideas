<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Mail\WelcomeEmail;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->redirectTo = URL::previous();
    }

    public function register()
    {
        return view('auth.register');
    }

    public function store(RegisterRequest $request)
    {
        $validated = $request->validated();
        $user = User::create($validated);

        // send welcome email to register user :)
//        Mail::to($user->email)->send(new WelcomeEmail($user));

        return redirect()->route('dashboard')->with('success', 'Account created successfully!');
    }

    public function login()
    {
        return view('auth.login');
    }

    public function authenticate(LoginRequest $request)
    {
        $validated = $request->validated();
        if (auth()->attempt($validated)) {
            request()->session()->regenerate();

            $url = Session::get('url.intended', route('dashboard'));
            Session::forget('url.intended'); // Clear the intended URL after use

            return redirect()->to($url)->with('success', 'Account logged in successfully!');
        }

        return redirect()->route('login')->withErrors([
            'password' => 'No matching user found with the provided email and password'
        ]);
    }

    public function logout()
    {
        auth()->logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();

        return redirect()->route('dashboard')->with('success', 'Account logged out successfully!');
    }
}
