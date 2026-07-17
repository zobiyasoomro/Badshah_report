@extends('admin.layouts.master')
@section('title', 'Contact Messages')
@section('admin_content')

<div class="max-w-5xl mx-auto px-4 py-8">

    <div class="flex items-center justify-between mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Contact Messages</h1>
            <p class="text-sm text-gray-500 mt-1">Messages submitted through the public contact form.</p>
        </div>
        <span class="inline-flex items-center gap-2 bg-[#2A4563]/10 text-[#2A4563] text-xs font-semibold px-3 py-1.5 rounded-full">
            <i class="fa-solid fa-envelope"></i>
            {{ $contacts->count() }} {{ Str::plural('message', $contacts->count()) }}
        </span>
    </div>

    @if(session('success'))
        <div id="successAlert" class="flex items-center gap-2 bg-green-50 border border-green-200 text-green-700 text-sm px-4 py-3 rounded-xl mb-6">
            <i class="fa-solid fa-circle-check"></i>
            {{ session('success') }}
        </div>
    @endif

    @forelse($contacts as $contact)
        <div class="w-full bg-white border border-gray-200 rounded-2xl shadow-sm hover:shadow-md transition-shadow mb-4 overflow-hidden">
            <div class="p-6">
                <div class="flex items-start justify-between gap-4 flex-wrap">
                    <div class="flex items-start gap-4">
                        <div class="w-11 h-11 rounded-full bg-[#2A4563] text-white flex items-center justify-center font-bold text-sm shrink-0">
                            {{ strtoupper(substr($contact->name, 0, 1)) }}
                        </div>
                        <div>
                            <h3 class="text-base font-semibold text-gray-800">{{ $contact->name }}</h3>
                            <a href="mailto:{{ $contact->email }}" class="text-sm text-[#2A4563] hover:underline">
                                {{ $contact->email }}
                            </a>
                        </div>
                    </div>

                    <div class="flex items-center gap-3">
                        <span class="text-xs text-gray-400 whitespace-nowrap">
                            <i class="fa-regular fa-clock mr-1"></i>{{ $contact->created_at->diffForHumans() }}
                        </span>

                        <button type="button"
                                class="delete-trigger w-9 h-9 flex items-center justify-center rounded-lg text-gray-400 hover:text-red-600 hover:bg-red-50 transition-colors"
                                title="Delete message"
                                data-action="{{ route('admin.contact.destroy', $contact->id) }}"
                                data-name="{{ $contact->name }}">
                            <i class="fa-solid fa-trash-can"></i>
                        </button>
                    </div>
                </div>

                <div class="mt-4 pl-15">
                    <span class="inline-block text-xs font-semibold uppercase tracking-wide text-gray-400 mb-1">Subject</span>
                    <p class="text-sm font-medium text-gray-700 mb-3">{{ $contact->subject }}</p>

                    <span class="inline-block text-xs font-semibold uppercase tracking-wide text-gray-400 mb-1">Message</span>
                    <p class="text-sm text-gray-600 leading-relaxed whitespace-pre-line">{{ $contact->description }}</p>
                </div>
            </div>
        </div>
    @empty
        <div class="text-center py-20 bg-white border border-dashed border-gray-300 rounded-2xl">
            <div class="w-14 h-14 mx-auto rounded-full bg-gray-100 flex items-center justify-center mb-4">
                <i class="fa-solid fa-inbox text-gray-400 text-xl"></i>
            </div>
            <h3 class="text-gray-700 font-semibold">No messages yet</h3>
            <p class="text-sm text-gray-400 mt-1">Submissions from the public contact form will appear here.</p>
        </div>
    @endforelse

</div>

{{-- ===================== Delete Confirmation Modal ===================== --}}
<div id="deleteModalOverlay" class="fixed inset-0 z-50 hidden items-center justify-center p-4">
    <div id="deleteModalBackdrop" class="absolute inset-0 bg-gray-900/60 backdrop-blur-sm"></div>

    <div id="deleteModalPanel"
         class="relative bg-white w-full max-w-sm rounded-2xl shadow-2xl p-6 text-center scale-95 opacity-0 transition-all duration-200">

        <div class="w-16 h-16 mx-auto rounded-full bg-red-50 flex items-center justify-center mb-4">
            <i class="fa-solid fa-trash-can text-red-500 text-2xl"></i>
        </div>

        <h3 class="text-lg font-bold text-gray-800">Delete message?</h3>
        <p class="text-sm text-gray-500 mt-2 leading-relaxed">
            You're about to delete the message from
            <span id="deleteModalName" class="font-semibold text-gray-700">this contact</span>.
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
            successAlert.style.transition = 'opacity .4s';
            successAlert.style.opacity = '0';
        }, 3000);
    }

    // ---------- Delete confirmation modal ----------
    const overlay      = document.getElementById('deleteModalOverlay');
    const panel        = document.getElementById('deleteModalPanel');
    const backdrop      = document.getElementById('deleteModalBackdrop');
    const nameLabel     = document.getElementById('deleteModalName');
    const cancelBtn     = document.getElementById('deleteModalCancel');
    const confirmBtn    = document.getElementById('deleteModalConfirm');
    const deleteForm    = document.getElementById('deleteForm');

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
        btn.addEventListener('click', () => {
            openModal(btn.dataset.action, btn.dataset.name);
        });
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