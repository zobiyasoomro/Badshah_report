@extends('layouts.master')

@section('content')

@include('components.pagesbanner', [
    'banner_title' => 'Deposit History',
    'banner_button_text' => 'LEARN MORE',
    'banner_button_url' => 'WHY YOU CHOOSE US',
    'banner_description' => 'View all your deposit transactions and their status.'
])

<style>
    .history-section {
        padding: 60px 0;
        background: #ffff;
        min-height: 500px;
    }

    .history-card {
        background: linear-gradient(160deg, #23395B 0%, #16273D 100%);
        border: 1px solid rgba(34, 211, 238, 0.15);
        border-radius: 16px;
        padding: 25px;
        margin-bottom: 30px;
        transition: all 0.3s ease;
    }

    .history-card:hover {
        border-color: rgba(34, 211, 238, 0.4);
        box-shadow: 0 8px 30px rgba(34, 211, 238, 0.08);
    }

    .status-filter {
        display: flex;
        gap: 12px;
        flex-wrap: wrap;
        margin-bottom: 30px;
    }

    .status-filter-btn {
        padding: 10px 24px;
        border-radius: 50px;
        border: 2px solid rgba(148, 163, 184, 0.25);
        background: transparent;
        color: #9FB3C8;
        font-weight: 600;
        font-size: 0.9rem;
        cursor: pointer;
        transition: all 0.3s ease;
        font-family: inherit;
    }

    .status-filter-btn:hover {
        border-color: rgba(34, 211, 238, 0.5);
        color: #F1F5F9;
        transform: translateY(-2px);
    }

    .status-filter-btn.active {
        background: #22D3EE;
        border-color: #22D3EE;
        color: #0f1c2e;
        box-shadow: 0 4px 15px rgba(34, 211, 238, 0.3);
    }

    .status-filter-btn .badge-count {
        background: rgba(255, 255, 255, 0.1);
        padding: 2px 10px;
        border-radius: 20px;
        font-size: 0.75rem;
        margin-left: 6px;
    }

    .status-filter-btn.active .badge-count {
        background: rgba(15, 28, 46, 0.2);
    }

    .history-table-wrapper {
        overflow-x: auto;
        border-radius: 12px;
        border: 1px solid rgba(148, 163, 184, 0.1);
    }

    .history-table {
        width: 100%;
        border-collapse: collapse;
        font-size: 0.9rem;
        min-width: 700px;
    }

    .history-table th {
        background: rgba(34, 211, 238, 0.06);
        color: #22D3EE;
        font-weight: 600;
        padding: 14px 18px;
        text-align: left;
        border-bottom: 2px solid rgba(34, 211, 238, 0.15);
        font-size: 0.8rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .history-table td {
        padding: 14px 18px;
        border-bottom: 1px solid rgba(148, 163, 184, 0.06);
        color: #F1F5F9;
        vertical-align: middle;
    }

    .history-table tr:hover td {
        background: rgba(34, 211, 238, 0.03);
    }

    .history-table tr:last-child td {
        border-bottom: none;
    }

    .status-badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 5px 14px;
        border-radius: 50px;
        font-size: 0.75rem;
        font-weight: 600;
        text-transform: capitalize;
    }

    .status-badge .dot {
        width: 8px;
        height: 8px;
        border-radius: 50%;
        display: inline-block;
    }

    .status-badge.pending {
        background: rgba(255, 165, 0, 0.15);
        color: #FFA500;
    }

    .status-badge.pending .dot {
        background: #FFA500;
        animation: pulse 1.5s ease-in-out infinite;
    }

    .status-badge.approved {
        background: rgba(34, 211, 238, 0.15);
        color: #22D3EE;
    }

    .status-badge.approved .dot {
        background: #22D3EE;
    }

    .status-badge.declined {
        background: rgba(239, 85, 85, 0.15);
        color: #ef5555;
    }

    .status-badge.declined .dot {
        background: #ef5555;
    }

    .status-badge.completed {
        background: rgba(0, 178, 130, 0.15);
        color: #00B282;
    }

    .status-badge.completed .dot {
        background: #00B282;
    }

    .status-badge.expired {
        background: rgba(148, 163, 184, 0.15);
        color: #7C8DA3;
    }

    .status-badge.expired .dot {
        background: #7C8DA3;
    }

    @keyframes pulse {
        0%, 100% { opacity: 1; transform: scale(1); }
        50% { opacity: 0.5; transform: scale(0.8); }
    }

    .amount-positive {
        color: #00B282;
        font-weight: 700;
    }

    .empty-state {
        text-align: center;
        padding: 60px 20px;
        color: #7C8DA3;
    }

    .empty-state .empty-icon {
        font-size: 4rem;
        margin-bottom: 20px;
        opacity: 0.5;
    }

    .empty-state h3 {
        color: #F1F5F9;
        margin-bottom: 10px;
    }

    .loading-spinner-center {
        display: flex;
        justify-content: center;
        align-items: center;
        padding: 60px 0;
    }

    .loading-spinner-center .spinner {
        width: 40px;
        height: 40px;
        border: 4px solid rgba(34, 211, 238, 0.1);
        border-top: 4px solid #22D3EE;
        border-radius: 50%;
        animation: spin 1s linear infinite;
    }

    @keyframes spin {
        to { transform: rotate(360deg); }
    }

    .txn-id {
        font-family: monospace;
        font-size: 0.75rem;
        background: rgba(255, 255, 255, 0.05);
        padding: 2px 8px;
        border-radius: 4px;
        color: #22D3EE;
        letter-spacing: 0.5px;
    }

    @media (max-width: 768px) {
        .history-section {
            padding: 30px 0;
        }

        .history-card {
            padding: 16px;
        }

        .status-filter {
            gap: 8px;
        }

        .status-filter-btn {
            padding: 8px 16px;
            font-size: 0.8rem;
        }

        .history-table th,
        .history-table td {
            padding: 10px 12px;
            font-size: 0.8rem;
        }

        .history-table {
            min-width: 500px;
        }
    }

    @media (max-width: 480px) {
        .status-filter-btn {
            padding: 6px 12px;
            font-size: 0.7rem;
        }

        .history-table th,
        .history-table td {
            padding: 8px 10px;
            font-size: 0.7rem;
        }

        .status-badge {
            padding: 3px 10px;
            font-size: 0.65rem;
        }
    }
</style>

<div class="history-section">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="history-card">
                    <div class="d-flex flex-wrap justify-content-between align-items-center mb-4">
                        <h4 style="color:#F1F5F9; margin:0;">
                            📊 Deposit Transactions
                            <span style="font-size:0.8rem; color:#7C8DA3; font-weight:400; margin-left:10px;">
                                (Total: <span id="totalCount">0</span>)
                            </span>
                        </h4>
                        <span style="color:#7C8DA3; font-size:0.8rem;">
                            Showing transactions for: <strong style="color:#22D3EE;" id="userNameDisplay">User</strong>
                        </span>
                    </div>

                    <div class="status-filter" id="statusFilter">
                        <button class="status-filter-btn active" data-status="all">
                            All <span class="badge-count" id="allCount">0</span>
                        </button>
                        <button class="status-filter-btn" data-status="pending">
                            ⏳ Pending <span class="badge-count" id="pendingCount">0</span>
                        </button>
                        <button class="status-filter-btn" data-status="approved">
                            ✅ Approved <span class="badge-count" id="approvedCount">0</span>
                        </button>
                        <button class="status-filter-btn" data-status="declined">
                            ❌ Declined <span class="badge-count" id="declinedCount">0</span>
                        </button>
                        <button class="status-filter-btn" data-status="expired">
                            ⏰ Expired <span class="badge-count" id="expiredCount">0</span>
                        </button>
                    </div>

                    <div class="history-table-wrapper">
                        <div id="depositTableContainer">
                            <table class="history-table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Amount</th>
                                        <th>Payment Method</th>
                                        <th>Transaction ID</th>
                                        <th>Account Details</th>
                                        <th>Status</th>
                                        <th>Date & Time</th>
                                    </tr>
                                </thead>
                                <tbody id="depositTableBody">
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div id="loadingState" class="loading-spinner-center" style="display:none;">
                        <div class="spinner"></div>
                    </div>

                    <div id="emptyState" class="empty-state" style="display:none;">
                        <div class="empty-icon">📭</div>
                        <h3>No Deposit Transactions Found</h3>
                        <p>You haven't made any deposits yet. Start depositing to see your history here.</p>
                       
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        loadDepositHistory();
    });

    function loadDepositHistory(status = 'all') {
        const token = document.querySelector('input[name="_token"]')?.value || 
                      document.querySelector('meta[name="csrf-token"]')?.content;

        document.getElementById('loadingState').style.display = 'flex';
        document.getElementById('depositTableContainer').style.display = 'none';
        document.getElementById('emptyState').style.display = 'none';

        fetch('/api/deposit/user-deposits', {
            headers: {
                'Accept': 'application/json',
                'X-CSRF-TOKEN': token,
            },
            credentials: 'include'
        })
        .then(response => response.json())
        .then(data => {
            document.getElementById('loadingState').style.display = 'none';

            if (data.success && data.deposits && data.deposits.length > 0) {
                renderDepositTable(data.deposits, status);
                updateFilters(data.deposits);
            } else {
                document.getElementById('depositTableContainer').style.display = 'none';
                document.getElementById('emptyState').style.display = 'block';
            }
        })
        .catch(error => {
            console.error('Error loading deposit history:', error);
            document.getElementById('loadingState').style.display = 'none';
            document.getElementById('depositTableContainer').style.display = 'none';
            document.getElementById('emptyState').style.display = 'block';
            document.getElementById('emptyState').querySelector('h3').textContent = 'Error Loading Data';
            document.getElementById('emptyState').querySelector('p').textContent = 'Please try again later.';
        });
    }

    function renderDepositTable(deposits, status) {
        const tbody = document.getElementById('depositTableBody');
        const container = document.getElementById('depositTableContainer');

        let filteredDeposits = deposits;
        if (status !== 'all') {
            filteredDeposits = deposits.filter(d => d.status === status);
        }

        if (filteredDeposits.length === 0) {
            container.style.display = 'none';
            document.getElementById('emptyState').style.display = 'block';
            document.getElementById('emptyState').querySelector('h3').textContent = `No ${status} Deposits Found`;
            document.getElementById('emptyState').querySelector('p').textContent = `You don't have any ${status} deposits.`;
            return;
        }

        container.style.display = 'block';
        document.getElementById('emptyState').style.display = 'none';

        let html = '';
        filteredDeposits.forEach((deposit, index) => {
            const date = new Date(deposit.created_at);
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

            const statusClass = deposit.status.toLowerCase();
            const statusIcon = getStatusIcon(deposit.status);

            // Get payment method display
            let paymentMethodDisplay = deposit.payment_method || 'N/A';
            
            // Account details
            let accountDetails = '';
            if (deposit.account_holder_name) {
                accountDetails += deposit.account_holder_name;
            }
            if (deposit.user_account_number) {
                accountDetails += ' (' + deposit.user_account_number + ')';
            }
            if (!accountDetails) {
                accountDetails = 'N/A';
            }

            html += `
                <tr>
                    <td>${index + 1}</td>
                    <td class="amount-positive">PKR ${parseFloat(deposit.amount).toLocaleString()}</td>
                    <td>${paymentMethodDisplay}</td>
                    <td><span class="txn-id">${deposit.transaction_id || 'N/A'}</span></td>
                    <td style="font-size:0.8rem; color:#9FB3C8;">${accountDetails}</td>
                    <td>
                        <span class="status-badge ${statusClass}">
                            <span class="dot"></span>
                            ${statusIcon} ${deposit.status}
                        </span>
                    </td>
                    <td style="font-size:0.8rem; color:#9FB3C8;">
                        ${formattedDate}<br>
                        <span style="font-size:0.7rem; color:#7C8DA3;">${formattedTime}</span>
                    </td>
                </tr>
            `;
        });

        tbody.innerHTML = html;
        document.getElementById('totalCount').textContent = filteredDeposits.length;

        const userMeta = document.querySelector('meta[name="user-name"]');
        if (userMeta) {
            document.getElementById('userNameDisplay').textContent = userMeta.content;
        }
    }

    function getStatusIcon(status) {
        const icons = {
            'pending': '⏳',
            'approved': '✅',
            'declined': '❌',
            'completed': '✔️',
            'expired': '⏰'
        };
        return icons[status.toLowerCase()] || '📌';
    }

    function updateFilters(deposits) {
        const counts = {
            all: deposits.length,
            pending: deposits.filter(d => d.status === 'pending').length,
            approved: deposits.filter(d => d.status === 'approved').length,
            declined: deposits.filter(d => d.status === 'declined').length,
            expired: deposits.filter(d => d.status === 'expired').length,
        };

        document.getElementById('allCount').textContent = counts.all;
        document.getElementById('pendingCount').textContent = counts.pending;
        document.getElementById('approvedCount').textContent = counts.approved;
        document.getElementById('declinedCount').textContent = counts.declined;
        document.getElementById('expiredCount').textContent = counts.expired;
        document.getElementById('totalCount').textContent = counts.all;
    }

    document.querySelectorAll('.status-filter-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            document.querySelectorAll('.status-filter-btn').forEach(b => b.classList.remove('active'));
            this.classList.add('active');

            const status = this.dataset.status;
            loadDepositHistory(status);
        });
    });
</script>

@endsection