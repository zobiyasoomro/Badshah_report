@extends('layouts.master')
@section('title', 'User Profile')
@section('content')



    <style>
        /* ===== Unique Namespace: upw (User Profile Wizard) ===== */
        :root {
            --upw-primary: #27d3e3;
            --upw-primary-hover: #27d3e3a5;
            --upw-bg-gradient: linear-gradient(135deg, #a1c4fd 0%, #c2e9fb 100%);
            --upw-sidebar-bg: #2a4563;
            --upw-text-dark: #172844;
            --upw-input-bg: #f5f6f8;
            --upw-border-color: #ddd;
            --upw-transition: 0.3s;
        }

        /* ----- Container ----- */
        .upw-wizard-container {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: calc(100vh - 200px);
            padding: 20px;
            width: 100%;
        }

        /* ----- Wizard Card ----- */
        .upw-wizard-card {
            background-color: #ffffff;
            width: 100%;
            max-width: 950px;
            min-height: 550px;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
            display: flex;
            overflow: hidden;
            position: relative;
        }

        /* ----- Toggler Button ----- */
        .upw-menu-toggle-btn {
            display: none;
            position: absolute;
            top: 15px;
            left: 15px;
            background-color: rgba(255, 255, 255, 0.95);
            border: 1px solid rgba(0, 0, 0, 0.15);
            border-radius: 6px;
            width: 34px;
            height: 34px;
            justify-content: center;
            align-items: center;
            cursor: pointer;
            z-index: 99;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.15);
            transition: background-color 0.2s, transform 0.1s;
        }

        .upw-menu-toggle-btn:hover {
            background-color: #ffffff;
        }

        .upw-menu-toggle-btn svg {
            width: 18px;
            height: 18px;
            stroke: var(--upw-text-dark);
        }

        /* ----- Sidebar ----- */
        .upw-sidebar {
            background-color: var(--upw-sidebar-bg);
            width: 280px;
            min-height: 100%;
            padding: 35px 25px;
            display: flex;
            flex-direction: column;
            gap: 25px;
            position: relative;
            left: 0;
            flex-shrink: 0;
            transition: left var(--upw-transition) ease-in-out;
        }

        .upw-close-sidebar-btn {
            display: none;
            align-self: flex-end;
            background: none;
            border: none;
            color: rgba(255, 255, 255, 0.7);
            cursor: pointer;
            padding: 5px;
            margin-bottom: -10px;
            transition: color 0.2s;
        }

        .upw-close-sidebar-btn:hover {
            color: #ffffff;
        }

        .upw-close-sidebar-btn svg {
            width: 24px;
            height: 24px;
        }

        /* ----- Sidebar Profile Image ----- */
        .upw-sidebar-logo-container {
            width: 100%;
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-bottom: 10px;
            gap: 10px;
        }

        .upw-sidebar-logo {
            width: 90px;
            height: 90px;
            border-radius: 50%;
            background-color: rgba(255, 255, 255, 0.1);
            border: 2px solid rgba(255, 255, 255, 0.3);
            display: flex;
            justify-content: center;
            align-items: center;
            overflow: hidden;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.15);
        }

        .upw-sidebar-logo img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .upw-sidebar-avatar-edit-btn {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background-color: rgba(255, 255, 255, 0.15);
            border: 1px solid rgba(255, 255, 255, 0.3);
            padding: 5px 12px;
            border-radius: 20px;
            color: #ffffff;
            font-size: 0.75rem;
            font-weight: 500;
            cursor: pointer;
            transition: background-color 0.2s, border-color 0.2s;
        }

        .upw-sidebar-avatar-edit-btn:hover {
            background-color: var(--upw-primary);
            border-color: var(--upw-primary);
        }

        .upw-sidebar-avatar-edit-btn svg {
            width: 13px;
            height: 13px;
            fill: #ffffff;
        }

        /* ----- Step Items ----- */
        .upw-step-item {
            display: flex;
            align-items: center;
            gap: 15px;
            color: rgba(255, 255, 255, 0.7);
            font-weight: 500;
            font-size: 0.95rem;
            transition: all var(--upw-transition) ease;
            cursor: pointer;
            padding: 8px 12px;
            border-radius: 8px;
        }

        .upw-step-item:hover {
            background-color: rgba(255, 255, 255, 0.1);
        }

        .upw-step-circle {
            width: 24px;
            height: 24px;
            border: 2px dashed rgba(255, 255, 255, 0.6);
            border-radius: 50%;
            display: inline-block;
            position: relative;
            flex-shrink: 0;
        }

        .upw-step-item.active {
            color: #ffffff;
            background-color: rgba(255, 255, 255, 0.1);
        }

        .upw-step-item.active .upw-step-circle {
            border: 2px dashed transparent;
            background-color: var(--upw-primary);
            box-shadow: 0 0 0 4px rgba(13, 110, 253, 0.3);
        }

        .upw-step-item.active .upw-step-circle::after {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 10px;
            height: 10px;
            background-color: #ffffff;
            border-radius: 50%;
        }

        /* ----- Sidebar Overlay ----- */
        .upw-sidebar-overlay {
            display: none;
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.4);
            z-index: 98;
        }

        .upw-sidebar-overlay.active {
            display: block;
        }

        /* ----- Content Area ----- */
        .upw-content-area {
            flex-grow: 1;
            padding: 40px 50px;
            display: flex;
            flex-direction: column;
            position: relative;
            transition: all var(--upw-transition);
            background: #ffffff;
        }

        .upw-form-title {
            color: var(--upw-text-dark);
            font-size: 1.4rem;
            text-transform: uppercase;
            font-weight: 700;
            margin-bottom: 30px;
            letter-spacing: 0.5px;
            border-bottom: 2px solid var(--upw-primary);
            padding-bottom: 12px;
        }

        .upw-wizard-form {
            display: flex;
            flex-direction: column;
            flex-grow: 1;
            gap: 24px;
        }

        .upw-form-step {
            display: none;
            flex-direction: column;
            gap: 20px;
            flex-grow: 1;
            animation: upw-fadeIn 0.3s ease;
        }

        @keyframes upw-fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .upw-form-step.active {
            display: flex;
        }

        .upw-input-group {
            position: relative;
            width: 100%;
            display: flex;
            flex-direction: column;
            gap: 6px;
        }

        .upw-input-group label {
            font-size: 0.85rem;
            font-weight: 600;
            color: var(--upw-text-dark);
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .upw-input-group input {
            width: 100%;
            padding: 14px 18px;
            background-color: var(--upw-input-bg);
            border: 1px solid transparent;
            border-radius: 6px;
            font-size: 0.95rem;
            color: #333;
            outline: none;
            transition: all 0.2s;
        }

        .upw-input-group input.upw-action-padding {
            padding-right: 85px;
        }

        .upw-input-group input::placeholder {
            color: #a0a5b0;
        }

        .upw-input-group input[readonly] {
            background-color: #f0f2f5;
            cursor: not-allowed;
            color: #555;
        }

        .upw-input-group input:focus:not([readonly]) {
            background-color: #fff;
            border-color: #1ea2e9;
            box-shadow: 0 0 0 3px rgba(30, 162, 233, 0.1);
        }

        /* ----- Input Actions ----- */
        .upw-input-actions {
            position: absolute;
            right: 14px;
            bottom: 12px;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .upw-action-icon-btn {
            background: none;
            border: none;
            padding: 0;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #a0a5b0;
            transition: color 0.2s;
        }

        .upw-action-icon-btn:hover {
            color: var(--upw-primary);
        }

        .upw-action-icon-btn svg {
            width: 19px;
            height: 19px;
        }

        .upw-copy-toast {
            position: absolute;
            right: 0;
            top: -30px;
            background: #172844;
            color: #fff;
            padding: 4px 8px;
            font-size: 0.75rem;
            border-radius: 4px;
            opacity: 0;
            visibility: hidden;
            transition: opacity 0.2s, transform 0.2s;
            transform: translateY(5px);
            pointer-events: none;
            white-space: nowrap;
        }

        .upw-copy-toast.show {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
        }

        /* ----- Navigation Buttons ----- */
        .upw-nav-buttons {
            display: flex;
            justify-content: flex-end;
            gap: 15px;
            margin-top: 20px;
            padding-top: 20px;
            border-top: 1px solid #eee;
        }

        .upw-nav-arrow {
            background: var(--upw-input-bg);
            border: 1px solid var(--upw-border-color);
            color: var(--upw-text-dark);
            font-size: 1.2rem;
            padding: 10px 25px;
            border-radius: 6px;
            cursor: pointer;
            transition: all 0.2s;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .upw-nav-arrow:hover:not(:disabled) {
            background: var(--upw-primary);
            color: white;
            border-color: var(--upw-primary);
            transform: scale(1.02);
        }

        .upw-nav-arrow:disabled {
            opacity: 0.4;
            cursor: not-allowed;
            transform: none;
        }

        /* ----- Submit Button ----- */
        .upw-submit-container {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-top: 20px;
        }

        .upw-submit-btn {
            background-color: #198754;
            color: white;
            border: none;
            padding: 14px 40px;
            border-radius: 6px;
            cursor: pointer;
            font-weight: 600;
            font-size: 1rem;
            transition: background-color 0.2s, transform 0.1s;
            box-shadow: 0 4px 12px rgba(25, 135, 84, 0.2);
            width: 100%;
            max-width: 300px;
        }

        .upw-submit-btn:hover {
            background-color: #157347;
            transform: translateY(-1px);
        }

        .upw-submit-btn:active {
            transform: translateY(1px);
        }

        /* ===== Mobile/Tablet Responsive ===== */
        @media (max-width: 768px) {
            .upw-wizard-container {
                padding: 10px;
                min-height: calc(100vh - 100px);
            }

            .upw-wizard-card {
                flex-direction: column;
                height: auto;
                min-height: 500px;
            }

            .upw-menu-toggle-btn {
                display: flex;
            }

            .upw-sidebar {
                position: absolute;
                left: -280px;
                top: 0;
                z-index: 100;
                min-height: 100%;
                box-shadow: 5px 0 15px rgba(0, 0, 0, 0.2);
            }

            .upw-sidebar.open {
                left: 0;
            }

            .upw-close-sidebar-btn {
                display: block;
            }

            .upw-content-area {
                padding: 70px 20px 30px 20px;
            }

            .upw-form-title {
                font-size: 1.1rem;
                margin-bottom: 20px;
            }

            .upw-nav-buttons {
                flex-direction: row;
                justify-content: space-between;
                gap: 10px;
            }

            .upw-nav-arrow {
                padding: 8px 16px;
                font-size: 0.9rem;
                flex: 1;
                justify-content: center;
            }
        }

        @media (max-width: 480px) {
            .upw-wizard-container {
                padding: 5px;
            }

            .upw-content-area {
                padding: 60px 15px 20px 15px;
            }

            .upw-form-title {
                font-size: 1rem;
            }

            .upw-input-group input {
                padding: 12px 15px;
                font-size: 0.85rem;
            }

            .upw-submit-btn {
                padding: 12px 20px;
                font-size: 0.9rem;
            }

            .upw-sidebar {
                width: 260px;
                padding: 25px 20px;
            }
        }
    </style>


    <div class="upw-wizard-container">


        <div class="upw-wizard-card">
            <div class="upw-sidebar-overlay" id="upw-sidebar-overlay"></div>

            <div class="upw-sidebar" id="upw-sidebar">
                <button type="button" class="upw-close-sidebar-btn" id="upw-close-sidebar-btn">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>

                <div class="upw-sidebar-logo-container">
                    <div class="upw-sidebar-logo" id="upw-sidebar-avatar-preview">
                        <img src="{{ $user->getAvatarAttribute() ?? 'https://images.unsplash.com/photo-1534528741775-53994a69daeb?auto=format&fit=crop&q=80&w=200' }}"
                            alt="Avatar" id="upw-sidebar-avatar-img">
                    </div>
                </div>

                <div class="upw-step-item active" data-step="1">
                    <span class="upw-step-circle"></span>
                    <span class="upw-step-text">Personal Details</span>
                </div>
                <div class="upw-step-item" data-step="2">
                    <span class="upw-step-circle"></span>
                    <span class="upw-step-text">Contact Info</span>
                </div>
                <div class="upw-step-item" data-step="3">
                    <span class="upw-step-circle"></span>
                    <span class="upw-step-text">Social Profiles</span>
                </div>
            </div>

            <div class="upw-content-area">
                <h2 class="upw-form-title" id="upw-step-title">Personal Details</h2>
                @if(session('success'))
                    <div id="success-alert" class="alert alert-success alert-dismissible fade show mb-3">
                        {{ session('success') }}
                    </div>
                @endif

                @if(session('error'))
                    <div id="error-alert" class="alert alert-danger alert-dismissible fade show mb-3">
                        {{ session('error') }}
                    </div>
                @endif
                <form id="upw-wizard-form" class="upw-wizard-form" action="{{ route('pages.userprofile.update') }}"
                    method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="upw-input-group">
                        <label for="upw-main-image-input">Profile Image (optional)</label>
                        <input type="file" id="upw-main-image-input" name="image" accept="image/*">
                    </div>

                    <div class="upw-form-step active" data-step="1">
                        <div class="upw-input-group">
                            <label for="upw-username">Username</label>
                            <input type="text" id="upw-username" name="user_name" class="upw-action-padding"
                                value="{{ $user->user_name }}" readonly>

                            <div class="upw-input-actions">
                                <span class="upw-copy-toast" id="upw-username-toast">Copied!</span>
                                <button type="button" class="upw-action-icon-btn"
                                    onclick="upwCopyField('upw-username', 'upw-username-toast')" title="Copy Username">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M15.75 17.25v3.375c0 .621-.504 1.125-1.125 1.125h-9.75a1.125 1.125 0 01-1.125-1.125V7.875c0-.621.504-1.125 1.125-1.125H5.25m11.9-3.664A2.251 2.251 0 0015 2.25h-1.5a2.251 2.251 0 00-2.15 1.586m5.8 0c.065.21.1.433.1.664v.75h-6V4.5c0-.231.035-.454.1-.664M6.75 7.309V19.5L18 19.5c.621 0 1.125-.504 1.125-1.125V8.118M6.75 7.309L15 2.25m-8.25 5.059H15" />
                                    </svg>
                                </button>
                            </div>
                        </div>

                        <div class="upw-input-group">
                            <label for="upw-password">Password</label>
                            <input type="password" id="upw-password" class="upw-action-padding"
                                value="{{ $user->password }}" readonly>

                            <div class="upw-input-actions">
                                <span class="upw-copy-toast" id="upw-password-toast">Copied!</span>

                                <button type="button" class="upw-action-icon-btn"
                                    onclick="upwCopyField('upw-password', 'upw-password-toast')" title="Copy Password">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M15.75 17.25v3.375c0 .621-.504 1.125-1.125 1.125h-9.75a1.125 1.125 0 01-1.125-1.125V7.875c0-.621.504-1.125 1.125-1.125H5.25m11.9-3.664A2.251 2.251 0 0015 2.25h-1.5a2.251 2.251 0 00-2.15 1.586m5.8 0c.065.21.1.433.1.664v.75h-6V4.5c0-.231.035-.454.1-.664M6.75 7.309V19.5L18 19.5c.621 0 1.125-.504 1.125-1.125V8.118M6.75 7.309L15 2.25m-8.25 5.059H15" />
                                    </svg>
                                </button>

                                <button type="button" class="upw-action-icon-btn" id="upw-toggle-pwd-btn"
                                    title="Toggle Visibility">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" id="upw-eye-svg">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                </button>
                            </div>
                        </div>

                        <div class="upw-input-group">
                            <label for="upw-full_name">Full Name</label>
                            <input type="text" id="upw-full_name" name="full_name" placeholder="Enter your full name"
                                value="{{ old('full_name', $user->name) }}" required>
                        </div>

                        <div class="upw-input-group">
                            <label for="upw-email">Email</label>
                            <input type="email" id="upw-email" name="email" placeholder="Enter your email address"
                                value="{{ old('email', $user->email) }}">
                        </div>
                    </div>

                    <div class="upw-form-step" data-step="2">
                        <div class="upw-input-group">
                            <label for="upw-whatsapp_num">Whatsapp Number</label>
                            <input type="tel" id="upw-whatsapp_num" name="whatsapp_number"
                                placeholder="Enter Whatsapp Number"
                                value="{{ old('whatsapp_number', $user->whatsapp_number) }}" required>
                        </div>

                        <div class="upw-input-group">
                            <label for="upw-address">Address (optional)</label>
                            <input type="text" id="upw-address" name="address" placeholder="Enter your address"
                                value="{{ old('address', $user->address) }}">
                        </div>

                        <div class="upw-input-group">
                            <label for="upw-city">City</label>
                            <input type="text" id="upw-city" name="city" placeholder="Enter your city"
                                value="{{ old('city', $user->city) }}">
                        </div>

                        <div class="upw-input-group">
                            <label for="upw-state">State/Province</label>
                            <input type="text" id="upw-state" name="state" placeholder="Enter your state or province"
                                value="{{ old('state', $user->state) }}">
                        </div>

                        <div class="upw-input-group">
                            <label for="upw-country">Country</label>
                            <input type="text" id="upw-country" name="country" placeholder="Enter your country"
                                value="{{ old('country', $user->country) }}">
                        </div>
                    </div>

                    <div class="upw-form-step" data-step="3">
                        <div class="upw-input-group">
                            <label for="upw-linkedin_url">LinkedIn Profile URL (optional)</label>
                            <input type="url" id="upw-linkedin_url" name="linkedin_url"
                                placeholder="https://linkedin.com/in/username"
                                value="{{ old('linkedin_url', $user->linkedin_url) }}">
                        </div>

                        <div class="upw-input-group">
                            <label for="upw-instagram_url">Instagram Profile URL (optional)</label>
                            <input type="url" id="upw-instagram_url" name="instagram_url"
                                placeholder="https://instagram.com/username"
                                value="{{ old('instagram_url', $user->instagram_url) }}">
                        </div>

                        <div class="upw-input-group">
                            <label for="upw-twitter_url">Twitter Profile URL (optional)</label>
                            <input type="url" id="upw-twitter_url" name="twitter_url"
                                placeholder="https://twitter.com/username"
                                value="{{ old('twitter_url', $user->twitter_url) }}">
                        </div>

                        <div class="upw-input-group">
                            <label for="upw-facebook_url">Facebook Profile URL (optional)</label>
                            <input type="url" id="upw-facebook_url" name="facebook_url"
                                placeholder="https://facebook.com/username"
                                value="{{ old('facebook_url', $user->facebook_url) }}">
                        </div>

                        <!-- <div class="upw-submit-container">
                            <button type="submit" class="upw-submit-btn">Update Profile</button>
                        </div> -->
                    </div>
                </form>

                <div class="upw-nav-buttons">
                    <button type="button" class="upw-nav-arrow" id="upw-prev-btn" disabled>
                        <span>←</span> Previous
                    </button>

                    <button type="button" class="upw-nav-arrow" id="upw-next-btn">
                        Next <span>→</span>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        (function () {
            'use strict';

            // Cache DOM elements
            const steps = document.querySelectorAll('.upw-form-step');
            const stepIndicators = document.querySelectorAll('.upw-step-item');
            const prevBtn = document.getElementById('upw-prev-btn');
            const nextBtn = document.getElementById('upw-next-btn');
            const stepTitle = document.getElementById('upw-step-title');

            let currentStep = 1;
            const totalSteps = steps.length;

            // 1. Bulletproof Copy Function
            window.upwCopyField = function (fieldId, toastId) {
                const inputField = document.getElementById(fieldId);
                if (!inputField) return;

                const originalType = inputField.type;

                // Momentarily change type to text to bypass password mask copy bans
                inputField.type = 'text';
                inputField.select();
                inputField.setSelectionRange(0, 99999);

                try {
                    const successful = document.execCommand('copy');
                    if (successful) {
                        showSuccessToast(toastId);
                    } else {
                        navigator.clipboard.writeText(inputField.value).then(() => {
                            showSuccessToast(toastId);
                        });
                    }
                } catch (err) {
                    navigator.clipboard.writeText(inputField.value).then(() => {
                        showSuccessToast(toastId);
                    }).catch(e => console.error('Failed to copy: ', e));
                }

                inputField.type = originalType;
                inputField.blur();
            };

            function showSuccessToast(toastId) {
                const toast = document.getElementById(toastId);
                if (toast) {
                    toast.classList.add('show');
                    setTimeout(() => toast.classList.remove('show'), 1500);
                }
            }

            // 2. Interactive Eye / Show Hide Password Toggle
            const passwordInput = document.getElementById('upw-password');
            const togglePwdBtn = document.getElementById('upw-toggle-pwd-btn');
            const eyeSvg = document.getElementById('upw-eye-svg');

            if (togglePwdBtn && passwordInput) {
                togglePwdBtn.addEventListener('click', function (e) {
                    e.preventDefault();
                    if (passwordInput.type === 'password') {
                        passwordInput.type = 'text';
                        if (eyeSvg) {
                            eyeSvg.innerHTML = `<path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 001.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.45 10.45 0 0112 4.5c4.756 0 8.773 3.162 10.065 7.498a10.523 10.523 0 01-4.293 5.774M6.228 6.228L3 3m3.228 3.228l3.65 3.65m7.894 7.894L21 21m-3.228-3.228l-3.65-3.65m0 0a3 3 0 10-4.243-4.243m4.242 4.242L9.88 9.88" />`;
                        }
                    } else {
                        passwordInput.type = 'password';
                        if (eyeSvg) {
                            eyeSvg.innerHTML = `<path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" /><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />`;
                        }
                    }
                });
            }

            // 3. Navigation Drawer Sidebar for Mobile Devices
            const sidebar = document.getElementById('upw-sidebar');
            const menuBtn = document.getElementById('upw-menu-btn');
            const closeSidebarBtn = document.getElementById('upw-close-sidebar-btn');
            const sidebarOverlay = document.getElementById('upw-sidebar-overlay');

            function openSidebar() {
                if (sidebar) sidebar.classList.add('open');
                if (sidebarOverlay) sidebarOverlay.classList.add('active');
            }

            function closeSidebar() {
                if (sidebar) sidebar.classList.remove('open');
                if (sidebarOverlay) sidebarOverlay.classList.remove('active');
            }

            if (menuBtn) menuBtn.addEventListener('click', openSidebar);
            if (closeSidebarBtn) closeSidebarBtn.addEventListener('click', closeSidebar);
            if (sidebarOverlay) sidebarOverlay.addEventListener('click', closeSidebar);

            // 4. Multi-step Form Wizard Handling
            function updateWizard(step) {
                steps.forEach(s => s.classList.remove('active'));
                const targetStep = document.querySelector(`.upw-form-step[data-step="${step}"]`);
                if (targetStep) targetStep.classList.add('active');

                stepIndicators.forEach(ind => {
                    ind.classList.toggle('active', parseInt(ind.getAttribute('data-step')) === step);
                });

                const activeText = document.querySelector(`.upw-step-item[data-step="${step}"] .upw-step-text`);
                if (activeText && stepTitle) {
                    stepTitle.textContent = activeText.textContent;
                }

                if (prevBtn) prevBtn.disabled = (step === 1);
                if (nextBtn) {
                    nextBtn.innerHTML = (step === totalSteps) ? 'Done <span>&check;</span>' : 'Next <span>→</span>';
                }
            }

            if (nextBtn) {
                nextBtn.addEventListener('click', function () {
                    if (currentStep < totalSteps) {
                        currentStep++;
                        updateWizard(currentStep);
                    } else {
                        document.getElementById('upw-wizard-form').submit();
                    }
                });
            }

            if (prevBtn) {
                prevBtn.addEventListener('click', function () {
                    if (currentStep > 1) {
                        currentStep--;
                        updateWizard(currentStep);
                    }
                });
            }

            stepIndicators.forEach(indicator => {
                indicator.addEventListener('click', function () {
                    currentStep = parseInt(this.getAttribute('data-step'));
                    updateWizard(currentStep);
                    if (window.innerWidth <= 768) {
                        closeSidebar();
                    }
                });
            });

            // 5. Instantly Preview Uploaded Avatar
            const mainImageInput = document.getElementById('upw-main-image-input');
            const sidebarAvatarImg = document.getElementById('upw-sidebar-avatar-img');

            if (mainImageInput && sidebarAvatarImg) {
                mainImageInput.addEventListener('change', function () {
                    const file = this.files[0];
                    if (file) {
                        const reader = new FileReader();
                        reader.onload = function (e) {
                            sidebarAvatarImg.src = e.target.result;
                        };
                        reader.readAsDataURL(file);
                    }
                });
            }

            // Initializer
            updateWizard(1);

            // Auto-hide alerts after 3 seconds
            const successAlert = document.getElementById('success-alert');
            if (successAlert) {
                setTimeout(() => {
                    successAlert.remove();
                }, 3000);
            }

            const errorAlert = document.getElementById('error-alert');
            if (errorAlert) {
                setTimeout(() => {
                    errorAlert.remove();
                }, 3000);
            }

        })();
    </script>
@endsection