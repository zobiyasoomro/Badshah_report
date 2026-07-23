<style>
    /* =========================
           PERMANENT DESKTOP HIDE (Placed at top for safety)
        ========================= */
    .mobile-support-item {
        display: none;
    }

    .close-menu {
        display: none;
    }

    /* =========================
           NAVBAR MAIN CONTAINER
        ========================= */
    .navbar-custom {
        background: #2A4563;
        border-top: 2px solid #00d4ff;
        border-bottom: 1px solid rgba(0, 212, 255, .18);
        padding: 10px 0;
        min-height: 100px;
        box-shadow: 0 8px 25px rgba(0, 0, 0, .35);
        position: relative;
        z-index: 1000;
    }

    .navbar-custom .container {
        position: relative;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    /* =========================
           LOGO CONFIGURATION (Desktop)
        ========================= */
    .navbar-brand {
        padding: 0;
        margin: 0;
        position: absolute;
        top: 100%;
        left: 12px;
        transform: translateY(-50%);
        z-index: 10005;
    }

    .logo-img {
        height: 140px;
        width: auto;
        display: block;
        object-fit: contain;
        transition: .35s ease;
        filter: drop-shadow(0 0 8px rgba(0, 212, 255, .30));
    }

    .logo-img:hover {
        transform: scale(1.03) translateY(-2%);
        filter: drop-shadow(0 0 14px rgba(0, 212, 255, .55));
    }

    /* =========================
           MENU LINKS (Desktop)
        ========================= */
    .navbar-nav {
        gap: 18px;
        margin-left: 160px;
    }

    .navbar-nav .nav-link {
        color: #fff !important;
        font-size: 17px;
        font-weight: 500;
        position: relative;
        transition: .3s;
        padding: 8px 4px;
    }

    .navbar-nav .nav-link::after {
        content: "";
        position: absolute;
        bottom: -6px;
        left: 0;
        width: 0;
        height: 2px;
        background: #00d4ff;
        transition: .3s;
    }

    .navbar-nav .nav-link:hover {
        color: #00d4ff !important;
    }

    .navbar-nav .nav-link:hover::after {
        width: 100%;
    }

    /* =========================
           PROFILE WRAPPER
        ========================= */
    .profile-dropdown-wrapper {
        position: relative;
        z-index: 10030;
    }

    .dropdown-toggle {
        border: none !important;
        background: none !important;
        box-shadow: none !important;
    }

    .dropdown-toggle::after {
        color: #00d4ff;
        margin-left: 10px;
    }

    .profile-container {
        display: flex;
        align-items: center;
        border-radius: 40px;
        transition: .3s;
    }

    .profile-container:hover {
        background: rgba(0, 212, 255, .08);
    }

    .profile-avatar {
        width: 46px;
        height: 46px;
        border-radius: 50%;
        background: linear-gradient(135deg, #25d8ff, #0094ff);
        display: flex;
        justify-content: center;
        align-items: center;
        font-size: 18px;
        color: #fff;
        font-weight: 700;
        border: 2px solid rgba(255, 255, 255, .25);
        box-shadow: 0 0 14px rgba(0, 212, 255, .45);
    }

    .profile-name {
        margin-left: 4px;
        color: #fff;
        font-size: 15px;
        font-weight: 600;
    }

    /* =========================
           DROPDOWN INTERACTIVE PANEL
        ========================= */
    .dropdown-menu {
        margin-top: 15px;
        min-width: 230px;
        background: #2A4563;
        border: 1px solid rgba(0, 212, 255, .35);
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 12px 35px rgba(0, 0, 0, .4);
        z-index: 10040;
    }

    .dropdown-item {
        color: #fff;
        padding: 12px 18px;
        transition: .25s;
        font-size: 15px;
    }

    .dropdown-item:hover {
        background: #00d4ff;
        color: #08192f;
    }

    .dropdown-divider {
        border-color: rgba(255, 255, 255, .12);
    }

    /* =========================
           TOGGLER & X MORPH ANIMATION
        ========================= */
    .navbar-toggler {
        border: 1px solid #27d5e4;
        padding: 8px 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 10015;
        background: transparent;
        transition: all 0.3s ease-in-out;
        width: 45px;
        height: 35px;
        position: relative;
    }

    .navbar-toggler:focus {
        box-shadow: none;
    }

    .navbar-toggler-icon {
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3e%3cpath stroke='%2327d5e4' stroke-linecap='round' stroke-miterlimit='10' stroke-width='2.5' d='M4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e");
        width: 2rem !important;
        height: 2rem !important;
        transition: all 0.5s cubic-bezier(0.68, -0.55, 0.265, 1.55);
    }

    .navbar-toggler:not(.collapsed) .navbar-toggler-icon {
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16' fill='%2327d5e4'%3e%3cpath d='M.293.293a1 1 0 0 1 1.414 0L8 6.586 14.293.293a1 1 0 1 1 1.414 1.414L9.414 8l6.293 6.293a1 1 0 0 1-1.414 1.414L8 9.414l-6.293 6.293a1 1 0 0 1-1.414-1.414L6.586 8 .293 1.707a1 1 0 0 1 0-1.414z'/%3e%3c/svg%3e");
        transform: rotate(180deg) scale(1.1);
    }

    .navbar-toggler:not(.collapsed) {
        border-color: #27d5e4;
        box-shadow: 0 0 20px rgba(39, 213, 228, 0.25);
        transition: all 0.4s ease;
    }

    /* =========================
           ADDITIONAL STYLES (kept from original)
        ========================= */
    .profile-container {
        display: flex;
        align-items: center;
        gap: 1px;
    }

    .profile-avatar {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background: linear-gradient(135deg, #2A4563, #00E5FF);
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-weight: bold;
        font-size: 16px;
        text-transform: uppercase;
        overflow: hidden;
    }

    .profile-avatar img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .profile-name {
        color: white;
        font-weight: 500;
        font-size: 14px;
    }

    .profile-username {
        font-size: 11px;
        color: #9ca3af;
    }

    .dropdown-toggle::after {
        color: white;
    }

    .dropdown-menu {
        background: #172844;
        border: 1px solid rgba(59, 90, 122, 0.3);
        border-radius: 12px;
        padding: 8px;
        min-width: 200px;
    }

    .dropdown-item {
        color: #d1d5db;
        border-radius: 8px;
        padding: 8px 16px;
        transition: all 0.3s ease;
    }

    .dropdown-item:hover {
        background: #2A4563;
        color: white;
    }

    .dropdown-divider {
        border-color: rgba(59, 90, 122, 0.3);
    }

    .btn:focus {
        box-shadow: none;
    }

    /* Prevent body scroll when menu is open */
    .menu-open {
        overflow: hidden;
    }

    /* =========================
           RESPONSIVE MEDIA OVERRIDES (Placed at the VERY BOTTOM to guarantee it works)
        ========================= */
    @media (max-width: 769px) {
        .navbar-custom {
            min-height: 80px;
        }

        .navbar-custom .container {
            display: flex !important;
            flex-direction: row !important;
            justify-content: space-between !important;
            align-items: center !important;
        }

        .navbar-brand {
            position: absolute;
            top: 100%;
            left: 50%;
            transform: translate(-50%, -50%);
        }

        .logo-img {
            margin-top: 8px;
            width: 130px;
            height: 130px;
        }

        .dropdown-menu-end {
            right: 0 !important;
            left: auto !important;
        }

        /* =============================================
           MOBILE MENU - SLIDING FROM LEFT SIDE
        ============================================= */
        .navbar-collapse {
            position: fixed;
            top: 0;
            left: -100%;
            width: 280px;
            height: 100vh;
            background: #2A4563;
            padding: 70px 20px 30px 20px;
            overflow-y: auto;
            transition: left 0.2s ease-out;
            border-right: 2px solid #00d4ff;
            box-shadow: 5px 0 30px rgba(0, 0, 0, 0.5);
            z-index: 10050;
        }

        .navbar-collapse.show {
            left: 0;
        }

        /* Close button inside the menu */
        .navbar-collapse .close-menu {
            display: block !important;
            position: absolute;
            top: 15px;
            right: 20px;
            background: none;
            border: none;
            color: #00d4ff;
            font-size: 28px;
            cursor: pointer;
            transition: 0.3s;
            z-index: 10060;
            line-height: 1;
        }

        .navbar-collapse .close-menu:hover {
            transform: rotate(90deg);
            color: #fff;
        }

        .navbar-nav {
            margin: 0;
            text-align: left;
            gap: 8px;
            flex-direction: column;
        }

        .navbar-nav .nav-item {
            width: 100%;
            border-bottom: 1px solid rgba(255, 255, 255, 0.05);
        }

        .navbar-nav .nav-link {
            padding: 12px 15px;
            font-size: 16px;
            display: flex;
            align-items: center;
            gap: 12px;
            border-radius: 8px;
            transition: 0.3s;
        }

        .navbar-nav .nav-link i {
            width: 22px;
            text-align: center;
            color: #00d4ff;
            font-size: 18px;
        }

        .navbar-nav .nav-link:hover {
            background: rgba(0, 212, 255, 0.1);
            padding-left: 25px;
        }

        .navbar-nav .nav-link::after {
            display: none;
        }

        /* ===== SUPPORT SECTION (Forces display on mobile) ===== */
        .mobile-support-item {
            display: flex !important;
            flex-direction: column !important;
            align-items: flex-start !important;
            padding: 20px 15px 10px 15px !important;
            border-bottom: none !important;
            width: 100%;
            margin-top: auto;
            /* Pushes it to the bottom */
        }

        .mobile-support-item .support-label {
            color: rgba(255, 255, 255, 0.5) !important;
            font-size: 0.7rem !important;
            text-transform: uppercase !important;
            letter-spacing: 1.5px !important;
            font-weight: 600 !important;
            margin-bottom: 6px !important;
        }

        .mobile-support-item .support-email {
            color: #00d4ff !important;
            text-decoration: none !important;
            font-weight: 500 !important;
            display: flex !important;
            align-items: center !important;
            gap: 10px !important;
            font-size: 0.95rem !important;
            transition: 0.3s !important;
        }

        .mobile-support-item .support-email i {
            font-size: 16px !important;
            width: 22px !important;
            text-align: center !important;
        }

        .mobile-support-item .support-email:hover {
            color: #fff !important;
            text-decoration: underline !important;
        }
    }
</style>


<nav class="navbar navbar-expand-lg navbar-custom">
    <div class="container">

        <button class="navbar-toggler collapsed order-1" type="button" data-bs-toggle="collapse"
            data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <a class="navbar-brand" href="#">
            <img src="{{ asset('images/nav_logo.png') }}" alt="Bet Pro Exchange" class="logo-img">
        </a>

        <div class="dropdown profile-dropdown-wrapper order-3">
            <button class="btn dropdown-toggle d-flex align-items-center p-0" type="button" data-bs-toggle="dropdown"
                aria-expanded="false" style="border: none; background: transparent;">
                <div class="profile-container">
                    <div class="profile-avatar">
                        @if(Auth::check() && Auth::user()->image)
                            <img src="{{ asset('users/' . Auth::user()->image) }}" alt="{{ Auth::user()->name }}"
                                style="width: 40px; height: 40px; border-radius: 50%; object-fit: cover;">
                        @else
                            {{ Auth::check() ? Auth::user()->getInitialsAttribute() : 'GU' }}
                        @endif
                    </div>
                    <div class="d-none d-md-block">
                        <div class="profile-name">{{ Auth::check() ? Auth::user()->name : 'Guest' }}</div>
                        <div class="profile-username" style="font-size: 11px; color: #9ca3af;">
                            @if(Auth::check())
                                {{ Auth::user()->user_name }}
                            @endif
                        </div>
                    </div>
                </div>
            </button>
            <ul class="dropdown-menu dropdown-menu-end">
                <li>
                    <div class="dropdown-item"
                        style="font-weight: 600; color: white; border-bottom: 1px solid rgba(59, 90, 122, 0.3);">
                        <i class="fas fa-user me-2"></i> {{ Auth::check() ? Auth::user()->name : 'Guest' }}
                    </div>
                </li>

                @if(Auth::check())
                    <!-- Show these items only when logged in -->
                    <li><a class="dropdown-item" href="{{ route('pages.userprofile') }}" style="font-size: larger;">
                            <i class="fas fa-user-edit me-2"></i> My Account
                        </a></li>

                    <li>
                        <a class="dropdown-item" href="{{ route('pages.deposit.history') }}" style="font-size: larger;">
                            <i class="fas fa-arrow-down me-2"></i> Deposit History
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="{{ route('pages.withdraw.history') }}" style="font-size: larger;">
                            <i class="fas fa-arrow-up me-2"></i> Withdraw History
                        </a>
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li>
                        <form action="{{ route('auth.logout') }}" method="POST" style="display: inline;">
                            @csrf
                            <button type="submit" class="dropdown-item"
                                style="font-size: larger; color: #ef5555; background: none; border: none; width: 100%; text-align: left; cursor: pointer;">
                                <i class="fas fa-sign-out-alt me-2"></i> Log Out
                            </button>
                        </form>
                    </li>
                @else
                    <!-- Show only Login when not logged in -->
                    <li>
                        <a class="dropdown-item" href="{{ route('auth.login.page') }}"
                            style="font-size: larger; color: #00E5FF; font-weight: 600;">
                            <i class="fas fa-sign-in-alt me-2"></i> Login
                        </a>
                    </li>
                @endif
            </ul>
        </div>

        <div class="collapse navbar-collapse order-2" id="navbarNav">
            <!-- Close (X) button for mobile -->
            <button class="close-menu" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-label="Close menu">
                <i class="fas fa-times"></i>
            </button>

            <ul class="navbar-nav mx-auto">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('pages.home') }}">
                        <i class="fas fa-home"></i> Home
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('pages.about') }}">
                        <i class="fas fa-info-circle"></i> About
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('pages.platforms') }}">
                        <i class="fas fa-th-large"></i> Platforms
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('pages.planes') }}">
                        <i class="fas fa-gem"></i> Planes
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('pages.blog') }}">
                        <i class="fas fa-blog"></i> Blogs
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('pages.contact') }}">
                        <i class="fas fa-envelope"></i> Contact Us
                    </a>
                </li>

                <!-- ===== SUPPORT ITEM (Mobile Only) ===== -->
                <li class="nav-item mobile-support-item">
                    <span class="support-label">
                        <i class="fas fa-headset"></i> Support
                    </span>
                    <a href="mailto:contact@betpro.com" class="support-email">
                        <i class="fas fa-envelope"></i> contact@betpro.com
                    </a>
                </li>
            </ul>
        </div>

    </div>
</nav>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const navbarCollapse = document.getElementById('navbarNav');
        const body = document.body;

        navbarCollapse.addEventListener('show.bs.collapse', function () {
            body.classList.add('menu-open');
        });

        navbarCollapse.addEventListener('hidden.bs.collapse', function () {
            body.classList.remove('menu-open');
        });
    });
</script>