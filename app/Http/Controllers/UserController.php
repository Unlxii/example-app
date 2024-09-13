<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\UserBio;
use App\Models\PersonalityType;

class UserController extends Controller
{
    public function updateProfilePhoto(Request $request)
    {
        $request->validate([
            'profile_photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $user = Auth::user();

        if ($request->file('profile_photo')) {
            // Delete old photo if exists
            if ($user->profile_photo) {
                Storage::disk('public')->delete($user->profile_photo);
            }

            $fileName = time() . '_' . $request->file('profile_photo')->getClientOriginalName();
            $filePath = $request->file('profile_photo')->storeAs('uploads/profile_photos', $fileName, 'public');

            $user->profile_photo = $filePath;
            $user->save();
        }

        return redirect()->route('profile.edit')->with('status', 'profile-photo-updated');
    }

    public function showBio()
    {
        $user = Auth::user(); // Retrieve the currently authenticated user
        $bio = $user->bio; // Access the related bio for the user
        $personalityTypes = PersonalityType::all(); // Retrieve all personality types
        return view('profile.show-bio', compact('user', 'bio', 'personalityTypes'));
    }

    public function updateBio(Request $request)
    {
        $request->validate([
            'bio' => 'required|string|max:255',
            'personality_type' => 'required|exists:personality_types,id',
        ]);

        $user = Auth::user();
        $user->bio = $request->bio;
        $user->personality_type_id = $request->personality_type;
        $user->save();

        return redirect()->route('profile.show-bio')->with('success', 'Bio updated successfully.');
    }

    public function show($id)
    {
        $personalityType = PersonalityType::find($id);
        $user = User::find($id); // or however you get the user
        return view('show-bio', compact('personalityType', 'user'));
    }
}