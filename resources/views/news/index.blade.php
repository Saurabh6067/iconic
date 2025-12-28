@extends('layouts.admin')

@section('content')
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="h3 mb-0">News Management</h1>
            @if($newsCount < 4)
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addNewsModal">
                    <i class="bi bi-plus-circle"></i> Add News
                </button>
            @else
                <button class="btn btn-secondary" disabled>
                    <i class="bi bi-exclamation-circle"></i> Maximum 4 News Items
                </button>
            @endif
        </div>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="alert alert-info">
            <i class="bi bi-info-circle"></i> You can add maximum 4 news items. Currently you have
            <strong>{{ $newsCount }}/4</strong> news items.
        </div>

        <div class="row">
            @forelse($news as $newsItem)
                <div class="col-md-6 mb-4">
                    <div class="card h-100">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-start mb-3">
                                <div class="news-icon-display" style="font-size: 2.5rem;">{{ $newsItem->icon }}</div>
                                <span class="badge bg-{{ $newsItem->status ? 'success' : 'secondary' }}">
                                    {{ $newsItem->status ? 'Active' : 'Inactive' }}
                                </span>
                            </div>
                            <h5 class="card-title">{{ $newsItem->title }}</h5>
                            <p class="card-text">
                                <small class="text-muted">Order: {{ $newsItem->order }}</small>
                            </p>
                            <div class="d-flex gap-2">
                                <button class="btn btn-sm btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#editNewsModal{{ $newsItem->id }}">
                                    <i class="bi bi-pencil"></i> Edit
                                </button>
                                <form action="{{ route('news.destroy', $newsItem->id) }}" method="POST"
                                    onsubmit="return confirm('Are you sure you want to delete this news item?');"
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

                <!-- Edit News Modal -->
                <div class="modal fade" id="editNewsModal{{ $newsItem->id }}" tabindex="-1">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Edit News</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <form action="{{ route('news.update', $newsItem->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label for="editTitle{{ $newsItem->id }}" class="form-label">News Title *</label>
                                        <textarea class="form-control" id="editTitle{{ $newsItem->id }}" name="title" rows="3"
                                            required>{{ $newsItem->title }}</textarea>
                                    </div>

                                    <div class="mb-3">
                                        <label for="editIcon{{ $newsItem->id }}" class="form-label">Icon (Emoji) *</label>
                                        <input type="text" class="form-control" id="editIcon{{ $newsItem->id }}" name="icon"
                                            value="{{ $newsItem->icon }}" maxlength="10" required>
                                        <small class="text-muted">
                                            Suggested: 📰 🏆 ⭐ 💡 🎉 🔥 ✨ 🚀
                                            <a href="https://emojipedia.org/" target="_blank">More emojis</a>
                                        </small>
                                    </div>

                                    <div class="mb-3">
                                        <label for="editOrder{{ $newsItem->id }}" class="form-label">Display Order</label>
                                        <input type="number" class="form-control" id="editOrder{{ $newsItem->id }}" name="order"
                                            value="{{ $newsItem->order }}" min="0">
                                    </div>

                                    <div class="mb-3 form-check">
                                        <input type="checkbox" class="form-check-input" id="editStatus{{ $newsItem->id }}"
                                            name="status" value="1" {{ $newsItem->status ? 'checked' : '' }}>
                                        <label class="form-check-label" for="editStatus{{ $newsItem->id }}">
                                            Active
                                        </label>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Update News</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="alert alert-info">
                        <i class="bi bi-info-circle"></i> No news items added yet. Click "Add News" to get started.
                    </div>
                </div>
            @endforelse
        </div>
    </div>

    <!-- Add News Modal -->
    <div class="modal fade" id="addNewsModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add New News</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form action="{{ route('news.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="title" class="form-label">News Title *</label>
                            <textarea class="form-control" id="title" name="title" rows="3" required
                                placeholder="Enter your news headline..."></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="icon" class="form-label">Icon (Emoji) *</label>
                            <input type="text" class="form-control" id="icon" name="icon" value="📰" maxlength="10"
                                required>
                            <small class="text-muted">
                                Suggested: 📰 🏆 ⭐ 💡 🎉 🔥 ✨ 🚀
                                <a href="https://emojipedia.org/" target="_blank">More emojis</a>
                            </small>
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
                        <button type="submit" class="btn btn-primary">Add News</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection