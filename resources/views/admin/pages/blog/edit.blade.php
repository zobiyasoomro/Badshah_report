@extends('admin.layouts.master')
@section('title', 'Edit Blog')
@section('admin_content')

<style>
    /* ===== ROOT VARIABLES ===== */
    :root {
        --primary-color: #2a4563;
        --secondary-color: #2a4563;
        --bg-light: #f7f8fc;
        --card-shadow: 0 20px 60px rgba(0, 0, 0, 0.08);
        --border-radius: 24px;
        --transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
    }

    /* ===== PAGE CONTAINER ===== */
    .blog-edit-page {
        padding: 20px 0;
        background: var(--bg-light);
        min-height: 100vh;
    }

    /* ===== MAIN CARD ===== */
    .blog-card {
        background: #ffffff;
        border-radius: var(--border-radius);
        box-shadow: var(--card-shadow);
        overflow: hidden;
        border: none;
        transition: var(--transition);
        position: relative;
    }

    .blog-card:hover {
        box-shadow: 0 30px 80px rgba(42, 69, 99, 0.15);
    }

    /* ===== HEADER SECTION ===== */
    .blog-header {
        background: linear-gradient(135deg, #3b5f86 0%, #2a4563 50%, #1f354d 100%);
        padding: 40px 45px;
        position: relative;
        overflow: hidden;
    }

    .blog-header::before {
        content: '';
        position: absolute;
        top: -80px;
        right: -80px;
        width: 300px;
        height: 300px;
        background: rgba(255, 255, 255, 0.05);
        border-radius: 50%;
        animation: float 6s ease-in-out infinite;
    }

    .blog-header::after {
        content: '';
        position: absolute;
        bottom: -60px;
        left: -60px;
        width: 200px;
        height: 200px;
        background: rgba(255, 255, 255, 0.03);
        border-radius: 50%;
        animation: float 8s ease-in-out infinite reverse;
    }

    @keyframes float {

        0%,
        100% {
            transform: translate(0, 0);
        }

        50% {
            transform: translate(-20px, -20px);
        }
    }

    .blog-header-content {
        position: relative;
        z-index: 1;
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 20px;
    }

    .blog-header-left {
        display: flex;
        align-items: center;
        gap: 20px;
    }

    .blog-header-icon {
        width: 64px;
        height: 64px;
        background: rgba(255, 255, 255, 0.2);
        border-radius: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 28px;
        color: #fff;
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.1);
    }

    .blog-header-title {
        color: #fff;
        font-weight: 700;
        font-size: 28px;
        margin: 0;
        letter-spacing: -0.5px;
    }

    .blog-header-subtitle {
        color: rgba(255, 255, 255, 0.8);
        font-size: 14px;
        margin: 4px 0 0 0;
        font-weight: 400;
    }

    .blog-header-badge {
        background: rgba(255, 255, 255, 0.2);
        backdrop-filter: blur(10px);
        padding: 8px 20px;
        border-radius: 50px;
        color: #fff;
        font-size: 13px;
        font-weight: 600;
        letter-spacing: 0.5px;
        border: 1px solid rgba(255, 255, 255, 0.1);
    }

    /* ===== BODY SECTION ===== */
    .blog-body {
        padding: 45px;
    }

    /* ===== FORM GROUP ===== */
    .form-group-modern {
        margin-bottom: 30px;
        position: relative;
    }

    .form-group-modern:last-of-type {
        margin-bottom: 35px;
    }

    .form-label-modern {
        display: flex;
        align-items: center;
        gap: 10px;
        font-weight: 600;
        color: #1a1a2e;
        font-size: 15px;
        margin-bottom: 10px;
        letter-spacing: 0.3px;
    }

    .form-label-modern .label-icon {
        width: 32px;
        height: 32px;
        background: linear-gradient(135deg, rgba(42, 69, 99, 0.1), rgba(42, 69, 99, 0.1));
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--primary-color);
        font-size: 14px;
        transition: var(--transition);
    }

    .form-label-modern .required-star {
        color: #ef4444;
        font-weight: 700;
    }

    .form-label-modern .label-badge {
        background: #f3f4f6;
        padding: 2px 12px;
        border-radius: 50px;
        font-size: 11px;
        font-weight: 600;
        color: #6b7280;
        margin-left: auto;
    }

    /* ===== INPUT STYLES ===== */
    .input-modern {
        width: 100%;
        padding: 14px 18px;
        border: 2px solid #e5e7eb;
        border-radius: 14px;
        font-size: 15px;
        color: #1a1a2e;
        background: #fafbfc;
        transition: var(--transition);
        font-family: inherit;
    }

    .input-modern:focus {
        outline: none;
        border-color: var(--primary-color);
        background: #ffffff;
        box-shadow: 0 0 0 4px rgba(42, 69, 99, 0.1);
        transform: translateY(-1px);
    }

    .input-modern:hover {
        background: #ffffff;
        border-color: #d1d5db;
    }

    .input-modern::placeholder {
        color: #9ca3af;
        font-weight: 400;
    }

    .input-modern.is-invalid {
        border-color: #ef4444;
        background: #fef2f2;
    }

    .input-modern.is-invalid:focus {
        box-shadow: 0 0 0 4px rgba(239, 68, 68, 0.1);
    }

    .input-modern.is-valid {
        border-color: #10b981;
        background: #f0fdf4;
    }

    .input-modern.is-valid:focus {
        box-shadow: 0 0 0 4px rgba(16, 185, 129, 0.1);
    }

    /* ===== TEXTAREA ===== */
    textarea.input-modern {
        min-height: 180px;
        resize: vertical;
        line-height: 1.6;
    }

    /* ===== CURRENT IMAGE DISPLAY ===== */
    .current-image-wrapper {
        margin-bottom: 15px;
        padding: 20px;
        background: #fafbfc;
        border-radius: 16px;
        border: 2px solid #e5e7eb;
        display: flex;
        align-items: center;
        gap: 20px;
        flex-wrap: wrap;
    }

    .current-image-thumb {
        width: 150px;
        height: 150px;
        border-radius: 12px;
        overflow: hidden;
        flex-shrink: 0;
        border: 3px solid #e5e7eb;
        background: #fff;
    }

    .current-image-thumb img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .current-image-info {
        flex: 1;
        min-width: 150px;
    }

    .current-image-label {
        font-weight: 600;
        color: #1a1a2e;
        font-size: 14px;
        margin-bottom: 4px;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .current-image-label .status-badge {
        font-size: 11px;
        background: #10b981;
        color: #fff;
        padding: 2px 12px;
        border-radius: 50px;
        font-weight: 600;
    }

    .current-image-name {
        color: #6b7280;
        font-size: 13px;
        margin-bottom: 4px;
    }

    .current-image-hint {
        color: #9ca3af;
        font-size: 12px;
    }

    .current-image-hint i {
        margin-right: 4px;
    }

    /* ===== FILE UPLOAD ===== */
    .upload-area {
        border: 2px dashed #e5e7eb;
        border-radius: 16px;
        padding: 40px 20px;
        text-align: center;
        background: #fafbfc;
        transition: var(--transition);
        cursor: pointer;
        position: relative;
    }

    .upload-area:hover {
        border-color: var(--primary-color);
        background: #f5f3ff;
        transform: scale(1.01);
    }

    .upload-area.dragover {
        border-color: var(--primary-color);
        background: #ede9fe;
        transform: scale(1.02);
        box-shadow: 0 0 0 4px rgba(42, 69, 99, 0.1);
    }

    .upload-area input[type="file"] {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        opacity: 0;
        cursor: pointer;
        z-index: 10;
    }

    .upload-icon-wrapper {
        width: 70px;
        height: 70px;
        background: linear-gradient(135deg, rgba(42, 69, 99, 0.1), rgba(42, 69, 99, 0.1));
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 15px;
        font-size: 28px;
        color: var(--primary-color);
        transition: var(--transition);
    }

    .upload-area:hover .upload-icon-wrapper {
        transform: scale(1.1) rotate(-5deg);
        background: linear-gradient(135deg, rgba(42, 69, 99, 0.2), rgba(42, 69, 99, 0.2));
    }

    .upload-title {
        font-size: 16px;
        font-weight: 600;
        color: #1a1a2e;
        margin-bottom: 6px;
    }

    .upload-title span {
        color: var(--primary-color);
    }

    .upload-text {
        color: #6b7280;
        font-size: 14px;
        margin: 0;
    }

    .upload-hint {
        color: #9ca3af;
        font-size: 13px;
        margin-top: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 15px;
        flex-wrap: wrap;
    }

    .upload-hint span {
        display: inline-flex;
        align-items: center;
        gap: 5px;
    }

    .upload-hint i {
        font-size: 12px;
    }

    /* ===== IMAGE PREVIEW ===== */
    .image-preview-modern {
        display: none;
        margin-top: 20px;
        padding: 20px;
        background: #fafbfc;
        border-radius: 16px;
        border: 2px solid #e5e7eb;
        animation: slideDown 0.4s ease;
    }

    .image-preview-modern.active {
        display: block;
    }

    @keyframes slideDown {
        from {
            opacity: 0;
            transform: translateY(-20px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .image-preview-content {
        display: flex;
        align-items: center;
        gap: 20px;
        flex-wrap: wrap;
    }

    .image-preview-thumb {
        width: 120px;
        height: 120px;
        border-radius: 12px;
        overflow: hidden;
        flex-shrink: 0;
        border: 3px solid #e5e7eb;
    }

    .image-preview-thumb img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .image-preview-info {
        flex: 1;
        min-width: 150px;
    }

    .image-preview-name {
        font-weight: 600;
        color: #1a1a2e;
        font-size: 15px;
        margin-bottom: 4px;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .image-preview-name .file-status {
        font-size: 12px;
        color: #10b981;
        font-weight: 600;
    }

    .image-preview-size {
        color: #6b7280;
        font-size: 13px;
        margin-bottom: 8px;
    }

    .image-preview-actions {
        display: flex;
        gap: 10px;
    }

    .btn-remove-image {
        padding: 6px 16px;
        background: #fef2f2;
        color: #ef4444;
        border: 1px solid #fca5a5;
        border-radius: 8px;
        font-size: 13px;
        font-weight: 600;
        cursor: pointer;
        transition: var(--transition);
    }

    .btn-remove-image:hover {
        background: #ef4444;
        color: #fff;
        border-color: #ef4444;
    }

    /* ===== VALIDATION FEEDBACK ===== */
    .feedback-modern {
        display: flex;
        align-items: center;
        gap: 8px;
        margin-top: 8px;
        padding: 10px 14px;
        border-radius: 10px;
        font-size: 14px;
        animation: slideDown 0.3s ease;
    }

    .feedback-modern.error {
        background: #fef2f2;
        color: #dc2626;
        border-left: 4px solid #ef4444;
    }

    .feedback-modern.success {
        background: #f0fdf4;
        color: #16a34a;
        border-left: 4px solid #22c55e;
    }

    .feedback-modern i {
        font-size: 16px;
    }

    /* ===== CHARACTER COUNTER ===== */
    .char-counter {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-top: 8px;
        padding: 8px 14px;
        background: #f3f4f6;
        border-radius: 10px;
        font-size: 13px;
        color: #6b7280;
    }

    .char-counter .count {
        font-weight: 600;
        transition: var(--transition);
    }

    .char-counter .count.good {
        color: #10b981;
    }

    .char-counter .count.warning {
        color: #f59e0b;
    }

    .char-counter .count.danger {
        color: #ef4444;
    }

    /* ===== BUTTONS ===== */
    .btn-group-modern {
        display: flex;
        gap: 15px;
        flex-wrap: wrap;
        padding-top: 10px;
        border-top: 2px solid #f3f4f6;
    }

    .btn-primary-modern {
        display: inline-flex;
        align-items: center;
        gap: 10px;
        padding: 14px 40px;
        background: linear-gradient(135deg, #3b5f86 0%, #2a4563 50%, #1f354d 100%);
        color: #fff;
        border: none;
        border-radius: 14px;
        font-weight: 600;
        font-size: 15px;
        cursor: pointer;
        transition: var(--transition);
        text-decoration: none;
        box-shadow: 0 4px 20px rgba(42, 69, 99, 0.3);
    }

    .btn-primary-modern:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 30px rgba(42, 69, 99, 0.4);
        color: #fff;
    }

    .btn-primary-modern:active {
        transform: translateY(0);
    }

    .btn-primary-modern i {
        font-size: 18px;
    }

    .btn-secondary-modern {
        display: inline-flex;
        align-items: center;
        gap: 10px;
        padding: 14px 35px;
        background: #f3f4f6;
        color: #4b5563;
        border: 2px solid #e5e7eb;
        border-radius: 14px;
        font-weight: 600;
        font-size: 15px;
        cursor: pointer;
        transition: var(--transition);
        text-decoration: none;
    }

    .btn-secondary-modern:hover {
        background: #e5e7eb;
        color: #1f2937;
        transform: translateY(-2px);
        border-color: #d1d5db;
    }

    .btn-secondary-modern i {
        font-size: 16px;
    }

    /* ===== RESPONSIVE ===== */
    @media (max-width: 992px) {
        .blog-header {
            padding: 30px 35px;
        }

        .blog-body {
            padding: 35px;
        }

        .blog-header-title {
            font-size: 24px;
        }

        .current-image-thumb {
            width: 120px;
            height: 120px;
        }
    }

    @media (max-width: 768px) {
        .blog-header {
            padding: 25px;
        }

        .blog-body {
            padding: 25px;
        }

        .blog-header-content {
            flex-direction: column;
            align-items: flex-start;
        }

        .blog-header-left {
            width: 100%;
        }

        .blog-header-badge {
            width: 100%;
            text-align: center;
        }

        .blog-header-title {
            font-size: 20px;
        }

        .blog-header-icon {
            width: 50px;
            height: 50px;
            font-size: 22px;
        }

        .upload-area {
            padding: 30px 15px;
        }

        .upload-icon-wrapper {
            width: 60px;
            height: 60px;
            font-size: 24px;
        }

        .upload-title {
            font-size: 16px;
        }

        .current-image-wrapper {
            flex-direction: column;
            align-items: center;
            text-align: center;
        }

        .current-image-thumb {
            width: 100%;
            max-width: 200px;
            height: 150px;
        }

        .image-preview-content {
            flex-direction: column;
            align-items: center;
            text-align: center;
        }

        .image-preview-thumb {
            width: 100%;
            max-width: 200px;
            height: 150px;
        }

        .image-preview-actions {
            justify-content: center;
        }

        .btn-group-modern {
            flex-direction: column;
        }

        .btn-group-modern .btn {
            width: 100%;
            justify-content: center;
        }

        .form-label-modern .label-badge {
            display: none;
        }
    }

    @media (max-width: 480px) {
        .blog-header {
            padding: 20px;
        }

        .blog-body {
            padding: 20px;
        }

        .blog-header-title {
            font-size: 18px;
        }

        .input-modern {
            font-size: 14px;
            padding: 12px 15px;
        }

        .upload-hint {
            flex-direction: column;
            gap: 5px;
        }
    }

    /* ===== SPINNER ANIMATION ===== */
    .spinner {
        display: none;
        width: 20px;
        height: 20px;
        border: 3px solid rgba(255, 255, 255, 0.3);
        border-radius: 50%;
        border-top-color: #fff;
        animation: spin 0.8s ease infinite;
    }

    @keyframes spin {
        to {
            transform: rotate(360deg);
        }
    }

    .btn-primary-modern.loading .spinner {
        display: inline-block;
    }

    .btn-primary-modern.loading .btn-text {
        display: none;
    }
</style>

<div class="blog-edit-page">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10 col-xl-9">

                <!-- Blog Card -->
                <div class="blog-card">

                    <!-- Header -->
                    <div class="blog-header">
                        <div class="blog-header-content">
                            <div class="blog-header-left">
                                <div class="blog-header-icon">
                                    <i class="fas fa-edit"></i>
                                </div>
                                <div>
                                    <h1 class="blog-header-title">Edit Blog</h1>
                                    <p class="blog-header-subtitle">Update your blog post</p>
                                </div>
                            </div>
                            <div class="blog-header-badge">
                                <i class="fas fa-pencil-alt me-2"></i>
                                Editing
                            </div>
                        </div>
                    </div>

                    <!-- Body -->
                    <div class="blog-body">

                        <form action="{{ route('admin.blog.update', $blog->id) }}" method="POST" enctype="multipart/form-data" id="blogForm">
                            @csrf
                            @method('PUT')

                            <!-- Title -->
                            <div class="form-group-modern">
                                <label for="title" class="form-label-modern">
                                    <span class="label-icon">
                                        <i class="fas fa-heading"></i>
                                    </span>
                                    Blog Title
                                    <span class="required-star">*</span>
                                    <span class="label-badge">Required</span>
                                </label>
                                <input type="text" 
                                       class="input-modern @error('title') is-invalid @enderror" 
                                       id="title" 
                                       name="title" 
                                       value="{{ old('title', $blog->title) }}" 
                                       placeholder="Write an amazing blog title..." 
                                       required 
                                       autofocus>
                                @error('title')
                                    <div class="feedback-modern error">
                                        <i class="fas fa-exclamation-circle"></i>
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <!-- Description -->
                            <div class="form-group-modern">
                                <label for="description" class="form-label-modern">
                                    <span class="label-icon">
                                        <i class="fas fa-align-left"></i>
                                    </span>
                                    Content
                                    <span class="required-star">*</span>
                                    <span class="label-badge">SEO Optimized</span>
                                </label>
                                <textarea class="input-modern @error('description') is-invalid @enderror" 
                                          id="description" 
                                          name="description" 
                                          rows="8" 
                                          placeholder="Write your blog content here... Be creative and engaging!" 
                                          required>{{ old('description', $blog->description) }}</textarea>

                                <!-- Character Counter -->
                                <div class="char-counter">
                                    <span>
                                        <i class="fas fa-keyboard me-1"></i>
                                        Character count
                                    </span>
                                    <span>
                                        <span class="count" id="charCount">0</span>
                                        <span style="color: #9ca3af;"> / 5000+</span>
                                    </span>
                                </div>

                                @error('description')
                                    <div class="feedback-modern error">
                                        <i class="fas fa-exclamation-circle"></i>
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <!-- Image Upload -->
                            <div class="form-group-modern">
                                <label class="form-label-modern">
                                    <span class="label-icon">
                                        <i class="fas fa-image"></i>
                                    </span>
                                    Featured Image
                                    <span class="label-badge">Optional</span>
                                </label>

                                <!-- Current Image Display -->
                                @if($blog->image)
                                    <div class="current-image-wrapper">
                                        <div class="current-image-thumb">
                                            <img src="{{ asset('blogs/' . $blog->image) }}" alt="{{ $blog->title }}">
                                        </div>
                                        <div class="current-image-info">
                                            <div class="current-image-label">
                                                <i class="fas fa-check-circle" style="color: #10b981;"></i>
                                                Current Image
                                                <span class="status-badge">Active</span>
                                            </div>
                                            <div class="current-image-name">
                                                <i class="fas fa-file-image me-1"></i>
                                                {{ $blog->image }}
                                            </div>
                                            <div class="current-image-hint">
                                                <i class="fas fa-info-circle"></i>
                                                Upload a new image below to replace this one
                                            </div>
                                        </div>
                                    </div>
                                @endif

                                <!-- Upload Area -->
                                <div class="upload-area" id="uploadArea">
                                    <div class="upload-icon-wrapper">
                                        <i class="fas fa-cloud-upload-alt"></i>
                                    </div>
                                    <div class="upload-title">
                                        <span>Click to upload</span> or drag & drop
                                    </div>
                                    <p class="upload-text">Choose a new image for your blog post</p>
                                    <div class="upload-hint">
                                        <span><i class="fas fa-file-image"></i> JPEG, PNG, JPG, GIF, WEBP</span>
                                        <span><i class="fas fa-weight-hanging"></i> Max 2MB</span>
                                        <span><i class="fas fa-expand"></i> 1200 x 630px recommended</span>
                                    </div>
                                    <input type="file" id="imageInput" name="image" accept="image/*">
                                </div>

                                <!-- Image Preview -->
                                <div class="image-preview-modern" id="imagePreview">
                                    <div class="image-preview-content">
                                        <div class="image-preview-thumb">
                                            <img id="previewImage" src="#" alt="Preview">
                                        </div>
                                        <div class="image-preview-info">
                                            <div class="image-preview-name">
                                                <span id="fileName">image.jpg</span>
                                                <span class="file-status">
                                                    <i class="fas fa-check-circle"></i> Ready
                                                </span>
                                            </div>
                                            <div class="image-preview-size" id="fileSize">2.5 MB</div>
                                            <div class="image-preview-actions">
                                                <button type="button" class="btn-remove-image" id="removeImage">
                                                    <i class="fas fa-trash-alt me-1"></i>
                                                    Remove
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                @error('image')
                                    <div class="feedback-modern error">
                                        <i class="fas fa-exclamation-circle"></i>
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <!-- Buttons -->
                            <div class="btn-group-modern">
                                <button type="submit" class="btn-primary-modern" id="submitBtn">
                                    <i class="fas fa-save"></i>
                                    <span class="btn-text">Update Blog</span>
                                    <span class="spinner"></span>
                                </button>
                                <a href="{{ route('admin.blog.index') }}" class="btn-secondary-modern">
                                    <i class="fas fa-times"></i>
                                    Cancel & Go Back
                                </a>
                            </div>

                        </form>

                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // ===== ELEMENTS =====
        const uploadArea = document.getElementById('uploadArea');
        const imageInput = document.getElementById('imageInput');
        const previewContainer = document.getElementById('imagePreview');
        const previewImage = document.getElementById('previewImage');
        const fileName = document.getElementById('fileName');
        const fileSize = document.getElementById('fileSize');
        const removeBtn = document.getElementById('removeImage');
        const description = document.getElementById('description');
        const charCount = document.getElementById('charCount');
        const form = document.getElementById('blogForm');
        const submitBtn = document.getElementById('submitBtn');

        // ===== CHARACTER COUNTER =====
        function updateCharCount() {
            const count = description.value.length;
            charCount.textContent = count;

            // Color coding
            charCount.className = 'count';
            if (count < 50) {
                charCount.classList.add('danger');
            } else if (count < 200) {
                charCount.classList.add('warning');
            } else {
                charCount.classList.add('good');
            }
        }

        // Initial character count
        updateCharCount();

        description.addEventListener('input', function() {
            updateCharCount();
            // Auto-expand textarea
            this.style.height = 'auto';
            this.style.height = (this.scrollHeight) + 'px';
        });

        // ===== IMAGE UPLOAD HANDLING =====
        // Click upload
        uploadArea.addEventListener('click', function(e) {
            if (e.target.tagName !== 'INPUT') {
                imageInput.click();
            }
        });

        // File selected
        imageInput.addEventListener('change', function(e) {
            const file = this.files[0];
            if (file) {
                handleFile(file);
            }
        });

        // Drag and drop
        uploadArea.addEventListener('dragover', function(e) {
            e.preventDefault();
            this.classList.add('dragover');
        });

        uploadArea.addEventListener('dragleave', function(e) {
            e.preventDefault();
            this.classList.remove('dragover');
        });

        uploadArea.addEventListener('drop', function(e) {
            e.preventDefault();
            this.classList.remove('dragover');

            const files = e.dataTransfer.files;
            if (files.length > 0) {
                imageInput.files = files;
                handleFile(files[0]);
            }
        });

        // Remove image
        removeBtn.addEventListener('click', function() {
            imageInput.value = '';
            previewContainer.classList.remove('active');
            uploadArea.style.display = 'block';
            // Show current image section if it exists
            const currentImageWrapper = document.querySelector('.current-image-wrapper');
            if (currentImageWrapper) {
                currentImageWrapper.style.display = 'flex';
            }
        });

        // ===== FILE HANDLER =====
        function handleFile(file) {
            if (file && file.type.startsWith('image/')) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    previewImage.src = e.target.result;
                    fileName.textContent = file.name;
                    fileSize.textContent = formatFileSize(file.size);
                    previewContainer.classList.add('active');
                    uploadArea.style.display = 'none';
                    // Hide current image section when new image is selected
                    const currentImageWrapper = document.querySelector('.current-image-wrapper');
                    if (currentImageWrapper) {
                        currentImageWrapper.style.display = 'none';
                    }
                };
                reader.readAsDataURL(file);
            } else {
                alert('Please select a valid image file.');
                imageInput.value = '';
            }
        }

        // ===== FILE SIZE FORMATTER =====
        function formatFileSize(bytes) {
            if (bytes === 0) return '0 Bytes';
            const k = 1024;
            const sizes = ['Bytes', 'KB', 'MB', 'GB'];
            const i = Math.floor(Math.log(bytes) / Math.log(k));
            return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
        }

        // ===== FORM SUBMIT =====
        form.addEventListener('submit', function(e) {
            const title = document.getElementById('title').value.trim();
            const desc = description.value.trim();

            if (!title || !desc) {
                e.preventDefault();
                alert('⚠️ Please fill in all required fields:\n- Blog Title\n- Content');
                return;
            }

            // Show loading state
            submitBtn.classList.add('loading');
            submitBtn.disabled = true;
        });

        // ===== KEYBOARD SHORTCUTS =====
        document.addEventListener('keydown', function(e) {
            // Ctrl + S to submit
            if ((e.ctrlKey || e.metaKey) && e.key === 's') {
                e.preventDefault();
                form.dispatchEvent(new Event('submit'));
            }
        });

        console.log('✨ Blog edit form loaded successfully!');
        console.log('💡 Tip: Press Ctrl+S to update the blog');
    });
</script>

@endsection