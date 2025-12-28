<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\EnquiryController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\PartnerController;
use App\Http\Controllers\NewsController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Frontend Website Route
Route::get('/', function () {
    $galleryCategories = \App\Models\GalleryCategory::with('images')
        ->where('status', true)
        ->orderBy('order')
        ->get();

    $partners = \App\Models\Partner::where('status', true)
        ->orderBy('order')
        ->get();

    $news = \App\Models\News::where('status', true)
        ->orderBy('order')
        ->limit(4)
        ->get();

    $siteSettings = \App\Models\SiteSetting::getSettings();

    return view('frontend.home', compact('galleryCategories', 'partners', 'news', 'siteSettings'));
});

// Frontend Enquiry Submission (Public - No Auth Required)
Route::post('/enquiry/submit', [EnquiryController::class, 'store'])->name('enquiry.submit');

// Authentication Routes (Login only - Register disabled)
Auth::routes(['register' => false]);

// Admin login shortcut
Route::get('/admin', function () {
    return redirect()->route('login');
});

// Protected Admin Routes
Route::middleware(['auth'])->group(function () {

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Services Management
    Route::resource('services', ServiceController::class)->except(['show', 'create', 'edit']);

    // Team Management
    Route::resource('team', TeamController::class)->except(['show', 'create', 'edit']);

    // Settings
    Route::get('/settings', [SettingController::class, 'index'])->name('settings.index');
    Route::put('/settings', [SettingController::class, 'update'])->name('settings.update');
    Route::put('/settings/site', [SettingController::class, 'updateSiteSettings'])->name('settings.site.update');

    // Enquiries Management
    Route::get('/enquiries', [EnquiryController::class, 'index'])->name('enquiries.index');
    Route::put('/enquiries/{enquiry}/status', [EnquiryController::class, 'updateStatus'])->name('enquiries.updateStatus');
    Route::delete('/enquiries/{enquiry}', [EnquiryController::class, 'destroy'])->name('enquiries.destroy');

    // Gallery Management
    Route::get('/gallery', [GalleryController::class, 'index'])->name('gallery.index');
    Route::post('/gallery/category', [GalleryController::class, 'storeCategory'])->name('gallery.storeCategory');
    Route::put('/gallery/category/{category}', [GalleryController::class, 'updateCategory'])->name('gallery.updateCategory');
    Route::delete('/gallery/category/{category}', [GalleryController::class, 'deleteCategory'])->name('gallery.deleteCategory');
    Route::get('/gallery/{category}/images', [GalleryController::class, 'showImages'])->name('gallery.images');
    Route::post('/gallery/{category}/images', [GalleryController::class, 'storeImage'])->name('gallery.storeImage');
    Route::put('/gallery/image/{image}', [GalleryController::class, 'updateImage'])->name('gallery.updateImage');
    Route::delete('/gallery/image/{image}', [GalleryController::class, 'deleteImage'])->name('gallery.deleteImage');

    // Partners Management
    Route::get('/partners', [PartnerController::class, 'index'])->name('partners.index');
    Route::post('/partners', [PartnerController::class, 'store'])->name('partners.store');
    Route::put('/partners/{partner}', [PartnerController::class, 'update'])->name('partners.update');
    Route::delete('/partners/{partner}', [PartnerController::class, 'destroy'])->name('partners.destroy');

    // News Management
    Route::get('/news', [NewsController::class, 'index'])->name('news.index');
    Route::post('/news', [NewsController::class, 'store'])->name('news.store');
    Route::put('/news/{news}', [NewsController::class, 'update'])->name('news.update');
    Route::delete('/news/{news}', [NewsController::class, 'destroy'])->name('news.destroy');
});

// Redirect /home to dashboard
Route::get('/home', function () {
    return redirect()->route('dashboard');
});
