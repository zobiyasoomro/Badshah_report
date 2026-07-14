<!-- Chart.js for charts -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    // Mobile Sidebar Toggle
    const mobileMenuBtn = document.getElementById('mobileMenuBtn');
    const closeMobileSidebarBtn = document.getElementById('closeMobileSidebarBtn');
    const sidebarElement = document.getElementById('adminSidebar');
    const burgerIcon = document.getElementById('burgerIcon');
    const closeIcon = document.getElementById('closeIcon');

    function toggleSidebar() {
        sidebarElement.classList.toggle('-translate-x-full');
        
        if (sidebarElement.classList.contains('-translate-x-full')) {
            if (burgerIcon) { burgerIcon.classList.remove('hidden'); burgerIcon.classList.add('block'); }
            if (closeIcon) { closeIcon.classList.remove('block'); closeIcon.classList.add('hidden'); }
        } else {
            if (burgerIcon) { burgerIcon.classList.remove('block'); burgerIcon.classList.add('hidden'); }
            if (closeIcon) { closeIcon.classList.remove('hidden'); closeIcon.classList.add('block'); }
        }
    }

    if (mobileMenuBtn) {
        mobileMenuBtn.addEventListener('click', toggleSidebar);
    }

    if (closeMobileSidebarBtn) {
        closeMobileSidebarBtn.addEventListener('click', toggleSidebar);
    }

    // Profile Dropdown
    const profileDropdownBtn = document.getElementById('profileDropdownBtn');
    const profileMenu = document.getElementById('profileMenu');

    if (profileDropdownBtn && profileMenu) {
        profileDropdownBtn.addEventListener('click', (e) => {
            e.stopPropagation();
            profileMenu.classList.toggle('hidden');
        });
    }

    // Close dropdown on outside click
    window.addEventListener('click', () => {
        if (profileMenu && !profileMenu.classList.contains('hidden')) {
            profileMenu.classList.add('hidden');
        }
    });

    // Close sidebar on outside click (mobile)
    document.addEventListener('click', function(event) {
        const sidebar = document.getElementById('adminSidebar');
        const isClickInside = sidebar?.contains(event.target);
        const isToggleBtn = event.target.closest('#mobileMenuBtn');
        
        if (!isClickInside && !isToggleBtn && window.innerWidth < 1024) {
            sidebar?.classList.add('-translate-x-full');
            if (burgerIcon) { burgerIcon.classList.remove('hidden'); burgerIcon.classList.add('block'); }
            if (closeIcon) { closeIcon.classList.remove('block'); closeIcon.classList.add('hidden'); }
        }
    });
</script>