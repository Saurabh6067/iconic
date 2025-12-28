@extends('layouts.admin')

@section('title', 'Settings')

@section('content')
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Settings</li>
        </ol>
    </nav>

    <!-- Page Header -->
    <div class="mb-4">
        <h2><i class="bi bi-sliders"></i> Settings</h2>
        <p class="text-muted">Manage your account and site settings</p>
    </div>

    <!-- Success Alert -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <!-- Errors Alert -->
    @if($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong><i class="bi bi-exclamation-triangle"></i> Oops! Something went wrong:</strong>
            <ul class="mb-0 mt-2">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <!-- Tabs Navigation -->
    <ul class="nav nav-tabs mb-4" id="settingsTabs" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button"
                role="tab">
                <i class="bi bi-person-circle"></i> Profile Settings
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="site-tab" data-bs-toggle="tab" data-bs-target="#site" type="button" role="tab">
                <i class="bi bi-globe"></i> Site Settings
            </button>
        </li>
    </ul>

    <!-- Tab Content -->
    <div class="tab-content" id="settingsTabContent">
        <!-- Profile Settings Tab -->
        <div class="tab-pane fade show active" id="profile" role="tabpanel">
            <div class="row">
                <!-- Profile Settings Card -->
                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="mb-0"><i class="bi bi-person-circle"></i> Profile Information</h5>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('settings.update') }}" method="POST">
                                @csrf
                                @method('PUT')

                                <!-- Name -->
                                <div class="mb-4">
                                    <label for="name" class="form-label">
                                        <i class="bi bi-person"></i> Full Name *
                                    </label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                                        name="name" value="{{ old('name', $user->name) }}" required>
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Email -->
                                <div class="mb-4">
                                    <label for="email" class="form-label">
                                        <i class="bi bi-envelope"></i> Email Address *
                                    </label>
                                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email"
                                        name="email" value="{{ old('email', $user->email) }}" required>
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <hr class="my-4">

                                <h6 class="mb-3"><i class="bi bi-key"></i> Change Password</h6>
                                <p class="text-muted small">Leave blank if you don't want to change your password</p>

                                <!-- Current Password -->
                                <div class="mb-3">
                                    <label for="current_password" class="form-label">
                                        <i class="bi bi-lock"></i> Current Password
                                    </label>
                                    <input type="password"
                                        class="form-control @error('current_password') is-invalid @enderror"
                                        id="current_password" name="current_password" placeholder="Enter current password">
                                    @error('current_password')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- New Password -->
                                <div class="mb-3">
                                    <label for="new_password" class="form-label">
                                        <i class="bi bi-lock-fill"></i> New Password
                                    </label>
                                    <input type="password" class="form-control @error('new_password') is-invalid @enderror"
                                        id="new_password" name="new_password" placeholder="Enter new password">
                                    @error('new_password')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <small class="text-muted">Minimum 8 characters</small>
                                </div>

                                <!-- Confirm New Password -->
                                <div class="mb-4">
                                    <label for="new_password_confirmation" class="form-label">
                                        <i class="bi bi-lock-fill"></i> Confirm New Password
                                    </label>
                                    <input type="password" class="form-control" id="new_password_confirmation"
                                        name="new_password_confirmation" placeholder="Confirm new password">
                                </div>

                                <!-- Submit Button -->
                                <div class="d-flex gap-2">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="bi bi-check-circle"></i> Save Changes
                                    </button>
                                    <a href="{{ route('dashboard') }}" class="btn btn-secondary">
                                        <i class="bi bi-x-circle"></i> Cancel
                                    </a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Account Information Card -->
                <div class="col-lg-4">
                    <div class="card mb-4">
                        <div class="card-header">
                            <h5 class="mb-0"><i class="bi bi-info-circle"></i> Account Info</h5>
                        </div>
                        <div class="card-body">
                            <ul class="list-unstyled mb-0">
                                <li class="mb-3">
                                    <small class="text-muted d-block">Account Created</small>
                                    <strong>{{ $user->created_at->format('M d, Y') }}</strong>
                                </li>
                                <li class="mb-3">
                                    <small class="text-muted d-block">Last Updated</small>
                                    <strong>{{ $user->updated_at->format('M d, Y') }}</strong>
                                </li>
                                <li class="mb-0">
                                    <small class="text-muted d-block">Account Status</small>
                                    <span class="badge bg-success">
                                        <i class="bi bi-check-circle"></i> Active
                                    </span>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header">
                            <h5 class="mb-0"><i class="bi bi-shield-check"></i> Security Tips</h5>
                        </div>
                        <div class="card-body">
                            <ul class="small mb-0">
                                <li class="mb-2">Use a strong, unique password</li>
                                <li class="mb-2">Never share your password</li>
                                <li class="mb-2">Change password regularly</li>
                                <li class="mb-0">Use a password manager</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Site Settings Tab -->
        <div class="tab-pane fade" id="site" role="tabpanel">
            <div class="row">
                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="mb-0"><i class="bi bi-globe"></i> Site Settings</h5>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('settings.site.update') }}" method="POST">
                                @csrf
                                @method('PUT')

                                <h6 class="mb-3"><i class="bi bi-telephone"></i> Contact Information</h6>

                                <!-- Mobile Number -->
                                <div class="mb-3">
                                    <label for="mobile" class="form-label">Mobile Number</label>
                                    <input type="text" class="form-control" id="mobile" name="mobile"
                                        value="{{ old('mobile', $siteSettings->mobile) }}" placeholder="+91 9876543210">
                                </div>

                                <!-- Email -->
                                <div class="mb-3">
                                    <label for="site_email" class="form-label">Email Address</label>
                                    <input type="email" class="form-control" id="site_email" name="email"
                                        value="{{ old('email', $siteSettings->email) }}" placeholder="contact@example.com">
                                </div>

                                <!-- WhatsApp -->
                                <div class="mb-3">
                                    <label for="whatsapp" class="form-label">WhatsApp Number</label>
                                    <input type="text" class="form-control" id="whatsapp" name="whatsapp"
                                        value="{{ old('whatsapp', $siteSettings->whatsapp) }}" placeholder="+91 9876543210">
                                    <small class="text-muted">Include country code (e.g., +91 for India)</small>
                                </div>

                                <!-- WhatsApp Message -->
                                <div class="mb-4">
                                    <label for="whatsapp_message" class="form-label">WhatsApp Default Message</label>
                                    <textarea class="form-control" id="whatsapp_message" name="whatsapp_message" rows="3"
                                        placeholder="Hi, I'm interested in your services...">{{ old('whatsapp_message', $siteSettings->whatsapp_message) }}</textarea>
                                    <small class="text-muted">This message will be pre-filled when users click WhatsApp
                                        button</small>
                                </div>

                                <hr class="my-4">

                                <h6 class="mb-3"><i class="bi bi-share"></i> Social Media Links</h6>

                                <!-- Facebook -->
                                <div class="mb-3">
                                    <label for="facebook" class="form-label">
                                        <i class="bi bi-facebook"></i> Facebook URL
                                    </label>
                                    <input type="url" class="form-control" id="facebook" name="facebook"
                                        value="{{ old('facebook', $siteSettings->facebook) }}"
                                        placeholder="https://facebook.com/yourpage">
                                </div>

                                <!-- Instagram -->
                                <div class="mb-3">
                                    <label for="instagram" class="form-label">
                                        <i class="bi bi-instagram"></i> Instagram URL
                                    </label>
                                    <input type="url" class="form-control" id="instagram" name="instagram"
                                        value="{{ old('instagram', $siteSettings->instagram) }}"
                                        placeholder="https://instagram.com/yourprofile">
                                </div>

                                <!-- Pinterest -->
                                <div class="mb-3">
                                    <label for="pinterest" class="form-label">
                                        <i class="bi bi-pinterest"></i> Pinterest URL
                                    </label>
                                    <input type="url" class="form-control" id="pinterest" name="pinterest"
                                        value="{{ old('pinterest', $siteSettings->pinterest) }}"
                                        placeholder="https://pinterest.com/yourprofile">
                                </div>

                                <!-- YouTube -->
                                <div class="mb-4">
                                    <label for="youtube" class="form-label">
                                        <i class="bi bi-youtube"></i> YouTube URL
                                    </label>
                                    <input type="url" class="form-control" id="youtube" name="youtube"
                                        value="{{ old('youtube', $siteSettings->youtube) }}"
                                        placeholder="https://youtube.com/@yourchannel">
                                </div>

                                <!-- Submit Button -->
                                <div class="d-flex gap-2">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="bi bi-check-circle"></i> Save Settings
                                    </button>
                                    <a href="{{ route('dashboard') }}" class="btn btn-secondary">
                                        <i class="bi bi-x-circle"></i> Cancel
                                    </a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="mb-0"><i class="bi bi-info-circle"></i> Site Settings Info</h5>
                        </div>
                        <div class="card-body">
                            <p class="small mb-3">Configure your website's contact information and social media links.</p>
                            <ul class="small mb-0">
                                <li class="mb-2">Contact details appear on your website</li>
                                <li class="mb-2">WhatsApp number enables quick messaging</li>
                                <li class="mb-2">Social links help visitors connect with you</li>
                                <li class="mb-0">All fields are optional</li>
                            </ul>
                        </div>
                    </div>
                </div>
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