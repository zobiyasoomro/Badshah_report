{{-- resources/views/admin/pages/deposits/index.blade.php --}}
@extends('admin.layouts.master')

@section('admin_content')
<style>
    /* ===== Custom replacements for former Tailwind utility classes =====
       These class names are kept as-is in the markup below so the visual
       output stays pixel-identical, but they are now plain custom CSS —
       no Tailwind framework dependency. ===== */
    .text-gray-800 { color: #1f2937 !important; }
    .text-gray-500 { color: #6b7280 !important; }
    .bg-gray-50 { background-color: #f9fafb !important; }
    .border-gray-200 { border-color: #e5e7eb !important; }
    .text-xs { font-size: 0.75rem !important; }
    .tracking-wider { letter-spacing: 0.05em !important; }
    .border-b { border-bottom: 1px solid #e5e7eb; }

    .stats-card {
        transition: all 0.3s ease;
        cursor: default;
    }
    .stats-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 8px 25px rgba(0,0,0,0.08);
    }
    .stats-card .icon {
        font-size: 1.8rem;
        opacity: 0.6;
    }
    .table-hover tbody tr {
        transition: all 0.2s ease;
    }
    .table-hover tbody tr:hover {
        background-color: #f8fafc !important;
        transform: scale(1.005);
    }
    .badge-soft {
        font-weight: 500;
        padding: 6px 14px;
    }
    .action-btn {
        transition: all 0.2s ease;
        width: 32px;
        height: 32px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 8px;
        border: none;
        cursor: pointer;
    }
    .action-btn:hover {
        transform: scale(1.1);
    }
    .modal-content {
        border: none;
        border-radius: 16px;
    }
    .modal-header {
        border-radius: 16px 16px 0 0;
    }
    .detail-row {
        padding: 10px 14px;
        background: #f8fafc;
        border-radius: 8px;
        margin-bottom: 6px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        border-left: 3px solid #0d6efd;
    }
    .detail-row .label {
        font-weight: 600;
        color: #6c757d;
        font-size: 0.85rem;
    }
    .detail-row .value {
        font-weight: 500;
        color: #212529;
        word-break: break-all;
    }
    .detail-row .value.text-success {
        color: #198754 !important;
    }
    .detail-row .value.text-danger {
        color: #dc3545 !important;
    }
    .pagination .page-link {
        color: #0d6efd;
        border-radius: 8px;
        margin: 0 3px;
    }
    .pagination .page-item.active .page-link {
        background-color: #0d6efd;
        border-color: #0d6efd;
        color: white;
    }
    .pagination .page-item.disabled .page-link {
        color: #dee2e6;
    }
    .search-box {
        border-radius: 10px;
        border: 2px solid #e9ecef;
        padding: 8px 16px;
        transition: all 0.3s ease;
    }
    .search-box:focus {
        border-color: #0d6efd;
        box-shadow: 0 0 0 3px rgba(13, 110, 253, 0.1);
    }
    .table-container {
        border-radius: 12px;
        overflow: hidden;
        border: 1px solid #e9ecef;
    }
    .table thead th {
        background: #f8fafc;
        border-bottom: 2px solid #e9ecef;
        font-weight: 600;
        font-size: 0.75rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        color: #6c757d;
        padding: 14px 16px;
    }
    .table tbody td {
        padding: 12px 16px;
        vertical-align: middle;
        border-bottom: 1px solid #f1f3f5;
    }
    .table tbody tr:last-child td {
        border-bottom: none;
    }
    @media (max-width: 768px) {
        .stats-card .icon {
            font-size: 1.4rem;
        }
        .stats-card .stat-number {
            font-size: 1.2rem;
        }
        .detail-row {
            flex-direction: column;
            align-items: flex-start;
            gap: 4px;
        }
        .detail-row .value {
            width: 100%;
        }
    }
</style>

<div class="container-fluid px-0">
    <!-- Stats Cards -->
    <div class="row g-4 mb-4">
        <div class="col-6 col-md-4 col-lg-2">
            <div class="stats-card bg-white rounded-3 shadow-sm border border-gray-200 p-3 text-center">
                <div class="icon text-primary mb-1">📊</div>
                <div class="stat-number fs-4 fw-bold text-gray-800">{{ $deposits->count() }}</div>
                <div class="text-xs text-gray-500 text-uppercase tracking-wider">Total</div>
            </div>
        </div>
        <div class="col-6 col-md-4 col-lg-2">
            <div class="stats-card bg-white rounded-3 shadow-sm border border-gray-200 p-3 text-center">
                <div class="icon text-warning mb-1">⏳</div>
                <div class="stat-number fs-4 fw-bold text-warning">{{ $deposits->where('status', 'pending')->count() }}</div>
                <div class="text-xs text-gray-500 text-uppercase tracking-wider">Pending</div>
            </div>
        </div>
        <div class="col-6 col-md-4 col-lg-2">
            <div class="stats-card bg-white rounded-3 shadow-sm border border-gray-200 p-3 text-center">
                <div class="icon text-info mb-1">📋</div>
                <div class="stat-number fs-4 fw-bold text-info">{{ $deposits->where('is_receipt_required', true)->whereNull('receipt_submitted_at')->count() }}</div>
                <div class="text-xs text-gray-500 text-uppercase tracking-wider">Needs Receipt</div>
            </div>
        </div>
        <div class="col-6 col-md-4 col-lg-2">
            <div class="stats-card bg-white rounded-3 shadow-sm border border-gray-200 p-3 text-center">
                <div class="icon text-success mb-1">✅</div>
                <div class="stat-number fs-4 fw-bold text-success">{{ $deposits->where('status', 'approved')->count() }}</div>
                <div class="text-xs text-gray-500 text-uppercase tracking-wider">Approved</div>
            </div>
        </div>
        <div class="col-6 col-md-4 col-lg-2">
            <div class="stats-card bg-white rounded-3 shadow-sm border border-gray-200 p-3 text-center">
                <div class="icon text-danger mb-1">❌</div>
                <div class="stat-number fs-4 fw-bold text-danger">{{ $deposits->where('status', 'declined')->count() }}</div>
                <div class="text-xs text-gray-500 text-uppercase tracking-wider">Declined</div>
            </div>
        </div>
        <div class="col-6 col-md-4 col-lg-2">
            <div class="stats-card bg-white rounded-3 shadow-sm border border-gray-200 p-3 text-center">
                <div class="icon text-secondary mb-1">⏰</div>
                <div class="stat-number fs-4 fw-bold text-secondary">{{ $deposits->where('status', 'expired')->count() }}</div>
                <div class="text-xs text-gray-500 text-uppercase tracking-wider">Expired</div>
            </div>
        </div>
    </div>

    <!-- Main Table Card -->
    <div class="bg-white rounded-3 shadow-sm border border-gray-200 overflow-hidden">
        <!-- Card Header -->
        <div class="px-4 py-3 bg-gray-50 border-b border-gray-200 d-flex flex-wrap justify-content-between align-items-center gap-2">
            <h5 class="text-gray-800 fw-semibold mb-0">
                <i class="fas fa-list me-2 text-primary"></i>Deposits Management
            </h5>
            <div class="d-flex flex-wrap gap-2">
                <span class="badge bg-primary bg-opacity-10 text-primary">Total: {{ $deposits->count() }}</span>
                <span class="badge bg-warning bg-opacity-10 text-warning">Pending: {{ $deposits->where('status', 'pending')->count() }}</span>
                <span class="badge bg-info bg-opacity-10 text-info">Needs Receipt: {{ $deposits->where('is_receipt_required', true)->whereNull('receipt_submitted_at')->count() }}</span>
                <span class="badge bg-success bg-opacity-10 text-success">Approved: {{ $deposits->where('status', 'approved')->count() }}</span>
                <span class="badge bg-danger bg-opacity-10 text-danger">Declined: {{ $deposits->where('status', 'declined')->count() }}</span>
                <span class="badge bg-secondary bg-opacity-10 text-secondary">Expired: {{ $deposits->where('status', 'expired')->count() }}</span>
            </div>
        </div>

        <!-- Search & Filters -->
        <div class="px-4 py-3 border-bottom border-gray-200 d-flex flex-wrap gap-3 align-items-center">
            <div class="flex-grow-1" style="max-width: 300px;">
                <input type="text" id="searchInput" class="form-control search-box" placeholder="🔍 Search deposits..." onkeyup="searchTable()">
            </div>
            <div>
                <select id="statusFilter" class="form-select form-select-sm" style="border-radius: 10px; border: 2px solid #e9ecef;" onchange="filterTable()">
                    <option value="all">All Status</option>
                    <option value="pending">Pending</option>
                    <option value="approved">Approved</option>
                    <option value="declined">Declined</option>
                    <option value="expired">Expired</option>
                </select>
            </div>
            <div>
                <span class="text-muted small">Showing <span id="showCount">{{ $deposits->count() }}</span> entries</span>
            </div>
        </div>

        <!-- Table -->
        <div class="table-container">
            <div class="table-responsive">
                <table class="table table-hover mb-0" id="depositsTable">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>User</th>
                            <th>Amount</th>
                            <th>Method</th>
                            <th>Transaction ID</th>
                            <th>Receipt</th>
                            <th>Status</th>
                            <th>Date</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody id="tableBody">
                        @forelse($deposits as $index => $deposit)
                        <tr data-status="{{ $deposit->status }}">
                            <td class="fw-medium text-gray-800">{{ $index + 1 }}</td>
                            <td>
                                <div class="fw-semibold text-gray-800">{{ $deposit->user->name ?? 'N/A' }}</div>
                                <small class="text-muted">{{ $deposit->user->user_name ?? '' }}</small>
                            </td>
                            <td class="fw-bold text-success">PKR {{ number_format($deposit->amount, 2) }}</td>
                            <td>
                                <span class="badge bg-primary bg-opacity-10 text-primary">{{ ucfirst($deposit->payment_method) }}</span>
                                @if($deposit->bank_name)
                                    <div><small class="text-muted">{{ $deposit->bank_name }}</small></div>
                                @endif
                            </td>
                            <td><code class="text-muted small">{{ $deposit->transaction_id ?? 'N/A' }}</code></td>
                            <td>
                                @if($deposit->receipt_path)
                                    <a href="{{ asset($deposit->receipt_path) }}" target="_blank" class="btn btn-sm btn-success">
                                        <i class="fas fa-eye me-1"></i> View
                                    </a>
                                @elseif($deposit->is_receipt_required)
                                    <span class="badge bg-warning bg-opacity-10 text-warning">Required</span>
                                @else
                                    <span class="badge bg-secondary bg-opacity-10 text-secondary">Not Required</span>
                                @endif
                            </td>
                            <td>
                                @if($deposit->status == 'pending')
                                    <span class="badge bg-warning bg-opacity-10 text-warning d-inline-flex align-items-center gap-1">
                                        <span class="spinner-grow spinner-grow-sm text-warning" role="status"></span> Pending
                                    </span>
                                    @if($deposit->is_receipt_required && !$deposit->receipt_submitted_at)
                                        <div><small class="text-danger">Awaiting Receipt</small></div>
                                    @endif
                                @elseif($deposit->status == 'approved')
                                    <span class="badge bg-success bg-opacity-10 text-success">✅ Approved</span>
                                @elseif($deposit->status == 'declined')
                                    <span class="badge bg-danger bg-opacity-10 text-danger">❌ Declined</span>
                                @elseif($deposit->status == 'expired')
                                    <span class="badge bg-secondary bg-opacity-10 text-secondary">⏰ Expired</span>
                                @endif
                                @if($deposit->admin_notes)
                                    <div><small class="text-warning">📝 {{ $deposit->admin_notes }}</small></div>
                                @endif
                            </td>
                            <td>
                                <div class="text-nowrap">{{ $deposit->created_at->format('Y-m-d') }}</div>
                                <small class="text-muted">{{ $deposit->created_at->format('H:i') }}</small>
                            </td>
                            <td>
                                <div class="d-flex justify-content-center gap-1">
                                    <button onclick="viewDeposit({{ $deposit->id }})" class="action-btn bg-primary bg-opacity-10 text-primary" title="View Details">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    @if($deposit->status == 'pending')
                                        <button onclick="updateDepositStatus({{ $deposit->id }}, 'approved')" class="action-btn bg-success bg-opacity-10 text-success" title="Approve">
                                            <i class="fas fa-check"></i>
                                        </button>
                                        <button onclick="updateDepositStatus({{ $deposit->id }}, 'declined')" class="action-btn bg-danger bg-opacity-10 text-danger" title="Decline">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="9" class="text-center py-5 text-muted">
                                <div class="display-4 mb-2">📭</div>
                                <p class="mb-0">No deposits found</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Pagination -->
        <div class="px-4 py-3 border-top border-gray-200 d-flex justify-content-between align-items-center flex-wrap gap-2">
            <div class="text-muted small">
                Showing <span id="pageStart">1</span> to <span id="pageEnd">{{ min(10, $deposits->count()) }}</span> of <span id="totalEntries">{{ $deposits->count() }}</span> entries
            </div>
            <nav>
                <ul class="pagination pagination-sm mb-0" id="paginationControls">
                    <li class="page-item disabled" id="prevPage">
                        <a class="page-link" href="#" onclick="changePage('prev')">«</a>
                    </li>
                    <li class="page-item active" id="page1"><a class="page-link" href="#" onclick="goToPage(1)">1</a></li>
                    <li class="page-item" id="page2"><a class="page-link" href="#" onclick="goToPage(2)">2</a></li>
                    <li class="page-item" id="page3"><a class="page-link" href="#" onclick="goToPage(3)">3</a></li>
                    <li class="page-item" id="nextPage">
                        <a class="page-link" href="#" onclick="changePage('next')">»</a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</div>

<!-- View Deposit Modal (Bootstrap 5) -->
<div class="modal fade" id="viewDepositModal" tabindex="-1" aria-labelledby="viewDepositModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content shadow-lg">
            <div class="modal-header bg-primary bg-opacity-10">
                <h5 class="modal-title fw-semibold" id="viewDepositModalLabel">
                    <i class="fas fa-file-invoice me-2 text-primary"></i>Deposit Details
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="depositDetails">
                <div class="text-center py-5">
                    <div class="spinner-border text-primary" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                    <p class="text-muted mt-2">Loading deposit details...</p>
                </div>
            </div>
            <div class="modal-footer bg-light">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script>
// Pagination variables
let currentPage = 1;
let rowsPerPage = 10;
let filteredRows = [];

// Initialize pagination
document.addEventListener('DOMContentLoaded', function() {
    filterTable();
});

function filterTable() {
    const searchTerm = document.getElementById('searchInput').value.toLowerCase();
    const statusFilter = document.getElementById('statusFilter').value;
    const rows = document.querySelectorAll('#tableBody tr');
    
    filteredRows = [];
    rows.forEach(row => {
        const status = row.dataset.status || '';
        const text = row.textContent.toLowerCase();
        const matchStatus = statusFilter === 'all' || status === statusFilter;
        const matchSearch = text.includes(searchTerm);
        
        if (matchStatus && matchSearch) {
            filteredRows.push(row);
            row.style.display = '';
        } else {
            row.style.display = 'none';
        }
    });
    
    document.getElementById('showCount').textContent = filteredRows.length;
    document.getElementById('totalEntries').textContent = filteredRows.length;
    
    // Reset to first page
    currentPage = 1;
    renderPage();
}

function searchTable() {
    filterTable();
}

function renderPage() {
    const totalPages = Math.ceil(filteredRows.length / rowsPerPage);
    const start = (currentPage - 1) * rowsPerPage;
    const end = Math.min(start + rowsPerPage, filteredRows.length);
    
    // Hide all rows
    filteredRows.forEach(row => row.style.display = 'none');
    
    // Show current page rows
    for (let i = start; i < end; i++) {
        if (filteredRows[i]) {
            filteredRows[i].style.display = '';
        }
    }
    
    // Update pagination info
    document.getElementById('pageStart').textContent = filteredRows.length > 0 ? start + 1 : 0;
    document.getElementById('pageEnd').textContent = end;
    
    // Update pagination buttons
    const prevBtn = document.getElementById('prevPage');
    const nextBtn = document.getElementById('nextPage');
    
    prevBtn.classList.toggle('disabled', currentPage === 1);
    nextBtn.classList.toggle('disabled', currentPage >= totalPages || totalPages === 0);
    
    // Show/hide page buttons
    for (let i = 1; i <= 3; i++) {
        const pageBtn = document.getElementById('page' + i);
        if (pageBtn) {
            if (i <= totalPages) {
                pageBtn.style.display = '';
                pageBtn.classList.toggle('active', i === currentPage);
                pageBtn.querySelector('a').textContent = i;
            } else {
                pageBtn.style.display = 'none';
            }
        }
    }
}

function changePage(direction) {
    const totalPages = Math.ceil(filteredRows.length / rowsPerPage);
    if (direction === 'prev' && currentPage > 1) {
        currentPage--;
    } else if (direction === 'next' && currentPage < totalPages) {
        currentPage++;
    }
    renderPage();
}

function goToPage(page) {
    currentPage = page;
    renderPage();
}

function viewDeposit(id) {
    const modal = new bootstrap.Modal(document.getElementById('viewDepositModal'));
    modal.show();
    
    document.getElementById('depositDetails').innerHTML = `
        <div class="text-center py-5">
            <div class="spinner-border text-primary" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
            <p class="text-muted mt-2">Loading deposit details...</p>
        </div>
    `;

    fetch(`/admin/deposits/${id}`, {
        headers: {
            'Accept': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        credentials: 'include'
    })
    .then(response => response.json())
    .then(data => {
        const d = data.deposit;
        const date = new Date(d.created_at);
        const formattedDate = date.toLocaleDateString('en-PK', {
            day: '2-digit',
            month: 'short',
            year: 'numeric'
        });
        const formattedTime = date.toLocaleTimeString('en-PK', {
            hour: '2-digit',
            minute: '2-digit',
            hour12: true
        });

        let statusBadge = '';
        if (d.status === 'pending') {
            statusBadge = '<span class="badge bg-warning bg-opacity-10 text-warning"><span class="spinner-grow spinner-grow-sm me-1"></span>Pending</span>';
        } else if (d.status === 'approved') {
            statusBadge = '<span class="badge bg-success bg-opacity-10 text-success">✅ Approved</span>';
        } else if (d.status === 'declined') {
            statusBadge = '<span class="badge bg-danger bg-opacity-10 text-danger">❌ Declined</span>';
        } else if (d.status === 'expired') {
            statusBadge = '<span class="badge bg-secondary bg-opacity-10 text-secondary">⏰ Expired</span>';
        }

        let receiptHtml = 'Not uploaded';
        if (d.receipt_path) {
            receiptHtml = `<a href="${d.receipt_url}" target="_blank" class="btn btn-sm btn-success"><i class="fas fa-eye me-1"></i>View Receipt</a>`;
        } else if (d.is_receipt_required) {
            receiptHtml = '<span class="badge bg-warning bg-opacity-10 text-warning">Required (Pending)</span>';
        } else {
            receiptHtml = '<span class="badge bg-secondary bg-opacity-10 text-secondary">Not Required</span>';
        }

        let imageHtml = '';
        if (d.image_url) {
            imageHtml = `<a href="${d.image_url}" target="_blank" class="btn btn-sm btn-info"><i class="fas fa-image me-1"></i>View Image</a>`;
        }

        document.getElementById('depositDetails').innerHTML = `
            <div class="row g-3">
                <div class="col-md-6">
                    <div class="detail-row">
                        <span class="label">ID</span>
                        <span class="value">#${d.id}</span>
                    </div>
                    <div class="detail-row">
                        <span class="label">User</span>
                        <span class="value">${d.user?.name || 'N/A'} (${d.user?.user_name || 'N/A'})</span>
                    </div>
                    <div class="detail-row">
                        <span class="label">Amount</span>
                        <span class="value text-success">PKR ${parseFloat(d.amount).toLocaleString()}</span>
                    </div>
                    <div class="detail-row">
                        <span class="label">Payment Method</span>
                        <span class="value">${d.payment_method || 'N/A'}</span>
                    </div>
                    <div class="detail-row">
                        <span class="label">Bank Name</span>
                        <span class="value">${d.bank_name || 'N/A'}</span>
                    </div>
                    <div class="detail-row">
                        <span class="label">Account Number</span>
                        <span class="value">${d.account_number || 'N/A'}</span>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="detail-row">
                        <span class="label">Account Holder</span>
                        <span class="value">${d.account_holder_name || 'N/A'}</span>
                    </div>
                    <div class="detail-row">
                        <span class="label">User Account</span>
                        <span class="value">${d.user_account_number || 'N/A'}</span>
                    </div>
                    <div class="detail-row">
                        <span class="label">Transaction ID</span>
                        <span class="value"><code>${d.transaction_id || 'N/A'}</code></span>
                    </div>
                    <div class="detail-row">
                        <span class="label">Branch Code</span>
                        <span class="value">${d.branch_code || 'N/A'}</span>
                    </div>
                    <div class="detail-row">
                        <span class="label">Receipt</span>
                        <span class="value">${receiptHtml}</span>
                    </div>
                    ${imageHtml ? `<div class="detail-row"><span class="label">Image</span><span class="value">${imageHtml}</span></div>` : ''}
                    <div class="detail-row">
                        <span class="label">Status</span>
                        <span class="value">${statusBadge}</span>
                    </div>
                </div>
                ${d.admin_notes ? `
                <div class="col-12">
                    <div class="detail-row" style="border-left-color: #ffc107;">
                        <span class="label">Admin Notes</span>
                        <span class="value">${d.admin_notes}</span>
                    </div>
                </div>` : ''}
                <div class="col-md-6">
                    <div class="detail-row">
                        <span class="label">Created</span>
                        <span class="value">${formattedDate} at ${formattedTime}</span>
                    </div>
                </div>
                ${d.expires_at ? `
                <div class="col-md-6">
                    <div class="detail-row">
                        <span class="label">Expires</span>
                        <span class="value">${new Date(d.expires_at).toLocaleString()}</span>
                    </div>
                </div>` : ''}
                ${d.approved_at ? `
                <div class="col-md-6">
                    <div class="detail-row" style="border-left-color: #198754;">
                        <span class="label">Approved</span>
                        <span class="value">${new Date(d.approved_at).toLocaleString()}</span>
                    </div>
                </div>` : ''}
                ${d.declined_at ? `
                <div class="col-md-6">
                    <div class="detail-row" style="border-left-color: #dc3545;">
                        <span class="label">Declined</span>
                        <span class="value">${new Date(d.declined_at).toLocaleString()}</span>
                    </div>
                </div>` : ''}
            </div>
        `;
    })
    .catch(error => {
        console.error('Error:', error);
        document.getElementById('depositDetails').innerHTML = `
            <div class="text-center py-5 text-danger">
                <i class="fas fa-exclamation-circle fa-3x mb-3"></i>
                <p>Failed to load deposit details</p>
            </div>
        `;
    });
}

function updateDepositStatus(id, status) {
    if (!confirm(`Are you sure you want to ${status} this deposit?`)) return;

    const adminNotes = prompt('Add admin notes (optional):');

    fetch(`/admin/deposits/${id}/update-status`, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'Content-Type': 'application/json',
            'Accept': 'application/json'
        },
        credentials: 'include',
        body: JSON.stringify({
            status: status,
            admin_notes: adminNotes || null
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert('✅ ' + data.message);
            location.reload();
        } else {
            alert('❌ ' + data.message);
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('❌ Error updating status');
    });
}

// Close modal on Escape key
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        const modal = bootstrap.Modal.getInstance(document.getElementById('viewDepositModal'));
        if (modal) modal.hide();
    }
});
</script>
@endsection