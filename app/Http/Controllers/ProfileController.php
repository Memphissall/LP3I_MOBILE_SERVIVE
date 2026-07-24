<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
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
        $user = $request->user();
        $user->fill($request->validated());

        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        $user->save();

        // Handle profile photo upload for Pendidik
        if ($user->role === 'pendidik') {
            $pendidik = $user->pendidik;
            if ($pendidik) {
                if ($request->filled('cropped_foto')) {
                    // Get base64 string
                    $croppedData = $request->input('cropped_foto');
                    
                    // Decode base64 image data
                    $imageParts = explode(";base64,", $croppedData);
                    if (count($imageParts) === 2) {
                        $imageTypeAux = explode("image/", $imageParts[0]);
                        $imageType = $imageTypeAux[1] ?? 'jpeg';
                        $imageBase64 = base64_decode($imageParts[1]);
                        
                        // Delete old photo if it exists
                        if ($pendidik->foto) {
                            \Illuminate\Support\Facades\Storage::disk('public')->delete($pendidik->foto);
                        }
                        
                        // Define filename and path
                        $filename = 'foto_pendidik/cropped_' . time() . '.' . $imageType;
                        
                        // Save file
                        \Illuminate\Support\Facades\Storage::disk('public')->put($filename, $imageBase64);
                        
                        // Update DB
                        $pendidik->update(['foto' => $filename]);
                    }
                } elseif ($request->hasFile('foto')) {
                    $request->validate([
                        'foto' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
                    ]);
                    
                    // Delete old photo if it exists
                    if ($pendidik->foto) {
                        \Illuminate\Support\Facades\Storage::disk('public')->delete($pendidik->foto);
                    }
                    
                    // Store new photo
                    $path = $request->file('foto')->store('foto_pendidik', 'public');
                    $pendidik->update(['foto' => $path]);
                }
            }
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
