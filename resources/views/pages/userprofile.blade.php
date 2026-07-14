@extends('layouts.master')
@section('title', 'User Profile')
@section('content')

<style>
    :root {
        --primary-color: #27d3e3;
        --primary-hover: #27d3e3a5;
        --bg-gradient: linear-gradient(135deg, #a1c4fd 0%, #c2e9fb 100%);
        --sidebar-bg: #2a4563;
        --text-dark: #172844;
        --input-bg: #f5f6f8;
        --border-color: #ddd;
        --transition-speed: 0.3s;
    }

    /* Container to center the wizard card */
    .wizard-container {
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: calc(100vh - 200px);
        padding: 20px;
        width: 100%;
    }

    .wizard-card {
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

    /* --- Updated Toggler Button --- */
    .menu-toggle-btn {
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
        box-shadow: 0 2px 6px rgba(0,0,0,0.15);
        transition: background-color 0.2s, transform 0.1s;
    }

    .menu-toggle-btn:hover {
        background-color: #ffffff;
    }

    .menu-toggle-btn svg {
        width: 18px;
        height: 18px;
        stroke: var(--text-dark);
    }

    /* --- Sidebar --- */
    .sidebar {
        background-color: var(--sidebar-bg);
        width: 280px;
        min-height: 100%;
        padding: 35px 25px;
        display: flex;
        flex-direction: column;
        gap: 25px;
        position: relative;
        left: 0;
        flex-shrink: 0;
        transition: left var(--transition-speed) ease-in-out;
    }

    .close-sidebar-btn {
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

    .close-sidebar-btn:hover {
        color: #ffffff;
    }

    .close-sidebar-btn svg {
        width: 24px;
        height: 24px;
    }

    /* --- Sidebar Profile Image --- */
    .sidebar-logo-container {
        width: 100%;
        display: flex;
        flex-direction: column;
        align-items: center;
        margin-bottom: 10px;
        gap: 10px;
    }

    .sidebar-logo {
        width: 90px;
        height: 90px;
        border-radius: 50%;
        background-color: rgba(255, 255, 255, 0.1);
        border: 2px solid rgba(255, 255, 255, 0.3);
        display: flex;
        justify-content: center;
        align-items: center;
        overflow: hidden;
        box-shadow: 0 4px 10px rgba(0,0,0,0.15);
    }

    .sidebar-logo img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .sidebar-avatar-edit-btn {
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

    .sidebar-avatar-edit-btn:hover {
        background-color: var(--primary-color);
        border-color: var(--primary-color);
    }

    .sidebar-avatar-edit-btn svg {
        width: 13px;
        height: 13px;
        fill: #ffffff;
    }

    .step-item {
        display: flex;
        align-items: center;
        gap: 15px;
        color: rgba(255, 255, 255, 0.7);
        font-weight: 500;
        font-size: 0.95rem;
        transition: all var(--transition-speed) ease;
        cursor: pointer;
        padding: 8px 12px;
        border-radius: 8px;
    }

    .step-item:hover {
        background-color: rgba(255, 255, 255, 0.1);
    }

    .step-circle {
        width: 24px;
        height: 24px;
        border: 2px dashed rgba(255, 255, 255, 0.6);
        border-radius: 50%;
        display: inline-block;
        position: relative;
        flex-shrink: 0;
    }

    .step-item.active {
        color: #ffffff;
        background-color: rgba(255, 255, 255, 0.1);
    }

    .step-item.active .step-circle {
        border: 2px dashed transparent;
        background-color: var(--primary-color);
        box-shadow: 0 0 0 4px rgba(13, 110, 253, 0.3);
    }

    .step-item.active .step-circle::after {
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

    /* --- Dark Overlay --- */
    .sidebar-overlay {
        display: none;
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.4);
        z-index: 98;
    }

    /* --- Content Area --- */
    .content-area {
        flex-grow: 1;
        padding: 40px 50px;
        display: flex;
        flex-direction: column;
        position: relative;
        transition: all var(--transition-speed);
        background: #ffffff;
    }

    .form-title {
        color: var(--text-dark);
        font-size: 1.4rem;
        text-transform: uppercase;
        font-weight: 700;
        margin-bottom: 30px;
        letter-spacing: 0.5px;
        border-bottom: 2px solid var(--primary-color);
        padding-bottom: 12px;
    }

    .wizard-form {
        display: flex;
        flex-direction: column;
        flex-grow: 1;
        gap: 20px;
    }

    .form-step {
        display: none;
        flex-direction: column;
        gap: 20px;
        flex-grow: 1;
        animation: fadeIn 0.3s ease;
    }

    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .form-step.active {
        display: flex;
    }

    .user-profile-wrapper {
        display: flex;
        align-items: center;
        gap: 20px;
        margin-bottom: 10px;
        flex-wrap: wrap;
    }

    .user-profile-preview {
        width: 90px;
        height: 90px;
        border-radius: 50%;
        background-color: var(--input-bg);
        border: 2px dashed #ccc;
        display: flex;
        justify-content: center;
        align-items: center;
        overflow: hidden;
        position: relative;
        flex-shrink: 0;
    }

    .user-profile-preview img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .user-profile-preview svg {
        width: 45px;
        height: 45px;
        fill: #aaa;
    }

    .user-profile-upload-btn {
        background-color: var(--input-bg);
        border: 1px solid var(--border-color);
        padding: 10px 18px;
        border-radius: 6px;
        cursor: pointer;
        font-size: 0.9rem;
        font-weight: 500;
        color: #555;
        transition: all 0.2s;
    }

    .user-profile-upload-btn:hover {
        background-color: #eef0f4;
        border-color: #ccc;
    }

    .input-group {
        position: relative;
        width: 100%;
    }

    .input-group input {
        width: 100%;
        padding: 14px 18px;
        background-color: var(--input-bg);
        border: 1px solid transparent;
        border-radius: 6px;
        font-size: 0.95rem;
        color: #333;
        outline: none;
        transition: all 0.2s;
    }

    .input-group input[type="password"],
    .input-group input[type="text"].password-field {
        padding-right: 50px;
    }

    .input-group input::placeholder {
        color: #a0a5b0;
    }

    .input-group input:focus {
        background-color: #fff;
        border-color: #1ea2e9;
        box-shadow: 0 0 0 3px rgba(30, 162, 233, 0.1);
    }

    .toggle-password {
        position: absolute;
        right: 18px;
        top: 50%;
        transform: translateY(-50%);
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #a0a5b0;
        transition: color 0.2s, opacity 0.2s, visibility 0.2s;
        user-select: none;
        opacity: 0;
        visibility: hidden;
    }

    .toggle-password.visible {
        opacity: 1;
        visibility: visible;
    }

    .toggle-password:hover {
        color: var(--primary-color);
    }

    .toggle-password svg {
        width: 20px;
        height: 20px;
    }

    .nav-buttons {
        display: flex;
        justify-content: flex-end;
        gap: 15px;
        margin-top: 20px;
        padding-top: 20px;
        border-top: 1px solid #eee;
    }

    .nav-arrow {
        background: var(--input-bg);
        border: 1px solid var(--border-color);
        color: var(--text-dark);
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

    .nav-arrow:hover:not(:disabled) {
        background: var(--primary-color);
        color: white;
        border-color: var(--primary-color);
        transform: scale(1.02);
    }

    .nav-arrow:disabled {
        opacity: 0.4;
        cursor: not-allowed;
        transform: none;
    }

    .submit-container {
        display: flex;
        justify-content: center;
        align-items: center;
        margin-top: 20px;
    }

    .submit-btn {
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

    .submit-btn:hover {
        background-color: #157347;
        transform: translateY(-1px);
    }

    .submit-btn:active {
        transform: translateY(1px);
    }

    /* --- Media Query for Mobile/Tablet --- */
    @media (max-width: 768px) {
        .wizard-container {
            padding: 10px;
            min-height: calc(100vh - 100px);
        }

        .wizard-card {
            flex-direction: column;
            height: auto;
            min-height: 500px;
        }

        .menu-toggle-btn {
            display: flex;
        }

        .sidebar {
            position: absolute;
            left: -280px;
            top: 0;
            z-index: 100;
            min-height: 100%;
            box-shadow: 5px 0 15px rgba(0,0,0,0.2);
        }

        .sidebar.open {
            left: 0;
        }

        .close-sidebar-btn {
            display: block;
        }

        .sidebar-overlay.active {
            display: block;
        }

        .content-area {
            padding: 70px 20px 30px 20px;
        }

        .form-title {
            font-size: 1.1rem;
            margin-bottom: 20px;
        }

        .nav-buttons {
            flex-direction: row;
            justify-content: space-between;
            gap: 10px;
        }

        .nav-arrow {
            padding: 8px 16px;
            font-size: 0.9rem;
            flex: 1;
            justify-content: center;
        }

        .user-profile-wrapper {
            justify-content: center;
        }
    }

    @media (max-width: 480px) {
        .wizard-container {
            padding: 5px;
        }

        .content-area {
            padding: 60px 15px 20px 15px;
        }

        .form-title {
            font-size: 1rem;
        }

        .input-group input {
            padding: 12px 15px;
            font-size: 0.85rem;
        }

        .submit-btn {
            padding: 12px 20px;
            font-size: 0.9rem;
        }

        .sidebar {
            width: 260px;
            padding: 25px 20px;
        }
    }
</style>

<div class="wizard-container">
    <button type="button" class="menu-toggle-btn" id="menu-btn" aria-label="Open Steps Menu">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
        </svg>
    </button>

    <div class="wizard-card">
        <div class="sidebar-overlay" id="sidebar-overlay"></div>

        <!-- Sidebar -->
        <div class="sidebar" id="sidebar">
            <button type="button" class="close-sidebar-btn" id="close-sidebar-btn">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>

            <div class="sidebar-logo-container">
                <input type="file" id="sidebar-avatar-input" accept="image/*" style="display: none;">
                
                <div class="sidebar-logo" id="sidebar-avatar-preview">
                    <img src="https://images.unsplash.com/photo-1534528741775-53994a69daeb?auto=format&fit=crop&q=80&w=200" alt="Avatar" id="sidebar-avatar-img">
                </div>
                
                <label for="sidebar-avatar-input" class="sidebar-avatar-edit-btn" title="Change Photo">
                    <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path d="M4 4h3l2-3h6l2 3h3a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2zm8 3a5 5 0 1 0 0 10 5 5 0 0 0 0-10zm0 2a3 3 0 1 1 0 6 3 3 0 0 1 0-6z"/>
                    </svg>
                    Edit Photo
                </label>
            </div>

            <div class="step-item active" data-step="1">
                <span class="step-circle"></span>
                <span class="step-text">User Profile</span>
            </div>
            <div class="step-item" data-step="2">
                <span class="step-circle"></span>
                <span class="step-text">Personal Details</span>
            </div>
            <div class="step-item" data-step="3">
                <span class="step-circle"></span>
                <span class="step-text">Contact Info</span>
            </div>
            <div class="step-item" data-step="4">
                <span class="step-circle"></span>
                <span class="step-text">Social Profiles</span>
            </div>
        </div>

        <!-- Content Area -->
        <div class="content-area">
            <h2 class="form-title" id="step-title">User Profile</h2>

            <form id="wizard-form" class="wizard-form" onsubmit="handleFormSubmit(event)">
                <!-- Step 1: User Profile -->
                <div class="form-step active" data-step="1">
                    <div class="input-group">
                        <input type="email" id="email" placeholder="User Name">
                    </div>
                   
                    <div class="input-group">
                        <input type="password" id="password" class="password-field" placeholder="Password" minlength="6">
                        <span id="password-eye" class="toggle-password" onclick="togglePasswordVisibility('password', this)">
                            <svg class="eye-open" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                        </span>
                    </div>
                    <div class="input-group">
                        <input type="password" id="confirm-password" class="password-field" placeholder="Confirm password">
                        <span id="confirm-password-eye" class="toggle-password" onclick="togglePasswordVisibility('confirm-password', this)">
                            <svg class="eye-open" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                        </span>
                    </div>
                </div>

                <!-- Step 2: Personal Details -->
                <div class="form-step" data-step="2">
                    
                    <div class="input-group">
                        <input type="text" placeholder="First Name">
                    </div>
                    <div class="input-group">
                        <input type="text" placeholder="Last Name">
                    </div>
                    <div class="input-group">
                        <input type="text" placeholder="Email (optional)">
                    </div>
                    <div class="input-group">
                        <input type="email" id="alt-email" placeholder="Alternative email (optional)">
                    </div>
                </div>

                <!-- Step 3: Contact Info -->
                <div class="form-step" data-step="3">
                    <div class="input-group">
                        <input type="tel" placeholder="Whatsapp Number">
                    </div>
                    <div class="input-group">
                        <input type="text" placeholder="Address (opetional)">
                    </div>
                    <div class="input-group">
                        <input type="text" placeholder="City">
                    </div>
                    <div class="input-group">
                        <input type="text" placeholder="State/Province">
                    </div>
                    <div class="input-group">
                        <input type="text" placeholder="Country">
                    </div>
                </div>

                <!-- Step 4: Social Profiles -->
                <div class="form-step" data-step="4">
                    <div class="input-group">
                        <input type="url" placeholder="LinkedIn Profile URL (opetional)">
                    </div>
                    <div class="input-group">
                        <input type="url" placeholder="Instagram Profile URL(opetional)">
                    </div>
                    <div class="input-group">
                        <input type="url" placeholder="Twitter Profile URL (opetional)">
                    </div>
                    <div class="input-group">
                        <input type="url" placeholder="Facebook Profile URL (opetional)">
                    </div>
                    
                    <div class="submit-container">
                        <button type="submit" class="submit-btn">Complete Registration</button>
                    </div>
                </div>
            </form>

            <!-- Navigation Buttons -->
            <div class="nav-buttons">
                <button type="button" class="nav-arrow" id="prev-btn" disabled>
                    <span>←</span> Previous
                </button>
                <button type="button" class="nav-arrow" id="next-btn">
                    Next <span>→</span>
                </button>
            </div>
        </div>
    </div>
</div>

<script>
    const steps = document.querySelectorAll('.form-step');
    const stepIndicators = document.querySelectorAll('.step-item');
    const prevBtn = document.getElementById('prev-btn');
    const nextBtn = document.getElementById('next-btn');
    const stepTitle = document.getElementById('step-title');

    // Sidebar elements
    const sidebar = document.getElementById('sidebar');
    const menuBtn = document.getElementById('menu-btn');
    const closeSidebarBtn = document.getElementById('close-sidebar-btn');
    const sidebarOverlay = document.getElementById('sidebar-overlay');

    let currentStep = 1;
    const totalSteps = steps.length;

    // --- Sidebar Drawer Open/Close logic ---
    function openSidebar() {
        sidebar.classList.add('open');
        sidebarOverlay.classList.add('active');
    }

    function closeSidebar() {
        sidebar.classList.remove('open');
        sidebarOverlay.classList.remove('active');
    }

    menuBtn.addEventListener('click', openSidebar);
    closeSidebarBtn.addEventListener('click', closeSidebar);
    sidebarOverlay.addEventListener('click', closeSidebar);

    // ----------------- Password Show/Hide Feature -----------------
    const passwordInput = document.getElementById('password');
    const confirmPasswordInput = document.getElementById('confirm-password');
    const passwordEye = document.getElementById('password-eye');
    const confirmPasswordEye = document.getElementById('confirm-password-eye');

    passwordInput.addEventListener('input', function() {
        if (this.value.trim().length > 0) {
            passwordEye.classList.add('visible');
        } else {
            passwordEye.classList.remove('visible');
        }
    });

    confirmPasswordInput.addEventListener('input', function() {
        if (this.value.trim().length > 0) {
            confirmPasswordEye.classList.add('visible');
        } else {
            confirmPasswordEye.classList.remove('visible');
        }
    });

    function togglePasswordVisibility(fieldId, iconElement) {
        const passwordField = document.getElementById(fieldId);
        
        if (passwordField.type === "password") {
            passwordField.type = "text";
            iconElement.innerHTML = `
                <svg class="eye-closed" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 001.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.45 10.45 0 0112 4.5c4.756 0 8.773 3.162 10.065 7.498a10.523 10.523 0 01-4.293 5.774M6.228 6.228L3 3m3.228 3.228l3.65 3.65m7.894 7.894L21 21m-3.228-3.228l-3.65-3.65m0 0a3 3 0 10-4.243-4.243m4.242 4.242L9.88 9.88" />
                </svg>
            `;
        } else {
            passwordField.type = "password";
            iconElement.innerHTML = `
                <svg class="eye-open" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                </svg>
            `;
        }
    }

    // REMOVED: validateCurrentStep function - No validation required for navigation

    // Enter key navigation - Now without validation
    document.querySelectorAll('.wizard-form input').forEach(input => {
        input.addEventListener('keydown', (event) => {
            if (event.key === 'Enter') {
                event.preventDefault();
                
                if (currentStep < totalSteps) {
                    currentStep++;
                    updateWizard(currentStep);
                    
                    setTimeout(() => {
                        const nextFormStep = document.querySelector(`.form-step[data-step="${currentStep}"]`);
                        const firstInput = nextFormStep.querySelector('input');
                        if (firstInput) firstInput.focus();
                    }, 100);
                } else if (currentStep === totalSteps) {
                    handleFormSubmit(event);
                }
            }
        });
    });

    function updateWizard(step) {
        // Update form steps
        steps.forEach(s => s.classList.remove('active'));
        const activeFormStep = document.querySelector(`.form-step[data-step="${step}"]`);
        if(activeFormStep) activeFormStep.classList.add('active');

        // Update sidebar indicators
        stepIndicators.forEach(indicator => {
            const indicatorStep = parseInt(indicator.getAttribute('data-step'));
            if (indicatorStep === step) {
                indicator.classList.add('active');
            } else {
                indicator.classList.remove('active');
            }
        });

        // Update title
        const activeTextElement = document.querySelector(`.step-item[data-step="${step}"] .step-text`);
        if(activeTextElement) stepTitle.textContent = activeTextElement.textContent;

        // Update navigation buttons
        prevBtn.disabled = (step === 1);
        nextBtn.disabled = (step === totalSteps);
        
        // Update next button text for last step
        if (step === totalSteps) {
            nextBtn.innerHTML = 'Submit <span>✓</span>';
        } else {
            nextBtn.innerHTML = 'Next <span>→</span>';
        }

        // Close sidebar on mobile
        if (window.innerWidth <= 768) {
            closeSidebar();
        }
    }

    // Navigation button clicks - Now without validation
    nextBtn.addEventListener('click', () => {
        if (currentStep === totalSteps) {
            // Submit the form
            handleFormSubmit(new Event('submit'));
        } else if (currentStep < totalSteps) {
            currentStep++;
            updateWizard(currentStep);
        }
    });

    prevBtn.addEventListener('click', () => {
        if (currentStep > 1) {
            currentStep--;
            updateWizard(currentStep);
        }
    });

    // Sidebar step clicks - Now without validation
    stepIndicators.forEach(indicator => {
        indicator.addEventListener('click', () => {
            const targetStep = parseInt(indicator.getAttribute('data-step'));
            currentStep = targetStep;
            updateWizard(currentStep);
        });
    });

    // ----------------- Profile Image Syncing -----------------
    const avatarInput = document.getElementById('avatar-input');
    const sidebarAvatarInput = document.getElementById('sidebar-avatar-input');
    const avatarContainer = document.getElementById('avatar-container');
    const sidebarAvatarImg = document.getElementById('sidebar-avatar-img');

    function updateAvatarPreview(file) {
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                avatarContainer.innerHTML = `<img src="${e.target.result}" alt="Avatar Preview">`;
                sidebarAvatarImg.src = e.target.result;
            }
            reader.readAsDataURL(file);
        }
    }

    avatarInput.addEventListener('change', function() {
        updateAvatarPreview(this.files[0]);
    });

    sidebarAvatarInput.addEventListener('change', function() {
        updateAvatarPreview(this.files[0]);
    });

    // Form submit handler
    function handleFormSubmit(event) {
        event.preventDefault();
        alert("Registration Completed successfully!");
        // You can submit the form here via AJAX or regular form submission
    }
</script>

@endsection