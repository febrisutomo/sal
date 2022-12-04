<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function edit()
    {
        $user = Auth::user();
        
        return view('pages.profile.edit', compact('user'));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,'.Auth::user()->id,
            'phone' => 'required',
        ]);

        $request->user()->update($validated);

        return redirect()->back()->with('success', 'Profil berhasil diperbarui!');
        
    }

    public function password(Request $request)
    {
        $request->validate([
            'current_password' => 'required|string|current_password',
            'new_password' => 'required|string|min:8|confirmed',
        ]);

        
        $request->user()->update(['password'=> Hash::make($request->new_password)]);

        return redirect()->back()->with('success', 'Password berhasil diperbarui!');
    }
}
