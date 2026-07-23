@extends('admin.layouts.master')
@section('title', 'Payment Methods')
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
    .table-card {
        background: white;
        border-radius: 15px;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
        padding: 20px;
    }
    .table thead th {
        background-color: #f8f9fa;
        color: #495057;
        font-weight: 600;
        border-bottom: 2px solid #dee2e6;
    }
    .table tbody tr:hover {
        background-color: #f8f9fa;
        transition: all 0.3s ease;
    }
    .badge-active {
        background-color: #28a745;
        color: white;
        padding: 5px 12px;
        border-radius: 20px;
        font-size: 12px;
    }
    .badge-inactive {
        background-color: #dc3545;
        color: white;
        padding: 5px 12px;
        border-radius: 20px;
        font-size: 12px;
    }
    .badge-type {
        padding: 5px 12px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 500;
    }
    .badge-wallet {
        background-color: #17a2b8;
        color: white;
    }
    .badge-bank {
        background-color: #6c757d;
        color: white;
    }
    .btn-sm-custom {
        padding: 5px 12px;
        border-radius: 8px;
        font-size: 13px;
        margin: 0 3px;
    }
    .btn-edit {
        background-color: #ffc107;
        color: #212529;
        border: none;
    }
    .btn-edit:hover {
        background-color: #e0a800;
        color: #212529;
    }
    .btn-delete {
        background-color: #dc3545;
        color: white;
        border: none;
    }
    .btn-delete:hover {
        background-color: #c82333;
        color: white;
    }
    .btn-add {
        background: linear-gradient(135deg, #263f5d 0%, #263f5d81 100%);
        color: white;
        padding: 10px 25px;
        border: none;
        border-radius: 10px;
        font-weight: 600;
        transition: all 0.3s ease;
    }
    .btn-add:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
        color: white;
    }
    .alert-success {
        border-radius: 12px;
        border: none;
        background-color: #d4edda;
        color: #155724;
    }
    .alert-danger {
        border-radius: 12px;
        border: none;
        background-color: #f8d7da;
        color: #721c24;
    }
    .empty-state {
        text-align: center;
        padding: 60px 20px;
        color: #6c757d;
    }
    .empty-state i {
        font-size: 60px;
        color: #dee2e6;
        margin-bottom: 20px;
    }
    .deep-link-preview {
        background: #f8f9fa;
        padding: 4px 10px;
        border-radius: 5px;
        font-size: 12px;
        color: #6c757d;
        max-width: 150px;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }
    .delete-form {
        display: inline-block;
    }
</style>

<div class="container-fluid">
    <!-- Page Header -->
    <div class="page-header">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h1><i class="fas fa-credit-card me-2"></i>Payment Methods</h1>
                    <p class="mb-0 opacity-75">Manage your payment methods</p>
                </div>
                <a href="{{ route('admin.payment-methods.create') }}" class="btn-add">
                    <i class="fas fa-plus me-2"></i>Add New
                </a>
            </div>
        </div>
    </div>

    <div class="container">
        <!-- Success Message -->
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <!-- Table Card -->
        <div class="table-card">
            @if($paymentMethods->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Type</th>
                                <th>Account Holder</th>
                                <th>Account #</th>
                                <th>Deep Link</th>
                                <th>Status</th>
                                <th>Order</th>
                                <th class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($paymentMethods as $key => $method)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>
                                        <strong>{{ $method->name }}</strong>
                                        @if($method->logo_url)
                                            <img src="{{ $method->logo_url }}" alt="{{ $method->name }}"
                                                style="width: 30px; height: 30px; border-radius: 50%; margin-left: 8px; object-fit: cover;">
                                        @endif
                                    </td>
                                    <td>
                                        <span class="badge-type {{ $method->type === 'mobile_wallet' ? 'badge-wallet' : 'badge-bank' }}">
                                            {{ $method->type === 'mobile_wallet' ? 'Mobile Wallet' : 'Bank' }}
                                        </span>
                                    </td>
                                    <td>{{ $method->account_holder_name }}</td>
                                    <td><span class="text-muted">{{ $method->account_number }}</span></td>
                                    <td>
                                        @if($method->deep_link_scheme)
                                            <div class="deep-link-preview" title="{{ $method->deep_link_scheme }}">
                                                {{ str_replace(['easypaisa://', 'jazzcash://', '://'], '', $method->deep_link_scheme) }}
                                            </div>
                                        @else
                                            <span class="text-muted">—</span>
                                        @endif
                                    </td>
                                    <td>
                                        <span class="{{ $method->is_active ? 'badge-active' : 'badge-inactive' }}">
                                            {{ $method->is_active ? 'Active' : 'Inactive' }}
                                        </span>
                                    </td>
                                    <td>{{ $method->sort_order }}</td>
                                    <td class="text-center">
                                        <!-- Edit Button -->
                                        <a href="{{ route('admin.payment-methods.edit', $method->id) }}"
                                            class="btn btn-sm-custom btn-edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        
                                        <!-- Delete Form with Confirmation -->
                                        <form action="{{ route('admin.payment-methods.destroy', $method->id) }}" 
                                              method="POST" 
                                              class="delete-form"
                                              onsubmit="return confirmDelete('{{ $method->name }}');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm-custom btn-delete">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="empty-state">
                    <i class="fas fa-credit-card"></i>
                    <h4>No Payment Methods Found</h4>
                    <p class="text-muted">Click the "Add New" button to create your first payment method.</p>
                    <a href="{{ route('admin.payment-methods.create') }}" class="btn-add mt-3">
                        <i class="fas fa-plus me-2"></i>Add New Payment Method
                    </a>
                </div>
            @endif
        </div>
    </div>
</div>

<script>
    function confirmDelete(name) {
        return confirm('Are you sure you want to delete "' + name + '"? This action cannot be undone.');
    }
</script>

@endsection