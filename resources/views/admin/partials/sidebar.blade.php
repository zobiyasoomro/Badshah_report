<style>
    /* ===== ADMIN LAYOUT STYLES ===== */
    body {
        background-color: #f8f9fa;
        color: #1f2937;
        font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
        -webkit-font-smoothing: antialiased;
        -moz-osx-font-smoothing: grayscale;
        min-height: 100vh;
        display: flex;
        flex-direction: column;
    }

    /* Main wrapper to accommodate sidebar */
    .admin-wrapper {
        display: flex;
        min-height: 100vh;
    }

    /* Content area with sidebar offset */
    .admin-content {
        flex: 1;
        display: flex;
        flex-direction: column;
        min-height: 100vh;
        transition: all 0.3s ease;
    }

    /* When sidebar is visible on desktop */
    @media (min-width: 992px) {
        .admin-content {
            margin-left: 256px;
        }
    }

    /* Main content padding */
    .admin-main {
        flex: 1;
        padding: 1.5rem;
    }

    /* Sidebar toggle for mobile */
    .sidebar-overlay {
        display: none;
        position: fixed;
        inset: 0;
        z-index: 1030;
        background: rgba(0, 0, 0, 0.50);
    }

    .sidebar-overlay.show {
        display: block;
    }

    @media (min-width: 992px) {
        .sidebar-overlay {
            display: none !important;
        }
    }

    /* ===== SIDEBAR STYLES (matching previous conversion) ===== */
    .admin-sidebar {
        position: fixed;
        top: 0;
        left: 0;
        z-index: 1040;
        width: 256px;
        height: 100vh;
        background: #ffffff;
        border-right: 1px solid #e5e7eb;
        transition: transform 0.3s ease-in-out;
        transform: translateX(-100%);
        overflow-y: auto;
    }

    .admin-sidebar.open {
        transform: translateX(0);
    }

    @media (min-width: 992px) {
        .admin-sidebar {
            transform: translateX(0);
        }
    }

    .sidebar-brand {
        background-color: #2A4563;
        height: 80px;
        border-bottom: 1px solid #e5e7eb;
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 0 24px;
    }

    .sidebar-brand .logo-wrapper {
        width: 64px;
        height: 64px;
        border-radius: 8px;
        overflow: hidden;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .sidebar-brand .logo-wrapper img {
        width: 80px;
        height: 80px;
        object-fit: contain;
    }

    .sidebar-brand .close-btn {
        color: #ffffff;
        background: none;
        border: none;
        font-size: 1.5rem;
        cursor: pointer;
        transition: color 0.2s ease;
        padding: 0;
        display: block;
    }

    .sidebar-brand .close-btn:hover {
        color: #e5e7eb;
    }

    @media (min-width: 992px) {
        .sidebar-brand .close-btn {
            display: none;
        }
    }

    .sidebar-nav {
        flex: 1;
        padding: 16px 12px;
        overflow-y: auto;
        height: calc(100vh - 80px);
    }

    .sidebar-nav .nav-list {
        list-style: none;
        padding: 0;
        margin: 0;
        display: flex;
        flex-direction: column;
        gap: 4px;
    }

    .sidebar-nav .nav-item {
        display: block;
    }

    .sidebar-nav .nav-link {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 10px 16px;
        border-radius: 12px;
        font-size: 0.875rem;
        font-weight: 500;
        text-decoration: none;
        transition: all 0.2s ease;
        color: #4b5563;
        background: transparent;
        border: none;
        width: 100%;
        cursor: pointer;
    }

    .sidebar-nav .nav-link:hover {
        background: #f3f4f6;
        color: #4b5563;
    }

    .sidebar-nav .nav-link.active {
        background: #2A4563;
        color: #ffffff;
        box-shadow: 0 4px 14px rgba(42, 69, 99, 0.20);
    }

    .sidebar-nav .nav-link i {
        width: 20px;
        font-size: 1rem;
        flex-shrink: 0;
    }

    .sidebar-nav .nav-link .chevron {
        margin-left: auto;
        font-size: 0.75rem;
        transition: transform 0.3s ease;
    }

    .sidebar-nav .nav-link .chevron.rotated {
        transform: rotate(180deg);
    }

    .sidebar-nav .dropdown-menu-custom {
        list-style: none;
        padding: 0;
        margin: 4px 0 0 0;
        padding-left: 32px;
        display: none;
    }

    .sidebar-nav .dropdown-menu-custom.show {
        display: block;
    }

    .sidebar-nav .dropdown-menu-custom .nav-link {
        padding: 10px 16px;
        font-size: 0.875rem;
        gap: 12px;
    }

    .sidebar-nav .dropdown-menu-custom .nav-link i {
        width: 16px;
        font-size: 0.875rem;
    }

    .sidebar-nav .dropdown-menu-custom .nav-link.active {
        background: #2A4563;
        color: #ffffff;
    }

    .sidebar-bottom {
        padding-top: 16px;
        margin-top: 16px;
        border-top: 1px solid #e5e7eb;
    }

    .sidebar-bottom .nav-link {
        color: #4b5563;
    }

    .sidebar-bottom .nav-link:hover {
        background: #f3f4f6;
        color: #4b5563;
    }

    /* Scrollbar styling */
    .sidebar-nav::-webkit-scrollbar {
        width: 4px;
    }

    .sidebar-nav::-webkit-scrollbar-track {
        background: transparent;
    }

    .sidebar-nav::-webkit-scrollbar-thumb {
        background: #d1d5db;
        border-radius: 4px;
    }

    .sidebar-nav::-webkit-scrollbar-thumb:hover {
        background: #9ca3af;
    }

    @media (max-width: 991.98px) {
        .admin-sidebar {
            transform: translateX(-100%);
        }

        .admin-sidebar.open {
            transform: translateX(0);
        }
    }
</style>
<!-- ===== SIDEBAR OVERLAY ===== -->
<div id="sidebarOverlay" class="sidebar-overlay" onclick="closeSidebar()"></div>

<!-- ===== SIDEBAR ===== -->
<aside id="adminSidebar" class="admin-sidebar">
    <div class="d-flex flex-column h-100">
        <!-- Brand Logo -->
        <div class="sidebar-brand">
            <div class="logo-wrapper">
                <img src="{{ asset('images/nav_logo.png') }}" alt="Logo">
            </div>
            <button id="closeMobileSidebarBtn" class="close-btn" onclick="closeSidebar()">
                <i class="fa-solid fa-xmark"></i>
            </button>
        </div>

        <!-- Navigation Menu -->
        <nav class="sidebar-nav">
            <ul class="nav-list">
                <!-- 1. Dashboard -->
                <li class="nav-item">
                    <a href="{{ route('admin.dashboard') }}"
                        class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                        <i class="fa-solid fa-th-large"></i>
                        Dashboard
                    </a>
                </li>

                <!-- 2. Users Dropdown -->
                <li class="nav-item">
                    <button type="button" onclick="toggleUsersDropdown()" class="nav-link">
                        <div class="d-flex align-items-center gap-3">
                            <i class="fa-solid fa-users"></i>
                            Users
                        </div>
                        <i id="usersChevron"
                            class="fa-solid fa-chevron-down chevron {{ request()->routeIs('admin.user') || request()->routeIs('admin.UserAccounts') ? 'rotated' : '' }}"></i>
                    </button>

                    <!-- Dropdown Menu -->
                    <ul id="usersDropdown"
                        class="dropdown-menu-custom {{ request()->routeIs('admin.user') || request()->routeIs('admin.UserAccounts') ? 'show' : '' }}">
                        <!-- Users -->
                        <li class="nav-item">
                            <a href="{{ route('admin.user') }}"
                                class="nav-link {{ request()->routeIs('admin.user') ? 'active' : '' }}">
                                <i class="fa-solid fa-user"></i>
                                Users
                            </a>
                        </li>
                        <!-- User Accounts -->
                        <li class="nav-item">
                            <a href="{{ route('admin.UserAccounts') }}"
                                class="nav-link {{ request()->routeIs('admin.UserAccounts') ? 'active' : '' }}">
                                <i class="fa-solid fa-user-gear"></i>
                                UsersAccounts
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- 4. Payment Methods -->
                <li class="nav-item">
                    <a href="{{ route('admin.payment-methods.index') }}"
                        class="nav-link {{ request()->routeIs('admin.payment-methods.*') ? 'active' : '' }}">
                        <i class="fa-solid fa-credit-card"></i>
                        Payment Methods
                    </a>
                </li>

                <!-- 4. Platforms -->
                <li class="nav-item">
                    <a href="{{ route('admin.platforms') }}"
                        class="nav-link {{ request()->routeIs('admin.platforms') ? 'active' : '' }}">
                        <i class="fa-solid fa-cubes"></i>
                        Platforms
                    </a>
                </li>
                <!-- 3. Deposit -->
                <li class="nav-item">
                    <a href="{{ route('admin.deposits.index') }}"
                        class="nav-link {{ request()->routeIs('admin.deposits.index') ? 'active' : '' }}">
                        <i class="fa-solid fa-circle-dollar-to-slot"></i>
                        Deposits
                    </a>
                </li>

                <!-- 4. Withdrawals -->
                <li class="nav-item">
                    <a href="{{ route('admin.withdrawals.index') }}"
                        class="nav-link {{ request()->routeIs('admin.withdrawals.index') ? 'active' : '' }}">
                        <i class="fa-solid fa-hand-holding-dollar"></i>
                        Withdrawals
                    </a>
                </li>

                <!-- 5. Blog -->
                <li class="nav-item">
                    <a href="{{ route('admin.blog.index') }}"
                        class="nav-link {{ request()->routeIs('admin.blog.*') ? 'active' : '' }}">
                        <i class="fa-solid fa-blog"></i>
                        Blog
                    </a>
                </li>

                <!-- 6. About -->
                <li class="nav-item">
                    <a href="{{ route('admin.about') }}"
                        class="nav-link {{ request()->routeIs('admin.about') ? 'active' : '' }}">
                        <i class="fa-solid fa-info-circle"></i>
                        About
                    </a>
                </li>
                <!-- 6. Review -->
                <li class="nav-item">
                    <a href="{{ route('admin.reviews.index') }}"
                        class="nav-link {{ request()->routeIs('admin.reviews.index') ? 'active' : '' }}">
                        <i class="fa-solid fa-star"></i>
                        Reviews
                    </a>
                </li>

                <!-- 7. Contact -->
                <li class="nav-item">
                    <a href="{{ route('admin.contact') }}"
                        class="nav-link {{ request()->routeIs('admin.contact') ? 'active' : '' }}">
                        <i class="fa-solid fa-envelope"></i>
                        Contact
                    </a>
                </li>
            </ul>

            <!-- Bottom Section -->
            <div class="sidebar-bottom">
                <a href="{{ url('/home') }}" target="_blank" class="nav-link">
                    <i class="fa-solid fa-external-link-alt"></i>
                    View Site
                </a>
            </div>
        </nav>
    </div>
</aside>

<!-- ===== MAIN CONTENT AREA ===== -->
<div class="admin-content">

    <!-- Header Include Component -->
    @include('admin.partials.header')

    <!-- Dynamic Content -->
    <main class="admin-main">
        @yield('admin_content')
    </main>

</div>


<script>
    // ===== TOGGLE USERS DROPDOWN =====
    function toggleUsersDropdown() {
        const dropdown = document.getElementById('usersDropdown');
        const chevron = document.getElementById('usersChevron');

        dropdown.classList.toggle('show');
        chevron.classList.toggle('rotated');
    }

    // ===== OPEN SIDEBAR =====
    function openSidebar() {
        const sidebar = document.getElementById('adminSidebar');
        const overlay = document.getElementById('sidebarOverlay');

        sidebar.classList.add('open');
        overlay.classList.add('show');
        document.body.style.overflow = 'hidden';
    }

    // ===== CLOSE SIDEBAR =====
    function closeSidebar() {
        const sidebar = document.getElementById('adminSidebar');
        const overlay = document.getElementById('sidebarOverlay');

        sidebar.classList.remove('open');
        overlay.classList.remove('show');
        document.body.style.overflow = '';
    }

    // ===== CLOSE ON ESCAPE KEY =====
    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape') {
            closeSidebar();
        }
    });

    // ===== HANDLE WINDOW RESIZE =====
    let resizeTimeout;
    window.addEventListener('resize', function () {
        clearTimeout(resizeTimeout);
        resizeTimeout = setTimeout(function () {
            if (window.innerWidth >= 992) {
                const sidebar = document.getElementById('adminSidebar');
                const overlay = document.getElementById('sidebarOverlay');
                sidebar.classList.remove('open');
                overlay.classList.remove('show');
                document.body.style.overflow = '';
            }
        }, 250);
    });

    // ===== SIDEBAR TOGGLE =====
    function toggleSidebar() {
        const sidebar = document.getElementById('adminSidebar');
        const overlay = document.getElementById('sidebarOverlay');

        if (sidebar.classList.contains('open')) {
            closeSidebar();
        } else {
            openSidebar();
        }
    }

    // ===== KEEP DROPDOWN OPEN ON PAGE LOAD IF ACTIVE =====
    document.addEventListener('DOMContentLoaded', function () {
        // If users or UserAccounts route is active, keep dropdown open
        @if(request()->routeIs('admin.user') || request()->routeIs('admin.UserAccounts'))
            const dropdown = document.getElementById('usersDropdown');
            const chevron = document.getElementById('usersChevron');
            if (dropdown) {
                dropdown.classList.add('show');
                chevron.classList.add('rotated');
            }
        @endif
    });
</script>