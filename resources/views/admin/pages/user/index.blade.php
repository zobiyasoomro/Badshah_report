@extends('admin.layouts.master')
@section('title', 'User Accounts')
@section('admin_content')

<div class="max-w-5xl mx-auto px-4 py-8">

    <div class="flex items-center justify-between mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">User Accounts</h1>
            <p class="text-sm text-gray-500 mt-1">All users registered on the platform.</p>
        </div>
        <span class="inline-flex items-center gap-2 bg-[#2A4563]/10 text-[#2A4563] text-xs font-semibold px-3 py-1.5 rounded-full">
            <i class="fa-solid fa-users"></i>
            {{ $users->count() }} {{ Str::plural('user', $users->count()) }}
        </span>
    </div>

    @if(session('success'))
        <div id="successAlert" class="flex items-center gap-2 bg-green-50 border border-green-200 text-green-700 text-sm px-4 py-3 rounded-xl mb-6">
            <i class="fa-solid fa-circle-check"></i>
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div id="errorAlert" class="flex items-center gap-2 bg-red-50 border border-red-200 text-red-700 text-sm px-4 py-3 rounded-xl mb-6">
            <i class="fa-solid fa-circle-exclamation"></i>
            {{ session('error') }}
        </div>
    @endif

    @forelse($users as $user)
        <div class="w-full bg-white border border-gray-200 rounded-2xl shadow-sm hover:shadow-md transition-shadow mb-4 overflow-hidden">
            <div class="p-6">
                <div class="flex items-start justify-between gap-4 flex-wrap">
                    <div class="flex items-start gap-4">
                        <div class="w-11 h-11 rounded-full bg-[#2A4563] text-white flex items-center justify-center font-bold text-sm shrink-0 overflow-hidden">
                            @if(!empty($user->image))
                                <img src="{{ asset($user->image) }}" alt="{{ $user->name }}" class="w-full h-full object-cover">
                            @else
                                {{ strtoupper(substr($user->name, 0, 1)) }}
                            @endif
                        </div>
                        <div>
                            <h3 class="text-base font-semibold text-gray-800">{{ $user->name }}</h3>
                            <p class="text-xs text-gray-400">&#64;{{ $user->user_name }}</p>
                            @if($user->email)
                                <a href="mailto:{{ $user->email }}" class="text-sm text-[#2A4563] hover:underline">
                                    {{ $user->email }}
                                </a>
                            @else
                                <span class="text-sm text-gray-400 italic">No email on file</span>
                            @endif
                        </div>
                    </div>

                    <div class="flex items-center gap-2">
                        @if($user->register_account)
                            <span class="text-xs font-semibold px-2.5 py-1 rounded-full bg-green-50 text-green-600">Active</span>
                        @else
                            <span class="text-xs font-semibold px-2.5 py-1 rounded-full bg-gray-100 text-gray-500">Inactive</span>
                        @endif

                        <button type="button"
                                class="password-trigger w-9 h-9 flex items-center justify-center rounded-lg text-gray-400 hover:text-[#2A4563] hover:bg-gray-100 transition-colors"
                                title="Update password"
                                data-action="{{ route('admin.user.password', $user->id) }}"
                                data-name="{{ $user->name }}">
                            <i class="fa-solid fa-key"></i>
                        </button>

                        <button type="button"
                                class="delete-trigger w-9 h-9 flex items-center justify-center rounded-lg text-gray-400 hover:text-red-600 hover:bg-red-50 transition-colors"
                                title="Delete user"
                                data-action="{{ route('admin.user.destroy', $user->id) }}"
                                data-name="{{ $user->name }}">
                            <i class="fa-solid fa-trash-can"></i>
                        </button>
                    </div>
                </div>

                <div class="mt-4 pl-15 grid grid-cols-2 sm:grid-cols-3 gap-y-2 gap-x-6 text-sm">
                    <div>
                        <span class="block text-xs font-semibold uppercase tracking-wide text-gray-400">WhatsApp</span>
                        <span class="text-gray-700">{{ $user->whatsapp_number ?: '—' }}</span>
                    </div>
                    <div>
                        <span class="block text-xs font-semibold uppercase tracking-wide text-gray-400">City</span>
                        <span class="text-gray-700">{{ $user->city ?: '—' }}</span>
                    </div>
                    <div>
                        <span class="block text-xs font-semibold uppercase tracking-wide text-gray-400">Joined</span>
                        <span class="text-gray-700">{{ $user->created_at->format('d M Y') }}</span>
                    </div>
                </div>
            </div>
        </div>
    @empty
        <div class="text-center py-20 bg-white border border-dashed border-gray-300 rounded-2xl">
            <div class="w-14 h-14 mx-auto rounded-full bg-gray-100 flex items-center justify-center mb-4">
                <i class="fa-solid fa-users text-gray-400 text-xl"></i>
            </div>
            <h3 class="text-gray-700 font-semibold">No users yet</h3>
            <p class="text-sm text-gray-400 mt-1">Registered users will appear here.</p>
        </div>
    @endforelse

