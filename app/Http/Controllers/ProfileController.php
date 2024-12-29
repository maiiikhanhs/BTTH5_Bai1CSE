<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\User;

class ProfileController extends Controller
{
    // Method to show the current user's profile edit page
    public function edit()
    {
        $user = Auth::user();  // Get the authenticated user
        return view('profile.edit', compact('user'));
    }

    // Method to update the current user's profile
    public function update(Request $request)
    {
        $user = auth()->user();
    
        // Validate input data
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $user->id],
            'bio' => ['nullable', 'string'],
            'avatar' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'],
            'current_password' => ['required_with:new_password', 'current_password'],
            'new_password' => ['nullable', 'string', 'min:8', 'confirmed'],
        ]);
    
        // Update profile details
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->bio = $request->input('bio');
    
        // Handle avatar upload
        if ($request->hasFile('avatar')) {
            $path = $request->file('avatar')->store('avatars', 'public');
            $user->avatar = $path;
        }
    
        // Update password if provided
        if ($request->filled('current_password') && $request->filled('new_password')) {
            if (\Hash::check($request->current_password, $user->password)) {
                $user->password = \Hash::make($request->new_password);
            } else {
                return back()->withErrors(['current_password' => 'Current password is incorrect']);
            }
        }
    
        $user->save();
    
        return back()->with('success', 'Profile updated successfully!');
    }
        

    // Method to show another user's profile
    public function show($id)
    {
        $user = User::findOrFail($id);
    
        // Check if the profile belongs to the authenticated user
        if ($user->id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }
    
        return view('profile.show', compact('user'));
    }
    
}
