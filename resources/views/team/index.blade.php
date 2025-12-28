@extends('layouts.admin')

@section('title', 'Team Management')

@section('content')
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Our Team</li>
        </ol>
    </nav>

    <!-- Page Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2><i class="bi bi-people"></i> Team Management</h2>
            <p class="text-muted">Manage your team members</p>
        </div>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addTeamModal">
            <i class="bi bi-plus-circle"></i> Add Team Member
        </button>
    </div>

    <!-- Success Alert -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <!-- Team Members Cards -->
    @if($teamMembers->count() > 0)
        <div class="row g-4">
            @foreach($teamMembers as $member)
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="card h-100 text-center">
                        <div class="card-body">
                            <!-- Member Image -->
                            @if($member->image)
                                <img src="{{ asset('storage/' . $member->image) }}" alt="{{ $member->name }}"
                                    class="rounded-circle mb-3" style="width: 120px; height: 120px; object-fit: cover;">
                            @else
                                <div class="rounded-circle bg-primary text-white d-inline-flex align-items-center justify-content-center mb-3"
                                    style="width: 120px; height: 120px; font-size: 3rem;">
                                    {{ strtoupper(substr($member->name, 0, 1)) }}
                                </div>
                            @endif

                            <!-- Member Details -->
                            <h5 class="card-title mb-1">{{ $member->name }}</h5>
                            <p class="text-muted mb-2">{{ $member->role }}</p>

                            <!-- Status Badge -->
                            @if($member->status)
                                <span class="badge bg-success mb-3">
                                    <i class="bi bi-check-circle"></i> Active
                                </span>
                            @else
                                <span class="badge bg-danger mb-3">
                                    <i class="bi bi-x-circle"></i> Inactive
                                </span>
                            @endif

                            <!-- Action Buttons -->
                            <div class="d-flex gap-2 justify-content-center mt-3">
                                <button type="button" class="btn btn-sm btn-info" data-bs-toggle="modal"
                                    data-bs-target="#editTeamModal{{ $member->id }}">
                                    <i class="bi bi-pencil"></i> Edit
                                </button>
                                <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal"
                                    data-bs-target="#deleteTeamModal{{ $member->id }}">
                                    <i class="bi bi-trash"></i> Delete
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Edit Modal -->
                <div class="modal fade" id="editTeamModal{{ $member->id }}" tabindex="-1">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Edit Team Member</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <form action="{{ route('team.update', $member) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label for="edit_name{{ $member->id }}" class="form-label">Name *</label>
                                        <input type="text" class="form-control" id="edit_name{{ $member->id }}" name="name"
                                            value="{{ $member->name }}" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="edit_role{{ $member->id }}" class="form-label">Role *</label>
                                        <input type="text" class="form-control" id="edit_role{{ $member->id }}" name="role"
                                            value="{{ $member->role }}" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="edit_image{{ $member->id }}" class="form-label">Image</label>
                                        @if($member->image)
                                            <div class="mb-2">
                                                <img src="{{ asset('storage/' . $member->image) }}" alt="Current" class="img-thumbnail"
                                                    style="max-width: 100px;">
                                            </div>
                                        @endif
                                        <input type="file" class="form-control" id="edit_image{{ $member->id }}" name="image"
                                            accept="image/*">
                                        <small class="text-muted">Leave empty to keep current image</small>
                                    </div>
                                    <div class="mb-3">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="edit_status{{ $member->id }}"
                                                name="status" value="1" {{ $member->status ? 'checked' : '' }}>
                                            <label class="form-check-label" for="edit_status{{ $member->id }}">
                                                Active
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                    <button type="submit" class="btn btn-primary">
                                        <i class="bi bi-check-circle"></i> Update Member
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Delete Modal -->
                <div class="modal fade" id="deleteTeamModal{{ $member->id }}" tabindex="-1">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header bg-danger text-white">
                                <h5 class="modal-title">Delete Team Member</h5>
                                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                            </div>
                            <form action="{{ route('team.destroy', $member) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <div class="modal-body">
                                    <p>Are you sure you want to delete this team member?</p>
                                    <p><strong>{{ $member->name }}</strong></p>
                                    <p class="text-danger">This action cannot be undone!</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                    <button type="submit" class="btn btn-danger">
                                        <i class="bi bi-trash"></i> Delete Member
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="card">
            <div class="card-body text-center py-5">
                <i class="bi bi-people display-1 text-muted"></i>
                <p class="mt-3 text-muted">No team members found. Click "Add Team Member" to create one.</p>
            </div>
        </div>
    @endif

    <!-- Add Team Member Modal -->
    <div class="modal fade" id="addTeamModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Team Member</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form action="{{ route('team.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="name" class="form-label">Name *</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                                name="name" value="{{ old('name') }}" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="role" class="form-label">Role *</label>
                            <input type="text" class="form-control @error('role') is-invalid @enderror" id="role"
                                name="role" value="{{ old('role') }}" required>
                            @error('role')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="image" class="form-label">Image</label>
                            <input type="file" class="form-control @error('image') is-invalid @enderror" id="image"
                                name="image" accept="image/*">
                            @error('image')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="text-muted">Supported formats: JPEG, PNG, JPG, GIF (Max: 2MB)</small>
                        </div>
                        <div class="mb-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="status" name="status" value="1" checked>
                                <label class="form-check-label" for="status">
                                    Active
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-plus-circle"></i> Add Member
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        // Auto-close alerts after 5 seconds
        setTimeout(function () {
            var alerts = document.querySelectorAll('.alert');
            alerts.forEach(function (alert) {
                var bsAlert = new bootstrap.Alert(alert);
                bsAlert.close();
            });
        }, 5000);
    </script>
@endpush