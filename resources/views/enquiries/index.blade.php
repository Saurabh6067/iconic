@extends('layouts.admin')

@section('title', 'Enquiries Management')

@section('content')
    <div class="container-fluid">
        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active">Enquiries</li>
            </ol>
        </nav>

        <!-- Success Message -->
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <!-- Enquiries Card -->
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0"><i class="bi bi-envelope me-2"></i>All Enquiries</h5>
                <span class="badge bg-primary">{{ $enquiries->count() }} Total</span>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Phone</th>
                                <th>Email</th>
                                <th>WhatsApp</th>
                                <th>Status</th>
                                <th>Date</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($enquiries as $enquiry)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td><strong>{{ $enquiry->name }}</strong></td>
                                    <td>
                                        <a href="tel:{{ $enquiry->phone }}" class="text-decoration-none">
                                            <i class="bi bi-telephone"></i> {{ $enquiry->phone }}
                                        </a>
                                    </td>
                                    <td>
                                        <a href="mailto:{{ $enquiry->email }}" class="text-decoration-none">
                                            {{ $enquiry->email }}
                                        </a>
                                    </td>
                                    <td>
                                        @if($enquiry->whatsapp_updates)
                                            <span class="badge bg-success">
                                                <i class="bi bi-check-circle"></i> Yes
                                            </span>
                                        @else
                                            <span class="badge bg-secondary">No</span>
                                        @endif
                                    </td>
                                    <td>
                                        <form action="{{ route('enquiries.updateStatus', $enquiry) }}" method="POST"
                                            class="d-inline">
                                            @csrf
                                            @method('PUT')
                                            <select name="status" class="form-select form-select-sm"
                                                onchange="this.form.submit()" style="width: auto;">
                                                <option value="new" {{ $enquiry->status == 'new' ? 'selected' : '' }}>New</option>
                                                <option value="contacted" {{ $enquiry->status == 'contacted' ? 'selected' : '' }}>
                                                    Contacted</option>
                                                <option value="closed" {{ $enquiry->status == 'closed' ? 'selected' : '' }}>Closed
                                                </option>
                                            </select>
                                        </form>
                                    </td>
                                    <td>
                                        <small class="text-muted">
                                            {{ $enquiry->created_at->format('d M Y') }}<br>
                                            {{ $enquiry->created_at->format('h:i A') }}
                                        </small>
                                    </td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            @if($enquiry->whatsapp_updates)
                                                <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $enquiry->phone) }}?text=Hi {{ $enquiry->name }}, Thank you for your enquiry. How can we help you?"
                                                    class="btn btn-sm btn-success" target="_blank" title="WhatsApp">
                                                    <i class="bi bi-whatsapp"></i>
                                                </a>
                                            @endif
                                            <form action="{{ route('enquiries.destroy', $enquiry) }}" method="POST"
                                                onsubmit="return confirm('Are you sure you want to delete this enquiry?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger" title="Delete">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center py-4">
                                        <i class="bi bi-inbox" style="font-size: 3rem; color: #ccc;"></i>
                                        <p class="text-muted mt-2">No enquiries yet</p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    @push('styles')
        <style>
            .badge {
                font-weight: 500;
            }

            .table td {
                vertical-align: middle;
            }

            .btn-group form {
                display: inline;
            }
        </style>
    @endpush
@endsection