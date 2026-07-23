<!-- Top Navbar Row Component -->
<style>
    .admin-header {
        background-color: #2A4563;
        border-bottom: 1px solid #e5e7eb;
        height: 80px;
        position: sticky;
        top: 0;
        z-index: 30;
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 0 24px;
        box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05);
    }

    .admin-header .header-left {
        display: flex;
        align-items: center;
        gap: 16px;
    }

    .admin-header .menu-btn {
        padding: 8px;
        border-radius: 8px;
        background: transparent;
        border: none;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: background 0.2s ease;
    }

    .admin-header .menu-btn:hover {
        background: rgba(255, 255, 255, 0.10);
    }

    .admin-header .menu-btn i {
        color: #f5f5f5;
        font-size: 1.25rem;
    }

    .admin-header .breadcrumb-text {
        font-size: 0.875rem;
        font-weight: 600;
        color: #ffffff;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        opacity: 0.9;
        transition: opacity 0.2s ease;
    }

    .admin-header .breadcrumb-text:hover {
        opacity: 1;
    }

    .admin-header .header-right {
        display: flex;
        align-items: center;
        gap: 12px;
        background-color: #2A4563;
        padding: 8px 16px;
        border-radius: 12px;
    }

    .admin-header .action-btn {
        padding: 8px;
        border-radius: 8px;
        background: transparent;
        border: none;
        cursor: pointer;
        transition: background 0.2s ease;
        color: #f5f5f5;
        position: relative;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .admin-header .action-btn:hover {
        background: rgba(255, 255, 255, 0.10);
    }

    .admin-header .action-btn i {
        color: #f5f5f5;
        font-size: 1.25rem;
    }

    .admin-header .notification-dot {
        position: absolute;
        top: 6px;
        right: 6px;
        width: 8px;
        height: 8px;
        background: #ef4444;
        border-radius: 50%;
    }

    .admin-header .profile-btn {
        display: flex;
        align-items: center;
        gap: 8px;
        padding: 6px 12px;
        border-radius: 12px;
        background: transparent;
        border: none;
        cursor: pointer;
        transition: background 0.2s ease;
    }

    .admin-header .profile-btn:hover {
        background: rgba(255, 255, 255, 0.10);
    }

    .admin-header .profile-avatar {
        width: 32px;
        height: 32px;
        border-radius: 50%;
        background: #ffffff;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 700;
        color: #2A4563;
        border: 2px solid rgba(255, 255, 255, 0.3);
        font-size: 0.875rem;
    }

    .admin-header .profile-name {
        font-size: 0.875rem;
        font-weight: 500;
        color: #f5f5f5;
    }

    .admin-header .profile-chevron {
        font-size: 0.75rem;
        color: rgba(245, 245, 245, 0.6);
    }

    .admin-header .dropdown-menu-custom {
        position: absolute;
        right: 0;
        margin-top: 8px;
        width: 224px;
        background: #ffffff;
        border: 1px solid #e5e7eb;
        border-radius: 16px;
        box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.10);
        padding: 8px 0;
        display: none;
        z-index: 50;
    }

    .admin-header .dropdown-menu-custom.show {
        display: block;
    }

    .admin-header .dropdown-user-info {
        padding: 12px 16px;
        border-bottom: 1px solid #f3f4f6;
    }

    .admin-header .dropdown-user-name {
        font-size: 0.875rem;
        font-weight: 600;
        color: #2A4563;
        margin-bottom: 0;
    }

    .admin-header .dropdown-user-email {
        font-size: 0.75rem;
        color: #6b7a8d;
        margin-bottom: 0;
    }

    .admin-header .dropdown-item-custom {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 10px 16px;
        font-size: 0.875rem;
        color: #2A4563;
        text-decoration: none;
        transition: background 0.2s ease;
        border: none;
        background: transparent;
        width: 100%;
        text-align: left;
        cursor: pointer;
    }

    .admin-header .dropdown-item-custom:hover {
        background: #f9fafb;
    }

    .admin-header .dropdown-item-custom i {
        width: 20px;
        text-align: center;
        color: #2A4563;
    }

    .admin-header .dropdown-item-custom.danger {
        color: #dc2626;
    }

    .admin-header .dropdown-item-custom.danger i {
        color: #dc2626;
    }

    .admin-header .dropdown-item-custom.danger:hover {
        background: #fef2f2;
    }

    .admin-header .dropdown-divider-custom {
        border: none;
        border-top: 1px solid #f3f4f6;
        margin: 4px 0;
    }

    /* Mobile responsive */
    @media (max-width: 991.98px) {
        .admin-header .menu-btn {
            display: flex;
        }

        .admin-header .close-btn {
            display: flex;
        }

        .admin-header .breadcrumb-text {
            display: none;
        }

        .admin-header .profile-name {
            display: none;
        }

        .admin-header .header-right {
            padding: 8px 12px;
        }
    }

    @media (min-width: 992px) {
        .admin-header .menu-btn {
            display: none;
        }

        .admin-header .close-btn {
            display: none;
        }

        .admin-header .breadcrumb-text {
            display: inline-block;
        }

        .admin-header .profile-name {
            display: inline-block;
        }
    }

    @media (max-width: 575.98px) {
        .admin-header {
            padding: 0 12px;
            height: 64px;
        }

        .admin-header .header-right {
            padding: 4px 8px;
            gap: 4px;
        }

        .admin-header .profile-btn {
            padding: 4px 8px;
        }

        .admin-header .profile-avatar {
            width: 28px;
            height: 28px;
            font-size: 0.75rem;
        }

        .admin-header .action-btn i {
            font-size: 1rem;
        }

        .admin-header .menu-btn i {
            font-size: 1rem;
        }

        .admin-header .dropdown-menu-custom {
            width: 200px;
            right: -10px;
        }
    }
