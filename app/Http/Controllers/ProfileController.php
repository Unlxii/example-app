<?php
namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Models\PersonalityType;

class ProfileController extends Controller
{
    // Other methods...

    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        $user = $request->user()->load('bio', 'personalityType'); // Load relationships

        return view('profile.edit', [
            'user' => $user,
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $user = $request->user();
        $user->fill($request->validated());

        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        $user->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }

    /**
     * Display the form to edit the user's bio.
     */
    public function editBio(): View
    {
        $personalityTypes = PersonalityType::all();
        $user = auth()->user(); // Fetch the authenticated user

        return view('profile.show-bio', compact('personalityTypes', 'user'));
    }

    /**
     * Update the user's bio information.
     */
    public function updateBio(Request $request): RedirectResponse
    {
        $request->validate([
            'bio' => 'required|string|max:255',
            'personality_type' => 'required|exists:personality_types,id',
        ]);

        $user = auth()->user();
        $user->bio = $request->input('bio'); // Update the bio directly on the user model
        $user->personality_type_id = $request->input('personality_type');
        $user->save();

        return Redirect::route('profile.show-bio')->with('status', 'Bio updated successfully!');
    }

    /**
     * Display the user's bio information.
     */
    public function showBio(): View
    {
        $personalityTypes = PersonalityType::all();
        $user = auth()->user(); // Fetch the authenticated user


        return view('profile.show-bio', compact('personalityTypes', 'user'));
    }
}