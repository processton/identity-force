<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\JsonResponse;

class ProfileController extends Controller
{
    /**
     * Display the user's profile.
     */
    public function index(Request $request): View
    {
        return view('profile.view', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Display the user's basic profile.
     */
    public function basic(Request $request): View
    {
        return view('profile.basic', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Display the user's security form.
     */
    public function loginAndSecurity(Request $request): View
    {
        return view('profile.login_and_security', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Display the user's notifications form.
     */
    public function notifications(Request $request): View
    {
        return view('profile.notifications', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Display the user's billing and payments form.
     */
    public function billingAndPayments(Request $request): View
    {
        return view('profile.billing_and_payments', [
            'user' => $request->user(),
        ]);
    }


    /**
     * Update the user's profile picture.
     */
    public function profilePicture(Request $request): JsonResponse
    {
        $request->validate([
            'imageFile' => ['required', 'image'],
        ]);

        $request->user()->uploadProfilePicture($request->file('imageFile'));

        return response()->json([
            'status' => 'profile-picture-updated',
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
    public function update(ProfileUpdateRequest $request): RedirectResponse | JsonResponse
    {
        $user = $request->user();

        foreach ($request->validated() as $key => $value) {

            $user->__set($key, $value);
        }

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        if($request->isJson()){

            return response()->json([
                'status' => 'profile-updated',
                'data' => $request->user(),
            ]);

        }

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
}
