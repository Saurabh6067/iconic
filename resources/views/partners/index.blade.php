@extends('layouts.admin')

@section('content')
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="h3 mb-0">Partners Management</h1>
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addPartnerModal">
                <i class="bi bi-plus-circle"></i> Add Partner
            </button>
        </div>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="row">
            @forelse($partners as $partner)
                <div class="col-md-3 mb-4">
                    <div class="card h-100">
                        @if($partner->logo)
                            <img src="{{ asset('storage/' . $partner->logo) }}" class="card-img-top" alt="{{ $partner->name }}"
                                style="height: 150px; object-fit: contain; padding: 15px; background: #f8f9fa;">
                        @else
                            <div class="card-img-top d-flex align-items-center justify-content-center"
                                style="height: 150px; background: #f8f9fa;">
                                <i class="bi bi-image" style="font-size: 3rem; color: #dee2e6;"></i>
                            </div>
                        @endif
                        <div class="card-body">
                            <h5 class="card-title">{{ $partner->name }}</h5>
                            <p class="card-text">
                                <small class="text-muted">Order: {{ $partner->order }}</small><br>
                                <span class="badge bg-{{ $partner->status ? 'success' : 'secondary' }}">
                                    {{ $partner->status ? 'Active' : 'Inactive' }}
                                </span>
                            </p>
                            <div class="d-flex gap-2">
                                <button class="btn btn-sm btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#editPartnerModal{{ $partner->id }}">
                                    <i class="bi bi-pencil"></i> Edit
                                </button>
                                <form action="{{ route('partners.destroy', $partner->id) }}" method="POST"
                                    onsubmit="return confirm('Are you sure you want to delete this partner?');"
                                    class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">
                                        <i class="bi bi-trash"></i> Delete
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Edit Partner Modal -->
                <div class="modal fade" id="editPartnerModal{{ $partner->id }}" tabindex="-1">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Edit Partner</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <form action="{{ route('partners.update', $partner->id) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label for="editName{{ $partner->id }}" class="form-label">Partner Name *</label>
                                        <input type="text" class="form-control" id="editName{{ $partner->id }}" name="name"
                                            value="{{ $partner->name }}" required>
                                    </div>

                                    <div class="mb-3">
                                        <label for="editLogo{{ $partner->id }}" class="form-label">Partner Logo</label>
                                        @if($partner->logo)
                                            <div class="mb-2">
                                                <img src="{{ asset('storage/' . $partner->logo) }}" alt="{{ $partner->name }}"
                                                    style="max-height: 100px; object-fit: contain;">
                                            </div>
                                        @endif
                                        <input type="file" class="form-control" id="editLogo{{ $partner->id }}" name="logo"
                                            accept="image/*">
                                        <small class="text-muted">Leave empty to keep current logo</small>
                                    </div>

                                    <div class="mb-3">
                                        <label for="editOrder{{ $partner->id }}" class="form-label">Display Order</label>
                                        <input type="number" class="form-control" id="editOrder{{ $partner->id }}" name="order"
                                            value="{{ $partner->order }}" min="0">
                                    </div>

                                    <div class="mb-3 form-check">
                                        <input type="checkbox" class="form-check-input" id="editStatus{{ $partner->id }}"
                                            name="status" value="1" {{ $partner->status ? 'checked' : '' }}>
                                        <label class="form-check-label" for="editStatus{{ $partner->id }}">
                                            Active
                                        </label>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Update Partner</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="alert alert-info">
                        <i class="bi bi-info-circle"></i> No partners added yet. Click "Add Partner" to get started.
                    </div>
                </div>
            @endforelse
        </div>
    </div>

    <!-- Add Partner Modal -->
    <div class="modal fade" id="addPartnerModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add New Partner</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form action="{{ route('partners.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="name" class="form-label">Partner Name *</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>

                        <div class="mb-3">
                            <label for="logo" class="form-label">Partner Logo</label>
                            <input type="file" class="form-control" id="logo" name="logo" accept="image/*">
                            <small class="text-muted">Supported: JPEG, PNG, JPG, GIF, WebP, SVG (Max: 5MB)</small>
                        </div>

                        <div class="mb-3">
                            <label for="order" class="form-label">Display Order</label>
                            <input type="number" class="form-control" id="order" name="order" value="0" min="0">
                            <small class="text-muted">Lower numbers appear first</small>
                        </div>

                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" id="status" name="status" value="1" checked>
                            <label class="form-check-label" for="status">
                                Active
                            </label>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Add Partner</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection