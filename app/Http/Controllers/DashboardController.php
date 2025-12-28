<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Enquiry;
use App\Models\GalleryCategory;
use App\Models\Partner;
use App\Models\News;

class DashboardController extends Controller
{
    /**
     * Display the dashboard
     */
    public function index()
    {
        $totalEnquiries = Enquiry::count();
        $newEnquiries = Enquiry::where('status', 'new')->count();
        $totalGalleryCategories = GalleryCategory::count();
        $totalPartners = Partner::count();
        $totalNews = News::count();

        return view('dashboard', compact(
            'totalEnquiries',
            'newEnquiries',
            'totalGalleryCategories',
            'totalPartners',
            'totalNews'
        ));
    }
}
