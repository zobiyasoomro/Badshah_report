@extends('admin.layouts.master')
@section('title', 'Edit Platform')
@section('admin_content')

<div class="container-fluid py-4">
    <div class="row align-items-center mb-4">
        <div class="col-auto">
            <a href="{{ route('admin.platforms') }}" class="btn btn-link text-secondary text-decoration-none rounded-3 p-2" style="width: 36px; height: 36px;">
                <i class="fa-solid fa-arrow-left"></i>
            </a>
        </div>
        <div class="col">
            <h1 class="h2 fw-bold text-dark mb-1">Edit Platform</h1>
            <p class="text-muted small mt-1">Update details for {{ $platform->name }}.</p>
        </div>
    </div>

    <div class="card border-0 shadow-sm rounded-4">
        <div class="card-body p-4 p-sm-5">
            <form action="{{ route('admin.platforms.update', $platform->id) }}" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate>
                @csrf
                
                <div class="mb-4">
                    <label class="form-label text-uppercase fw-semibold small text-secondary">Platform Name</label>
                    <input type="text" name="name" value="{{ old('name', $platform->name) }}" required 
                           class="form-control form-control-lg rounded-3 border-secondary" 
                           style="border-color: #e5e7eb; padding: 0.625rem 1rem;">
                    <div class="invalid-feedback">Please enter a platform name.</div>
                </div>

                <div class="mb-4">
                    <label class="form-label text-uppercase fw-semibold small text-secondary">Subtitle (Max 30 words)</label>
                    <textarea name="subtitle" id="subtitle" rows="2" 
                              class="form-control rounded-3 border-secondary" 
                              style="border-color: #e5e7eb; padding: 0.625rem 1rem; resize: vertical;">{{ old('subtitle', $platform->subtitle) }}</textarea>
                    <p id="wordCount" class="text-muted small mt-1">0 / 30 words</p>
                </div>

                <div class="mb-4">
                    <label class="form-label text-uppercase fw-semibold small text-secondary">Description</label>
                    <textarea name="description" rows="4" required 
                              class="form-control rounded-3 border-secondary" 
                              style="border-color: #e5e7eb; padding: 0.625rem 1rem; resize: vertical;">{{ old('description', $platform->description) }}</textarea>
                    <div class="invalid-feedback">Please enter a description.</div>
                </div>

                <div class="mb-4">
                    <label class="form-label text-uppercase fw-semibold small text-secondary">Logo</label>
                    @if($platform->logo)
                        <div class="mb-3">
                            <img src="{{ asset($platform->logo) }}" class="rounded-3 object-fit-cover" style="width: 56px; height: 56px;">
                        </div>
                    @endif
                    <input type="file" name="logo" accept="image/*" 
                           class="form-control rounded-3 border-secondary" 
                           style="border-color: #e5e7eb; padding: 0.625rem 1rem;">
                </div>

                <div class="row g-3 mb-4">
                    <div class="col-md-6">
                        <label class="form-label text-uppercase fw-semibold small text-secondary">Learn More URL</label>
                        <input type="url" name="website_url" value="{{ old('website_url', $platform->website_url) }}" 
                               class="form-control rounded-3 border-secondary" 
                               style="border-color: #e5e7eb; padding: 0.625rem 1rem;">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label text-uppercase fw-semibold small text-secondary">Join Now URL</label>
                        <input type="url" name="join_url" value="{{ old('join_url', $platform->join_url) }}" 
                               class="form-control rounded-3 border-secondary" 
                               style="border-color: #e5e7eb; padding: 0.625rem 1rem;">
                    </div>
                </div>

                <div class="row g-3 mb-4">
                    <div class="col-6">
                        <label class="form-label text-uppercase fw-semibold small text-secondary">Status</label>
                        <select name="status" class="form-select rounded-3 border-secondary" style="border-color: #e5e7eb; padding: 0.625rem 1rem;">
                            <option value="1" {{ $platform->status ? 'selected' : '' }}>Online</option>
                            <option value="0" {{ !$platform->status ? 'selected' : '' }}>Offline</option>
                        </select>
                    </div>
                    <div class="col-6">
                        <label class="form-label text-uppercase fw-semibold small text-secondary">Display Order</label>
                        <input type="number" name="sort_order" value="{{ old('sort_order', $platform->sort_order) }}" 
                               class="form-control rounded-3 border-secondary" 
                               style="border-color: #e5e7eb; padding: 0.625rem 1rem;">
                    </div>
                </div>

                <div class="d-flex gap-3 pt-3">
                    <a href="{{ route('admin.platforms') }}" 
                       class="btn btn-light flex-fill py-2 rounded-3 fw-medium border-secondary" 
                       style="border-color: #e5e7eb;">Cancel</a>
                    <button type="submit" 
                            class="btn btn-primary flex-fill py-2 rounded-3 fw-semibold" 
                            style="background-color: #2A4563; border-color: #2A4563;">Update Platform</button>
                </div>
            </form>
        </div>
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

    // Bootstrap validation
    (function() {
        'use strict';
        const forms = document.querySelectorAll('.needs-validation');
        Array.from(forms).forEach(form => {
            form.addEventListener('submit', event => {
                if (!form.checkValidity()) {
                    event.preventDefault();
                    event.stopPropagation();
                }
                form.classList.add('was-validated');
            }, false);
        });
    })();
</script>
@endsection