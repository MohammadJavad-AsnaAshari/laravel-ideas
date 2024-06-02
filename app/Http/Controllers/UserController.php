<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        $ideas = $user->ideas()->paginate(5);

        return view('users.show', compact('user', 'ideas'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $this->authorize('update', $user);

        $ideas = $user->ideas()->paginate(5);
        $profileEditing = true;

        return view('users.show', compact('user', 'ideas', 'profileEditing'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        $validatedData = $request->validated();

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('profile', 'public');
            $validatedData['image'] = $imagePath;

            Storage::disk('public')->delete($user->image ?? '');
        }

        $user = $user->update($validatedData);

        return redirect()
            ->route('users.show', ['user' => $user])
            ->with('success', 'User updated successfully !');
    }

    public function profile()
    {
        if (auth()->check()) {
            return $this->show(auth()->user());
        }

        return redirect('login');
    }
}
