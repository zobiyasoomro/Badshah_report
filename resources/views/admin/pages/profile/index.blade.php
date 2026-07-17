@extends('admin.layouts.master')
@section('title', 'Dashboard')
@section('admin_content')

<style>
    /* ===== ROOT VARIABLES ===== */
    :root {
        --primary-blue: #3b5f86;
        --primary-blue-dark: #2a4563;
        --primary-blue-darker: #1f354d;
        --primary-gradient: linear-gradient(135deg, #3b5f86 0%, #2a4563 50%, #1f354d 100%);
        --accent: #5b9bd5;
        --accent-light: #8bb9e6;
        --bg: #f0f4f9;
        --card-bg: #ffffff;
        --text-dark: #1a2332;
        --text-muted: #6b7a8f;
        --border-color: #e2e8f0;
        --shadow-sm: 0 2px 8px rgba(42, 69, 99, 0.06);
        --shadow-md: 0 8px 30px rgba(42, 69, 99, 0.10);
        --shadow-lg: 0 16px 50px rgba(42, 69, 99, 0.16);
        --radius: 16px;
        --radius-sm: 10px;
        --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }

    /* ===== GLOBAL ===== */
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        background: var(--bg);
        font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
        color: var(--text-dark);
        line-height: 1.6;
    }

    .container-fluid {
        max-width: 1200px;
        margin: 0 auto;
        padding: 20px 24px;
    }

    /* ===== PROFILE HEADER ===== */
    .profile-header {
        background: var(--primary-gradient);
        border-radius: var(--radius);
        padding: 48px 40px;
        position: relative;
        overflow: hidden;
        box-shadow: var(--shadow-lg);
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        text-align: center;
        margin-bottom: 28px;
    }

    .profile-header::before {
        content: '';
        position: absolute;
        top: -60%;
        right: -15%;
        width: 500px;
        height: 500px;
        background: radial-gradient(circle, rgba(255, 255, 255, 0.06) 0%, transparent 70%);
        border-radius: 50%;
        pointer-events: none;
    }

    .profile-header::after {
        content: '';
        position: absolute;
        bottom: -50%;
        left: -10%;
        width: 400px;
        height: 400px;
        background: radial-gradient(circle, rgba(255, 255, 255, 0.04) 0%, transparent 70%);
        border-radius: 50%;
        pointer-events: none;
    }

    .profile-img {
        width: 128px;
        height: 128px;
        border-radius: 50%;
        border: 5px solid rgba(255, 255, 255, 0.95);
        object-fit: cover;
        background: #fff;
        box-shadow: 0 8px 32px rgba(0, 0, 0, 0.20);
        margin-bottom: 18px;
        display: block;
        position: relative;
        z-index: 1;
        transition: var(--transition);
    }

    .profile-img:hover {
        transform: scale(1.05) rotate(-2deg);
    }

    .profile-info h3 {
        font-weight: 700;
        color: #fff;
        font-size: 26px;
        margin-bottom: 2px;
        text-shadow: 0 2px 12px rgba(0, 0, 0, 0.15);
        position: relative;
        z-index: 1;
        letter-spacing: -0.3px;
    }

    .profile-info p {
        color: rgba(255, 255, 255, 0.82);
        font-size: 15px;
        margin-bottom: 6px;
        position: relative;
        z-index: 1;
    }

    .badge-admin {
        background: rgba(255, 255, 255, 0.15);
        backdrop-filter: blur(12px);
        -webkit-backdrop-filter: blur(12px);
        color: #fff;
        padding: 6px 22px;
        border-radius: 50px;
        font-weight: 600;
        display: inline-block;
        margin-top: 6px;
        font-size: 13px;
        letter-spacing: 0.5px;
        border: 1px solid rgba(255, 255, 255, 0.12);
        position: relative;
        z-index: 1;
    }

    .badge-admin i {
        margin-right: 8px;
        font-size: 12px;
    }

    /* ===== SECTION CARDS ===== */
    .section-card {
        background: var(--card-bg);
        border-radius: var(--radius);
        padding: 28px 32px;
        box-shadow: var(--shadow-sm);
        transition: var(--transition);
        margin-bottom: 20px;
        border: 1px solid rgba(226, 232, 240, 0.4);
    }

    .section-card:hover {
        box-shadow: var(--shadow-md);
        border-color: rgba(59, 95, 134, 0.10);
    }

    .section-title {
        color: var(--primary-blue);
        font-weight: 700;
        font-size: 18px;
        margin-bottom: 20px;
        padding-bottom: 12px;
        border-bottom: 2px solid rgba(59, 95, 134, 0.12);
        display: flex;
        align-items: center;
        gap: 10px;
        letter-spacing: -0.2px;
    }

    .section-title i {
        color: var(--primary-blue);
        font-size: 20px;
        width: 32px;
        height: 32px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: rgba(59, 95, 134, 0.08);
        border-radius: 8px;
    }

    /* ===== FORM FIELDS ===== */
    .field-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 16px 24px;
    }

    .field-group {
        display: flex;
        flex-direction: column;
        gap: 4px;
    }

    .field-group label {
        font-weight: 600;
        color: var(--text-dark);
        font-size: 0.82rem;
        letter-spacing: 0.3px;
        text-transform: uppercase;
        opacity: 0.75;
        display: flex;
        align-items: center;
        gap: 6px;
    }

    .field-group label i {
        color: var(--primary-blue);
        opacity: 0.6;
        font-size: 13px;
        width: 16px;
    }

    .field-group .form-control {
        width: 100%;
        border-radius: var(--radius-sm);
        min-height: 46px;
        border: 1.5px solid var(--border-color);
        background: #fafbfc;
        padding: 0 14px;
        font-size: 14px;
        transition: var(--transition);
        color: var(--text-dark);
        font-family: inherit;
    }

    .field-group .form-control:focus {
        border-color: var(--accent);
        background: #ffffff;
        box-shadow: 0 0 0 4px rgba(91, 155, 213, 0.12);
        outline: none;
    }

    .field-group .form-control::placeholder {
        color: #a8b8c9;
        font-size: 13px;
    }

    .field-group textarea.form-control {
        padding: 12px 14px;
        resize: vertical;
        min-height: 90px;
    }

    .field-group.full-width {
        grid-column: 1 / -1;
    }

    @media (max-width: 768px) {
        .field-grid {
            grid-template-columns: 1fr;
            gap: 12px;
        }

        .field-group.full-width {
            grid-column: 1;
        }

        .section-card {
            padding: 20px;
        }

        .profile-header {
            padding: 32px 20px;
        }

        .profile-info h3 {
            font-size: 22px;
        }

        .profile-img {
            width: 100px;
            height: 100px;
        }

        .container-fluid {
            padding: 12px 16px;
        }
    }

    /* ===== PASSWORD SECTION ===== */
    .password-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 20px;
    }

    .password-grid .field-group label {
        text-transform: uppercase;
        font-size: 0.78rem;
        opacity: 0.7;
    }

    .password-grid .form-control {
        min-height: 44px;
        border-radius: var(--radius-sm);
        border: 1.5px solid var(--border-color);
        background: #fafbfc;
        padding: 0 14px;
        font-size: 14px;
        transition: var(--transition);
        font-family: inherit;
    }

    .password-grid .form-control:focus {
        border-color: var(--accent);
        background: #ffffff;
        box-shadow: 0 0 0 4px rgba(91, 155, 213, 0.10);
        outline: none;
    }

    @media (max-width: 768px) {
        .password-grid {
            grid-template-columns: 1fr;
            gap: 12px;
        }
    }

    /* ===== PROFILE PICTURE SECTION ===== */
    .profile-picture-section {
        background: var(--card-bg);
        border-radius: var(--radius);
        padding: 28px 32px;
        box-shadow: var(--shadow-sm);
        transition: var(--transition);
        border: 1px solid rgba(226, 232, 240, 0.4);
        height: 100%;
        display: flex;
        flex-direction: column;
        justify-content: center;
    }

    .profile-picture-section:hover {
        box-shadow: var(--shadow-md);
        border-color: rgba(59, 95, 134, 0.10);
    }

    .profile-picture-section .file-input {
        display: block;
        width: 100%;
        padding: 10px 14px;
        border: 1.5px solid var(--border-color);
        border-radius: var(--radius-sm);
        background: #fafbfc;
        transition: var(--transition);
        font-size: 14px;
        cursor: pointer;
        font-family: inherit;
    }

    .profile-picture-section .file-input:hover {
        border-color: var(--accent);
        background: #ffffff;
    }

    .profile-picture-section .file-input:focus {
        border-color: var(--accent);
        box-shadow: 0 0 0 4px rgba(91, 155, 213, 0.10);
        outline: none;
    }

    .profile-picture-section .label-text {
        font-weight: 600;
        color: var(--text-dark);
        font-size: 0.82rem;
        letter-spacing: 0.3px;
        text-transform: uppercase;
        opacity: 0.75;
        margin-bottom: 6px;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .profile-picture-section .label-text i {
        color: var(--primary-blue);
        opacity: 0.6;
    }

    .profile-picture-section .current-file {
        margin-top: 8px;
        font-size: 13px;
        color: var(--text-muted);
    }

    /* ===== UPDATE BUTTON SECTION ===== */
    .update-btn-section {
        background: var(--card-bg);
        border-radius: var(--radius);
        padding: 28px 32px;
        box-shadow: var(--shadow-sm);
        transition: var(--transition);
        border: 1px solid rgba(226, 232, 240, 0.4);
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        min-height: 140px;
    }

    .update-btn-section:hover {
        box-shadow: var(--shadow-md);
        border-color: rgba(59, 95, 134, 0.10);
    }

    .btn-theme {
        background: var(--primary-gradient);
        color: #ffffff;
        border: none;
        border-radius: var(--radius-sm);
        padding: 16px 48px;
        font-weight: 600;
        font-size: 16px;
        transition: var(--transition);
        cursor: pointer;
        letter-spacing: 0.3px;
        width: 100%;
        position: relative;
        overflow: hidden;
        font-family: inherit;
    }

    .btn-theme::after {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.12), transparent);
        transition: left 0.6s ease;
    }

    .btn-theme:hover::after {
        left: 100%;
    }

    .btn-theme:hover {
        transform: translateY(-2px);
        box-shadow: 0 12px 32px rgba(42, 69, 99, 0.35);
        color: #fff;
    }

    .btn-theme:active {
        transform: translateY(0);
        box-shadow: 0 4px 16px rgba(42, 69, 99, 0.25);
    }

    .btn-theme i {
        margin-right: 10px;
        font-size: 15px;
    }

    /* ===== ALERTS ===== */
    .alert {
        border-radius: var(--radius-sm);
        padding: 14px 20px;
        border: none;
        font-weight: 500;
        box-shadow: var(--shadow-sm);
        margin-bottom: 20px;
        display: flex;
        align-items: center;
        gap: 10px;
        transition: opacity 0.5s ease;
    }

    .alert-success {
        background: #e6f7ed;
        color: #0f5c3a;
        border-left: 4px solid #10b981;
    }

    .alert-danger {
        background: #fde8e8;
        color: #7f1d1d;
        border-left: 4px solid #ef4444;
    }

    .alert .btn-close {
        filter: brightness(0.4);
        opacity: 0.6;
        margin-left: auto;
        background: transparent;
        border: none;
        font-size: 20px;
        cursor: pointer;
        padding: 0 4px;
    }

    .alert .btn-close:hover {
        opacity: 1;
    }

    .alert ul {
        margin: 0;
        padding-left: 20px;
    }

    /* ===== LAYOUT HELPERS ===== */
    .row {
        display: flex;
        flex-wrap: wrap;
        margin: 0 -12px;
    }

    .col-md-4,
    .col-md-6,
    .col-12 {
        padding: 0 12px;
        flex: 0 0 auto;
        box-sizing: border-box;
    }

    .col-md-4 {
        flex: 0 0 33.333%;
        max-width: 33.333%;
    }

    .col-md-6 {
        flex: 0 0 50%;
        max-width: 50%;
    }

    .col-12 {
        flex: 0 0 100%;
        max-width: 100%;
    }

    @media (max-width: 768px) {
        .col-md-4 {
            flex: 0 0 100%;
            max-width: 100%;
        }

        .col-md-6 {
            flex: 0 0 100%;
            max-width: 100%;
        }
    }

    .mt-2 {
        margin-top: 8px;
    }
    .mt-3 {
        margin-top: 16px;
    }
    .mt-4 {
        margin-top: 24px;
    }
    .mb-2 {
        margin-bottom: 8px;
    }
    .mb-3 {
        margin-bottom: 16px;
    }
    .mb-4 {
        margin-bottom: 24px;
    }
    .gap-2 {
        gap: 8px;
    }
    .gap-3 {
        gap: 12px;
    }
