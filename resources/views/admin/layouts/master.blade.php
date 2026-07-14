<!DOCTYPE html>
<html lang="en">
<head>
    @include('admin.partials.head')
</head>
<body class="bg-[#f8f9fa] text-gray-800 antialiased font-sans">

    <!-- Sidebar Include Component -->
    @include('admin.partials.sidebar')

    <!-- Main Content Area -->
    <div class="lg:pl-64 min-h-screen flex flex-col">
        
        <!-- Header Include Component -->
        @include('admin.partials.header')

        <!-- Dynamic Content -->
        <main class="flex-1 p-6">
            @yield('admin_content')
        </main>

    </div>

    <!-- Scripts -->
    @include('admin.partials.script')
</body>
</html>