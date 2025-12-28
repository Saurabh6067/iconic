@extends('layouts.admin')

@section('title', 'Gallery Images - ' . $category->name)

@section('content')
<div class="container-fluid">
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('gallery.index') }}">Gallery</a></li>
            <li class="breadcrumb-item active">{{ $category->name }}</li>
        </ol>
    </nav>

    <!-- Success Message -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <!-- Gallery Images Card -->
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">
                <i class="bi bi-images me-2"></i>{{ $category->name }} Gallery
            </h5>
            <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#addImageModal">
                <i class="bi bi-plus-circle"></i> Add Image
            </button>
        </div>
        <div class="card-body">
            <div class="row g-4">
                @forelse($images as $image)
                    <div class="col-md-6 col-lg-3">
                        <div class="card h-100 shadow-sm">
                            <img src="{{ asset('storage/' . $image->image) }}" class="card-img-top" alt="{{ $image->title }}" 
                                 style="height: 200px; object-fit: cover;">
                            <div class="card-body">
                                <h6 class="card-title">{{ $image->title }}</h6>
                                <div class="d-flex justify-content-between align-items-center">
                                    <small class="text-muted">Order: {{ $image->order }}</small>
                                    <span class="badge {{ $image->status ? 'bg-success' : 'bg-secondary' }}">
                                        {{ $image->status ? 'Active' : 'Inactive' }}
                                    </span>
                                </div>
                            </div>
                            <div class="card-footer bg-white border-0">
                                <div class="d-flex gap-2">
                                    <button class="btn btn-sm btn-warning flex-fill" data-bs-toggle="modal" 
                                            data-bs-target="#editImageModal{{ $image->id }}">
                                        <i class="bi bi-pencil"></i> Edit
                                    </button>
                                    <form action="{{ route('gallery.deleteImage', $image) }}" method="POST" 
                                          onsubmit="return confirm('Delete this image?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Edit Image Modal -->
                    <div class="modal fade" id="editImageModal{{ $image->id }}" tabindex="-1">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <form action="{{ route('gallery.updateImage', $image) }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="modal-header">
                                        <h5 class="modal-title">Edit Image</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <img src="{{ asset('storage/' . $image->image) }}" class="img-fluid mb-2" alt="{{ $image->title }}">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Image Title *</label>
                                            <input type="text" name="title" class="form-control" value="{{ $image->title }}" required>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Replace Image</label>
                                            <input type="file" name="image" class="form-control" accept="image/*">
                                            <small class="text-muted">Leave empty to keep current image</small>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Display Order</label>
                                            <input type="number" name="order" class="form-control" value="{{ $image->order }}">
                                        </div>
                                        <div class="mb-3">
                                            <div class="form-check form-switch">
                                                <input type="checkbox" name="status" class="form-check-input" value="1" 
                                                       {{ $image->status ? 'checked' : '' }}>
                                                <label class="form-check-label">Active</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                        <button type="submit" class="btn btn-primary">Update Image</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="text-center py-5">
                            <i class="bi bi-image" style="font-size: 4rem; color: #ccc;"></i>
                            <p class="text-muted mt-3">No images in this gallery yet. Add your first image!</p>
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</div>

<!-- Add Image Modal -->
<div class="modal fade" id="addImageModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('gallery.storeImage', $category) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Add New Image</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Image Title *</label>
                        <input type="text" name="title" class="form-control" required placeholder="e.g., Modern Kitchen Design">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Upload Image *</label>
                        <input type="file" name="image" class="form-control" accept="image/*" required>
                        <small class="text-muted">Max size: 5MB. Formats: JPG, PNG, GIF, WEBP</small>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Display Order</label>
                        <input type="number" name="order" class="form-control" value="0">
                    </div>
                    <div class="mb-3">
                        <div class="form-check form-switch">
                            <input type="checkbox" name="status" class="form-check-input" value="1" checked>
                            <label class="form-check-label">Active</label>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Add Image</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