</style>

<div class="container-fluid">

    <!-- ===== ALERTS ===== -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert" id="successAlert">
            <i class="fas fa-check-circle"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">&times;</button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert" id="errorAlert">
            <i class="fas fa-exclamation-circle"></i> {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">&times;</button>
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert" id="errorAlert">
            <i class="fas fa-exclamation-triangle"></i>
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">&times;</button>
        </div>
    @endif

    <!-- ===== PROFILE HEADER ===== -->
    <div class="profile-header">
        @php
            $imagePath = $user->image ? asset('users/' . $user->image) : asset('admin/assets/images/avatar.png');
        @endphp
        <img src="{{ $imagePath }}" class="profile-img" id="preview" alt="Profile Avatar">
        <div class="profile-info">
            <h3>{{ $user->name }}</h3>
            <p>{{ $user->email ?? 'No email address set' }}</p>
            <span class="badge-admin">
                <i class="fas fa-user-shield"></i>
                {{ $user->isAdmin() ? 'Administrator' : 'User' }}
            </span>
        </div>
    </div>

    <!-- ===== SINGLE FORM ===== -->
    <form action="{{ route('admin.profile.update') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <!-- ===== PERSONAL INFORMATION ===== -->
        <div class="section-card">
            <h4 class="section-title">
                <i class="fas fa-user-circle"></i> Personal Information
            </h4>

            <div class="field-grid">
                <div class="field-group">
                    <label><i class="fas fa-user"></i> Username</label>
                    <input type="text" name="user_name" class="form-control" value="{{ old('user_name', $user->user_name) }}" placeholder="Enter username">
                </div>

                <div class="field-group">
                    <label><i class="fas fa-user-tag"></i> Full Name</label>
                    <input type="text" name="full_name" class="form-control" value="{{ old('full_name', $user->name) }}" placeholder="Enter full name">
                </div>

                <div class="field-group">
                    <label><i class="fas fa-envelope"></i> Email</label>
                    <input type="email" name="email" class="form-control" value="{{ old('email', $user->email) }}" placeholder="Enter email">
                </div>

                <div class="field-group">
                    <label><i class="fab fa-whatsapp"></i> WhatsApp</label>
                    <input type="text" name="whatsapp_number" class="form-control" value="{{ old('whatsapp_number', $user->whatsapp_number) }}" placeholder="Enter WhatsApp number">
                </div>

                <div class="field-group">
                    <label><i class="fas fa-city"></i> City</label>
                    <input type="text" name="city" class="form-control" value="{{ old('city', $user->city) }}" placeholder="Enter city">
                </div>

                <div class="field-group">
                    <label><i class="fas fa-globe"></i> Country</label>
                    <input type="text" name="country" class="form-control" value="{{ old('country', $user->country) }}" placeholder="Enter country">
                </div>

                <div class="field-group">
                    <label><i class="fas fa-map-pin"></i> State</label>
                    <input type="text" name="state" class="form-control" value="{{ old('state', $user->state) }}" placeholder="Enter state">
                </div>

                <div class="field-group">
                    <label><i class="fab fa-linkedin"></i> LinkedIn</label>
                    <input type="url" name="linkedin_url" class="form-control" value="{{ old('linkedin_url', $user->linkedin_url) }}" placeholder="LinkedIn URL">
                </div>

                <div class="field-group">
                    <label><i class="fab fa-instagram"></i> Instagram</label>
                    <input type="url" name="instagram_url" class="form-control" value="{{ old('instagram_url', $user->instagram_url) }}" placeholder="Instagram URL">
                </div>

                <div class="field-group">
                    <label><i class="fab fa-twitter"></i> Twitter</label>
                    <input type="url" name="twitter_url" class="form-control" value="{{ old('twitter_url', $user->twitter_url) }}" placeholder="Twitter URL">
                </div>

                <div class="field-group">
                    <label><i class="fab fa-facebook"></i> Facebook</label>
                    <input type="url" name="facebook_url" class="form-control" value="{{ old('facebook_url', $user->facebook_url) }}" placeholder="Facebook URL">
                </div>

                <div class="field-group full-width">
                    <label><i class="fas fa-home"></i> Address</label>
                    <textarea name="address" class="form-control" rows="3" placeholder="Enter full address">{{ old('address', $user->address) }}</textarea>
                </div>
            </div>
        </div>

        <!-- ===== CHANGE PASSWORD ===== -->
        <div class="section-card">
            <h4 class="section-title">
                <i class="fas fa-lock"></i> Change Password
            </h4>

            <div class="password-grid">
                <div class="field-group">
                    <label><i class="fas fa-key"></i> Current Password</label>
                    <input type="password" name="current_password" class="form-control" placeholder="Enter current password">
                </div>

                <div class="field-group">
                    <label><i class="fas fa-lock"></i> New Password</label>
                    <input type="password" name="new_password" class="form-control" placeholder="Enter new password">
                </div>

                <div class="field-group">
                    <label><i class="fas fa-check-circle"></i> Confirm Password</label>
                    <input type="password" name="new_password_confirmation" class="form-control" placeholder="Confirm new password">
                </div>
            </div>
            
            <small class="text-muted mt-2 d-block">
                <i class="fas fa-info-circle"></i> Leave password fields empty if you don't want to change the password.
            </small>
        </div>

        <!-- ===== PROFILE PICTURE & UPDATE ===== -->
        <div class="row mt-4">
            <div class="col-md-6">
                <div class="profile-picture-section">
                    <span class="label-text">
                        <i class="fas fa-camera"></i> Upload Profile Picture
                    </span>
                    <input type="file" name="image" id="image" onchange="previewImage(event)" accept="image/*" class="file-input">
                    @if($user->image)
                        <div class="current-file">
                            <i class="fas fa-image"></i> Current: {{ $user->image }}
                        </div>
                    @endif
                </div>
            </div>

            <div class="col-md-6">
                <div class="update-btn-section">
                    <button type="submit" class="btn-theme">
                        <i class="fas fa-save"></i> Update Profile
                    </button>
                </div>
            </div>
        </div>

    </form>

</div>

<script>
    // ===== AUTO-HIDE ALERTS =====
    document.addEventListener('DOMContentLoaded', function() {
        // Success alert - hide after 3 seconds
        const successAlert = document.getElementById('successAlert');
        if (successAlert) {
            setTimeout(function() {
                successAlert.style.opacity = '0';
                setTimeout(function() {
                    successAlert.style.display = 'none';
                }, 500);
            }, 3000);
        }

        // Error alert - hide after 5 seconds
        const errorAlert = document.getElementById('errorAlert');
        if (errorAlert) {
            setTimeout(function() {
                errorAlert.style.opacity = '0';
                setTimeout(function() {
                    errorAlert.style.display = 'none';
                }, 500);
            }, 5000);
        }
    });

    // ===== PROFILE IMAGE PREVIEW =====
    function previewImage(event) {
        let reader = new FileReader();
        reader.onload = function () {
            document.getElementById('preview').src = reader.result;
        }
        reader.readAsDataURL(event.target.files[0]);
    }
</script>

@endsection