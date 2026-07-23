@extends('admin.layouts.master')
@section('title', 'Edit Plane')
@section('admin_content')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<style>
    body {
        background-color: #f8fafc;
    }

    .edit-plane-container {
        padding: 1.5rem;
    }

    .btn-back {
        color: #64748b;
        transition: color 0.2s;
        font-size: 1.25rem;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 36px;
        height: 36px;
        border-radius: 8px;
    }

    .btn-back:hover {
        color: #1e293b;
        background: #f1f5f9;
    }

    .edit-plane-title {
        font-size: 1.875rem;
        font-weight: 600;
        color: #1f2937;
        margin-bottom: 0;
    }

    .edit-plane-subtitle {
        color: #6b7280;
        margin-top: 4px;
        margin-bottom: 0;
    }

    .form-card {
        background-color: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 24px;
        box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.02);
        max-width: 800px;
        margin: 0 auto;
        padding: 2rem;
    }

    .form-label-custom {
        font-size: 11px;
        font-weight: 700;
        letter-spacing: 0.05em;
        color: #64748b;
        text-transform: uppercase;
        margin-bottom: 8px;
        display: block;
    }

    .custom-input {
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        padding: 12px 16px;
        color: #334155;
        font-size: 15px;
        background-color: #ffffff;
        transition: border-color 0.2s, box-shadow 0.2s;
        width: 100%;
        display: block;
    }

    .custom-input:focus {
        border-color: #94a3b8;
        box-shadow: none;
        outline: none;
    }

    textarea.custom-input {
        resize: vertical;
        min-height: 100px;
    }

    .form-error {
        color: #ef4444;
        font-size: 0.875rem;
        margin-top: 4px;
        display: block;
    }

    .btn-update {
        background-color: #2A4563 !important;
        color: #ffffff !important;
        font-weight: 500;
        padding: 12px 32px;
        border-radius: 12px;
        border: none;
        transition: background-color 0.2s;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        cursor: pointer;
    }

    .btn-update:hover {
        background-color: #1f334a !important;
    }

    .form-group-custom {
        margin-bottom: 1.5rem;
        display: flex;
        flex-direction: column;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .edit-plane-container {
            padding: 1rem;
        }

        .edit-plane-title {
            font-size: 1.5rem;
        }

        .form-card {
            padding: 1.25rem;
        }

        .custom-input {
            padding: 10px 14px;
            font-size: 14px;
        }

        .btn-update {
            padding: 10px 24px;
            font-size: 0.9rem;
        }
    }

    @media (max-width: 576px) {
        .edit-plane-container {
            padding: 0.75rem;
        }

        .form-card {
            padding: 1rem;
            border-radius: 16px;
        }

        .custom-input {
            padding: 8px 12px;
            font-size: 13px;
            border-radius: 10px;
        }

        .btn-update {
            padding: 8px 20px;
            font-size: 0.85rem;
            border-radius: 10px;
            width: 100%;
            justify-content: center;
        }

        .edit-plane-title {
            font-size: 1.25rem;
        }

        .btn-back {
            font-size: 1rem;
            width: 32px;
            height: 32px;
        }
    }
</style>

<div class="edit-plane-container">
    <!-- Header -->
    <div class="d-flex align-items-center gap-3 mb-4 flex-wrap">
        <a href="{{ route('admin.planes') }}" class="btn-back" title="Go Back">
            <i class="fa-solid fa-arrow-left"></i>
        </a>
        <div>
            <h1 class="edit-plane-title">Edit Plane</h1>
            <p class="edit-plane-subtitle">Update details for {{ $plane->name }}.</p>
        </div>
    </div>

    <!-- Form Card -->
    <div class="form-card">
        <form action="{{ route('admin.planes.update', $plane->id) }}" method="POST">
            @csrf
            @method('PUT')

            <!-- Plane Name -->
            <div class="form-group-custom">
                <label for="name" class="form-label-custom">Full Name</label>
                <input type="text" id="name" name="name" value="{{ old('name', $plane->name) }}"
                    class="custom-input" placeholder="Enter plane full name" required>
                @error('name')
                    <span class="form-error">{{ $message }}</span>
                @enderror
            </div>

            <!-- Short Description -->
            <div class="form-group-custom">
                <label for="short_description" class="form-label-custom">Short Description</label>
                <textarea id="short_description" name="short_description" rows="4" class="custom-input"
                    placeholder="Enter short description..."
                    required>{{ old('short_description', $plane->short_description) }}</textarea>
                @error('short_description')
                    <span class="form-error">{{ $message }}</span>
                @enderror
            </div>

            <!-- Price -->
            <div class="form-group-custom">
                <label for="price" class="form-label-custom">Price (₹)</label>
                <input type="number" id="price" name="price" value="{{ old('price', $plane->price) }}"
                    class="custom-input" placeholder="Enter price" required>
                @error('price')
                    <span class="form-error">{{ $message }}</span>
                @enderror
            </div>

            <!-- Submit Button -->
            <div class="d-flex justify-content-start">
                <button type="submit" class="btn-update">
                    Update Plane
                </button>
            </div>
        </form>
    </div>
</div>

@endsection