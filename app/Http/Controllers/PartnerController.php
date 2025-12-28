<?php

namespace App\Http\Controllers;

use App\Models\Partner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PartnerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $partners = Partner::orderBy('order', 'asc')->get();
        return view('partners.index', compact('partners'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp,svg|max:5120',
            'order' => 'nullable|integer',
            'status' => 'nullable|boolean'
        ]);

        $partner = new Partner();
        $partner->name = $validated['name'];
        $partner->order = $validated['order'] ?? 0;
        $partner->status = $request->has('status') ? true : false;

        if ($request->hasFile('logo')) {
            $logo = $request->file('logo');
            $logoName = time() . '_' . $logo->getClientOriginalName();
            $logo->storeAs('partners', $logoName, 'public');
            $partner->logo = 'partners/' . $logoName;
        }

        $partner->save();

        return redirect()->route('partners.index')->with('success', 'Partner added successfully!');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Partner $partner)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp,svg|max:5120',
            'order' => 'nullable|integer',
            'status' => 'nullable|boolean'
        ]);

        $partner->name = $validated['name'];
        $partner->order = $validated['order'] ?? 0;
        $partner->status = $request->has('status') ? true : false;

        if ($request->hasFile('logo')) {
            // Delete old logo
            if ($partner->logo && Storage::disk('public')->exists($partner->logo)) {
                Storage::disk('public')->delete($partner->logo);
            }

            $logo = $request->file('logo');
            $logoName = time() . '_' . $logo->getClientOriginalName();
            $logo->storeAs('partners', $logoName, 'public');
            $partner->logo = 'partners/' . $logoName;
        }

        $partner->save();

        return redirect()->route('partners.index')->with('success', 'Partner updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Partner $partner)
    {
        // Delete logo
        if ($partner->logo && Storage::disk('public')->exists($partner->logo)) {
            Storage::disk('public')->delete($partner->logo);
        }

        $partner->delete();

        return redirect()->route('partners.index')->with('success', 'Partner deleted successfully!');
    }
}
