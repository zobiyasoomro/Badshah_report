@extends('admin.layouts.master')
@section('title', 'Contact Messages')
@section('admin_content')

<style>
    .contact-page-wrap {
        max-width: 960px;
        margin: 0 auto;
        padding: 32px 16px;
    }

    .contact-page-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 16px;
        margin-bottom: 24px;
    }

    .contact-page-title {
        font-size: 24px;
        font-weight: 700;
        color: #1f2937;
        margin: 0;
    }

    .contact-page-subtitle {
        font-size: 14px;
        color: #6b7280;
        margin-top: 4px;
        margin-bottom: 0;
    }

    .contact-count-badge {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: rgba(42, 69, 99, 0.1);
        color: #2A4563;
        font-size: 12px;
        font-weight: 600;
        padding: 6px 14px;
        border-radius: 50px;
        white-space: nowrap;
    }

    .contact-success-alert {
        display: flex;
        align-items: center;
        gap: 8px;
        background: #f0fdf4;
        border: 1px solid #bbf7d0;
        color: #15803d;
        font-size: 14px;
        padding: 12px 16px;
        border-radius: 12px;
        margin-bottom: 24px;
    }

    .contact-card {
        width: 100%;
        background: #ffffff;
        border: 1px solid #e5e7eb;
        border-radius: 16px;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.04);
        transition: box-shadow 0.2s ease;
        margin-bottom: 16px;
        overflow: hidden;
    }

    .contact-card:hover {
        box-shadow: 0 6px 16px rgba(0, 0, 0, 0.08);
    }

    .contact-card-body {
        padding: 24px;
    }

    .contact-card-top {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        gap: 16px;
        flex-wrap: wrap;
    }

    .contact-card-left {
        display: flex;
        align-items: flex-start;
        gap: 16px;
    }

    .contact-avatar {
        width: 44px;
        height: 44px;
        border-radius: 50%;
        background: #2A4563;
        color: #ffffff;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 700;
        font-size: 14px;
        flex-shrink: 0;
    }

    .contact-name {
        font-size: 16px;
        font-weight: 600;
        color: #1f2937;
        margin: 0 0 2px 0;
    }

    .contact-email {
        font-size: 14px;
        color: #2A4563;
        text-decoration: none;
    }

    .contact-email:hover {
        text-decoration: underline;
        color: #2A4563;
    }

    .contact-card-right {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .contact-time {
        font-size: 12px;
        color: #9ca3af;
        white-space: nowrap;
    }

    .contact-time i {
        margin-right: 4px;
    }

    .contact-delete-btn {
        width: 36px;
        height: 36px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 8px;
        color: #9ca3af;
        background: transparent;
        border: none;
        transition: all 0.15s ease;
    }

    .contact-delete-btn:hover {
        color: #dc2626;
        background: #fef2f2;
    }

    .contact-card-content {
        margin-top: 16px;
        padding-left: 60px;
    }

    .contact-label {
        display: block;
        font-size: 11px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        color: #9ca3af;
        margin-bottom: 4px;
    }

    .contact-subject {
        font-size: 14px;
        font-weight: 600;
        color: #374151;
        margin-bottom: 12px;
    }

    .contact-message {
        font-size: 14px;
        color: #4b5563;
        line-height: 1.6;
        white-space: pre-line;
        margin: 0;
    }

    .contact-empty-state {
        text-align: center;
        padding: 80px 20px;
        background: #ffffff;
        border: 2px dashed #d1d5db;
        border-radius: 16px;
    }

    .contact-empty-icon {
        width: 56px;
        height: 56px;
        margin: 0 auto 16px;
        border-radius: 50%;
        background: #f3f4f6;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .contact-empty-icon i {
        color: #9ca3af;
        font-size: 20px;
    }

    .contact-empty-title {
        color: #374151;
        font-weight: 600;
        margin-bottom: 4px;
    }

    .contact-empty-text {
        font-size: 14px;
        color: #9ca3af;
        margin: 0;
    }

    /* ===== Delete Modal ===== */
    .contact-modal-overlay {
        display: none;
        position: fixed;
        inset: 0;
        z-index: 1050;
        align-items: center;
        justify-content: center;
        padding: 16px;
    }

    .contact-modal-overlay.show {
        display: flex;
    }

    .contact-modal-backdrop {
        position: absolute;
        inset: 0;
        background: rgba(17, 24, 39, 0.6);
        backdrop-filter: blur(4px);
    }

    .contact-modal-panel {
        position: relative;
        background: #ffffff;
        width: 100%;
        max-width: 384px;
        border-radius: 16px;
        box-shadow: 0 25px 50px rgba(0, 0, 0, 0.25);
        padding: 24px;
        text-align: center;
        transform: scale(0.95);
        opacity: 0;
        transition: all 0.2s ease;
    }

    .contact-modal-panel.show {
        transform: scale(1);
        opacity: 1;
    }

    .contact-modal-icon {
        width: 64px;
        height: 64px;
        margin: 0 auto 16px;
        border-radius: 50%;
        background: #fef2f2;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .contact-modal-icon i {
        color: #ef4444;
        font-size: 24px;
    }

    .contact-modal-title {
        font-size: 18px;
        font-weight: 700;
        color: #1f2937;
        margin-bottom: 8px;
    }

    .contact-modal-text {
        font-size: 14px;
        color: #6b7280;
        line-height: 1.6;
    }

    .contact-modal-actions {
        display: flex;
        align-items: center;
        gap: 12px;
        margin-top: 24px;
    }

    .contact-modal-btn {
        flex: 1;
        padding: 10px 16px;
        border-radius: 12px;
        font-weight: 500;
        font-size: 14px;
        transition: all 0.15s ease;
        border: none;
    }

    .contact-modal-btn-cancel {
        background: #ffffff;
        border: 1px solid #e5e7eb;
        color: #4b5563;
    }

    .contact-modal-btn-cancel:hover {
        background: #f9fafb;
    }

    .contact-modal-btn-confirm {
        background: #ef4444;
        color: #ffffff;
        box-shadow: 0 8px 16px rgba(239, 68, 68, 0.25);
    }

    .contact-modal-btn-confirm:hover {
        background: #dc2626;
        color: #ffffff;
    }

    @media (max-width: 576px) {
        .contact-card-content {
            padding-left: 0;
        }
    }
</style>

<div class="contact-page-wrap">

    <div class="contact-page-header">
        <div>
            <h1 class="contact-page-title">Contact Messages</h1>
            <p class="contact-page-subtitle">Messages submitted through the public contact form.</p>
        </div>
        <span class="contact-count-badge">
            <i class="fa-solid fa-envelope"></i>
            {{ $contacts->count() }} {{ Str::plural('message', $contacts->count()) }}
        </span>
    </div>

    @if(session('success'))
        <div id="successAlert" class="contact-success-alert">
            <i class="fa-solid fa-circle-check"></i>
            {{ session('success') }}
        </div>
    @endif

    @forelse($contacts as $contact)
        <div class="contact-card">
            <div class="contact-card-body">
                <div class="contact-card-top">
                    <div class="contact-card-left">
                        <div class="contact-avatar">
                            {{ strtoupper(substr($contact->name, 0, 1)) }}
                        </div>
                        <div>
                            <h3 class="contact-name">{{ $contact->name }}</h3>
                            <a href="mailto:{{ $contact->email }}" class="contact-email">
                                {{ $contact->email }}
                            </a>
                        </div>
                    </div>

                    <div class="contact-card-right">
                        <span class="contact-time">
                            <i class="fa-regular fa-clock"></i>{{ $contact->created_at->diffForHumans() }}
                        </span>

                        <button type="button"
                                class="contact-delete-btn delete-trigger"
                                title="Delete message"
                                data-action="{{ route('admin.contact.destroy', $contact->id) }}"
                                data-name="{{ $contact->name }}">
                            <i class="fa-solid fa-trash-can"></i>
                        </button>
                    </div>
                </div>

                <div class="contact-card-content">
                    <span class="contact-label">Subject</span>
                    <p class="contact-subject">{{ $contact->subject }}</p>

                    <span class="contact-label">Message</span>
                    <p class="contact-message">{{ $contact->description }}</p>
                </div>
            </div>
        </div>
    @empty
        <div class="contact-empty-state">
            <div class="contact-empty-icon">
                <i class="fa-solid fa-inbox"></i>
            </div>
            <h3 class="contact-empty-title">No messages yet</h3>
            <p class="contact-empty-text">Submissions from the public contact form will appear here.</p>
        </div>
    @endforelse

</div>

{{-- ===================== Delete Confirmation Modal ===================== --}}
<div id="deleteModalOverlay" class="contact-modal-overlay">
    <div id="deleteModalBackdrop" class="contact-modal-backdrop"></div>

    <div id="deleteModalPanel" class="contact-modal-panel">

        <div class="contact-modal-icon">
            <i class="fa-solid fa-trash-can"></i>
        </div>

        <h3 class="contact-modal-title">Delete message?</h3>
        <p class="contact-modal-text">
            You're about to delete the message from
            <span id="deleteModalName" style="font-weight: 600; color: #374151;">this contact</span>.
            This action can't be undone.
        </p>

        <div class="contact-modal-actions">
            <button type="button" id="deleteModalCancel" class="contact-modal-btn contact-modal-btn-cancel">
                Cancel
            </button>
            <button type="button" id="deleteModalConfirm" class="contact-modal-btn contact-modal-btn-confirm">
                Delete
            </button>
        </div>
    </div>
</div>

<form id="deleteForm" method="POST" style="display: none;">
    @csrf
    @method('DELETE')
</form>

<script>
    const successAlert = document.getElementById('successAlert');
    if (successAlert) {
        setTimeout(() => {
            successAlert.style.transition = 'opacity .4s';
            successAlert.style.opacity = '0';
        }, 3000);
    }

    // ---------- Delete confirmation modal ----------
    const overlay      = document.getElementById('deleteModalOverlay');
    const panel        = document.getElementById('deleteModalPanel');
    const backdrop      = document.getElementById('deleteModalBackdrop');
    const nameLabel     = document.getElementById('deleteModalName');
    const cancelBtn     = document.getElementById('deleteModalCancel');
    const confirmBtn    = document.getElementById('deleteModalConfirm');
    const deleteForm    = document.getElementById('deleteForm');

    const openModal = (action, name) => {
        deleteForm.setAttribute('action', action);
        nameLabel.textContent = name;

        overlay.classList.add('show');
        document.body.style.overflow = 'hidden';

        requestAnimationFrame(() => {
            panel.classList.add('show');
        });
    };

    const closeModal = () => {
        panel.classList.remove('show');
        document.body.style.overflow = '';

        setTimeout(() => {
            overlay.classList.remove('show');
        }, 180);
    };

    document.querySelectorAll('.delete-trigger').forEach(btn => {
        btn.addEventListener('click', () => {
            openModal(btn.dataset.action, btn.dataset.name);
        });
    });

    cancelBtn.addEventListener('click', closeModal);
    backdrop.addEventListener('click', closeModal);
    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape' && overlay.classList.contains('show')) closeModal();
    });

    confirmBtn.addEventListener('click', () => {
        confirmBtn.disabled = true;
        confirmBtn.innerHTML = '<i class="fa-solid fa-spinner fa-spin"></i>';
        deleteForm.submit();
    });
</script>
@endsection