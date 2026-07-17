<style>
    /* ===== GLOBAL STYLES ===== */
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background: #0a1620;
    }

    .account-section {
         background: #1d334d;
        /* padding: 60px 0; */
        min-height: 90vh;
        display: flex;
        align-items: center;
    }

    @media (min-width: 769) {
        .account-section {
            min-height: 70vh;
        }
    }

    @media (min-width: 1040px) {
        .account-section {
            min-height: 90vh;
        }
    }

    /* ===== CARD CUSTOM ===== */
    .card-custom {
        background: linear-gradient(145deg, #3a5b80, #2a4563);
        border: 1px solid rgba(30, 58, 80, 0.6);
        border-radius: 16px;
        padding: 30px;
        backdrop-filter: blur(10px);
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.5),
            inset 0 1px 0 rgba(255, 255, 255, 0.05);
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }

    .card-custom::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 2px;
        background: linear-gradient(90deg, transparent, #00e5ff, transparent);
        opacity: 0.6;
    }

    .card-custom:hover {
        border-color: rgba(0, 229, 255, 0.3);
        box-shadow: 0 15px 50px rgba(0, 229, 255, 0.08);
    }

    /* ===== SIDE CARD (Green Gradient) ===== */
    .side-card {
        background: linear-gradient(145deg, #268440, #1a5a30);
        border: 2px solid rgba(0, 229, 255, 0.4);
        border-radius: 20px;
        padding: 35px 25px;
        box-shadow: 0 10px 40px rgba(0, 229, 255, 0.1),
            inset 0 1px 0 rgba(255, 255, 255, 0.1);
        position: relative;
        overflow: hidden;
        min-height: 420px;
        transition: all 0.4s ease;
    }

    /* Animated border glow */
    .side-card::before {
        content: '';
        position: absolute;
        top: -2px;
        left: -2px;
        right: -2px;
        bottom: -2px;
        background: linear-gradient(45deg, #00e5ff, transparent, #00e5ff, transparent);
        border-radius: 20px;
        z-index: -1;
        background-size: 400% 400%;
        animation: gradientBorder 4s ease infinite;
        opacity: 0.6;
    }

    @keyframes gradientBorder {
        0% {
            background-position: 0% 50%;
        }

        50% {
            background-position: 100% 50%;
        }

        100% {
            background-position: 0% 50%;
        }
    }

    /* Subtle pattern overlay */
    .side-card::after {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: radial-gradient(circle at 30% 20%, rgba(0, 229, 255, 0.05) 0%, transparent 70%);
        pointer-events: none;
    }

    /* ===== LOGO CIRCLE ===== */
    .logo-circle {
        border: 3px solid rgba(0, 229, 255, 0.4);
        padding: 10px;
        border-radius: 50%;
        width: 110px;
        height: 110px;
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
        background: rgba(255, 255, 255, 0.95);
        margin: 0 auto;
        transition: all 0.4s ease;
        box-shadow: 0 0 40px rgba(0, 229, 255, 0.15);
        position: relative;
        z-index: 1;
    }

    .logo-circle:hover {
        transform: scale(1.05) rotate(-5deg);
        border-color: #00e5ff;
        box-shadow: 0 0 60px rgba(0, 229, 255, 0.3);
    }

    .logo-circle img {
        width: 100%;
        height: 100%;
        object-fit: contain;
        filter: drop-shadow(0 2px 4px rgba(0, 0, 0, 0.1));
    }

    /* ===== WELCOME TEXT ===== */
    .welcome-text {
        font-size: 1.8rem;
        font-weight: 700;
        background: linear-gradient(135deg, #ffffff 0%, #00e5ff 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        text-shadow: none;
        position: relative;
        z-index: 1;
        letter-spacing: 0.5px;
    }

    .user-name-display {
        color: rgba(255, 255, 255, 0.9);
        font-weight: 500;
        font-size: 1rem;
        letter-spacing: 0.5px;
        position: relative;
        z-index: 1;
    }

    .divider-line {
        width: 60px;
        height: 2px;
        background: linear-gradient(90deg, #00e5ff, transparent);
        margin: 8px auto;
        border-radius: 2px;
        position: relative;
        z-index: 1;
    }

    .sub-text-bet {
        color: rgba(255, 255, 255, 0.7);
        font-size: 0.9rem;
        letter-spacing: 1px;
        position: relative;
        z-index: 1;
    }

    .betting-text-highlight {
        color: #00e5ff;
        font-weight: 700;
        font-size: 1.2rem;
        text-shadow: 0 0 30px rgba(0, 229, 255, 0.3);
        letter-spacing: 2px;
        text-transform: uppercase;
        position: relative;
        z-index: 1;
    }

    /* ===== LOGIN BUTTON ===== */
    .btn-login {
        background: linear-gradient(135deg, #00e5ff, #00b8d4);
        color: #0a1620 !important;
        border: none;
        border-radius: 50px !important;
        padding: 14px 45px !important;
        font-weight: 700 !important;
        font-size: 16px;
        text-transform: uppercase;
        letter-spacing: 1.5px;
        transition: all 0.4s ease;
        box-shadow: 0 6px 30px rgba(0, 229, 255, 0.3);
        position: relative;
        z-index: 1;
        overflow: hidden;
        width: 100%;
        max-width: 250px;
    }

    .btn-login::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
        transition: left 0.6s ease;
    }

    .btn-login:hover::before {
        left: 100%;
    }

    .btn-login:hover {
        transform: translateY(-3px) scale(1.02);
        box-shadow: 0 10px 40px rgba(0, 229, 255, 0.5);
        background: linear-gradient(135deg, #00f5ff, #00c8e0);
        color: #0a1620 !important;
    }

    .btn-login:active {
        transform: translateY(0px) scale(0.98);
    }

    /* ===== FORM CONTROLS - FIXED VISIBILITY ===== */
    .form-control-custom {
        background: rgba(20, 40, 60, 0.9) !important;
        border: 1px solid rgba(30, 58, 80, 0.6);
        color: #ffffff !important;
        padding: 12px 15px;
        width: 100%;
        border-radius: 8px 0 0 8px;
        font-size: 0.95rem;
        letter-spacing: 0.5px;
        font-weight: 500;

        /* DISABLE TEXT SELECTION */
        -webkit-user-select: none !important;
        -moz-user-select: none !important;
        -ms-user-select: none !important;
        user-select: none !important;
        cursor: default !important;
        caret-color: transparent !important;
        outline: none !important;
        box-shadow: none !important;
        -webkit-touch-callout: none !important;
        -webkit-tap-highlight-color: transparent !important;
        pointer-events: none !important;
        transition: all 0.3s ease;
    }

    /* Override any white background from browser */
    .form-control-custom:-webkit-autofill,
    .form-control-custom:-webkit-autofill:hover,
    .form-control-custom:-webkit-autofill:focus,
    .form-control-custom:-webkit-autofill:active {
        -webkit-box-shadow: 0 0 0 1000px rgba(20, 40, 60, 0.9) inset !important;
        -webkit-text-fill-color: #ffffff !important;
        background-color: rgba(20, 40, 60, 0.9) !important;
        color: #ffffff !important;
    }

    .form-control-custom:focus {
        outline: none !important;
        box-shadow: 0 0 0 2px rgba(0, 229, 255, 0.2) !important;
        border-color: rgba(0, 229, 255, 0.4) !important;
    }

    .form-control-custom:hover {
        border-color: rgba(0, 229, 255, 0.3) !important;
    }

    /* ===== COPY BUTTON ===== */
    .btn-copy {
        background: linear-gradient(135deg, #1e3a50, #162d40);
        color: #00e5ff;
        border: 1px solid rgba(30, 58, 80, 0.6);
        padding: 8px 20px;
        font-size: 0.8rem;
        cursor: pointer;
        font-weight: 700;
        pointer-events: auto !important;
        position: relative;
        z-index: 10;
        border-radius: 0 8px 8px 0;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        transition: all 0.3s ease;
        white-space: nowrap;
    }

    .btn-copy:hover {
        background: linear-gradient(135deg, #00e5ff, #00b8d4);
        color: #0a1620;
        border-color: #00e5ff;
        box-shadow: 0 0 20px rgba(0, 229, 255, 0.2);
        transform: scale(1.02);
    }

    .btn-copy:active {
        transform: scale(0.95);
    }

    /* ===== LABELS ===== */
    .form-label-custom {
        color: rgba(255, 255, 255, 0.7) !important;
        font-size: 0.8rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 1px;
        margin-bottom: 6px;
        -webkit-user-select: text !important;
        -moz-user-select: text !important;
        -ms-user-select: text !important;
        user-select: text !important;
        cursor: text !important;
    }

    .form-label-custom i {
        color: #00e5ff;
        margin-right: 4px;
    }

    /* ===== GUEST MESSAGE ===== */
    .guest-message {
        color: #7C8DA3;
        text-align: center;
        padding: 50px 30px;
        background: linear-gradient(145deg, #122230, #0d1a26);
        border-radius: 20px;
        border: 1px solid rgba(30, 58, 80, 0.4);
    }

    .guest-message h3 {
        color: #fff;
        margin-bottom: 15px;
        font-weight: 700;
        font-size: 2rem;
    }

    .guest-message p {
        font-size: 1.05rem;
        color: rgba(255, 255, 255, 0.7);
    }

    .btn-guest-login {
        background: linear-gradient(135deg, #00e5ff, #00b8d4);
        color: #0a1620;
        border: none;
        padding: 14px 40px;
        border-radius: 50px;
        font-weight: 700;
        font-size: 1rem;
        text-decoration: none;
        display: inline-block;
        transition: all 0.3s ease;
        text-transform: uppercase;
        letter-spacing: 1px;
        box-shadow: 0 6px 30px rgba(0, 229, 255, 0.2);
    }

    .btn-guest-login:hover {
        background: linear-gradient(135deg, #00f5ff, #00c8e0);
        color: #0a1620;
        transform: translateY(-3px);
        box-shadow: 0 10px 40px rgba(0, 229, 255, 0.4);
    }

    .guest-link {
        color: #00e5ff;
        text-decoration: none;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .guest-link:hover {
        color: #00f5ff;
        text-decoration: underline;
    }

    /* ===== SECTION HEADING ===== */
    .section-title {
        color: #fff;
        font-weight: 700;
        font-size: 1.5rem;
        letter-spacing: 0.5px;
        position: relative;
        padding-bottom: 15px;
    }

    .section-title::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 50%;
        height: 3px;
        background: linear-gradient(90deg, #00e5ff, transparent);
        border-radius: 2px;
    }

    .section-title i {
        color: #00e5ff;
    }

    /* ===== INPUT GROUP FIX ===== */
    .input-group .form-control-custom {
        border-radius: 8px 0 0 8px;
        pointer-events: none !important;
        background: rgba(20, 40, 60, 0.9) !important;
        color: #ffffff !important;
    }

    .input-group .btn-copy {
        border-radius: 0 8px 8px 0;
    }

    /* ===== RESPONSIVE ===== */
    @media (max-width: 992px) {
        .side-card {
            min-height: 350px;
            padding: 30px 20px;
        }

        .logo-circle {
            width: 90px;
            height: 90px;
            padding: 8px;
        }

        .welcome-text {
            font-size: 1.5rem;
        }

        .btn-login {
            padding: 12px 35px !important;
            max-width: 200px;
            font-size: 14px;
        }
    }

    @media (max-width: 768px) {
        .account-section {
            padding: 40px 0;
        }

        .card-custom {
            padding: 20px;
        }

        .side-card {
            min-height: 300px;
            /* padding: 25px 15px; */
            /* margin-top: 20px; */
        }

        .logo-circle {
            width: 80px;
            height: 80px;
            padding: 6px;
        }

        .welcome-text {
            font-size: 1.3rem;
        }

        .btn-login {
            padding: 10px 30px !important;
            max-width: 180px;
            font-size: 13px;
        }

        .section-title {
            font-size: 1.2rem;
        }

        .guest-message h3 {
            font-size: 1.5rem;
        }
    }

    @media (max-width: 576px) {
        .logo-circle {
            width: 70px;
            height: 70px;
        }

        .welcome-text {
            font-size: 1.1rem;
        }

        .betting-text-highlight {
            font-size: 1rem;
        }

        .btn-login {
            padding: 10px 25px !important;
            max-width: 160px;
            font-size: 12px;
        }

        .form-control-custom {
            font-size: 0.85rem;
            padding: 10px 12px;
        }

        .btn-copy {
            font-size: 0.7rem;
            padding: 6px 12px;
        }
    }

    /* ===== SCROLLBAR STYLING ===== */
    ::-webkit-scrollbar {
        width: 8px;
    }

    ::-webkit-scrollbar-track {
        background: #0a1620;
    }

    ::-webkit-scrollbar-thumb {
        background: linear-gradient(180deg, #00e5ff, #008c9e);
        border-radius: 4px;
    }

    ::-webkit-scrollbar-thumb:hover {
        background: #00e5ff;
    }

    /* ===== SELECTION OVERRIDE ===== */
    ::selection {
        background: rgba(0, 229, 255, 0.3);
        color: #fff;
    }
</style>

<div class="account-section">
    <div class="container">
        <div class="row g-4 justify-content-center">

            @if($user)
                <!-- ===== USER IS LOGGED IN ===== -->
                <div class="col-lg-7 col-xl-8">
                    <div class="card-custom">
                        <h4 class="section-title text-white mb-4">
                            <i class="fas fa-user-circle me-2"></i>
                            Your Account Details
                        </h4>

                        <div class="mb-3">
                            <label class="form-label-custom">
                                <i class="fas fa-user"></i> Full Name
                            </label>
                            <input type="text" class="form-control form-control-custom" value="{{ $user->name }}" readonly
                                disabled onfocus="this.blur()" onselectstart="return false" oncopy="return false"
                                oncut="return false" ondrag="return false" ondrop="return false"
                                oncontextmenu="return false">
                        </div>

                        <div class="mb-3">
                            <label class="form-label-custom">
                                <i class="fas fa-id-card"></i> Username
                            </label>
                            <div class="input-group">
                                <input type="text" class="form-control form-control-custom" id="user-id"
                                    value="{{ $user->user_name }}" readonly disabled onfocus="this.blur()"
                                    onselectstart="return false" oncopy="return false" oncut="return false"
                                    ondrag="return false" ondrop="return false" oncontextmenu="return false">
                                <button class="btn btn-copy" onclick="copyText('user-id', this)">
                                    <i class="fas fa-copy me-1"></i> Copy
                                </button>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label-custom">
                                <i class="fas fa-lock"></i> Password
                            </label>
                            <div class="input-group">
                                <input type="text" class="form-control form-control-custom" id="pass-id"
                                    value="{{ $user->password_plain ?? '********' }}" readonly disabled
                                    onfocus="this.blur()" onselectstart="return false" oncopy="return false"
                                    oncut="return false" ondrag="return false" ondrop="return false"
                                    oncontextmenu="return false">
                                <button class="btn btn-copy" onclick="copyText('pass-id', this)">
                                    <i class="fas fa-copy me-1"></i> Copy
                                </button>
                            </div>
                        </div>

                        <div class="mb-0">
                            <label class="form-label-custom">
                                <i class="fab fa-whatsapp"></i> WhatsApp Number
                            </label>
                            <input type="text" class="form-control form-control-custom" value="{{ $user->whatsapp_number }}"
                                readonly disabled onfocus="this.blur()" onselectstart="return false" oncopy="return false"
                                oncut="return false" ondrag="return false" ondrop="return false"
                                oncontextmenu="return false">
                        </div>
                    </div>
                </div>

                <div class="col-lg-5 col-xl-4">
                    <div
                        class="card-custom side-card text-center h-100 d-flex flex-column align-items-center justify-content-center">
                        <!-- Logo -->
                        <div class="mb-3 logo-circle">
                            <img src="{{ asset('images/login_logo.png') }}" alt="Logo">
                        </div>

                        <!-- Welcome Text -->
                        <h5 class="welcome-text mt-2">Welcome Back!</h5>

                        <!-- User Name -->
                        <p class="user-name-display small mb-1">
                            <i class="fas fa-user-check me-1" style="color: #00e5ff; font-size: 0.8rem;"></i>
                            {{ $user->name ?? 'User' }}
                        </p>

                        <!-- Divider -->
                        <div class="divider-line"></div>

                        <!-- Sub Text -->
                        <p class="sub-text-bet mb-2">
                            <i class="fas fa-shield-alt me-1"></i>
                            Login with Betpro
                        </p>

                        <!-- Betting Text -->
                        <p class="betting-text-highlight mb-4">
                            <i class="fas fa-rocket me-2"></i>
                            Start Betting Now
                        </p>

                        <!-- Login Button -->
                        <a href="#" class="btn btn-login">
                            <i class="fas fa-sign-in-alt me-2"></i> Login
                        </a>
                    </div>
                </div>

            @else
                <!-- ===== GUEST USER (NOT LOGGED IN) ===== -->
                <div class="col-12 col-lg-10 col-xl-8">
                    <div class="guest-message">
                        <div class="mb-4">
                            <i class="fas fa-dice" style="font-size: 4rem; color: #00e5ff; opacity: 0.8;"></i>
                        </div>
                        <h3>
                            <i class="fas fa-hand-peace me-2"></i>
                            Welcome to BetPro
                        </h3>
                        <p class="mb-4">Please login to view your account details and start betting.</p>
                        <a href="{{ route('login') }}" class="btn-guest-login">
                            <i class="fas fa-sign-in-alt me-2"></i> Login Now
                        </a>
                        <p class="mt-4 small text-secondary">
                            Don't have an account?
                            <a href="{{ route('register') }}" class="guest-link">
                                <i class="fas fa-user-plus me-1"></i> Register here
                            </a>
                        </p>
                    </div>
                </div>
            @endif

        </div>
    </div>
</div>


<script>
    // ===== GLOBAL: Prevent Ctrl+C, Ctrl+X, Ctrl+A on the page =====
    document.addEventListener('keydown', function (e) {
        if (e.ctrlKey || e.metaKey) {
            if (e.key === 'c' || e.key === 'C' ||
                e.key === 'x' || e.key === 'X' ||
                e.key === 'a' || e.key === 'A') {
                e.preventDefault();
                return false;
            }
        }
    });

    // ===== GLOBAL: Prevent right-click on the entire card =====
    document.querySelectorAll('.card-custom').forEach(function (card) {
        card.addEventListener('contextmenu', function (e) {
            e.preventDefault();
            return false;
        });
    });

    // ===== COPY FUNCTION =====
    function copyText(id, btn) {
        const input = document.getElementById(id);
        const originalHTML = btn.innerHTML;

        if (!input) return;

        const textToCopy = input.value;

        if (navigator.clipboard && navigator.clipboard.writeText) {
            navigator.clipboard.writeText(textToCopy).then(() => {
                btn.innerHTML = '<i class="fas fa-check me-1"></i> COPIED!';
                btn.style.background = 'linear-gradient(135deg, #28a745, #20c997)';
                btn.style.color = '#ffffff';
                btn.style.borderColor = '#28a745';

                setTimeout(() => {
                    btn.innerHTML = originalHTML;
                    btn.style.background = 'linear-gradient(135deg, #1e3a50, #162d40)';
                    btn.style.color = '#00e5ff';
                    btn.style.borderColor = 'rgba(30, 58, 80, 0.6)';
                }, 2000);
            }).catch(() => {
                fallbackCopy(textToCopy, btn, originalHTML);
            });
        } else {
            fallbackCopy(textToCopy, btn, originalHTML);
        }
    }

    function fallbackCopy(text, btn, originalHTML) {
        const tempInput = document.createElement('input');
        tempInput.value = text;
        document.body.appendChild(tempInput);
        tempInput.select();
        document.execCommand('copy');
        document.body.removeChild(tempInput);

        btn.innerHTML = '<i class="fas fa-check me-1"></i> COPIED!';
        btn.style.background = 'linear-gradient(135deg, #28a745, #20c997)';
        btn.style.color = '#ffffff';
        btn.style.borderColor = '#28a745';

        setTimeout(() => {
            btn.innerHTML = originalHTML;
            btn.style.background = 'linear-gradient(135deg, #1e3a50, #162d40)';
            btn.style.color = '#00e5ff';
            btn.style.borderColor = 'rgba(30, 58, 80, 0.6)';
        }, 2000);
    }
</script>