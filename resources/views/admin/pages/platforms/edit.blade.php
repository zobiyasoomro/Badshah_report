@extends('admin.layouts.master')
@section('title', 'Edit Platform')
@section('admin_content')

<div class="max-w-2xl mx-auto px-4 py-8">
    <div class="flex items-center gap-3 mb-6">
        <a href="{{ route('admin.platforms') }}" class="w-9 h-9 flex items-center justify-center rounded-lg text-gray-400 hover:text-[#2A4563] hover:bg-gray-100 transition-colors">
            <i class="fa-solid fa-arrow-left"></i>
        </a>
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Edit Platform</h1>
            <p class="text-sm text-gray-500 mt-1">Update details for {{ $platform->name }}.</p>
        </div>
    </div>

    <div class="bg-white border border-gray-200 rounded-2xl shadow-sm p-6 sm:p-8">
        <form action="{{ route('admin.platforms.update', $platform->id) }}" method="POST" enctype="multipart/form-data" class="space-y-5">
            @csrf
            <div>
                <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wide mb-1.5">Platform Name</label>
                <input type="text" name="name" value="{{ old('name', $platform->name) }}" required class="w-full px-3.5 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2A4563]/30 focus:border-[#2A4563]">
            </div>

            <div>
                <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wide mb-1.5">Subtitle (Max 30 words)</label>
                <textarea name="subtitle" id="subtitle" rows="2" class="w-full px-3.5 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2A4563]/30">{{ old('subtitle', $platform->subtitle) }}</textarea>
                <p id="wordCount" class="text-xs text-gray-400 mt-1">0 / 30 words</p>
            </div>

            <div>
                <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wide mb-1.5">Description</label>
                <textarea name="description" rows="4" required class="w-full px-3.5 py-2.5 border border-gray-200 rounded-xl text-sm resize-y focus:outline-none focus:ring-2 focus:ring-[#2A4563]/30">{{ old('description', $platform->description) }}</textarea>
            </div>

            <div>
                <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wide mb-1.5">Logo</label>
                @if($platform->logo)
                    <div class="mb-3"><img src="{{ asset($platform->logo) }}" class="w-14 h-14 rounded-lg object-cover"></div>
                @endif
                <input type="file" name="logo" accept="image/*" class="w-full text-sm text-gray-600 border border-gray-200 rounded-xl px-3.5 py-2.5">
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wide mb-1.5">Learn More URL</label>
                    <input type="url" name="website_url" value="{{ old('website_url', $platform->website_url) }}" class="w-full px-3.5 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none">
                </div>
                <div>
                    <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wide mb-1.5">Join Now URL</label>
                    <input type="url" name="join_url" value="{{ old('join_url', $platform->join_url) }}" class="w-full px-3.5 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none">
                </div>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wide mb-1.5">Status</label>
                    <select name="status" class="w-full px-3.5 py-2.5 border border-gray-200 rounded-xl text-sm">
                        <option value="1" {{ $platform->status ? 'selected' : '' }}>Online</option>
                        <option value="0" {{ !$platform->status ? 'selected' : '' }}>Offline</option>
                    </select>
                </div>
                <div>
                    <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wide mb-1.5">Display Order</label>
                    <input type="number" name="sort_order" value="{{ old('sort_order', $platform->sort_order) }}" class="w-full px-3.5 py-2.5 border border-gray-200 rounded-xl text-sm">
                </div>
            </div>

            <div class="flex items-center gap-3 pt-3">
                <a href="{{ route('admin.platforms') }}" class="flex-1 text-center px-4 py-2.5 rounded-xl border border-gray-200 text-gray-600 font-medium text-sm hover:bg-gray-50 transition-colors">Cancel</a>
                <button type="submit" class="flex-1 px-4 py-2.5 rounded-xl bg-[#2A4563] text-white font-semibold text-sm hover:bg-[#223a54] transition-colors">Update Platform</button>
            </div>
        </form>
    </div>
</div>

<script>
    const subtitle = document.getElementById('subtitle');
    const wordCount = document.getElementById('wordCount');
    const updateCount = () => {
        let words = subtitle.value.trim().split(/\s+/).filter(w => w.length > 0);
        wordCount.textContent = `${words.length} / 30 words`;
    };
    subtitle.addEventListener('input', () => {
        let words = subtitle.value.trim().split(/\s+/).filter(w => w.length > 0);
        if (words.length > 30) {
            subtitle.value = words.slice(0, 30).join(" ");
            words = words.slice(0, 30);
        }
        updateCount();
    });
    updateCount();
</script>
@endsection