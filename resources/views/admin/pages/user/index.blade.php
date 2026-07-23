@extends('admin.layouts.master')
@section('title', 'Users')
@section('admin_content')

<style>
    .users-header {
        padding: 1.5rem;
        margin-bottom: 1.5rem;
    }

    .users-title {
        font-size: 1.875rem;
        font-weight: 600;
        color: #1f2937;
        margin-bottom: 0;
    }

    .users-subtitle {
        color: #6b7280;
        margin-top: 4px;
        margin-bottom: 0;
    }

    .user-card {
        background: #ffffff;
        border: 1px solid #f3f4f6;
        border-radius: 16px;
        padding: 1.25rem;
        transition: all 0.2s ease;
        height: 100%;
    }

    .user-card:hover {
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        transform: translateY(-2px);
    }

    .user-avatar {
        width: 48px;
        height: 48px;
        border-radius: 50%;
        background: #2A4563;
        color: #ffffff;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 700;
        font-size: 1rem;
        flex-shrink: 0;
        overflow: hidden;
    }

    .user-avatar img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .user-name {
        font-weight: 600;
        color: #1f2937;
        margin-bottom: 0;
    }

    .user-email {
        color: #6b7280;
        font-size: 0.875rem;
    }

    .user-username {
        color: #9ca3af;
        font-size: 0.75rem;
    }

    .status-badge-active {
        font-size: 0.75rem;
        font-weight: 600;
        padding: 0.25rem 0.625rem;
        border-radius: 9999px;
        background: #f0fdf4;
        color: #16a34a;
    }

    .status-badge-inactive {
        font-size: 0.75rem;
        font-weight: 600;
        padding: 0.25rem 0.625rem;
        border-radius: 9999px;
        background: #f3f4f6;
        color: #6b7280;
    }

    .action-btn {
        width: 36px;
        height: 36px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 8px;
        color: #9ca3af;
        border: none;
        background: transparent;
        transition: all 0.2s ease;
        cursor: pointer;
    }

    .action-btn:hover {
        background: #f3f4f6;
        color: #2A4563;
    }

    .action-btn.delete:hover {
        background: #fef2f2;
        color: #dc2626;
    }

    .empty-state {
        text-align: center;
        padding: 4rem 0;
        color: #6b7280;
    }

    .empty-state .empty-icon {
        font-size: 4rem;
        margin-bottom: 1rem;
        opacity: 0.5;
    }

    .empty-state h5 {
        color: #1f2937;
        font-weight: 600;
    }

    /* ===== CUSTOM MODALS (No Bootstrap JS needed) ===== */
    .custom-modal-overlay {
        display: none;
        position: fixed;
        inset: 0;
        z-index: 1050;
        align-items: center;
        justify-content: center;
        padding: 16px;
        background: rgba(0, 0, 0, 0.5);
        backdrop-filter: blur(4px);
    }

    .custom-modal-overlay.show {
        display: flex;
    }

    .custom-modal {
        background: #ffffff;
        width: 100%;
        max-width: 420px;
        border-radius: 16px;
        box-shadow: 0 25px 50px rgba(0, 0, 0, 0.25);
        padding: 2rem;
        text-align: center;
        animation: modalSlideIn 0.3s ease;
        position: relative;
    }

    @keyframes modalSlideIn {
        from {
            transform: scale(0.9) translateY(20px);
            opacity: 0;
        }
        to {
            transform: scale(1) translateY(0);
            opacity: 1;
        }
    }

    .modal-icon {
        width: 64px;
        height: 64px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1rem;
        font-size: 1.5rem;
    }

    .modal-icon.delete {
        background: #fef2f2;
        color: #ef4444;
    }

    .modal-icon.password {
        background: rgba(42, 69, 99, 0.10);
        color: #2A4563;
    }

    .modal-title {
        font-weight: 700;
        color: #1f2937;
        margin-bottom: 8px;
    }

    .modal-text {
        color: #6b7280;
        font-size: 0.875rem;
        line-height: 1.625;
        margin-bottom: 0;
    }

    .modal-text .highlight {
        font-weight: 600;
        color: #374151;
    }

    .modal-actions {
        display: flex;
        gap: 12px;
        margin-top: 1.5rem;
    }

    .modal-actions .btn {
        flex: 1;
        padding: 0.625rem 1rem;
        border-radius: 10px;
        font-weight: 500;
        font-size: 0.875rem;
        transition: all 0.2s ease;
        border: none;
    }

    .btn-cancel {
        background: #f3f4f6;
        color: #4b5563;
    }

    .btn-cancel:hover {
        background: #e5e7eb;
    }

    .btn-danger {
        background: #ef4444;
        color: #ffffff;
        box-shadow: 0 4px 14px rgba(239, 68, 68, 0.25);
    }

    .btn-danger:hover {
        background: #dc2626;
        transform: translateY(-1px);
    }

    .btn-primary {
        background: #2A4563;
        color: #ffffff;
        box-shadow: 0 4px 14px rgba(42, 69, 99, 0.25);
    }

    .btn-primary:hover {
        background: #1d334d;
        transform: translateY(-1px);
    }

    .modal-form .form-control {
        border: 1px solid #e5e7eb;
        border-radius: 10px;
        padding: 0.625rem 0.875rem;
        width: 100%;
        background: #ffffff;
        color: #1f2937;
    }

    .modal-form .form-control:focus {
        border-color: #2A4563;
        outline: none;
        box-shadow: 0 0 0 3px rgba(42, 69, 99, 0.15);
    }

    .modal-form label {
        font-weight: 600;
        font-size: 0.875rem;
        color: #4b5563;
        display: block;
        margin-bottom: 4px;
    }

    .modal-form .form-group {
        margin-bottom: 1rem;
        text-align: left;
    }

    .text-danger {
        color: #dc2626;
        font-size: 0.75rem;
    }

    .d-none {
        display: none !important;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .users-header {
            padding: 1rem;
        }

        .users-title {
            font-size: 1.5rem;
        }

        .user-card {
            padding: 1rem;
        }

        .custom-modal {
            padding: 1.5rem;
            margin: 16px;
        }
    }
