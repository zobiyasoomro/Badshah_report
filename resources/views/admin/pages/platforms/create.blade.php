@extends('admin.layouts.master')
@section('title', 'Add Platform')
@section('admin_content')

<div class="max-w-2xl mx-auto px-4 py-8">
    <div class="flex items-center gap-3 mb-6">
        <a href="{{ route('admin.platforms') }}" class="w-9 h-9 flex items-center justify-center rounded-lg text-gray-400 hover:text-[#2A4563] hover:bg-gray-100 transition-colors">
            <i class="fa-solid fa-arrow-left"></i>
        </a>
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Add Platform</h1>
            <p class="text-sm text-gray-500 mt-1">Create a new partner platform entry.</p>
        </div>
    </div>

    <div class="bg-white border border-gray-200 rounded-2xl shadow-sm p-6 sm:p-8">
        <form action="{{ route('admin.platforms.store') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
            @csrf

            <div>
                <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wide mb-1.5">Platform Name</label>
                <input type="text" name="name" value="{{ old('name') }}" required class="w-full px-3.5 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2A4563]/30 focus:border-[#2A4563]">
            </div>

            <div>
                <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wide mb-1.5">Subtitle (Max 30 words)</label>
                <textarea name="subtitle" id="subtitle" rows="2" class="w-full px-3.5 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2A4563]/30 focus:border-[#2A4563]">{{ old('subtitle') }}</textarea>
                <p id="wordCount" class="text-xs text-gray-400 mt-1">0 / 30 words</p>
            </div>

            <div>
                <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wide mb-1.5">Description</label>
                <textarea name="description" rows="4" required class="w-full px-3.5 py-2.5 border border-gray-200 rounded-xl text-sm resize-y focus:outline-none focus:ring-2 focus:ring-[#2A4563]/30 focus:border-[#2A4563]">{{ old('description') }}</textarea>
            </div>

            <div>
                <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wide mb-1.5">Logo</label>
                <input type="file" name="logo" accept="image/*" class="w-full text-sm text-gray-600 border border-gray-200 rounded-xl px-3.5 py-2.5 file:mr-3 file:py-1.5 file:px-3 file:rounded-lg file:border-0 file:bg-[#2A4563]/10 file:text-[#2A4563] file:text-xs file:font-semibold">
            </div>

            <div>
                <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wide mb-1.5">Join Now URL</label>
                <input type="url" name="join_url" value="{{ old('join_url') }}" class="w-full px-3.5 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2A4563]/30">
            </div>

            <div>
                <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wide mb-1.5">Status</label>
                <select name="status" class="w-full px-3.5 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2A4563]/30">
                    <option value="1">Online</option>
                    <option value="0">Offline</option>
                </select>
            </div>

            <div class="flex items-center gap-3 pt-3">
                <a href="{{ route('admin.platforms') }}" class="flex-1 text-center px-4 py-2.5 rounded-xl border border-gray-200 text-gray-600 font-medium text-sm hover:bg-gray-50 transition-colors">Cancel</a>
                <button type="submit" class="flex-1 px-4 py-2.5 rounded-xl bg-[#2A4563] text-white font-semibold text-sm hover:bg-[#223a54] transition-colors">Save Platform</button>
            </div>
        </form>
    </div>
</div>

<script>
    const subtitle = document.getElementById('subtitle');
    const wordCount = document.getElementById('wordCount');
    subtitle.addEventListener('input', () => {
        let words = subtitle.value.trim().split(/\s+/).filter(w => w.length > 0);
        if (words.length > 30) {
            subtitle.value = words.slice(0, 30).join(" ");
            words = words.slice(0, 30);
        }
        wordCount.textContent = `${words.length} / 30 words`;
    });
</script>
@endsection