<?php

namespace App\Http\Controllers;

use App\Models\TeamMember;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TeamController extends Controller
{
    /**
     * Display a listing of the team members.
     */
    public function index()
    {
        $teamMembers = TeamMember::latest()->get();
        return view('team.index', compact('teamMembers'));
    }

    /**
     * Store a newly created team member in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'role' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'boolean'
        ]);

        // Handle image upload
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('team', 'public');
            $validated['image'] = $imagePath;
        }

        TeamMember::create($validated);

        return redirect()->route('team.index')
            ->with('success', 'Team member added successfully!');
    }

    /**
     * Update the specified team member in storage.
     */
    public function update(Request $request, TeamMember $team)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'role' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'boolean'
        ]);

        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($team->image && Storage::disk('public')->exists($team->image)) {
                Storage::disk('public')->delete($team->image);
            }
            $imagePath = $request->file('image')->store('team', 'public');
            $validated['image'] = $imagePath;
        }

        $team->update($validated);

        return redirect()->route('team.index')
            ->with('success', 'Team member updated successfully!');
    }

    /**
     * Remove the specified team member from storage.
     */
    public function destroy(TeamMember $team)
    {
        // Delete image if exists
        if ($team->image && Storage::disk('public')->exists($team->image)) {
            Storage::disk('public')->delete($team->image);
        }

        $team->delete();

        return redirect()->route('team.index')
            ->with('success', 'Team member deleted successfully!');
    }
}
