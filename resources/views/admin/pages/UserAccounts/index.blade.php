@extends('admin.layouts.master')
@section('title', 'User Accounts')
@section('admin_content')

<style>
    :root {
        --primary-blue: #2A4563;
        --primary-blue-dark: #223a54;
        --radius: 16px;
        --radius-sm: 10px;
        --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .user-card {
        background: #ffffff;
        border: 1px solid #e5e7eb;
        border-radius: var(--radius);
        box-shadow: 0 2px 8px rgba(42, 69, 99, 0.06);
        transition: var(--transition);
        margin-bottom: 16px;
        overflow: hidden;
    }

    .user-card:hover {
        box-shadow: 0 8px 30px rgba(42, 69, 99, 0.10);
    }

    .user-avatar {
        width: 44px;
        height: 44px;
        border-radius: 50%;
        background: var(--primary-blue);
        color: #fff;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 700;
        font-size: 14px;
        flex-shrink: 0;
    }

    .user-avatar img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        border-radius: 50%;
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
        transition: var(--transition);
        cursor: pointer;
    }

    .action-btn:hover {
        background: #f3f4f6;
        color: var(--primary-blue);
    }

    .action-btn.delete:hover {
        background: #fef2f2;
        color: #dc2626;
    }

    .password-toggle {
        cursor: pointer;
        color: #9ca3af;
        font-size: 0.75rem;
        transition: var(--transition);
        background: none;
        border: none;
        padding: 0 4px;
    }

    .password-toggle:hover {
        color: var(--primary-blue);
    }

    .badge-count {
        background: rgba(42, 69, 99, 0.10);
        color: #2A4563;
        font-weight: 600;
        padding: 0.375rem 0.875rem;
        border-radius: 50px;
        font-size: 0.75rem;
    }

    .badge-count i {
        margin-right: 6px;
    }

    .btn-primary-custom {
        background: var(--primary-blue);
        color: #fff;
        border: none;
        padding: 0.5rem 1rem;
        border-radius: var(--radius-sm);
        font-weight: 500;
        font-size: 0.875rem;
        transition: var(--transition);
        box-shadow: 0 4px 14px rgba(42, 69, 99, 0.25);
        display: inline-flex;
        align-items: center;
        gap: 8px;
        text-decoration: none;
    }

    .btn-primary-custom:hover {
        background: var(--primary-blue-dark);
        color: #fff;
        transform: translateY(-1px);
        box-shadow: 0 8px 25px rgba(42, 69, 99, 0.35);
    }

    .btn-primary-custom i {
        font-size: 0.875rem;
    }

    /* ===== ALERTS ===== */
    .alert-custom {
        border-radius: var(--radius-sm);
        padding: 0.75rem 1rem;
        border: none;
        font-weight: 500;
        margin-bottom: 1.5rem;
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 0.875rem;
    }

    .alert-success-custom {
        background: #f0fdf4;
        border: 1px solid #bbf7d0;
        color: #166534;
    }

    .alert-danger-custom {
        background: #fef2f2;
        border: 1px solid #fecaca;
        color: #991b1b;
    }

    .alert-custom i {
        font-size: 1rem;
    }

    /* ===== EMPTY STATE ===== */
    .empty-state {
        text-align: center;
        padding: 5rem 0;
        background: #ffffff;
        border: 2px dashed #d1d5db;
        border-radius: var(--radius);
    }

    .empty-state .icon {
        width: 56px;
        height: 56px;
        border-radius: 50%;
        background: #f3f4f6;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1rem;
        font-size: 1.25rem;
        color: #9ca3af;
    }

    .empty-state h5 {
        color: #374151;
        font-weight: 600;
    }

    .empty-state p {
        color: #9ca3af;
        font-size: 0.875rem;
        margin-top: 4px;
    }

    /* ===== MODAL ===== */
    .modal-custom .modal-content {
        border-radius: var(--radius);
        border: none;
        box-shadow: 0 25px 50px rgba(0, 0, 0, 0.25);
    }

    .modal-custom .modal-body {
        padding: 2rem;
        text-align: center;
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

    .modal-custom h3 {
        font-weight: 700;
        font-size: 1.125rem;
        color: #1f2937;
        margin-bottom: 8px;
    }

    .modal-custom p {
        color: #6b7280;
        font-size: 0.875rem;
        line-height: 1.625;
        margin-bottom: 0;
    }

    .modal-custom p .highlight {
        font-weight: 600;
        color: #374151;
    }

    .btn-cancel {
        flex: 1;
        padding: 0.625rem 1rem;
        border-radius: var(--radius-sm);
        border: 1px solid #e5e7eb;
        background: transparent;
        color: #4b5563;
        font-weight: 500;
        font-size: 0.875rem;
        transition: var(--transition);
    }

    .btn-cancel:hover {
        background: #f9fafb;
    }

    .btn-danger-custom {
        flex: 1;
        padding: 0.625rem 1rem;
        border-radius: var(--radius-sm);
        border: none;
        background: #ef4444;
        color: #fff;
        font-weight: 500;
        font-size: 0.875rem;
        transition: var(--transition);
        box-shadow: 0 4px 14px rgba(239, 68, 68, 0.25);
    }

    .btn-danger-custom:hover {
        background: #dc2626;
        transform: translateY(-1px);
        box-shadow: 0 8px 25px rgba(239, 68, 68, 0.35);
    }

    .btn-danger-custom:disabled {
        opacity: 0.7;
        cursor: not-allowed;
    }

    @media (max-width: 768px) {
        .user-card .card-body {
            padding: 1.25rem;
        }
    }
</style>

<div class="container-fluid py-4">

    <!-- ===== HEADER ===== -->
    <div class="d-flex align-items-center justify-content-between mb-4 flex-wrap gap-3">
        <div>
            <h1 class="h2 fw-bold text-dark mb-1">Accounts</h1>
            <p class="text-muted small mt-1">All UnRegistered Users.</p>
        </div>
        <div class="d-flex align-items-center gap-3">
            <span class="badge-count">
                <i class="fa-solid fa-user-lock"></i>
                {{ $userAccounts->count() }} {{ Str::plural('account', $userAccounts->count()) }}
            </span>
            <a href="{{ route('admin.UserAccounts.create') }}" class="btn-primary-custom">
                <i class="fa-solid fa-plus"></i>
                New Account
            </a>
        </div>
    </div>

    <!-- ===== ALERTS ===== -->
    @if(session('success'))
        <div id="successAlert" class="alert-custom alert-success-custom">
            <i class="fa-solid fa-circle-check"></i>
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div id="errorAlert" class="alert-custom alert-danger-custom">
            <i class="fa-solid fa-circle-exclamation"></i>
            {{ session('error') }}
        </div>
    @endif

    <!-- ===== USER LIST ===== -->
    @forelse($userAccounts as $account)
        <div class="user-card">
            <div class="card-body p-4">
                <div class="d-flex align-items-center justify-content-between gap-3 flex-wrap">
                    <!-- Left: Avatar + Info -->
                    <div class="d-flex align-items-center gap-3">
                        <div class="user-avatar">
                            {{ strtoupper(substr($account->user_account, 0, 1)) }}
                        </div>
                        <div>
                            <h5 class="fw-semibold text-dark mb-0">{{ $account->user_account }}</h5>
                            <div class="d-flex align-items-center gap-2 mt-1">
                                <span class="password-text small text-muted font-monospace" data-password="{{ $account->user_password }}">
                                    ••••••••
                                </span>
                                <button type="button" class="toggle-password password-toggle">
                                    <i class="fa-solid fa-eye"></i>
                                </button>
                            </div>
                            <p class="text-muted small mt-1 mb-0">Created {{ $account->created_at->format('d M Y') }}</p>
                        </div>
                    </div>

                    <!-- Right: Delete Button -->
                    <button type="button"
                            class="action-btn delete delete-trigger"
                            title="Delete account"
                            data-action="{{ route('admin.UserAccounts.destroy', $account->id) }}"
                            data-name="{{ $account->user_account }}">
                        <i class="fa-solid fa-trash-can"></i>
                    </button>
                </div>
            </div>
        </div>
    @empty
        <div class="empty-state">
            <div class="icon">
                <i class="fa-solid fa-user-lock"></i>
            </div>
            <h5>No accounts yet</h5>
            <p>Accounts you create will appear here.</p>
        </div>
    @endforelse

</div>

{{-- ===================== Delete Confirmation Modal ===================== --}}
<div class="modal fade modal-custom" id="deleteModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                <div class="modal-icon delete">
                    <i class="fa-solid fa-trash-can"></i>
                </div>
                <h3>Delete account?</h3>
                <p>
                    You're about to permanently delete
                    <span id="deleteModalName" class="highlight">this account</span>.
                    This action can't be undone.
                </p>
                <div class="d-flex gap-3 mt-4">
                    <button type="button" class="btn-cancel" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" id="deleteModalConfirm" class="btn-danger-custom">Delete</button>
                </div>
            </div>
        </div>
    </div>
</div>

<form id="deleteForm" method="POST" class="d-none">
    @csrf
    @method('DELETE')
</form>

<script>
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

    // ===== TOGGLE PASSWORD =====
    document.querySelectorAll('.toggle-password').forEach(btn => {
        btn.addEventListener('click', () => {
            const span = btn.previousElementSibling;
            const icon = btn.querySelector('i');
            const revealed = span.dataset.revealed === '1';

            if (revealed) {
                span.textContent = '••••••••';
                span.dataset.revealed = '0';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            } else {
                span.textContent = span.dataset.password;
                span.dataset.revealed = '1';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            }
        });
    });

    // ===== DELETE MODAL =====
    const deleteModal = new bootstrap.Modal(document.getElementById('deleteModal'));
    const deleteForm = document.getElementById('deleteForm');
    const deleteNameLabel = document.getElementById('deleteModalName');
    const deleteConfirmBtn = document.getElementById('deleteModalConfirm');

    document.querySelectorAll('.delete-trigger').forEach(btn => {
        btn.addEventListener('click', () => {
            deleteForm.setAttribute('action', btn.dataset.action);
            deleteNameLabel.textContent = btn.dataset.name;
            deleteModal.show();
        });
    });

    deleteConfirmBtn.addEventListener('click', () => {
        deleteConfirmBtn.disabled = true;
        deleteConfirmBtn.innerHTML = '<i class="fa-solid fa-spinner fa-spin"></i>';
        deleteForm.submit();
    });
</script>
@endsection