</div>

{{-- ===================== Update Password Modal ===================== --}}
<div id="passwordModalOverlay" class="fixed inset-0 z-50 hidden items-center justify-center p-4">
    <div id="passwordModalBackdrop" class="absolute inset-0 bg-gray-900/60 backdrop-blur-sm"></div>

    <div id="passwordModalPanel"
         class="relative bg-white w-full max-w-sm rounded-2xl shadow-2xl p-6 scale-95 opacity-0 transition-all duration-200">

        <div class="w-16 h-16 mx-auto rounded-full bg-[#2A4563]/10 flex items-center justify-center mb-4">
            <i class="fa-solid fa-key text-[#2A4563] text-2xl"></i>
        </div>

        <h3 class="text-lg font-bold text-gray-800 text-center">Update password</h3>
        <p class="text-sm text-gray-500 mt-1 text-center">
            Set a new password for <span id="passwordModalName" class="font-semibold text-gray-700">this user</span>.
        </p>

        <form id="passwordForm" method="POST" class="mt-5 space-y-3">
            @csrf
            @method('PUT')

            <div>
                <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wide mb-1">New password</label>
                <input type="password" name="password" id="passwordInput" required minlength="6"
                       class="w-full px-3.5 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2A4563]/30 focus:border-[#2A4563]">
            </div>

            <div>
                <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wide mb-1">Confirm password</label>
                <input type="password" name="password_confirmation" required minlength="6"
                       class="w-full px-3.5 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2A4563]/30 focus:border-[#2A4563]">
            </div>

            <p id="passwordMismatch" class="hidden text-xs text-red-500">Passwords don't match.</p>

            <div class="flex items-center gap-3 pt-2">
                <button type="button" id="passwordModalCancel"
                        class="flex-1 px-4 py-2.5 rounded-xl border border-gray-200 text-gray-600 font-medium text-sm hover:bg-gray-50 transition-colors">
                    Cancel
                </button>
                <button type="submit" id="passwordModalConfirm"
                        class="flex-1 px-4 py-2.5 rounded-xl bg-[#2A4563] text-white font-medium text-sm hover:bg-[#223a54] transition-colors shadow-lg shadow-[#2A4563]/25">
                    Update
                </button>
            </div>
        </form>
    </div>
</div>

{{-- ===================== Delete Confirmation Modal ===================== --}}
<div id="deleteModalOverlay" class="fixed inset-0 z-50 hidden items-center justify-center p-4">
    <div id="deleteModalBackdrop" class="absolute inset-0 bg-gray-900/60 backdrop-blur-sm"></div>

    <div id="deleteModalPanel"
         class="relative bg-white w-full max-w-sm rounded-2xl shadow-2xl p-6 text-center scale-95 opacity-0 transition-all duration-200">

        <div class="w-16 h-16 mx-auto rounded-full bg-red-50 flex items-center justify-center mb-4">
            <i class="fa-solid fa-trash-can text-red-500 text-2xl"></i>
        </div>

        <h3 class="text-lg font-bold text-gray-800">Delete user?</h3>
        <p class="text-sm text-gray-500 mt-2 leading-relaxed">
            You're about to permanently delete
            <span id="deleteModalName" class="font-semibold text-gray-700">this user</span>.
            This action can't be undone.
        </p>

        <div class="flex items-center gap-3 mt-6">
            <button type="button" id="deleteModalCancel"
                    class="flex-1 px-4 py-2.5 rounded-xl border border-gray-200 text-gray-600 font-medium text-sm hover:bg-gray-50 transition-colors">
                Cancel
            </button>
            <button type="button" id="deleteModalConfirm"
                    class="flex-1 px-4 py-2.5 rounded-xl bg-red-500 text-white font-medium text-sm hover:bg-red-600 transition-colors shadow-lg shadow-red-500/25">
                Delete
            </button>
        </div>
    </div>
