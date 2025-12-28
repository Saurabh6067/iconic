@extends('layouts.admin')

@section('title', 'Dashboard - Admin Panel')

@section('content')
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">
                <i class="bi bi-house-door"></i> Dashboard
            </li>
        </ol>
    </nav>

    <!-- Welcome Message -->
    <div class="mb-4">
        <h2>Welcome back, {{ Auth::user()->name }}! 👋</h2>
        <p class="text-muted">Here's what's happening with your admin panel today.</p>
    </div>

    <!-- Stats Cards -->
    <div class="row g-4 mb-4">
        <!-- Total Enquiries Card -->
        <div class="col-xl-3 col-md-6">
            <div class="card stats-card primary">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <p class="text-muted mb-1">Total Enquiries</p>
                            <h3 class="mb-0">{{ $totalEnquiries }}</h3>
                            <small class="text-warning">
                                <i class="bi bi-exclamation-circle"></i> {{ $newEnquiries }} New
                            </small>
                        </div>
                        <div class="text-primary" style="font-size: 3rem; opacity: 0.3;">
                            <i class="bi bi-envelope"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Gallery Categories Card -->
        <div class="col-xl-3 col-md-6">
            <div class="card stats-card success">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <p class="text-muted mb-1">Gallery Categories</p>
                            <h3 class="mb-0">{{ $totalGalleryCategories }}</h3>
                            <small class="text-success">
                                <i class="bi bi-check-circle"></i> Active
                            </small>
                        </div>
                        <div class="text-success" style="font-size: 3rem; opacity: 0.3;">
                            <i class="bi bi-images"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Partners Card -->
        <div class="col-xl-3 col-md-6">
            <div class="card stats-card warning">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <p class="text-muted mb-1">Partners</p>
                            <h3 class="mb-0">{{ $totalPartners }}</h3>
                            <small class="text-success">
                                <i class="bi bi-check-circle"></i> Active
                            </small>
                        </div>
                        <div class="text-warning" style="font-size: 3rem; opacity: 0.3;">
                            <i class="bi bi-building"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- News Card -->
        <div class="col-xl-3 col-md-6">
            <div class="card stats-card info">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <p class="text-muted mb-1">News Items</p>
                            <h3 class="mb-0">{{ $totalNews }}</h3>
                            <small class="text-info">
                                <i class="bi bi-info-circle"></i> Max 4
                            </small>
                        </div>
                        <div class="text-info" style="font-size: 3rem; opacity: 0.3;">
                            <i class="bi bi-newspaper"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="row g-4 mb-4">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0"><i class="bi bi-lightning me-2"></i>Quick Actions</h5>
                </div>
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-md-3">
                            <a href="{{ route('enquiries.index') }}" class="btn btn-outline-primary w-100">
                                <i class="bi bi-envelope me-2"></i>View Enquiries
                            </a>
                        </div>
                        <div class="col-md-3">
                            <a href="{{ route('gallery.index') }}" class="btn btn-outline-success w-100">
                                <i class="bi bi-images me-2"></i>Manage Gallery
                            </a>
                        </div>
                        <div class="col-md-3">
                            <a href="{{ route('partners.index') }}" class="btn btn-outline-warning w-100">
                                <i class="bi bi-building me-2"></i>Manage Partners
                            </a>
                        </div>
                        <div class="col-md-3">
                            <a href="{{ route('news.index') }}" class="btn btn-outline-info w-100">
                                <i class="bi bi-newspaper me-2"></i>Manage News
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Quick Actions -->
    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0"><i class="bi bi-lightning"></i> Quick Actions</h5>
                </div>
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-md-4">
                            <a href="{{ route('gallery.index') }}" class="btn btn-outline-primary w-100 py-3">
                                <i class="bi bi-images fs-4 d-block mb-2"></i>
                                Manage Gallery
                            </a>
                        </div>
                        <div class="col-md-4">
                            <a href="{{ route('partners.index') }}" class="btn btn-outline-warning w-100 py-3">
                                <i class="bi bi-building fs-4 d-block mb-2"></i>
                                Manage Partners
                            </a>
                        </div>
                        <div class="col-md-4">
                            <a href="{{ route('settings.index') }}" class="btn btn-outline-info w-100 py-3">
                                <i class="bi bi-sliders fs-4 d-block mb-2"></i>
                                Settings
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0"><i class="bi bi-info-circle"></i> System Info</h5>
                </div>
                <div class="card-body">
                    <ul class="list-unstyled mb-0">
                        <li class="mb-2">
                            <i class="bi bi-calendar text-primary"></i>
                            <strong>Date:</strong> {{ date('F d, Y') }}
                        </li>
                        <li class="mb-2">
                            <i class="bi bi-clock text-success"></i>
                            <strong>Time:</strong> {{ date('h:i A') }}
                        </li>
                        <li class="mb-2">
                            <i class="bi bi-person text-warning"></i>
                            <strong>User:</strong> {{ Auth::user()->name }}
                        </li>
                        <li class="mb-0">
                            <i class="bi bi-envelope text-info"></i>
                            <strong>Email:</strong> {{ Auth::user()->email }}
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection