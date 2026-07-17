@extends('admin.layouts.master')
@section('title', 'Platforms')
@section('admin_content')

<div class="max-w-6xl mx-auto px-4 py-8">

    <div class="flex items-center justify-between mb-6 flex-wrap gap-3">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Platforms</h1>
            <p class="text-sm text-gray-500 mt-1">Manage the partner platforms shown on the public site.</p>
        </div>
        <a href="{{ route('admin.platforms.create') }}"
           class="inline-flex items-center gap-2 bg-[#2A4563] text-white text-sm font-semibold px-4 py-2.5 rounded-xl hover:bg-[#223a54] transition-colors shadow-lg shadow-[#2A4563]/20">
            <i class="fa-solid fa-plus"></i>
            Add Platform
        </a>
    </div>

    @if(session('success'))
        <div id="successAlert" class="flex items-center gap-2 bg-green-50 border border-green-200 text-green-700 text-sm px-4 py-3 rounded-xl mb-6">
            <i class="fa-solid fa-circle-check"></i>
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white border border-gray-200 rounded-2xl shadow-sm overflow-hidden">
        @if($platforms->count())
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="bg-gray-50 border-b border-gray-200 text-left text-xs font-semibold uppercase tracking-wide text-gray-400">
                            <th class="px-5 py-3 w-16">Logo</th>
                            <th class="px-5 py-3">Platform</th>
                            <th class="px-5 py-3 w-28">Status</th>
                            <th class="px-5 py-3 w-20">Order</th>
                            <th class="px-5 py-3 w-32 text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @foreach($platforms as $platform)
                            <tr class="hover:bg-gray-50/60 transition-colors">
                                <td class="px-5 py-4">
                                    <div class="w-11 h-11 rounded-lg bg-[#2A4563]/10 flex items-center justify-center overflow-hidden">
                                        @if($platform->logo)
                                            <img src="{{ asset($platform->logo) }}" alt="{{ $platform->name }}" class="w-full h-full object-cover">
                                        @else
                                            <i class="fa-solid fa-cubes text-[#2A4563]"></i>
                                        @endif
                                    </div>
                                </td>
                                <td class="px-5 py-4">
                                    <p class="font-semibold text-gray-800">{{ $platform->name }}</p>
                                    <p class="text-gray-500 text-xs mt-0.5 max-w-md truncate">{{ $platform->description }}</p>
                                </td>
                                <td class="px-5 py-4">
                                    @if($platform->status)
                                        <span class="text-xs font-semibold px-2.5 py-1 rounded-full bg-green-50 text-green-600">Online</span>
                                    @else
                                        <span class="text-xs font-semibold px-2.5 py-1 rounded-full bg-gray-100 text-gray-500">Offline</span>
                                    @endif
                                </td>
                                <td class="px-5 py-4 text-gray-500">{{ $platform->sort_order }}</td>
                                <td class="px-5 py-4">
                                    <div class="flex items-center justify-end gap-1">
                                        <a href="{{ route('admin.platforms.edit', $platform->id) }}"
                                           class="w-9 h-9 flex items-center justify-center rounded-lg text-gray-400 hover:text-[#2A4563] hover:bg-gray-100 transition-colors"
                                           title="Edit">
                                            <i class="fa-solid fa-pen"></i>
                                        </a>
                                        <button type="button"
                                                class="delete-trigger w-9 h-9 flex items-center justify-center rounded-lg text-gray-400 hover:text-red-600 hover:bg-red-50 transition-colors"
                                                title="Delete"
                                                data-action="{{ route('admin.platforms.destroy', $platform->id) }}"
                                                data-name="{{ $platform->name }}">
                                            <i class="fa-solid fa-trash-can"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="text-center py-20">
                <div class="w-14 h-14 mx-auto rounded-full bg-gray-100 flex items-center justify-center mb-4">
                    <i class="fa-solid fa-cubes text-gray-400 text-xl"></i>
                </div>
                <h3 class="text-gray-700 font-semibold">No platforms yet</h3>
                <p class="text-sm text-gray-400 mt-1 mb-5">Add your first partner platform to get started.</p>
                <a href="{{ route('admin.platforms.create') }}"
                   class="inline-flex items-center gap-2 bg-[#2A4563] text-white text-sm font-semibold px-4 py-2.5 rounded-xl hover:bg-[#223a54] transition-colors">
                    <i class="fa-solid fa-plus"></i>
                    Add Platform
                </a>
            </div>
        @endif
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

        <h3 class="text-lg font-bold text-gray-800">Delete platform?</h3>
        <p class="text-sm text-gray-500 mt-2 leading-relaxed">
            You're about to permanently delete
            <span id="deleteModalName" class="font-semibold text-gray-700">this platform</span>.
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
    const successAlert = document.getElementById('successAlert');
    if (successAlert) {
        setTimeout(() => {
            successAlert.style.overflow = 'hidden';
            successAlert.style.transition = 'opacity .3s ease, max-height .3s ease .2s, margin .3s ease .2s, padding .3s ease .2s';
            successAlert.style.maxHeight = successAlert.offsetHeight + 'px';
            successAlert.style.opacity = '0';
            requestAnimationFrame(() => {
                successAlert.style.maxHeight = '0px';
                successAlert.style.marginBottom = '0px';
                successAlert.style.paddingTop = '0px';
                successAlert.style.paddingBottom = '0px';
            });
            setTimeout(() => successAlert.remove(), 550);
        }, 3000);
    }

    const overlay   = document.getElementById('deleteModalOverlay');
    const panel     = document.getElementById('deleteModalPanel');
    const backdrop  = document.getElementById('deleteModalBackdrop');
    const nameLabel = document.getElementById('deleteModalName');
    const cancelBtn = document.getElementById('deleteModalCancel');
    const confirmBtn = document.getElementById('deleteModalConfirm');
    const deleteForm = document.getElementById('deleteForm');

    const openModal = (action, name) => {
        deleteForm.setAttribute('action', action);
        nameLabel.textContent = name;
        overlay.classList.remove('hidden');
        overlay.classList.add('flex');
        document.body.style.overflow = 'hidden';
        requestAnimationFrame(() => {
            panel.classList.remove('scale-95', 'opacity-0');
            panel.classList.add('scale-100', 'opacity-100');
        });
    };

    const closeModal = () => {
        panel.classList.remove('scale-100', 'opacity-100');
        panel.classList.add('scale-95', 'opacity-0');
        document.body.style.overflow = '';
        setTimeout(() => {
            overlay.classList.add('hidden');
            overlay.classList.remove('flex');
        }, 180);
    };

    document.querySelectorAll('.delete-trigger').forEach(btn => {
        btn.addEventListener('click', () => openModal(btn.dataset.action, btn.dataset.name));
    });
    cancelBtn.addEventListener('click', closeModal);
    backdrop.addEventListener('click', closeModal);
    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape' && !overlay.classList.contains('hidden')) closeModal();
    });
    confirmBtn.addEventListener('click', () => {
        confirmBtn.disabled = true;
        confirmBtn.innerHTML = '<i class="fa-solid fa-spinner fa-spin"></i>';
        deleteForm.submit();
    });
</script>
@endsection