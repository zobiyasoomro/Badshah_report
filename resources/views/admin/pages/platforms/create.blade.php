@extends('admin.layouts.master')
@section('title', 'Add Platform')
@section('admin_content')

<div class="container-fluid py-4">
    <div class="row align-items-center mb-4">
        <div class="col-auto">
            <a href="{{ route('admin.platforms') }}" class="btn btn-link text-secondary text-decoration-none rounded-3 p-2" style="width: 36px; height: 36px;">
                <i class="fa-solid fa-arrow-left"></i>
            </a>
        </div>
        <div class="col">
            <h1 class="h2 fw-bold text-dark mb-1">Add Platform</h1>
            <p class="text-muted small mt-1">Create a new partner platform entry.</p>
        </div>
    </div>

    <div class="card border-0 shadow-sm rounded-4">
        <div class="card-body p-4 p-sm-5">
            <form action="{{ route('admin.platforms.store') }}" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate>
                @csrf

                <div class="mb-4">
                    <label class="form-label text-uppercase fw-semibold small text-secondary">Platform Name</label>
                    <input type="text" name="name" value="{{ old('name') }}" required 
                           class="form-control form-control-lg rounded-3 border-secondary" 
                           style="border-color: #e5e7eb; padding: 0.625rem 1rem;">
                    <div class="invalid-feedback">Please enter a platform name.</div>
                </div>

                <div class="mb-4">
                    <label class="form-label text-uppercase fw-semibold small text-secondary">Subtitle (Max 30 words)</label>
                    <textarea name="subtitle" id="subtitle" rows="2" 
                              class="form-control rounded-3 border-secondary" 
                              style="border-color: #e5e7eb; padding: 0.625rem 1rem; resize: vertical;">{{ old('subtitle') }}</textarea>
                    <p id="wordCount" class="text-muted small mt-1">0 / 30 words</p>
                </div>

                <div class="mb-4">
                    <label class="form-label text-uppercase fw-semibold small text-secondary">Description</label>
                    <textarea name="description" rows="4" required 
                              class="form-control rounded-3 border-secondary" 
                              style="border-color: #e5e7eb; padding: 0.625rem 1rem; resize: vertical;">{{ old('description') }}</textarea>
                    <div class="invalid-feedback">Please enter a description.</div>
                </div>

                <div class="mb-4">
                    <label class="form-label text-uppercase fw-semibold small text-secondary">Logo</label>
                    <input type="file" name="logo" accept="image/*" 
                           class="form-control rounded-3 border-secondary" 
                           style="border-color: #e5e7eb; padding: 0.625rem 1rem;">
                    <div class="form-text small text-muted">Upload a logo image for the platform.</div>
                </div>

                <div class="mb-4">
                    <label class="form-label text-uppercase fw-semibold small text-secondary">Join Now URL</label>
                    <input type="url" name="join_url" value="{{ old('join_url') }}" 
                           class="form-control rounded-3 border-secondary" 
                           style="border-color: #e5e7eb; padding: 0.625rem 1rem;">
                </div>

                <div class="mb-4">
                    <label class="form-label text-uppercase fw-semibold small text-secondary">Status</label>
                    <select name="status" class="form-select rounded-3 border-secondary" style="border-color: #e5e7eb; padding: 0.625rem 1rem;">
                        <option value="1">Online</option>
                        <option value="0">Offline</option>
                    </select>
                </div>

                <div class="d-flex gap-3 pt-3">
                    <a href="{{ route('admin.platforms') }}" 
                       class="btn btn-light flex-fill py-2 rounded-3 fw-medium border-secondary" 
                       style="border-color: #e5e7eb;">Cancel</a>
                    <button type="submit" 
                            class="btn btn-primary flex-fill py-2 rounded-3 fw-semibold" 
                            style="background-color: #2A4563; border-color: #2A4563;">Save Platform</button>
                </div>
            </form>
        </div>
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