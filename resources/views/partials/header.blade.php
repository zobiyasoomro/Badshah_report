<style>
    /* =========================
           BODY & GLOBAL
        ========================= */


    /* =========================
           NAVBAR MAIN CONTAINER
        ========================= */
    .navbar-custom {
        background: #08192f;
        border-top: 2px solid #00d4ff;
        border-bottom: 1px solid rgba(0, 212, 255, .18);
        padding: 10px 0;
        min-height: 100px;
        box-shadow: 0 8px 25px rgba(0, 0, 0, .35);
    }

    /* Ensures absolute elements align with the grid container bounds */
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
        /* Aligns perfectly with the container layout edge */
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
        /* Offset ensures links never clip behind the logo */
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
        /* Higher priority so dropdown is always clickable over mobile overlays */
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
        /* gap: 12px; */
        /* padding: 7px 14px; */
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
        background: #08192f;
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
    /* =========================
   MORPHING HAMBURGER TO X ANIMATION
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

    /* Morph to X with rotation and color */
    .navbar-toggler:not(.collapsed) .navbar-toggler-icon {
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16' fill='%2327d5e4'%3e%3cpath d='M.293.293a1 1 0 0 1 1.414 0L8 6.586 14.293.293a1 1 0 1 1 1.414 1.414L9.414 8l6.293 6.293a1 1 0 0 1-1.414 1.414L8 9.414l-6.293 6.293a1 1 0 0 1-1.414-1.414L6.586 8 .293 1.707a1 1 0 0 1 0-1.414z'/%3e%3c/svg%3e");
        transform: rotate(180deg) scale(1.1);
    }

    /* Glowing border effect when menu is open */
    .navbar-toggler:not(.collapsed) {
        border-color: #27d5e4;
        box-shadow: 0 0 20px rgba(39, 213, 228, 0.25);
        transition: all 0.4s ease;
    }

    /* =========================
           RESPONSIVE MEDIA OVERRIDES
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

        /* Center logo perfectly on mobile screens */
        .navbar-brand {
            position: absolute;
            top: 100%;
            left: 50%;
            transform: translate(-50%, -50%);
        }

        .logo-img {
            width: 100px;
            height: 100px;
        }

        /* Keeps dropdown menus cleanly confined to viewport boundaries */
        .dropdown-menu-end {
            right: 0 !important;
            left: auto !important;
        }

        /* Collapsible panel menu drawer setup */
        .navbar-collapse {
            border-radius: 4%;
            position: absolute;
            top: 117%;
            left: 0;
            right: 0;
            width: 100%;
            background: #08192f;
            padding: 40px 20px 20px 20px;
            border-bottom: 2px solid #00d4ff;
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.5);
            /* z-index: 10010; */
            /* Lower layer depth index priority compared to interactive avatar wrappers */
        }

        .navbar-nav {
            margin: 0;
            text-align: center;
            gap: 20px;
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
            <button class="btn dropdown-toggle d-flex align-items-center p-0" type="button"
                data-bs-toggle="dropdown" aria-expanded="false">
                <div class="profile-container">
                    <div class="profile-avatar">AR</div>
                    <div class="d-none d-md-block">
                        <div class="profile-name">Alex Rivera</div>
                    </div>
                </div>
            </button>
            <ul class="dropdown-menu dropdown-menu-end">
                <li><a class="dropdown-item" href="#">My Account</a></li>
                <li><a class="dropdown-item" href="#">Withdraw</a></li>
                <li><a class="dropdown-item" href="#">Deposit</a></li>
                <li>
                    <hr class="dropdown-divider">
                </li>
                <li><a class="dropdown-item text-danger" href="#">Log Out</a></li>
            </ul>
        </div>

        <div class="collapse navbar-collapse order-2" id="navbarNav">
            <ul class="navbar-nav mx-auto">
                <li class="nav-item"><a class="nav-link" href="{{ route('pages.home') }}">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('pages.about') }}">About</a>
                <li class="nav-item"><a class="nav-link" href="#">Platforms</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Blogs</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('pages.contact') }}">Contact Us</a></li>
            </ul>
        </div>

    </div>
</nav>