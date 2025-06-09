<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile.
     */
    public function show(Request $request): View
    {
        return view('profile.profile', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $validated = $request->validated();
        
        Log::info('Profile update validated data:', $validated);

        if ($request->hasFile('photo')) {
            Log::info('Photo file detected');
            
            // Delete old photo if exists
            if ($request->user()->photo) {
                Log::info('Deleting old photo:', ['path' => $request->user()->photo]);
                Storage::disk('public')->delete($request->user()->photo);
            }

            // Store new photo
            $photo = $request->file('photo');
            $photoName = time() . '_' . $photo->getClientOriginalName();
            Log::info('Storing new photo:', ['name' => $photoName]);
            
            $path = $photo->storeAs('profile-photos', $photoName, 'public');
            Log::info('Photo stored at:', ['path' => $path]);
            
            $validated['photo'] = 'profile-photos/' . $photoName;
        }

        $request->user()->fill($validated);

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();
        Log::info('User updated:', $request->user()->toArray());

        return Redirect::route('profile')->with('status', 'profile-updated');
    }
} 