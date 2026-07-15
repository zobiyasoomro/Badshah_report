<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BetPro | login</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <link rel="icon" href="{{ asset('images/fav_icon.jpeg') }}" width="100" height="100">

    <!-- Internal CSS -->
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background-color: #0f172a;
            min-height: 100vh;
            min-height: 100dvh;
            /* For dynamic viewport height on mobile */
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 1rem;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
        }

        .auth-wrapper {
            width: 100%;
            height: 100vh;
            height: 100dvh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 1rem;
        }

        .auth-card {
            max-width: 28rem;
            width: 100%;
            max-height: 98vh;
            max-height: 98dvh;
            background-color: #172844;
            border-radius: 1.5rem;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
            overflow-y: auto;
            overflow-x: hidden;
            border: 1px solid rgba(59, 90, 122, 0.3);
            display: flex;
            flex-direction: column;
        }

        /* Custom Scrollbar */
        .auth-card::-webkit-scrollbar {
            width: 4px;
        }

        .auth-card::-webkit-scrollbar-track {
            background: transparent;
        }

        .auth-card::-webkit-scrollbar-thumb {
            background: #2A4563;
            border-radius: 10px;
        }

        /* Logo Styles */
        .logo-container {
            background: linear-gradient(to bottom right, #2A4563, #172844);
            text-align: center;
            border-bottom: 1px solid rgba(59, 90, 122, 0.3);
            /* padding: 1.5rem 1.5rem; */
            flex-shrink: 0;
        }

        .logo-image {
            max-width: 180px;
            width: 100%;
            height: auto;
            filter: drop-shadow(0 10px 15px rgba(0, 0, 0, 0.3));
        }

        /* Tab Styles */
        .tab-container {
            display: flex;
            border-bottom: 1px solid rgba(59, 90, 122, 0.3);
            flex-shrink: 0;
        }

        .tab-button {
            flex: 1;
            padding: 1rem 0;
            font-size: 0.875rem;
            font-weight: 600;
            transition: all 0.3s ease;
            color: #9ca3af;
            background: transparent;
            border: none;
            cursor: pointer;
            letter-spacing: 0.5px;
        }

        .tab-button:hover {
            color: #d1d5db;
        }

        .tab-button.active {
            color: #ffffff;
            border-bottom: 2px solid #00E5FF;
        }

        /* Form Styles */
        .form-container {
            padding: 2rem;
            flex: 1;
            overflow-y: auto;
        }

        /* Label Styles */
        .form-label-custom {
            display: block;
            font-size: 0.8rem;
            font-weight: 600;
            color: #d1d5db;
            margin-top: 0.5rem;
            letter-spacing: 0.5px;
            text-transform: uppercase;
            position: relative;
            padding-left: 0.25rem;
        }

        .form-label-custom::before {
            content: '';
            position: absolute;
            left: 0;
            top: 50%;
            transform: translateY(-50%);
            width: 3px;
            height: 14px;
            background: #00E5FF;
            border-radius: 2px;
        }

        .form-label-custom .optional-text {
            color: #9ca3af;
            font-weight: 400;
            text-transform: none;
            font-size: 0.7rem;
        }

        /* Input Fields */
        .form-group {
            /* margin-bottom: 1.25rem; */
        }

        .form-group:last-of-type {
            margin-bottom: 1.5rem;
        }

        .form-input {
            width: 100%;
            background-color: #2A4563;
            border: 1px solid rgba(59, 90, 122, 0.5);
            border-radius: 0.75rem;
            padding: 0.75rem 1.25rem;
            color: #ffffff;
            font-size: 0.95rem;
            transition: all 0.3s ease;
            height: 48px;
        }

        .form-input:focus {
            outline: none;
            border-color: #00E5FF;
            box-shadow: 0 0 0 4px rgba(0, 229, 255, 0.15);
            background-color: #2A4563;
        }

        .form-input::placeholder {
            color: rgba(255, 255, 255, 0.35);
            font-size: 0.9rem;
        }

        /* Bootstrap Grid Override for signup */
        .grid-2 {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1rem;
        }

        .grid-2 .form-group {
            margin-bottom: 0;
        }

        /* Buttons */
        .btn-login {
            width: 100%;
            background-color: #67e8f9;
            color: #0f172a;
            font-weight: 700;
            padding: 0.85rem;
            border-radius: 0.75rem;
            transition: all 0.3s ease;
            font-size: 1.125rem;
            border: none;
            cursor: pointer;
            letter-spacing: 1px;
            height: 50px;
        }

        .btn-login:hover {
            background-color: #67e8f9;
            transform: translateY(-1px);
            box-shadow: 0 10px 20px -10px rgba(0, 229, 255, 0.3);
        }

        .btn-signup {
            width: 100%;
            background-color: #00E5FF;
            color: #0f172a;
            font-weight: 700;
            padding: 0.85rem;
            border-radius: 0.75rem;
            transition: all 0.3s ease;
            font-size: 1.125rem;
            border: none;
            cursor: pointer;
            letter-spacing: 1px;
            height: 50px;
        }

        .btn-signup:hover {
            background-color: #67e8f9;
            transform: translateY(-1px);
            box-shadow: 0 10px 20px -10px rgba(0, 229, 255, 0.3);
        }

        .btn-google {
            width: 100%;
            background-color: #ffffff;
            color: #111827;
            font-weight: 600;
            padding: 0.85rem;
            border-radius: 0.75rem;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.75rem;
            border: 1px solid rgba(209, 213, 219, 0.3);
            cursor: pointer;
            height: 50px;
        }

        .btn-google:hover {
            background-color: #f3f4f6;
            transform: translateY(-1px);
            box-shadow: 0 10px 20px -10px rgba(0, 0, 0, 0.2);
        }

        /* Links */
        .link-text {
            color: #00E5FF;
            cursor: pointer;
            font-weight: 600;
        }

        .link-text:hover {
            text-decoration: underline;
        }

        .text-muted-custom {
            color: #9ca3af;
            font-size: 0.875rem;
        }

        .text-center-custom {
            text-align: center;
        }

        .mt-3-custom {
            margin-top: 1.25rem;
        }

        .mt-2-custom {
            margin-top: 0.75rem;
        }

        .hidden {
            display: none !important;
        }

        .google-icon {
            color: #ea4335;
            font-size: 1.2rem;
        }

        /* Alert message animations */
        .alert {
            animation: slideDown 0.5s ease forwards;
        }

        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Alert fade out animation */
        .alert-fade-out {
            animation: fadeOut 0.5s ease forwards;
        }

        @keyframes fadeOut {
            from {
                opacity: 1;
                transform: translateY(0);
            }

            to {
                opacity: 0;
                transform: translateY(-20px);
            }
        }

        /* ============================================
           FULLY RESPONSIVE WITH BOOTSTRAP 5
           ============================================ */

        /* Extra Small Devices (Phones, <576px) */
        @media (max-width: 575.98px) {
            body {
                padding: 0.5rem;
            }

            .auth-wrapper {
                padding: 0.5rem;
            }

            .auth-card {
                max-width: 100%;
                border-radius: 1rem;
                max-height: 100vh;
                max-height: 100dvh;
            }

            .logo-container {
                padding: 1rem 1rem;
            }

            .logo-image {
                max-width: 120px;
            }

            .form-container {
                padding: 1.25rem;
            }

            .tab-button {
                padding: 0.75rem 0;
                font-size: 0.75rem;
            }

            .form-label-custom {
                font-size: 0.7rem;
            }

            .form-input {
                height: 42px;
                padding: 0.6rem 1rem;
                font-size: 0.85rem;
                border-radius: 0.6rem;
            }

            .form-group {
                margin-bottom: 1rem;
            }

            .btn-login,
            .btn-signup,
            .btn-google {
                height: 44px;
                font-size: 0.95rem;
                padding: 0.6rem;
                border-radius: 0.6rem;
            }

            .grid-2 {
                grid-template-columns: 1fr;
                gap: 0;
            }

            .grid-2 .form-group {
                margin-bottom: 1rem;
            }

            .grid-2 .form-group:last-child {
                margin-bottom: 0;
            }

            .mt-3-custom {
                margin-top: 1rem;
            }

            .text-muted-custom {
                font-size: 0.75rem;
            }
        }

        /* Small Devices (Tablets, 576px - 767px) */
        @media (min-width: 576px) and (max-width: 767.98px) {
            .auth-card {
                max-width: 100%;
                max-height: 95vh;
                max-height: 95dvh;
            }

            .logo-image {
                max-width: 150px;
            }

            .form-container {
                padding: 1.5rem;
            }

            .form-input {
                height: 44px;
                padding: 0.65rem 1.1rem;
            }

            .btn-login,
            .btn-signup,
            .btn-google {
                height: 46px;
            }

            .grid-2 {
                gap: 0.75rem;
            }
        }

        /* Medium Devices (Tablets/Laptops, 768px - 991px) */
        @media (min-width: 768px) and (max-width: 991.98px) {
            .auth-card {
                max-width: 26rem;
            }

            .logo-image {
                max-width: 160px;
            }
        }

        /* Large Devices (Desktops, 992px - 1199px) */
        @media (min-width: 992px) and (max-width: 1199.98px) {
            .auth-card {
                max-width: 28rem;
            }
        }

        /* Extra Large Devices (Large Desktops, 1200px+) */
        @media (min-width: 1200px) {
            .auth-card {
                max-width: 30rem;
            }

            .logo-image {
                max-width: 200px;
            }

            .form-container {
                padding: 2.5rem;
            }

            .form-input {
                height: 54px;
                padding: 0.9rem 1.5rem;
                font-size: 1rem;
            }

            .btn-login,
            .btn-signup,
            .btn-google {
                height: 56px;
                font-size: 1.2rem;
            }

            .form-label-custom {
                font-size: 0.85rem;
            }
        }

        /* Landscape Mode for Mobile */
        @media (max-height: 600px) and (orientation: landscape) {
            .auth-wrapper {
                padding: 0.5rem;
            }

            .auth-card {
                max-height: 98vh;
                max-height: 98dvh;
            }

            .logo-container {
                padding: 0.75rem 1rem;
            }

            .logo-image {
                max-width: 100px;
            }

            .form-container {
                padding: 1rem;
            }

            .form-group {
                margin-bottom: 0.6rem;
            }

            .form-input {
                height: 36px;
                padding: 0.4rem 0.8rem;
                font-size: 0.8rem;
                border-radius: 0.5rem;
            }

            .btn-login,
            .btn-signup,
            .btn-google {
                height: 38px;
                font-size: 0.8rem;
                padding: 0.4rem;
                border-radius: 0.5rem;
            }

            .tab-button {
                padding: 0.5rem 0;
                font-size: 0.7rem;
            }

            .form-label-custom {
                font-size: 0.65rem;
                margin-bottom: 0.25rem;
            }

            .grid-2 {
                gap: 0.5rem;
            }

            .grid-2 .form-group {
                margin-bottom: 0.5rem;
            }
        }

        /* Very Small Screens (<= 360px) */
        @media (max-width: 360px) {
            .logo-image {
                max-width: 90px;
            }

            .form-container {
                padding: 0.75rem;
            }

            .form-input {
                height: 36px;
                font-size: 0.75rem;
                padding: 0.4rem 0.8rem;
            }

            .btn-login,
            .btn-signup,
            .btn-google {
                height: 38px;
                font-size: 0.8rem;
                padding: 0.4rem;
            }

            .form-label-custom {
                font-size: 0.6rem;
            }

            .tab-button {
                font-size: 0.65rem;
                padding: 0.5rem 0;
            }
        }
    </style>
</head>

<body>

    <div class="auth-wrapper">
        <!-- Main Card -->
        <div class="auth-card">

            <!-- Logo Section -->
            <div class="logo-container">
                <img src="{{ asset('images/nav_logo.png') }}" alt="BET PRO EXCHANGE" class="logo-image">
            </div>


            <!-- Flash Messages -->
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show m-3" role="alert" id="successAlert"
                    style="background-color: #00E5FF; color: #0f172a; border: none; border-radius: 0.75rem; padding: 0.75rem 1rem;">
                    <i class="fas fa-check-circle me-2"></i>
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show m-3" role="alert" id="errorAlert"
                    style="background-color: #dc3545; color: white; border: none; border-radius: 0.75rem; padding: 0.75rem 1rem;">
                    <i class="fas fa-exclamation-circle me-2"></i>
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if($errors->any())
                <div class="alert alert-danger alert-dismissible fade show m-3" role="alert" id="errorAlert"
                    style="background-color: #dc3545; color: white; border: none; border-radius: 0.75rem; padding: 0.75rem 1rem;">
                    <ul class="mb-0" style="list-style: none; padding-left: 0;">
                        @foreach($errors->all() as $error)
                            <li><i class="fas fa-times-circle me-2"></i>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <!-- Tab Switch -->
            <div class="tab-container">
                <button onclick="switchTab('login')" id="loginTab" class="tab-button active">
                    LOGIN
                </button>
                <button onclick="switchTab('signup')" id="signupTab" class="tab-button">
                    SIGN UP
                </button>
            </div>

            <!-- Login Form -->
            <div id="loginForm" class="form-container">
                <form action="{{ route('auth.login') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label class="form-label-custom">Username</label>
                        <input type="text" name="user_name" class="form-input" placeholder="Enter your username"
                            required>
                    </div>
                    <div class="form-group">
                        <label class="form-label-custom">Password</label>
                        <input type="password" name="password" class="form-input" placeholder="Enter your password"
                            required>
                    </div>
                    <button type="submit" class="btn-login">
                        LOGIN NOW
                    </button>
                </form>
                <!-- <p class="text-muted-custom text-center-custom mt-3-custom">
                    Don't have an account?
                    <span onclick="switchTab('signup')" class="link-text">Sign Up</span>
                </p> -->
            </div>


            <!-- Signup Form -->
            <div id="signupForm" class="form-container hidden">
                <form action="{{ route('auth.register') }}" method="POST">
                    @csrf
                    <div>
                        <!-- Username Dropdown -->
                        <div class="form-group">
                            <label class="form-label-custom">Select Your Username</label>
                            <select name="user_name" required class="form-input" id="userAccountSelect"
                                style="appearance: auto; background-color: #2A4563; color: white; border: 1px solid rgba(59, 90, 122, 0.5);">
                                <option value="" style="background-color: #172844; color: #9ca3af;">-- Select your
                                    username --</option>
                                @foreach($availableUsers as $account)
                                    <option value="{{ $account->user_account }}"
                                        data-password="{{ $account->user_password }}"
                                        style="background-color: #172844; color: white; padding: 8px;">
                                        {{ $account->user_account }}
                                    </option>
                                @endforeach
                            </select>
                            <small style="color: #9ca3af; font-size: 0.7rem; display: block; margin-top: 0.25rem;">
                                <i class="fas fa-info-circle"></i> Select your pre-assigned username
                            </small>
                        </div>

                        <!-- Password - Auto-filled from selection -->
                        <div class="form-group">
                            <label class="form-label-custom">Your Password</label>
                            <input type="text" name="password" id="userPassword" required class="form-input"
                                placeholder="Password will auto-fill" readonly
                                style="background-color: #1a2f47; cursor: not-allowed; color: #00E5FF; font-weight: 600;">
                            <small style="color: #9ca3af; font-size: 0.7rem; display: block; margin-top: 0.25rem;">
                                <i class="fas fa-lock"></i> Password is pre-defined for this account and will be
                                encrypted
                            </small>
                        </div>

                        <!-- Full Name & WhatsApp -->
                        <div class="grid-2">
                            <div class="form-group">
                                <label class="form-label-custom">Full Name</label>
                                <input type="text" name="full_name" required class="form-input"
                                    placeholder="Enter full name">
                            </div>
                            <div class="form-group">
                                <label class="form-label-custom">WhatsApp No.</label>
                                <input type="tel" name="whatsapp" required class="form-input"
                                    placeholder="Enter WhatsApp number">
                            </div>
                        </div>

                        <!-- City (Optional) -->
                        <div class="form-group">
                            <label class="form-label-custom">
                                City <span class="optional-text">(Optional)</span>
                            </label>
                            <input type="text" name="city" class="form-input" placeholder="Enter your city">
                        </div>

                        <!-- Email (Optional) -->
                        <div class="form-group">
                            <label class="form-label-custom">
                                Email <span class="optional-text">(Optional)</span>
                            </label>
                            <input type="email" name="email" class="form-input" placeholder="Enter your email address">
                        </div>

                        <!-- Submit Button -->
                        <button type="submit" class="btn-signup">
                            CREATE ACCOUNT
                        </button>
                    </div>
                </form>

                <!-- Google Signup -->
                <div class="mt-2-custom">
                    <button onclick="signUpWithGoogle()" class="btn-google">
                        <i class="fab fa-google google-icon"></i>
                        Sign up with Google
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- JavaScript -->
    <script>
        // Auto-dismiss alerts after 3 seconds
        document.addEventListener('DOMContentLoaded', function () {
            // Find all alert messages
            const alerts = document.querySelectorAll('.alert');

            alerts.forEach(function (alert) {
                // Set timeout to auto-dismiss after 3 seconds (3000ms)
                setTimeout(function () {
                    // Add fade-out class for smooth animation
                    alert.classList.add('alert-fade-out');

                    // After animation completes, remove the alert from DOM
                    setTimeout(function () {
                        alert.remove();
                    }, 500); // Wait for animation to complete
                }, 3000); // 3 seconds
            });
        });

        function switchTab(tab) {
            const loginForm = document.getElementById('loginForm');
            const signupForm = document.getElementById('signupForm');
            const loginTab = document.getElementById('loginTab');
            const signupTab = document.getElementById('signupTab');

            if (tab === 'login') {
                loginForm.classList.remove('hidden');
                signupForm.classList.add('hidden');
                loginTab.classList.add('active');
                signupTab.classList.remove('active');
            } else {
                loginForm.classList.add('hidden');
                signupForm.classList.remove('hidden');
                signupTab.classList.add('active');
                loginTab.classList.remove('active');
            }
        }

        window.onload = function () {
            const url = window.location.href;
            if (url.includes('register') || url.includes('signup')) {
                switchTab('signup');
            } else {
                switchTab('login');
            }

            // Auto-fill password when username is selected
            const userSelect = document.getElementById('userAccountSelect');
            const passwordInput = document.getElementById('userPassword');

            if (userSelect && passwordInput) {
                userSelect.addEventListener('change', function () {
                    const selectedOption = this.options[this.selectedIndex];
                    const password = selectedOption.getAttribute('data-password');

                    if (password) {
                        passwordInput.value = password;
                        passwordInput.style.borderColor = '#00E5FF';
                        passwordInput.style.boxShadow = '0 0 0 4px rgba(0, 229, 255, 0.15)';
                    } else {
                        passwordInput.value = '';
                        passwordInput.style.borderColor = 'rgba(59, 90, 122, 0.5)';
                        passwordInput.style.boxShadow = 'none';
                    }
                });
            }
        };

        function signUpWithGoogle() {
            alert("Google Sign Up feature is coming soon!");
        }
    </script>

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>