</style>

<div class="users-header">
    <div class="d-flex flex-wrap justify-content-between align-items-center gap-3">
        <div>
            <h1 class="users-title">Users</h1>
            <p class="users-subtitle">Manage all registered users</p>
        </div>
        <span class="badge rounded-pill px-3 py-2" style="background: rgba(42, 69, 99, 0.10); color: #2A4563; font-weight: 600;">
            <i class="fa-solid fa-users me-1"></i>
            {{ $users->count() }} {{ Str::plural('user', $users->count()) }}
        </span>
    </div>
</div>

@if(session('success'))
    <div id="successAlert" class="alert alert-success alert-dismissible fade show mx-3 mb-3" role="alert">
        <i class="fa-solid fa-circle-check me-2"></i>
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@if(session('error'))
    <div id="errorAlert" class="alert alert-danger alert-dismissible fade show mx-3 mb-3" role="alert">
        <i class="fa-solid fa-circle-exclamation me-2"></i>
        {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<div class="px-3 pb-3">
    <div class="row g-3">
        @forelse($users as $user)
            <div class="col-12 col-md-6 col-lg-4">
                <div class="user-card">
                    <div class="d-flex align-items-start justify-content-between gap-1">
                        <div class="d-flex align-items-center gap-3">
                            <div class="user-avatar">
                                @if($user->image)
                                    <img src="{{ asset('users/' . $user->image) }}" alt="{{ $user->name }}">
                                @else
                                    {{ strtoupper(substr($user->name, 0, 1)) }}
                                @endif
                            </div>
                            <div>
                                <p class="user-name">{{ $user->name }}</p>
                                <p class="user-email">{{ $user->email ?? 'No email' }}</p>
                                <p class="user-username">&#64;{{ $user->user_name }}</p>
                            </div>
                        </div>
                        <div class="d-flex gap-1">
                            <!-- Password Button -->
                            <button type="button"
                                    class="action-btn password-trigger"
                                    title="Reset Password"
                                    data-action="{{ route('admin.user.password', $user->id) }}"
                                    data-name="{{ $user->name }}">
                                <i class="fa-solid fa-key"></i>
                            </button>
                            <!-- Delete Button -->
                            <button type="button"
                                    class="action-btn delete delete-trigger"
                                    title="Delete User"
                                    data-action="{{ route('admin.user.destroy', $user->id) }}"
                                    data-name="{{ $user->name }}">
                                <i class="fa-solid fa-trash-can"></i>
                            </button>
                        </div>
                    </div>
                    <div class="mt-3 pt-3 border-top border-gray-100">
                        <div class="d-flex flex-wrap gap-2">
                            @if($user->register_account)
                                <span class="status-badge-active">
                                    <i class="fa-regular fa-circle-check me-1"></i> Active
                                </span>
                            @else
                                <span class="status-badge-inactive">
                                    <i class="fa-regular fa-circle me-1"></i> Inactive
                                </span>
                            @endif
                            <span class="badge bg-light text-secondary">
                                <i class="fa-regular fa-calendar me-1"></i>
                                {{ $user->created_at->format('d M Y') }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="empty-state">
                    <div class="empty-icon">👤</div>
                    <h5>No Users Found</h5>
                    <p>No registered users yet.</p>
                </div>
            </div>
        @endforelse
    </div>
</div>

{{-- ===================== PASSWORD MODAL ===================== --}}
<div id="passwordModal" class="custom-modal-overlay">
    <div class="custom-modal">
        <div class="modal-icon password">
            <i class="fa-solid fa-key"></i>
        </div>
        <h3 class="modal-title">Reset Password</h3>
        <p class="modal-text">
            Set a new password for <span id="passwordModalName" class="highlight">this user</span>.
        </p>

        <form id="passwordForm" method="POST" class="modal-form text-start" action="">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label>New Password</label>
                <input type="password" name="password" id="passwordInput" required minlength="6" class="form-control">
            </div>

            <div class="form-group">
                <label>Confirm Password</label>
                <input type="password" name="password_confirmation" required minlength="6" class="form-control">
            </div>

            <p id="passwordMismatch" class="text-danger d-none">Passwords don't match.</p>

            <div class="modal-actions">
                <button type="button" class="btn btn-cancel" onclick="closeModal('passwordModal')">Cancel</button>
                <button type="submit" class="btn btn-primary">Reset Password</button>
            </div>
        </form>
    </div>
</div>

{{-- ===================== DELETE MODAL ===================== --}}
<div id="deleteModal" class="custom-modal-overlay">
    <div class="custom-modal">
        <div class="modal-icon delete">
            <i class="fa-solid fa-trash-can"></i>
        </div>
        <h3 class="modal-title">Delete User?</h3>
        <p class="modal-text">
            You're about to permanently delete
            <span id="deleteModalName" class="highlight">this user</span>.
            This action can't be undone.
        </p>

        <form id="deleteForm" method="POST" action="">
            @csrf
            @method('DELETE')
            <div class="modal-actions">
                <button type="button" class="btn btn-cancel" onclick="closeModal('deleteModal')">Cancel</button>
                <button type="submit" class="btn btn-danger">Delete</button>
            </div>
        </form>
    </div>
</div>

<script>
    // ===== MODAL FUNCTIONS =====
    function openModal(modalId) {
        const modal = document.getElementById(modalId);
        if (modal) {
            modal.classList.add('show');
            document.body.style.overflow = 'hidden';
        }
    }

    function closeModal(modalId) {
        const modal = document.getElementById(modalId);
        if (modal) {
            modal.classList.remove('show');
            document.body.style.overflow = '';
        }
    }

    // Close modal when clicking outside
    document.querySelectorAll('.custom-modal-overlay').forEach(overlay => {
        overlay.addEventListener('click', function(e) {
            if (e.target === this) {
                this.classList.remove('show');
                document.body.style.overflow = '';
            }
        });
    });

    // Close modal on Escape key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            document.querySelectorAll('.custom-modal-overlay.show').forEach(modal => {
                modal.classList.remove('show');
                document.body.style.overflow = '';
            });
        }
    });

    document.addEventListener('DOMContentLoaded', function() {
        // ===== AUTO-HIDE ALERTS =====
        ['successAlert', 'errorAlert'].forEach(id => {
            const el = document.getElementById(id);
            if (el) {
                setTimeout(() => {
                    el.style.transition = 'opacity .4s';
                    el.style.opacity = '0';
                    setTimeout(() => {
                        el.style.display = 'none';
                    }, 400);
                }, 3000);
            }
        });

        // ===== PASSWORD MODAL =====
        const passwordForm = document.getElementById('passwordForm');
        const passwordNameLabel = document.getElementById('passwordModalName');
        const passwordInput = document.getElementById('passwordInput');
        const passwordMismatch = document.getElementById('passwordMismatch');

        document.querySelectorAll('.password-trigger').forEach(btn => {
            btn.addEventListener('click', function() {
                const action = this.dataset.action;
                const name = this.dataset.name;
                passwordForm.setAttribute('action', action);
                passwordNameLabel.textContent = name;
                passwordForm.reset();
                passwordMismatch.classList.add('d-none');
                openModal('passwordModal');
                setTimeout(() => {
                    if (passwordInput) passwordInput.focus();
                }, 300);
            });
        });

        // Password form validation
        passwordForm.addEventListener('submit', function(e) {
            const pass = this.querySelector('input[name="password"]').value;
            const confirm = this.querySelector('input[name="password_confirmation"]').value;
            
            if (pass !== confirm) {
                e.preventDefault();
                passwordMismatch.classList.remove('d-none');
            }
        });

        // ===== DELETE MODAL =====
        const deleteForm = document.getElementById('deleteForm');
        const deleteNameLabel = document.getElementById('deleteModalName');

        document.querySelectorAll('.delete-trigger').forEach(btn => {
            btn.addEventListener('click', function() {
                const action = this.dataset.action;
                const name = this.dataset.name;
                deleteForm.setAttribute('action', action);
                deleteNameLabel.textContent = name;
                openModal('deleteModal');
            });
        });
    });
</script>

@endsection