@extends('admin.layouts.master')
@section('title', 'Manage Reviews')
@section('admin_content')

    <div class="container-fluid py-4">
        <div class="row align-items-center mb-4">
            <div class="col">
                <h1 class="h2 fw-bold text-dark mb-1">
                    <i class="fas fa-star text-warning me-2"></i>Reviews
                </h1>
                <p class="text-muted small mt-1">Manage customer reviews and feedback.</p>
            </div>
            <div class="col-auto">
                <span class="badge bg-primary rounded-pill px-3 py-2">
                    <i class="fas fa-comments me-1"></i> {{ $reviews->count() }} Total
                </span>
            </div>
        </div>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
                <i class="fas fa-check-circle me-2"></i>
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show shadow-sm" role="alert">
                <i class="fas fa-exclamation-circle me-2"></i>
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
            <div class="card-header bg-white border-0 py-3 px-4">
                <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">
                    <h6 class="mb-0 fw-bold text-muted">
                        <i class="fas fa-list me-2"></i>All Reviews
                    </h6>
                    <div class="d-flex gap-1 flex-wrap">
                        <span class="badge bg-success">{{ $reviews->where('status', 'approved')->count() }} Approved</span>
                        <span class="badge bg-warning text-dark">{{ $reviews->where('status', 'pending')->count() }}
                            Pending</span>
                        <span class="badge bg-danger">{{ $reviews->where('status', 'rejected')->count() }} Rejected</span>
                    </div>
                </div>
            </div>
            <div class="card-body p-0">
                @if($reviews->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="bg-light">
                                <tr>
                                    <th class="px-3 py-3 text-uppercase fw-semibold small text-muted" style="width: 60px;">#
                                    </th>
                                    <th class="px-3 py-3 text-uppercase fw-semibold small text-muted" style="width: 150px;">Name
                                    </th>
                                    <th class="px-3 py-3 text-uppercase fw-semibold small text-muted" style="width: 130px;">
                                        Rating</th>
                                    <th class="px-3 py-3 text-uppercase fw-semibold small text-muted">Review</th>
                                    <th class="px-3 py-3 text-uppercase fw-semibold small text-muted" style="width: 80px;">Image
                                    </th>
                                    <th class="px-3 py-3 text-uppercase fw-semibold small text-muted" style="width: 110px;">
                                        Status</th>
                                    <th class="px-3 py-3 text-uppercase fw-semibold small text-muted" style="width: 110px;">Date
                                    </th>
                                    <th class="px-3 py-3 text-uppercase fw-semibold small text-muted text-center"
                                        style="width: 120px;">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($reviews as $review)
                                    <tr class="border-bottom">
                                        <td class="px-3 py-3 fw-semibold text-dark">{{ $review->id }}</td>
                                        <td class="px-3 py-3">
                                            <div class="d-flex align-items-center">
                                                @php
                                                    $imagePath = public_path('reviews/' . $review->image);
                                                    $imageExists = $review->image && file_exists($imagePath);
                                                @endphp
                                                @if($imageExists)
                                                    <img src="{{ asset('reviews/' . $review->image) }}" alt="{{ $review->name }}"
                                                        class="rounded-circle me-2"
                                                        style="width: 32px; height: 32px; object-fit: cover;">
                                                @else
                                                    <div class="rounded-circle bg-secondary text-white d-flex align-items-center justify-content-center me-2"
                                                        style="width: 32px; height: 32px; font-size: 0.75rem; font-weight: 600;">
                                                        {{ $review->initials }}
                                                    </div>
                                                @endif
                                                <span class="fw-semibold">{{ $review->name }}</span>
                                            </div>
                                        </td>
                                        <td class="px-3 py-3">
                                            @for($i = 1; $i <= 5; $i++)
                                                @if($i <= $review->rating)
                                                    <i class="fas fa-star text-warning" style="font-size: 0.85rem;"></i>
                                                @else
                                                    <i class="fas fa-star text-muted" style="font-size: 0.85rem; opacity: 0.3;"></i>
                                                @endif
                                            @endfor
                                            <span class="text-muted small ms-1">({{ $review->rating }})</span>
                                        </td>
                                        <td class="px-3 py-3">
                                            <div class="review-text-wrapper">
                                                <span class="review-short">{{ Str::limit($review->description, 80) }}</span>
                                                @if(strlen($review->description) > 80)
                                                    <span class="review-full d-none">{{ $review->description }}</span>
                                                    <button class="btn btn-link btn-sm p-0 text-primary read-more-btn"
                                                        style="font-size: 0.8rem;">
                                                        Read More
                                                    </button>
                                                @endif
                                            </div>
                                        </td>
                                        <td class="px-3 py-3">
                                            @php
                                                $imagePath = public_path('reviews/' . $review->image);
                                                $imageExists = $review->image && file_exists($imagePath);
                                            @endphp
                                            @if($imageExists)
                                                <img src="{{ asset('reviews/' . $review->image) }}" alt="{{ $review->name }}"
                                                    class="rounded-circle shadow-sm"
                                                    style="width: 44px; height: 44px; object-fit: cover; border: 2px solid #e9ecef;">
                                            @else
                                                <span class="text-muted small">
                                                    <i class="fas fa-image me-1"></i>No image
                                                </span>
                                            @endif
                                        </td>
                                        <td class="px-3 py-3">
                                            @if($review->status == 'approved')
                                                <span class="badge bg-success rounded-pill px-3 py-2">
                                                    <i class="fas fa-check-circle me-1"></i>Approved
                                                </span>
                                            @elseif($review->status == 'pending')
                                                <span class="badge bg-warning rounded-pill px-3 py-2 text-dark">
                                                    <i class="fas fa-clock me-1"></i>Pending
                                                </span>
                                            @else
                                                <span class="badge bg-danger rounded-pill px-3 py-2">
                                                    <i class="fas fa-times-circle me-1"></i>Rejected
                                                </span>
                                            @endif
                                        </td>
                                        <td class="px-3 py-3 text-muted small">
                                            <i class="far fa-calendar-alt me-1"></i>
                                            {{ $review->created_at ? $review->created_at->format('M d, Y') : 'N/A' }}
                                        </td>
                                        <td class="px-3 py-3">
                                            <select class="form-select form-select-sm status-dropdown" data-id="{{ $review->id }}">
                                                <option value="pending" {{ $review->status == 'pending' ? 'selected' : '' }}>Pending
                                                </option>
                                                <option value="approved" {{ $review->status == 'approved' ? 'selected' : '' }}>
                                                    Approved</option>
                                                <option value="rejected" {{ $review->status == 'rejected' ? 'selected' : '' }}>
                                                    Rejected</option>
                                            </select>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer bg-white border-0 py-3 px-4">
                        <div class="d-flex justify-content-between align-items-center">
                            <small class="text-muted">
                                Showing {{ $reviews->count() }} review(s)
                            </small>
                        </div>
                    </div>
                @else
                    <div class="text-center py-5">
                        <div class="mb-3">
                            <i class="fas fa-star fa-3x text-muted opacity-25"></i>
                        </div>
                        <h5 class="text-muted">No reviews yet</h5>
                        <p class="text-muted small">Reviews will appear here once customers submit them.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <style>
        /* Internal CSS only for custom styling */
        .table> :not(caption)>*>* {
            border-bottom-color: #f1f3f5;
        }

        .table tbody tr:hover {
            background-color: #f8f9fa;
        }

        .badge {
            font-weight: 500;
        }

        .btn-group-sm .btn {
            padding: 0.25rem 0.5rem;
            font-size: 0.75rem;
        }

        .review-text-wrapper {
            max-width: 280px;
        }

        .review-short {
            display: inline;
        }

        .review-full {
            display: none;
        }

        .review-full.show {
            display: inline;
        }

        .review-short.hidden {
            display: none;
        }

        .read-more-btn {
            text-decoration: none;
            font-weight: 500;
            cursor: pointer;
        }

        .read-more-btn:hover {
            text-decoration: underline;
        }

        @media (max-width: 768px) {
            .table-responsive {
                font-size: 0.85rem;
            }

            .review-text-wrapper {
                max-width: 150px;
            }
        }

        /* Approve button animation */
        .approve-btn:disabled {
            opacity: 0.6;
            cursor: not-allowed;
        }

        .approve-btn .fa-spinner {
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // ===================== READ MORE / READ LESS FUNCTIONALITY =====================
            document.querySelectorAll('.read-more-btn').forEach(btn => {
                btn.addEventListener('click', function () {
                    const wrapper = this.closest('.review-text-wrapper');
                    const shortText = wrapper.querySelector('.review-short');
                    const fullText = wrapper.querySelector('.review-full');

                    if (fullText.classList.contains('d-none')) {
                        // Show full text
                        shortText.classList.add('d-none');
                        fullText.classList.remove('d-none');
                        this.textContent = 'Read Less';
                    } else {
                        // Show short text
                        shortText.classList.remove('d-none');
                        fullText.classList.add('d-none');
                        this.textContent = 'Read More';
                    }
                });
            });

            // ===================== APPROVE BUTTON FUNCTIONALITY =====================
            document.querySelectorAll('.approve-btn').forEach(btn => {
                btn.addEventListener('click', function () {
                    const id = this.dataset.id;
                    const url = `/admin/reviews/${id}/status`;

                    // Show loading state
                    const originalHtml = this.innerHTML;
                    this.innerHTML = '<i class="fas fa-spinner fa-spin"></i>';
                    this.disabled = true;

                    fetch(url, {
                        method: 'PUT',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                        },
                        body: JSON.stringify({ status: 'approved' })
                    })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                // Show success message and reload
                                location.reload();
                            } else {
                                alert('Failed to approve review. Please try again.');
                                this.innerHTML = originalHtml;
                                this.disabled = false;
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            alert('An error occurred. Please try again.');
                            this.innerHTML = originalHtml;
                            this.disabled = false;
                        });
                });
            });

            // ===================== AUTO-DISMISS ALERTS =====================
            const alerts = document.querySelectorAll('.alert');
            alerts.forEach(alert => {
                setTimeout(() => {
                    const bsAlert = new bootstrap.Alert(alert);
                    bsAlert.close();
                }, 5000);
            });
        });

        document.querySelectorAll('.status-dropdown').forEach(select => {
            select.addEventListener('change', function () {
                const reviewId = this.getAttribute('data-id');
                const newStatus = this.value;
                const row = this.closest('tr'); // Used to remove the row from UI

                // CASE 1: DELETE IF REJECTED
                if (newStatus === 'rejected') {
                    if (!confirm('Selecting "Rejected" will permanently delete this review. Are you sure?')) {
                        // Reset dropdown if user cancels
                        this.value = 'pending';
                        return;
                    }

                    fetch(`/admin/reviews/${reviewId}`, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({ _method: 'DELETE' })
                    })
                        .then(response => response.json())
                        .then(data => {
                            row.remove(); // Remove row from table UI
                            alert('Review rejected and deleted successfully.');
                        });
                }
                // CASE 2: UPDATE STATUS FOR PENDING/APPROVED
                else {
                    fetch(`/admin/reviews/${reviewId}/status`, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({
                            _method: 'PUT',
                            status: newStatus
                        })
                    })
                        .then(response => response.json())
                        .then(data => {
                            alert('Status updated to ' + newStatus + '!');
                        });
                }
            });
        });
    </script>

@endsection