</style>

<header class="admin-header">
    <!-- Left Section -->
    <div class="header-left">
        <!-- Mobile Menu Toggle Button -->
        <button id="mobileMenuBtn" class="menu-btn">
            <i id="burgerIcon" class="fa-solid fa-bars"></i>
        </button>

        <!-- Breadcrumb / Page Title -->
        <span class="breadcrumb-text">Dashboard</span>
    </div>

    <!-- Right Section -->
    <div class="header-right">
        <!-- Close Button (Mobile) -->
        <button id="closeMenuBtn" class="menu-btn close-btn">
            <i id="closeIcon" class="fa-solid fa-xmark"></i>
        </button>

        <!-- Notification Bell -->
        @php
            use App\Models\Contact;
            $unreadContactsCount = Contact::where('is_read', false)->count();
            $unreadContacts = Contact::where('is_read', false)
                ->latest()
                ->take(5)
                ->get();
        @endphp

        <div class="dropdown" style="position: relative;">
            <button class="action-btn" 
                    type="button" 
                    id="notificationDropdown" 
                    style="position: relative; background: transparent; border: none; color: #f5f5f5; cursor: pointer; padding: 8px;">
                <i class="fa-regular fa-bell" style="font-size: 1.25rem;"></i>
                @if($unreadContactsCount > 0)
                    <span id="notificationBadge" style="position: absolute; top: -4px; right: -4px; min-width: 20px; height: 20px; background: #ef4444; color: white; border-radius: 50%; font-size: 10px; display: flex; align-items: center; justify-content: center; font-weight: 700; border: 2px solid #2A4563; padding: 0 4px;">
                        {{ $unreadContactsCount > 9 ? '9+' : $unreadContactsCount }}
                    </span>
                @else
                    <span id="notificationBadge" style="display: none;"></span>
                @endif
            </button>
            
            <div id="notificationMenu" 
                 style="display: none; position: absolute; right: 0; top: 100%; width: 380px; max-height: 450px; overflow-y: auto; background: #ffffff; border-radius: 12px; box-shadow: 0 10px 40px rgba(0,0,0,0.15); margin-top: 8px; z-index: 1000;">
                
                <!-- Header -->
                <div style="padding: 14px 18px; border-bottom: 1px solid #e5e7eb; background: #f8fafc; border-radius: 12px 12px 0 0; position: sticky; top: 0; z-index: 1;">
                    <div style="display: flex; justify-content: space-between; align-items: center;">
                        <span style="font-weight: 600; color: #1f2937; font-size: 14px;">
                            <i class="fa-regular fa-bell me-2"></i>Notifications
                        </span>
                        @if($unreadContactsCount > 0)
                            <span style="background: #ef4444; color: white; font-size: 10px; font-weight: 600; padding: 2px 12px; border-radius: 50px;">
                                {{ $unreadContactsCount }} new
                            </span>
                        @endif
                    </div>
                </div>
                
                <!-- Notification Items - Only Unread -->
                @if($unreadContacts->count() > 0)
                    @foreach($unreadContacts as $contact)
                        <a href="{{ route('admin.contact') }}" 
                           class="notification-item"
                           data-contact-id="{{ $contact->id }}"
                           style="display: flex; align-items: flex-start; gap: 12px; padding: 12px 18px; border-bottom: 1px solid #f1f5f9; text-decoration: none; transition: all 0.15s ease; background: #f0f7ff; position: relative;"
                           onmouseover="this.style.backgroundColor='#e3f0ff'" 
                           onmouseout="this.style.backgroundColor='#f0f7ff'">
                            
                            <!-- Unread indicator - Blue dot -->
                            <div style="width: 10px; height: 10px; border-radius: 50%; background: #3b82f6; flex-shrink: 0; margin-top: 14px; box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.2);"></div>
                            
                            <!-- Avatar -->
                            <div style="width: 40px; height: 40px; border-radius: 50%; background: #2A4563; color: white; display: flex; align-items: center; justify-content: center; font-weight: 600; font-size: 14px; flex-shrink: 0;">
                                {{ strtoupper(substr($contact->name, 0, 1)) }}
                            </div>
                            
                            <!-- Content -->
                            <div style="flex: 1; min-width: 0;">
                                <div style="font-weight: 600; color: #1f2937; font-size: 13px; margin-bottom: 2px;">
                                    {{ $contact->name }}
                                    <span style="font-weight: 400; color: #6b7280; font-size: 11px; margin-left: 4px;">
                                        {{ $contact->created_at->diffForHumans() }}
                                    </span>
                                </div>
                                <div style="font-size: 12px; color: #374151; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; font-weight: 500;">
                                    {{ Str::limit($contact->subject, 35) }}
                                </div>
                                <div style="font-size: 11px; color: #6b7280; margin-top: 3px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                                    {{ Str::limit($contact->description, 50) }}
                                </div>
                            </div>
                            
                            <!-- Arrow -->
                            <div style="color: #9ca3af; flex-shrink: 0; margin-top: 12px;">
                                <i class="fa-solid fa-chevron-right" style="font-size: 12px;"></i>
                            </div>
                        </a>
                    @endforeach
                    
                    <!-- Footer - View All -->
                    <div style="padding: 10px 18px; text-align: center; background: #f8fafc; border-radius: 0 0 12px 12px; position: sticky; bottom: 0; z-index: 1; border-top: 1px solid #e5e7eb;">
                        <a href="{{ route('admin.contact') }}" 
                           style="font-size: 13px; color: #2A4563; font-weight: 500; text-decoration: none; display: block; padding: 8px; border-radius: 8px; transition: all 0.15s ease;"
                           onmouseover="this.style.backgroundColor='#e5e7eb'" 
                           onmouseout="this.style.backgroundColor='transparent'">
                            <i class="fa-regular fa-eye me-1"></i>View all messages
                        </a>
                    </div>
                @else
                    <!-- Empty State -->
                    <div style="padding: 50px 20px; text-align: center;">
                        <div style="width: 60px; height: 60px; margin: 0 auto 16px; border-radius: 50%; background: #f3f4f6; display: flex; align-items: center; justify-content: center;">
                            <i class="fa-regular fa-bell-slash" style="color: #9ca3af; font-size: 24px;"></i>
                        </div>
                        <div style="font-size: 15px; color: #374151; font-weight: 500;">All caught up!</div>
                        <div style="font-size: 13px; color: #9ca3af; margin-top: 4px;">No unread messages</div>
                    </div>
                @endif
            </div>
        </div>

        <!-- Profile Interactive Dropdown -->
        <div class="position-relative">
            <button id="profileDropdownBtn" class="profile-btn">
                <div class="profile-avatar">
                    A
                </div>
                <span class="profile-name">Admin</span>
                <i class="fa-solid fa-chevron-down profile-chevron"></i>
            </button>

            <!-- Dropdown Menu -->
            <div id="profileMenu" class="dropdown-menu-custom">
                <!-- User Info -->
                <div class="dropdown-user-info">
                    <p class="dropdown-user-name">Admin Profile</p>
                    <p class="dropdown-user-email">betproadmin@example.com</p>
                </div>

                <!-- Menu Items -->
                <a href="{{ route('admin.profile') }}" class="dropdown-item-custom">
                    <i class="fa-regular fa-user"></i>
                    My Profile
                </a>

                <a href="{{ url('/home') }}" target="_blank" class="dropdown-item-custom">
                    <i class="fa-solid fa-globe"></i>
                    View Website
                </a>

                <!-- Divider -->
                <hr class="dropdown-divider-custom">

                <!-- Logout -->
                <form action="{{ route('auth.logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="dropdown-item-custom danger">
                        <i class="fas fa-sign-out-alt"></i>
                        Log Out
                    </button>
                </form>
            </div>
        </div>
    </div>
