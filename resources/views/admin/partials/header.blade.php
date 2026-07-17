<!-- Top Navbar Row Component -->
<header
    class="bg-white border-b border-gray-200 h-20 sticky top-0 z-30 flex items-center justify-between px-6 shadow-sm"
    style="background-color: #2A4563 ;">
    <div class="flex items-center gap-4">
        <!-- Mobile Menu Toggle Button -->
        <button id="mobileMenuBtn"
            class="p-2 rounded-lg hover:bg-white/10 lg:hidden focus:outline-none flex items-center"
            style="background: transparent;">
            <i id="burgerIcon" class="fa-solid fa-bars text-xl block" style="color: #f5f5f5;"></i>
        </button>

        <!-- Breadcrumb / Page Title -->
        <div>
            <span
                class="text-sm font-semibold text-white hidden sm:inline-block tracking-wider uppercase opacity-90 hover:opacity-100 transition-opacity duration-200">Dashboard</span>
        </div>
    </div>

    <!-- Right Side - Profile & Actions -->
    <div class="flex items-center gap-3" style="background-color: #2A4563; padding: 8px 16px; border-radius: 12px;">
        <!-- Close Icon (Right Most) -->
        <button id="closeMenuBtn" class="lg:hidden p-2 rounded-lg hover:bg-white/10 transition-all">
            <i id="closeIcon" class="fa-solid fa-xmark text-xl" style="color: #f5f5f5;"></i>
        </button>

        <!-- Notification Bell -->
        <button class="relative p-2 rounded-lg hover:bg-white/10 transition-all text-white">
            <i class="fa-regular fa-bell text-xl" style="color: #f5f5f5;"></i>
            <span class="absolute top-1.5 right-1.5 w-2 h-2 bg-red-500 rounded-full"></span>
        </button>

        <!-- Profile Interactive Dropdown -->
        <div class="relative">
            <button id="profileDropdownBtn"
                class="flex items-center gap-2 focus:outline-none py-1.5 px-3 rounded-xl hover:bg-white/10 transition-all">
                <div class="w-8 h-8 rounded-full bg-white flex items-center justify-center font-bold border-2"
                    style="color: #2A4563; border-color: rgba(255,255,255,0.3);">
                    A
                </div>
                <span class="text-sm font-medium hidden sm:inline-block" style="color: #f5f5f5;">Admin</span>
                <i class="fa-solid fa-chevron-down text-xs" style="color: rgba(245,245,245,0.6);"></i>
            </button>

            <!-- Dropdown Menu -->
            <div id="profileMenu"
                class="absolute right-0 mt-2 w-56 bg-white border border-gray-200 rounded-2xl shadow-xl py-2 hidden z-50">

                <!-- User Info -->
                <div class="px-4 py-3 border-b border-gray-100">
                    <p class="text-sm font-semibold" style="color: #2A4563;">Admin Profile</p>
                    <p class="text-xs" style="color: #6b7a8d;">betproadmin@example.com</p>
                </div>

                <!-- Menu Items -->
                <a href="{{ route('admin.profile') }}"
                    class="flex items-center gap-3 px-4 py-2.5 text-sm hover:bg-gray-50 transition-all duration-200"
                    style="color: #2A4563;">
                    <i class="fa-regular fa-user w-5 text-center" style="color: #2A4563;"></i>
                    My Profile
                </a>

                

                <a href="{{ url('/home') }}" target="_blank"
                    class="flex items-center gap-3 px-4 py-2.5 text-sm hover:bg-gray-50 transition-all duration-200"
                    style="color: #2A4563;">
                    <i class="fa-solid fa-globe w-5 text-center" style="color: #2A4563;"></i>
                    View Website
                </a>

                <!-- Divider -->
                <hr class="border-gray-100 my-1">

                <!-- Logout -->
                <form action="{{ route('auth.logout') }}" method="POST">
                    @csrf
                    <button type="submit"
                        class="flex items-center gap-3 px-4 py-2.5 text-sm w-full text-left hover:bg-red-50 transition-all duration-200"
                        style="color: #dc2626;">
                        <i class="fas fa-sign-out-alt w-5 text-center" style="color: #dc2626;"></i>
                        Log Out
                    </button>
                </form>
            </div>
        </div>
    </div>
</header>