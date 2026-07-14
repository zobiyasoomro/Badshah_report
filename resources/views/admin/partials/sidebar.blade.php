<!-- Admin Sidebar -->
<aside id="adminSidebar"
    class="fixed top-0 left-0 z-40 w-64 h-screen bg-white border-r border-gray-200 transition-transform -translate-x-full lg:translate-x-0">
    <div class="h-full flex flex-col">
        <!-- Brand Logo -->
        <!-- Brand Logo -->
        <div class="flex items-center justify-between px-6 h-20 border-b border-gray-200"
            style="background-color: #2A4563 ;">

            <!-- Logo wrapper -->
            <div class="w-16 h-16 rounded-lg overflow-hidden flex items-center justify-center">
                <img src="{{ asset('images/nav_logo.png') }}" alt="Logo" class="w-20 h-20 object-contain">
            </div>

            <!-- Close button for mobile -->
            <button id="closeMobileSidebarBtn" class="lg:hidden text-white hover:text-gray-200">
                <i class="fa-solid fa-xmark text-2xl"></i>
            </button>
        </div>

        <!-- Navigation Menu -->
        <nav class="flex-1 px-3 py-4 overflow-y-auto">
            <ul class="space-y-1">
                <li>
                    <a href="{{ route('admin.dashboard') }}"
                        class="flex items-center gap-3 px-4 py-2.5 rounded-xl text-sm font-medium transition-all {{ request()->routeIs('admin.dashboard') ? 'bg-[#2A4563] text-white shadow-lg shadow-[#2A4563]/20' : 'text-gray-600 hover:bg-gray-100' }}">
                        <i class="fa-solid fa-th-large w-5"></i>
                        Dashboard
                    </a>
                </li>
                <li>
                    <a href="#"
                        class="flex items-center gap-3 px-4 py-2.5 rounded-xl text-sm font-medium transition-all {{ request()->routeIs('admin.about') ? 'bg-[#2A4563] text-white shadow-lg shadow-[#2A4563]/20' : 'text-gray-600 hover:bg-gray-100' }}">
                        <i class="fa-solid fa-info-circle w-5"></i>
                        About
                    </a>
                </li>
                <li>
                    <a href="#"
                        class="flex items-center gap-3 px-4 py-2.5 rounded-xl text-sm font-medium transition-all {{ request()->routeIs('admin.platforms') ? 'bg-[#2A4563] text-white shadow-lg shadow-[#2A4563]/20' : 'text-gray-600 hover:bg-gray-100' }}">
                        <i class="fa-solid fa-cubes w-5"></i>
                        Platforms
                    </a>
                </li>
                <li>
                    <a href="#"
                        class="flex items-center gap-3 px-4 py-2.5 rounded-xl text-sm font-medium transition-all {{ request()->routeIs('admin.blog') ? 'bg-[#2A4563] text-white shadow-lg shadow-[#2A4563]/20' : 'text-gray-600 hover:bg-gray-100' }}">
                        <i class="fa-solid fa-blog w-5"></i>
                        Blog
                    </a>
                </li>
                <li>
                    <a href="#"
                        class="flex items-center gap-3 px-4 py-2.5 rounded-xl text-sm font-medium transition-all {{ request()->routeIs('admin.contact') ? 'bg-[#2A4563] text-white shadow-lg shadow-[#2A4563]/20' : 'text-gray-600 hover:bg-gray-100' }}">
                        <i class="fa-solid fa-envelope w-5"></i>
                        Contact
                    </a>
                </li>
            </ul>

            <!-- Bottom Section -->
            <div class="pt-4 mt-4 border-t border-gray-200">
                <a href="#" target="_blank"
                    class="flex items-center gap-3 px-4 py-2.5 rounded-xl text-sm font-medium text-gray-600 hover:bg-gray-100 transition-all">
                    <i class="fa-solid fa-external-link-alt w-5"></i>
                    View Site
                </a>
            </div>
        </nav>
    </div>
</aside>