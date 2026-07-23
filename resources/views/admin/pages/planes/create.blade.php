@extends('admin.layouts.master')

@section('title', 'Add New Plane')

@section('admin_content')

<style>
    .plane-form-container {
        padding: 1.5rem;
        max-width: 768px;
        margin: 0 auto;
    }

    .plane-form-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 2rem;
        flex-wrap: wrap;
        gap: 1rem;
    }

    .plane-form-title {
        font-size: 1.875rem;
        font-weight: 600;
        color: #1f2937;
        margin-bottom: 0;
    }

    .plane-form-subtitle {
        color: #6b7280;
        margin-top: 4px;
        margin-bottom: 0;
    }

    .btn-back {
        display: flex;
        align-items: center;
        gap: 8px;
        color: #4b5563;
        text-decoration: none;
        transition: color 0.2s ease;
        background: none;
        border: none;
        padding: 0;
        font-size: inherit;
    }

    .btn-back:hover {
        color: #1f2937;
    }

    .form-card {
        background: #ffffff;
        border-radius: 24px;
        border: 1px solid #f3f4f6;
        box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05);
        padding: 2rem;
    }

    .form-group-custom {
        margin-bottom: 1.5rem;
    }

    .form-label-custom {
        display: block;
        font-size: 0.875rem;
        font-weight: 500;
        color: #374151;
        margin-bottom: 8px;
    }

    .form-label-custom .required {
        color: #ef4444;
    }

    .form-control-custom {
        width: 100%;
        padding: 0.875rem 1.25rem;
        border: 1px solid #d1d5db;
        border-radius: 16px;
        font-size: 1rem;
        transition: all 0.2s ease;
        background: #ffffff;
        color: #1f2937;
    }

    .form-control-custom:focus {
        outline: none;
        border-color: #2A4563;
        box-shadow: 0 0 0 1px #2A4563;
    }

    .form-control-custom::placeholder {
        color: #9ca3af;
    }

    textarea.form-control-custom {
        resize: vertical;
        min-height: 100px;
    }

    .form-error {
        color: #ef4444;
        font-size: 0.875rem;
        margin-top: 4px;
        display: block;
    }

    .btn-submit {
        width: 100%;
        background-color: #2A4563;
        color: #ffffff;
        padding: 1rem;
        border-radius: 16px;
        font-weight: 600;
        font-size: 1.125rem;
        border: none;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        transition: all 0.2s ease;
        cursor: pointer;
    }

    .btn-submit:hover {
        background-color: #1f334a;
        transform: translateY(-1px);
    }

    .btn-submit i {
        font-size: 1rem;
    }

    .mt-6 {
        margin-top: 1.5rem;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .plane-form-container {
            padding: 1rem;
        }

        .plane-form-header {
            flex-direction: column;
            align-items: flex-start;
        }

        .plane-form-title {
            font-size: 1.5rem;
        }

        .form-card {
            padding: 1.25rem;
        }

        .form-control-custom {
            padding: 0.75rem 1rem;
            font-size: 0.875rem;
        }

        .btn-submit {
            padding: 0.75rem;
            font-size: 1rem;
        }
    }

    @media (max-width: 576px) {
        .plane-form-container {
            padding: 0.75rem;
        }

        .form-card {
            padding: 1rem;
            border-radius: 16px;
        }

        .form-control-custom {
            padding: 0.625rem 0.875rem;
            font-size: 0.875rem;
            border-radius: 12px;
        }

        .form-label-custom {
            font-size: 0.8rem;
        }

        .btn-submit {
            padding: 0.625rem;
            font-size: 0.875rem;
            border-radius: 12px;
        }
    }
</style>

<div class="plane-form-container">
    <!-- Header -->
    <div class="plane-form-header">
        <div>
            <h1 class="plane-form-title">Add New Plane</h1>
            <p class="plane-form-subtitle">Create a new plane entry</p>
        </div>
        <a href="{{ route('admin.planes') }}" class="btn-back">
            <i class="fa-solid fa-arrow-left"></i>
            <span>Back to Planes</span>
        </a>
    </div>

    <!-- Form Card -->
    <div class="form-card">
        <form action="{{ route('admin.planes.store') }}" method="POST">
            @csrf

            <!-- Plane Name -->
            <div class="form-group-custom">
                <label class="form-label-custom">
                    Plane Name <span class="required">*</span>
                </label>
                <input type="text" 
                       name="name" 
                       value="{{ old('name') }}"
                       class="form-control-custom"
                       placeholder="e.g. Boeing 777X" 
                       required>
                @error('name')
                    <span class="form-error">{{ $message }}</span>
                @enderror
            </div>

            <!-- Short Description -->
            <div class="form-group-custom">
                <label class="form-label-custom">
                    Short Description <span class="required">*</span>
                </label>
                <textarea name="short_description" 
                          rows="4"
                          class="form-control-custom"
                          placeholder="Brief description about this plane...">{{ old('short_description') }}</textarea>
                @error('short_description')
                    <span class="form-error">{{ $message }}</span>
                @enderror
            </div>

            <!-- Price -->
            <div class="form-group-custom">
                <label class="form-label-custom">
                    Price (₹) <span class="required">*</span>
                </label>
                <input type="number" 
                       name="price" 
                       step="0.01"
                       value="{{ old('price') }}"
                       class="form-control-custom"
                       placeholder="12500000" 
                       required>
                @error('price')
                    <span class="form-error">{{ $message }}</span>
                @enderror
            </div>

            <!-- Submit Button -->
            <div class="mt-6">
                <button type="submit" class="btn-submit">
                    <i class="fa-solid fa-plus"></i>
                    Add New Plane
                </button>
            </div>

        </form>
    </div>
</div>

@endsection