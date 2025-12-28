<?php

namespace App\Http\Controllers;

use App\Models\GalleryCategory;
use App\Models\GalleryImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class GalleryController extends Controller
{
    /**
     * Display gallery management page
     */
    public function index()
    {
        $categories = GalleryCategory::withCount('images')->orderBy('order')->get();
        return view('gallery.index', compact('categories'));
    }

    /**
     * Store a new gallery category
     */
    public function storeCategory(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'icon' => 'nullable|string|max:255',
            'order' => 'nullable|integer',
            'status' => 'boolean'
        ]);

        $validated['slug'] = Str::slug($validated['name']);

        GalleryCategory::create($validated);

        return redirect()->route('gallery.index')
            ->with('success', 'Gallery category created successfully!');
    }

    /**
     * Update gallery category
     */
    public function updateCategory(Request $request, GalleryCategory $category)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'icon' => 'nullable|string|max:255',
            'order' => 'nullable|integer',
            'status' => 'boolean'
        ]);

        $validated['slug'] = Str::slug($validated['name']);

        $category->update($validated);

        return redirect()->route('gallery.index')
            ->with('success', 'Gallery category updated successfully!');
    }

    /**
     * Delete gallery category
     */
    public function deleteCategory(GalleryCategory $category)
    {
        // Delete all images in this category
        foreach ($category->images as $image) {
            if (Storage::disk('public')->exists($image->image)) {
                Storage::disk('public')->delete($image->image);
            }
        }

        $category->delete();

        return redirect()->route('gallery.index')
            ->with('success', 'Gallery category deleted successfully!');
    }

    /**
     * Show images for a category
     */
    public function showImages(GalleryCategory $category)
    {
        $images = $category->images()->orderBy('order')->get();
        return view('gallery.images', compact('category', 'images'));
    }

    /**
     * Store a new gallery image
     */
    public function storeImage(Request $request, GalleryCategory $category)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'order' => 'nullable|integer',
            'status' => 'boolean'
        ]);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('gallery', 'public');
            $validated['image'] = $imagePath;
        }

        $validated['gallery_category_id'] = $category->id;

        GalleryImage::create($validated);

        return redirect()->route('gallery.images', $category)
            ->with('success', 'Gallery image added successfully!');
    }

    /**
     * Update gallery image
     */
    public function updateImage(Request $request, GalleryImage $image)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'order' => 'nullable|integer',
            'status' => 'boolean'
        ]);

        if ($request->hasFile('image')) {
            // Delete old image
            if (Storage::disk('public')->exists($image->image)) {
                Storage::disk('public')->delete($image->image);
            }
            $imagePath = $request->file('image')->store('gallery', 'public');
            $validated['image'] = $imagePath;
        }

        $image->update($validated);

        return redirect()->route('gallery.images', $image->category)
            ->with('success', 'Gallery image updated successfully!');
    }

    /**
     * Delete gallery image
     */
    public function deleteImage(GalleryImage $image)
    {
        $category = $image->category;

        if (Storage::disk('public')->exists($image->image)) {
            Storage::disk('public')->delete($image->image);
        }

        $image->delete();

        return redirect()->route('gallery.images', $category)
            ->with('success', 'Gallery image deleted successfully!');
    }
}
