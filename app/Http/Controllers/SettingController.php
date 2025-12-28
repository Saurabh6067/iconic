<?php

namespace App\Http\Controllers;

use App\Models\SiteSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class SettingController extends Controller
{
    /**
     * Display the settings page
     */
    public function index()
    {
        $user = Auth::user();
        $siteSettings = SiteSetting::getSettings();
        return view('settings.index', compact('user', 'siteSettings'));
    }

    /**
     * Update user profile
     */
    public function update(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'current_password' => 'nullable|required_with:new_password',
            'new_password' => 'nullable|min:8|confirmed',
        ]);

        // Update name and email
        $user->name = $validated['name'];
        $user->email = $validated['email'];

        // Update password if provided
        if ($request->filled('new_password')) {
            if (!Hash::check($request->current_password, $user->password)) {
                return back()->withErrors(['current_password' => 'Current password is incorrect']);
            }
            $user->password = Hash::make($request->new_password);
        }

        $user->save();

        return redirect()->route('settings.index')
            ->with('success', 'Profile updated successfully!');
    }

    /**
     * Update site settings
     */
    public function updateSiteSettings(Request $request)
    {
        $validated = $request->validate([
            'mobile' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255',
            'whatsapp' => 'nullable|string|max:20',
            'whatsapp_message' => 'nullable|string',
            'facebook' => 'nullable|url|max:255',
            'instagram' => 'nullable|url|max:255',
            'pinterest' => 'nullable|url|max:255',
            'youtube' => 'nullable|url|max:255',
        ]);

        $siteSettings = SiteSetting::getSettings();
        $siteSettings->update($validated);

        return redirect()->route('settings.index')
            ->with('success', 'Site settings updated successfully!');
    }
}
