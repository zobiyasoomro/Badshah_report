@extends('admin.layouts.master')
@section('title', 'New User Account')
@section('admin_content')

<style>
    :root {
        --primary-blue: #2A4563;
        --primary-blue-dark: #223a54;
        --radius: 16px;
        --radius-sm: 10px;
        --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .card-custom {
        background: #ffffff;
        border: 1px solid #e5e7eb;
        border-radius: var(--radius);
        box-shadow: 0 2px 8px rgba(42, 69, 99, 0.06);
        padding: 1.5rem;
    }

    .btn-back {
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
        text-decoration: none;
    }

    .btn-back:hover {
        background: #f3f4f6;
        color: var(--primary-blue);
    }

    .form-label-custom {
        display: block;
        font-size: 0.7rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        color: #6b7280;
        margin-bottom: 4px;
    }

    .form-control-custom {
        width: 100%;
        padding: 0.625rem 0.875rem;
        border: 1.5px solid #e5e7eb;
        border-radius: var(--radius-sm);
        font-size: 0.875rem;
        transition: var(--transition);
        color: #1f2937;
        background: #ffffff;
    }

    .form-control-custom:focus {
        border-color: var(--primary-blue);
        box-shadow: 0 0 0 4px rgba(42, 69, 99, 0.12);
        outline: none;
    }

    .form-control-custom::placeholder {
        color: #9ca3af;
        font-size: 0.875rem;
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
        text-align: center;
        text-decoration: none;
    }

    .btn-cancel:hover {
        background: #f9fafb;
        color: #4b5563;
    }

    .btn-submit {
        flex: 1;
        padding: 0.625rem 1rem;
        border-radius: var(--radius-sm);
        border: none;
        background: var(--primary-blue);
        color: #fff;
        font-weight: 500;
        font-size: 0.875rem;
        transition: var(--transition);
        box-shadow: 0 4px 14px rgba(42, 69, 99, 0.25);
    }

    .btn-submit:hover {
        background: var(--primary-blue-dark);
        color: #fff;
        transform: translateY(-1px);
        box-shadow: 0 8px 25px rgba(42, 69, 99, 0.35);
    }

    .btn-submit:active {
        transform: translateY(0);
    }

    /* ===== ERROR ALERT ===== */
    .alert-error-custom {
        background: #fef2f2;
        border: 1px solid #fecaca;
        color: #991b1b;
        border-radius: var(--radius-sm);
        padding: 0.75rem 1rem;
        font-size: 0.875rem;
        margin-bottom: 1.25rem;
    }

    .alert-error-custom ul {
        margin: 0;
        padding-left: 1.25rem;
        list-style-type: disc;
    }

    .alert-error-custom ul li {
        margin-bottom: 4px;
    }

    .alert-error-custom ul li:last-child {
        margin-bottom: 0;
    }

    @media (max-width: 768px) {
        .card-custom {
            padding: 1.25rem;
        }
    }
</style>

<div class="container-fluid py-4">

    <!-- ===== HEADER ===== -->
    <div class="d-flex align-items-center gap-3 mb-4">
        <a href="{{ route('admin.UserAccounts') }}" class="btn-back">
            <i class="fa-solid fa-arrow-left"></i>
        </a>
        <h1 class="h2 fw-bold text-dark mb-0">New User Account</h1>
    </div>

    <!-- ===== FORM CARD ===== -->
    <div class="card-custom">

        <!-- ===== ERROR ALERTS ===== -->
        @if($errors->any())
            <div class="alert-error-custom">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- ===== FORM ===== -->
        <form method="POST" action="{{ route('admin.UserAccounts.store') }}" class="needs-validation" novalidate>
            @csrf

            <div class="mb-3">
                <label class="form-label-custom">Account name</label>
                <input type="text" name="user_account" value="{{ old('user_account') }}" required
                       class="form-control-custom" placeholder="Enter account name">
                <div class="invalid-feedback">Please enter an account name.</div>
            </div>

            <div class="mb-3">
                <label class="form-label-custom">Password</label>
                <input type="text" name="user_password" required minlength="6"
                       class="form-control-custom" placeholder="Enter password (min 6 characters)">
                <div class="invalid-feedback">Please enter a password (min 6 characters).</div>
            </div>

            <div class="d-flex gap-3 pt-2">
                <a href="{{ route('admin.UserAccounts') }}" class="btn-cancel">Cancel</a>
                <button type="submit" class="btn-submit">Create Account</button>
            </div>
        </form>
    </div>
</div>

<script>
    // ===== BOOTSTRAP VALIDATION =====
    (function() {
        'use strict';
        const forms = document.querySelectorAll('.needs-validation');
        Array.from(forms).forEach(form => {
            form.addEventListener('submit', event => {
                if (!form.checkValidity()) {
                    event.preventDefault();
                    event.stopPropagation();
                }
                form.classList.add('was-validated');
            }, false);
        });
    })();
</script>
@endsection