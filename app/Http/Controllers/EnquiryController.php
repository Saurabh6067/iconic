<?php

namespace App\Http\Controllers;

use App\Models\Enquiry;
use Illuminate\Http\Request;

class EnquiryController extends Controller
{
    /**
     * Display a listing of enquiries (Admin Panel)
     */
    public function index()
    {
        $enquiries = Enquiry::latest()->get();
        return view('enquiries.index', compact('enquiries'));
    }

    /**
     * Store a new enquiry from frontend form
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'email' => 'required|email|max:255',
            'whatsapp' => 'nullable|boolean'
        ]);

        Enquiry::create([
            'name' => $validated['name'],
            'phone' => $validated['phone'],
            'email' => $validated['email'],
            'whatsapp_updates' => $request->has('whatsapp') ? true : false,
            'status' => 'new'
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Thank you! We will contact you soon.'
        ]);
    }

    /**
     * Update enquiry status
     */
    public function updateStatus(Request $request, Enquiry $enquiry)
    {
        $validated = $request->validate([
            'status' => 'required|in:new,contacted,closed'
        ]);

        $enquiry->update(['status' => $validated['status']]);

        return redirect()->route('enquiries.index')
            ->with('success', 'Enquiry status updated successfully!');
    }

    /**
     * Delete an enquiry
     */
    public function destroy(Enquiry $enquiry)
    {
        $enquiry->delete();

        return redirect()->route('enquiries.index')
            ->with('success', 'Enquiry deleted successfully!');
    }
}