</header>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // ===== PROFILE DROPDOWN TOGGLE =====
        const profileBtn = document.getElementById('profileDropdownBtn');
        const profileMenu = document.getElementById('profileMenu');

        if (profileBtn && profileMenu) {
            profileBtn.addEventListener('click', function(e) {
                e.stopPropagation();
                profileMenu.classList.toggle('show');
            });

            document.addEventListener('click', function(e) {
                if (!profileBtn.contains(e.target) && !profileMenu.contains(e.target)) {
                    profileMenu.classList.remove('show');
                }
            });
        }

        // ===== NOTIFICATION DROPDOWN TOGGLE =====
        const notificationBtn = document.getElementById('notificationDropdown');
        const notificationMenu = document.getElementById('notificationMenu');

        if (notificationBtn && notificationMenu) {
            notificationBtn.addEventListener('click', function(e) {
                e.stopPropagation();
                const isOpen = notificationMenu.style.display === 'block';
                notificationMenu.style.display = isOpen ? 'none' : 'block';
                
                // Refresh unread count when opening
                if (!isOpen) {
                    updateBadgeCount();
                }
            });

            document.addEventListener('click', function(e) {
                if (!notificationBtn.contains(e.target) && !notificationMenu.contains(e.target)) {
                    notificationMenu.style.display = 'none';
                }
            });

            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape') {
                    notificationMenu.style.display = 'none';
                }
            });
        }

        // ===== MARK NOTIFICATION AS READ WHEN CLICKED =====
        document.querySelectorAll('.notification-item').forEach(item => {
            item.addEventListener('click', function(e) {
                const contactId = this.dataset.contactId;
                
                if (contactId) {
                    fetch(`/admin/contacts/${contactId}/mark-read`, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || ''
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            // Close dropdown
                            notificationMenu.style.display = 'none';
                            // Update badge
                            updateBadgeCount();
                        }
                    })
                    .catch(error => console.error('Error:', error));
                }
            });
        });

        // ===== UPDATE BADGE COUNT =====
        function updateBadgeCount() {
            fetch('/admin/contacts/unread-count')
                .then(response => response.json())
                .then(data => {
                    const badge = document.getElementById('notificationBadge');
                    if (badge) {
                        if (data.count > 0) {
                            badge.textContent = data.count > 9 ? '9+' : data.count;
                            badge.style.display = 'flex';
                        } else {
                            badge.style.display = 'none';
                        }
                    }
                })
                .catch(error => console.error('Error:', error));
        }

        // ===== MOBILE MENU TOGGLE =====
        const mobileMenuBtn = document.getElementById('mobileMenuBtn');
        const closeMenuBtn = document.getElementById('closeMenuBtn');

        function toggleSidebar() {
            const sidebar = document.getElementById('adminSidebar');
            const overlay = document.getElementById('sidebarOverlay');
            
            if (sidebar) {
                if (sidebar.classList.contains('open')) {
                    sidebar.classList.remove('open');
                    if (overlay) overlay.classList.remove('show');
                    document.body.style.overflow = '';
                } else {
                    sidebar.classList.add('open');
                    if (overlay) overlay.classList.add('show');
                    document.body.style.overflow = 'hidden';
                }
            }
        }

        if (mobileMenuBtn) {
            mobileMenuBtn.addEventListener('click', toggleSidebar);
        }

        if (closeMenuBtn) {
            closeMenuBtn.addEventListener('click', function() {
                const sidebar = document.getElementById('adminSidebar');
                const overlay = document.getElementById('sidebarOverlay');
                
                if (sidebar) {
                    sidebar.classList.remove('open');
                    if (overlay) overlay.classList.remove('show');
                    document.body.style.overflow = '';
                }
            });
        }

        // ===== CLOSE DROPDOWNS ON ESCAPE =====
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                if (profileMenu) profileMenu.classList.remove('show');
                if (notificationMenu) notificationMenu.style.display = 'none';
            }
        });
    });
</script>