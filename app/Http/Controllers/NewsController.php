<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $news = News::orderBy('order', 'asc')->get();
        $newsCount = $news->count();
        return view('news.index', compact('news', 'newsCount'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Check if already have 4 news items
        $newsCount = News::count();
        if ($newsCount >= 4) {
            return redirect()->route('news.index')->with('error', 'Maximum 4 news items allowed!');
        }

        $validated = $request->validate([
            'title' => 'required|string',
            'icon' => 'required|string|max:10',
            'order' => 'nullable|integer',
            'status' => 'nullable|boolean'
        ]);

        $news = new News();
        $news->title = $validated['title'];
        $news->icon = $validated['icon'];
        $news->order = $validated['order'] ?? 0;
        $news->status = $request->has('status') ? true : false;
        $news->save();

        return redirect()->route('news.index')->with('success', 'News added successfully!');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, News $news)
    {
        $validated = $request->validate([
            'title' => 'required|string',
            'icon' => 'required|string|max:10',
            'order' => 'nullable|integer',
            'status' => 'nullable|boolean'
        ]);

        $news->title = $validated['title'];
        $news->icon = $validated['icon'];
        $news->order = $validated['order'] ?? 0;
        $news->status = $request->has('status') ? true : false;
        $news->save();

        return redirect()->route('news.index')->with('success', 'News updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(News $news)
    {
        $news->delete();
        return redirect()->route('news.index')->with('success', 'News deleted successfully!');
    }
}
