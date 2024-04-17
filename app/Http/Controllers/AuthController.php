<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthRequest;
use App\Models\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function register()
    {
        return view('auth.register');
    }

    public function store(AuthRequest $request)
    {
        $validated = $request->validated();
        User::create($validated);

        return redirect()->route('dashboard')->with('success', 'Account created successfully!');
    }
}
