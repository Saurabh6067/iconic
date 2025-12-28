@extends('layouts.admin')

@section('title', 'Gallery Management')

@section('content')
<div class="container-fluid">
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active">Gallery</li>
        </ol>
    </nav>

    <!-- Success Message -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <!-- Gallery Categories Card -->
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0"><i class="bi bi-images me-2"></i>Gallery Categories</h5>
            <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#addCategoryModal">
                <i class="bi bi-plus-circle"></i> Add Category
            </button>
        </div>
        <div class="card-body">
            <div class="row g-4">
                @forelse($categories as $category)
                    <div class="col-md-6 col-lg-4">
                        <div class="card h-100 shadow-sm">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-start mb-3">
                                    <div>
                                        <h5 class="card-title mb-1">
                                            @if($category->icon)
                                                <i class="{{ $category->icon }}"></i>
                                            @endif
                                            {{ $category->name }}
                                        </h5>
                                        <small class="text-muted">{{ $category->images_count }} images</small>
                                    </div>
                                    <span class="badge {{ $category->status ? 'bg-success' : 'bg-secondary' }}">
                                        {{ $category->status ? 'Active' : 'Inactive' }}
                                    </span>
                                </div>
                                <div class="d-flex gap-2">
                                    <a href="{{ route('gallery.images', $category) }}" class="btn btn-sm btn-info flex-fill">
                                        <i class="bi bi-images"></i> Manage Images
                                    </a>
                                    <button class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#editCategoryModal{{ $category->id }}">
                                        <i class="bi bi-pencil"></i>
                                    </button>
                                    <form action="{{ route('gallery.deleteCategory', $category) }}" method="POST" 
                                          onsubmit="return confirm('Delete this category and all its images?')">
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

                    <!-- Edit Category Modal -->
                    <div class="modal fade" id="editCategoryModal{{ $category->id }}" tabindex="-1">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <form action="{{ route('gallery.updateCategory', $category) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="modal-header">
                                        <h5 class="modal-title">Edit Category</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label class="form-label">Category Name *</label>
                                            <input type="text" name="name" class="form-control" value="{{ $category->name }}" required>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">FontAwesome Icon Class</label>
                                            <input type="text" name="icon" class="form-control" value="{{ $category->icon }}" 
                                                   placeholder="fas fa-utensils">
                                            <small class="text-muted">Example: fas fa-utensils, fas fa-couch, etc.</small>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Display Order</label>
                                            <input type="number" name="order" class="form-control" value="{{ $category->order }}">
                                        </div>
                                        <div class="mb-3">
                                            <div class="form-check form-switch">
                                                <input type="checkbox" name="status" class="form-check-input" value="1" 
                                                       {{ $category->status ? 'checked' : '' }}>
                                                <label class="form-check-label">Active</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                        <button type="submit" class="btn btn-primary">Update Category</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="text-center py-5">
                            <i class="bi bi-images" style="font-size: 4rem; color: #ccc;"></i>
                            <p class="text-muted mt-3">No gallery categories yet. Add your first category!</p>
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</div>

<!-- Add Category Modal -->
<div class="modal fade" id="addCategoryModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('gallery.storeCategory') }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Add New Category</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Category Name *</label>
                        <input type="text" name="name" class="form-control" required placeholder="e.g., Kitchen, Bedroom">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">FontAwesome Icon Class</label>
                        <input type="text" name="icon" class="form-control" placeholder="fas fa-utensils">
                        <small class="text-muted">Visit <a href="https://fontawesome.com/icons" target="_blank">FontAwesome</a> for icons</small>
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
                    <button type="submit" class="btn btn-primary">Add Category</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
