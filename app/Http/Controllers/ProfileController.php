<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use App\Models\Profile;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\View\View
     */
    public function edit(Request $request)
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     *
     * @param  \App\Http\Requests\ProfileUpdateRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(ProfileUpdateRequest $request)
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request)
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current-password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }

    public function displayProfile($id) 
    {

        return view('user_profile', ['id' => $id]);
    }

    public function createProfile() {
        if(Profile::find(Auth::user()->id)) {
            return redirect()->route('getProfile', ['id' => Auth::user()->id]);
        } else {
            return view('create_profile');
        }

    }

    public function storeProfile(Request $request) 
    {
        $profile = new Profile;
        $profile->user_id = Auth::user()->id;
        $profile->username = $request->input('username');
        if($request->file('avatar') != NULL) {
            $image = $request->file('avatar')->getClientOriginalName();
            Storage::putFileAs('public/images', $request->file('avatar'), $image);
            $profile->avatar = $image;
        }
        $profile->gender = $request->input('gender');
        $profile->save();
    }
}
