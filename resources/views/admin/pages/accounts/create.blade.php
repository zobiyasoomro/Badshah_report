@extends('admin.layouts.master')
@section('title', 'About Page Settings')
@section('admin_content')



    <style>
        .page-header {
            background: linear-gradient(135deg, #263f5d 0%, #263f5d81 100%);
            color: white;
            padding: 30px 0;
            border-radius: 0 0 30px 30px;
            margin-bottom: 30px;
        }
        .page-header h1 {
            font-weight: 700;
            margin: 0;
        }
        .form-card {
            background: white;
            border-radius: 15px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.08);
            padding: 30px;
            max-width: 800px;
            margin: 0 auto;
        }
        .form-label {
            font-weight: 600;
            color: #495057;
        }
        .form-control, .form-select {
            border-radius: 10px;
            padding: 10px 15px;
            border: 1px solid #e0e0e0;
            transition: all 0.3s ease;
        }
        .form-control:focus, .form-select:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
        }
        .btn-submit {
             background: linear-gradient(135deg, #263f5d 0%, #263f5d81 100%);
            color: white;
            padding: 12px 40px;
            border: none;
            border-radius: 10px;
            font-weight: 600;
            transition: all 0.3s ease;
            min-width: 150px;
        }
        .btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
            color: white;
        }
        .btn-cancel {
            background-color: #6c757d;
            color: white;
            padding: 12px 30px;
            border: none;
            border-radius: 10px;
            font-weight: 600;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-block;
        }
        .btn-cancel:hover {
            background-color: #5a6268;
            color: white;
        }
        .form-section-title {
            font-size: 18px;
            font-weight: 700;
            color: #495057;
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 2px solid #f0f0f0;
        }
        .form-section-title i {
            color: #667eea;
            margin-right: 10px;
        }
        .required-field::after {
            content: ' *';
            color: #dc3545;
        }
        .invalid-feedback {
            font-size: 13px;
        }
        .logo-preview {
            max-width: 100px;
            max-height: 100px;
            border-radius: 10px;
            border: 2px dashed #dee2e6;
            padding: 5px;
            margin-top: 10px;
            display: none;
        }
    </style>


    <div class="container-fluid">
        <!-- Page Header -->
        <div class="page-header">
            <div class="container">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h1><i class="fas fa-plus-circle me-2"></i>Create Payment Method</h1>
                        <p class="mb-0 opacity-75">Add a new payment method</p>
                    </div>
                    <a href="{{ route('admin.payment-methods.index') }}" class="btn-cancel">
                        <i class="fas fa-arrow-left me-2"></i>Back
                    </a>
                </div>
            </div>
        </div>

        <div class="container">
            <div class="form-card">
                <form action="{{ route('admin.payment-methods.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <!-- Basic Information -->
                    <div class="form-section-title">
                        <i class="fas fa-info-circle"></i>Basic Information
                    </div>

                    <div class="row g-4">
                        <div class="col-md-6">
                            <label for="name" class="form-label required-field">Payment Method Name</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                   id="name" name="name" value="{{ old('name') }}" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="type" class="form-label required-field">Type</label>
                            <select class="form-select @error('type') is-invalid @enderror" 
                                    id="type" name="type" required>
                                <option value="">Select Type</option>
                                <option value="mobile_wallet" {{ old('type') == 'mobile_wallet' ? 'selected' : '' }}>
                                    Mobile Wallet
                                </option>
                                <option value="bank" {{ old('type') == 'bank' ? 'selected' : '' }}>
                                    Bank
                                </option>
                            </select>
                            @error('type')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="account_holder_name" class="form-label required-field">Account Holder Name</label>
                            <input type="text" class="form-control @error('account_holder_name') is-invalid @enderror" 
                                   id="account_holder_name" name="account_holder_name" 
                                   value="{{ old('account_holder_name') }}" required>
                            @error('account_holder_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="account_number" class="form-label required-field">Account Number</label>
                            <input type="text" class="form-control @error('account_number') is-invalid @enderror" 
                                   id="account_number" name="account_number" 
                                   value="{{ old('account_number') }}" required>
                            @error('account_number')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="account_iban" class="form-label">IBAN (Optional)</label>
                            <input type="text" class="form-control @error('account_iban') is-invalid @enderror" 
                                   id="account_iban" name="account_iban" value="{{ old('account_iban') }}">
                            @error('account_iban')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="branch_code" class="form-label">Branch Code (Optional)</label>
                            <input type="text" class="form-control @error('branch_code') is-invalid @enderror" 
                                   id="branch_code" name="branch_code" value="{{ old('branch_code') }}">
                            @error('branch_code')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Deep Link & Settings -->
                    <div class="form-section-title mt-4">
                        <i class="fas fa-link"></i>Deep Link & Settings
                    </div>

                    <div class="row g-4">
                        <div class="col-md-6">
                            <label for="deep_link_scheme" class="form-label">Deep Link Scheme</label>
                            <input type="text" class="form-control @error('deep_link_scheme') is-invalid @enderror" 
                                   id="deep_link_scheme" name="deep_link_scheme" 
                                   value="{{ old('deep_link_scheme') }}"
                                   placeholder="easypaisa:// or jazzcash://">
                            @error('deep_link_scheme')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="text-muted">Example: easypaisa:// or jazzcash://</small>
                        </div>

                        <div class="col-md-3">
                            <label for="sort_order" class="form-label">Sort Order</label>
                            <input type="number" class="form-control @error('sort_order') is-invalid @enderror" 
                                   id="sort_order" name="sort_order" value="{{ old('sort_order', 1) }}" min="1">
                            @error('sort_order')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-3">
                            <label for="is_active" class="form-label">Status</label>
                            <div class="form-check form-switch mt-2">
                                <input class="form-check-input" type="checkbox" id="is_active" 
                                       name="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }}>
                                <label class="form-check-label" for="is_active">Active</label>
                            </div>
                        </div>
                    </div>

                    <!-- Logo Upload -->
                    <div class="form-section-title mt-4">
                        <i class="fas fa-image"></i>Logo (Optional)
                    </div>

                    <div class="row">
                       <div class="col-12">
    <label for="logo_path" class="form-label">Upload Logo</label>
    <input type="file" class="form-control @error('logo_path') is-invalid @enderror" 
           id="logo_path" name="logo_path" accept="image/*">
    @error('logo_path')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
    <small class="text-muted">Supported: JPEG, PNG, JPG, GIF, SVG. Max: 2MB</small>
    <img id="logoPreview" class="logo-preview" style="display: none;" alt="Logo Preview">
</div>
                    </div>

                    <!-- Form Actions -->
                    <div class="mt-4 d-flex justify-content-between">
                        <a href="{{ route('admin.payment-methods.index') }}" class="btn-cancel">
                            <i class="fas fa-times me-2"></i>Cancel
                        </a>
                        <button type="submit" class="btn-submit">
                            <i class="fas fa-save me-2"></i>Create Payment Method
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>

  
    <script>
        // Logo preview
        document.getElementById('logo_path').addEventListener('change', function(e) {
            const preview = document.getElementById('logoPreview');
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.style.display = 'block';
                }
                reader.readAsDataURL(file);
            } else {
                preview.style.display = 'none';
            }
        });
    </script>



@endsection