</div>

<form id="deleteForm" method="POST" class="hidden">
    @csrf
    @method('DELETE')
</form>

<script>
    ['successAlert', 'errorAlert'].forEach(id => {
        const el = document.getElementById(id);
        if (el) {
            setTimeout(() => {
                el.style.transition = 'opacity .4s';
                el.style.opacity = '0';
            }, 3000);
        }
    });

    // ---------- shared modal open/close helper ----------
    const setupModal = (overlayId, panelId) => {
        const overlay = document.getElementById(overlayId);
        const panel = document.getElementById(panelId);

        const open = () => {
            overlay.classList.remove('hidden');
            overlay.classList.add('flex');
            document.body.style.overflow = 'hidden';
            requestAnimationFrame(() => {
                panel.classList.remove('scale-95', 'opacity-0');
                panel.classList.add('scale-100', 'opacity-100');
            });
        };

        const close = () => {
            panel.classList.remove('scale-100', 'opacity-100');
            panel.classList.add('scale-95', 'opacity-0');
            document.body.style.overflow = '';
            setTimeout(() => {
                overlay.classList.add('hidden');
                overlay.classList.remove('flex');
            }, 180);
        };

        return { overlay, panel, open, close };
    };

    // ---------- Delete modal ----------
    const del = setupModal('deleteModalOverlay', 'deleteModalPanel');
    const deleteForm = document.getElementById('deleteForm');
    const deleteNameLabel = document.getElementById('deleteModalName');
    const deleteConfirmBtn = document.getElementById('deleteModalConfirm');

    document.querySelectorAll('.delete-trigger').forEach(btn => {
        btn.addEventListener('click', () => {
            deleteForm.setAttribute('action', btn.dataset.action);
            deleteNameLabel.textContent = btn.dataset.name;
            del.open();
        });
    });
    document.getElementById('deleteModalCancel').addEventListener('click', del.close);
    document.getElementById('deleteModalBackdrop').addEventListener('click', del.close);
    deleteConfirmBtn.addEventListener('click', () => {
        deleteConfirmBtn.disabled = true;
        deleteConfirmBtn.innerHTML = '<i class="fa-solid fa-spinner fa-spin"></i>';
        deleteForm.submit();
    });

    // ---------- Password modal ----------
    const pwd = setupModal('passwordModalOverlay', 'passwordModalPanel');
    const passwordForm = document.getElementById('passwordForm');
    const passwordNameLabel = document.getElementById('passwordModalName');
    const passwordInput = document.getElementById('passwordInput');
    const passwordMismatch = document.getElementById('passwordMismatch');

    document.querySelectorAll('.password-trigger').forEach(btn => {
        btn.addEventListener('click', () => {
            passwordForm.setAttribute('action', btn.dataset.action);
            passwordNameLabel.textContent = btn.dataset.name;
            passwordForm.reset();
            passwordMismatch.classList.add('hidden');
            pwd.open();
            setTimeout(() => passwordInput.focus(), 200);
        });
    });
    document.getElementById('passwordModalCancel').addEventListener('click', pwd.close);
    document.getElementById('passwordModalBackdrop').addEventListener('click', pwd.close);

    passwordForm.addEventListener('submit', (e) => {
        const pass = passwordForm.password.value;
        const confirm = passwordForm.password_confirmation.value;
        if (pass !== confirm) {
            e.preventDefault();
            passwordMismatch.classList.remove('hidden');
        }
    });

    // ---------- Escape key closes whichever modal is open ----------
    document.addEventListener('keydown', (e) => {
        if (e.key !== 'Escape') return;
        if (!del.overlay.classList.contains('hidden')) del.close();
        if (!pwd.overlay.classList.contains('hidden')) pwd.close();
    });
</script>
@endsection