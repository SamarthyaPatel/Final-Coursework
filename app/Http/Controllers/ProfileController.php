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

    /**
     * Display the user's profile.
     *
     * @param  \Illuminate\Http\Request
     * @return \Illuminate\View\View
     */
    public function displayProfile($id) 
    {
        if(!Profile::find($id)) {
            return view('create_profile');
        }

        return view('user_profile', ['id' => $id]);
    }

    /**
     * Create the user's profile.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\View\View
     */
    public function createProfile() {
        
        return view('create_profile');

    }

    /**
     * Store the user's profile.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\View\View
     */
    public function storeProfile(Request $request) 
    {

        $request->validate([
            'username'=>'required|max:20',
        ]); 

        $profile = new Profile;
        $profile->user_id = Auth::user()->id;
        $profile->username = $request->input('username');

        //If user uploaded avatar image, save it, else use default image.
        if($request->file('avatar') != NULL) {
            $image = $request->file('avatar')->getClientOriginalName();
            Storage::putFileAs('public/images', $request->file('avatar'), $image);
            $profile->avatar = $image;
        } else {
            $profile->avatar = 'avatar.jpg';
        }

        $profile->gender = $request->input('gender');
        $profile->save();

        return redirect()->route('index');
    }

    //Redirects to editing profile view
    public function editProfile($id) 
    {
        return view('profile.editProfile', ['id' => $id]);
    }

    // Updates the profile with new details
    public function updateProfile(Request $request, $id) 
    {
        $profile = Profile::find($id);
        $profile->username = $request->input('username');

        //Check whether user uploaded new avatar image, if not, use the old image
        if($request->file('avatar') != NULL) {
            $image = $request->file('avatar')->getClientOriginalName();
            Storage::putFileAs('public/images', $request->file('avatar'), $image);
            $profile->avatar = $image;
        }
        $profile->gender = $request->input('gender');
        $profile->save();

        return view('user_profile', ['id' => $id]);
    }
}
