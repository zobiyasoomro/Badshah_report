@extends('admin.layouts.master')
@section('title', 'Dashboard')
@section('admin_content')

<div class="container-fluid py-4">
    <!-- Page Header -->
    <div class="row mb-4">
        <div class="col">
            <h1 class="h2 fw-bold text-dark mb-1">
                <i class="fas fa-chart-pie text-primary me-2"></i>Admin Dashboard
            </h1>
            <p class="text-muted small mt-1">Central overview of your platform's performance metrics.</p>
        </div>
    </div>

    <!-- Stats Cards Row 1 -->
    <div class="row g-4 mb-4">
        <!-- Withdraw Card -->
        <div class="col-12 col-sm-6 col-xl-3">
            <div class="card border-0 shadow-sm rounded-4 h-100">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <p class="text-uppercase fw-bold text-muted small mb-1">Withdraw</p>
                            <h3 class="fw-bold text-dark mb-0">Rs. {{ number_format($withdrawTotal, 2) }}</h3>
                        </div>
                        <div class="rounded-3 d-flex align-items-center justify-content-center" 
                             style="width: 48px; height: 48px; background: rgba(16, 185, 129, 0.1);">
                            <i class="fas fa-wallet text-success fs-4"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Deposit Card -->
        <div class="col-12 col-sm-6 col-xl-3">
            <div class="card border-0 shadow-sm rounded-4 h-100">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <p class="text-uppercase fw-bold text-muted small mb-1">Deposit</p>
                            <h3 class="fw-bold text-dark mb-0">Rs. {{ number_format($depositTotal, 2) }}</h3>
                        </div>
                        <div class="rounded-3 d-flex align-items-center justify-content-center" 
                             style="width: 48px; height: 48px; background: rgba(245, 158, 11, 0.1);">
                            <i class="fas fa-chart-line text-warning fs-4"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Orders Card -->
        <div class="col-12 col-sm-6 col-xl-3">
            <div class="card border-0 shadow-sm rounded-4 h-100">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <p class="text-uppercase fw-bold text-muted small mb-1">Orders</p>
                            <h3 class="fw-bold text-dark mb-0">{{ $ordersCount }}</h3>
                        </div>
                        <div class="rounded-3 d-flex align-items-center justify-content-center" 
                             style="width: 48px; height: 48px; background: rgba(59, 130, 246, 0.1);">
                            <i class="fas fa-box-open text-primary fs-4"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Reviews Card -->
        <div class="col-12 col-sm-6 col-xl-3">
            <div class="card border-0 shadow-sm rounded-4 h-100">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <p class="text-uppercase fw-bold text-muted small mb-1">Reviews</p>
                            <h3 class="fw-bold text-dark mb-0">{{ $reviewsCount }}</h3>
                        </div>
                        <div class="rounded-3 d-flex align-items-center justify-content-center" 
                             style="width: 48px; height: 48px; background: rgba(139, 92, 246, 0.1);">
                            <i class="fas fa-star text-purple-500 fs-4"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Stats Cards Row 2 -->
    <div class="row g-4 mb-4">
        <!-- Contacts Card -->
        <div class="col-12 col-sm-6 col-lg-4">
            <div class="card border-0 shadow-sm rounded-4 h-100">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <p class="text-uppercase fw-bold text-muted small mb-1">Contacts</p>
                            <h3 class="fw-bold text-dark mb-0">{{ $contactsCount }}</h3>
                        </div>
                        <div class="rounded-3 d-flex align-items-center justify-content-center" 
                             style="width: 48px; height: 48px; background: rgba(236, 72, 153, 0.1);">
                            <i class="fas fa-envelope text-pink-500 fs-4"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Unregistered Accounts Card -->
        <div class="col-12 col-sm-6 col-lg-4">
            <div class="card border-0 shadow-sm rounded-4 h-100">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <p class="text-uppercase fw-bold text-muted small mb-1">Unregistered Accounts</p>
                            <h3 class="fw-bold text-dark mb-0">{{ $unregisteredAccountsCount }}</h3>
                        </div>
                        <div class="rounded-3 d-flex align-items-center justify-content-center" 
                             style="width: 48px; height: 48px; background: rgba(14, 165, 233, 0.1);">
                            <i class="fas fa-user-slash text-info fs-4"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Users Card -->
        <div class="col-12 col-sm-6 col-lg-4">
            <div class="card border-0 shadow-sm rounded-4 h-100">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <p class="text-uppercase fw-bold text-muted small mb-1">Users</p>
                            <h3 class="fw-bold text-dark mb-0">{{ $usersCount }}</h3>
                        </div>
                        <div class="rounded-3 d-flex align-items-center justify-content-center" 
                             style="width: 48px; height: 48px; background: rgba(249, 115, 22, 0.1);">
                            <i class="fas fa-users text-orange-500 fs-4"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts Row 1 -->
    <div class="row g-4 mb-4">
        <!-- Sign-up Chart -->
        <div class="col-12 col-lg-8">
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-header bg-white border-0 py-3 px-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <h6 class="mb-0 fw-bold text-dark">User Sign-ups (Last 30 Days)</h6>
                        <span class="badge bg-light text-muted rounded-pill px-3 py-2 small fw-normal">
                            <i class="fas fa-circle text-primary me-1" style="font-size: 0.5rem;"></i> Live Active
                        </span>
                    </div>
                </div>
                <div class="card-body p-4">
                    <div style="height: 260px;">
                        <canvas id="signupChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <!-- Orders Doughnut Chart -->
        <div class="col-12 col-lg-4">
            <div class="card border-0 shadow-sm rounded-4 h-100">
                <div class="card-header bg-white border-0 py-3 px-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <h6 class="mb-0 fw-bold text-dark">Orders by Plane</h6>
                        <span class="badge bg-light text-muted rounded-pill px-3 py-2 small fw-normal">
                            <i class="fas fa-circle text-primary me-1" style="font-size: 0.5rem;"></i> Popularity
                        </span>
                    </div>
                </div>
                <div class="card-body p-4 d-flex align-items-center justify-content-center">
                    <div style="height: 240px; width: 100%;">
                        <canvas id="orderChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts Row 2 -->
    <div class="row g-4">
        <!-- Deposit Trend Chart -->
        <div class="col-12 col-lg-6">
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-header bg-white border-0 py-3 px-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <h6 class="mb-0 fw-bold text-dark">Deposit Trend (Last 30 Days)</h6>
                        <span class="badge bg-light text-muted rounded-pill px-3 py-2 small fw-normal">
                            <i class="fas fa-circle text-warning me-1" style="font-size: 0.5rem;"></i> Approved Amounts
                        </span>
                    </div>
                </div>
                <div class="card-body p-4">
                    <div style="height: 260px;">
                        <canvas id="depositChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <!-- Withdraw Trend Chart -->
        <div class="col-12 col-lg-6">
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-header bg-white border-0 py-3 px-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <h6 class="mb-0 fw-bold text-dark">Withdraw Trend (Last 30 Days)</h6>
                        <span class="badge bg-light text-muted rounded-pill px-3 py-2 small fw-normal">
                            <i class="fas fa-circle text-success me-1" style="font-size: 0.5rem;"></i> Approved Amounts
                        </span>
                    </div>
                </div>
                <div class="card-body p-4">
                    <div style="height: 260px;">
                        <canvas id="withdrawChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Font Awesome 6 -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />

<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // ===================== USER SIGN-UP CHART =====================
    const signupCtx = document.getElementById('signupChart').getContext('2d');
    new Chart(signupCtx, {
        type: 'line',
        data: {
            labels: @json($signupChartLabels),
            datasets: [{
                label: 'New Sign-ups',
                data: @json($signupChartData),
                borderColor: '#2A4563',
                backgroundColor: 'rgba(42, 69, 99, 0.08)',
                borderWidth: 2,
                tension: 0.35,
                fill: true,
                pointRadius: 3,
                pointBackgroundColor: '#2A4563',
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { display: false }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: { precision: 0 }
                }
            }
        }
    });

    // ===================== ORDERS DOUGHNUT CHART =====================
    const orderCtx = document.getElementById('orderChart').getContext('2d');
    new Chart(orderCtx, {
        type: 'doughnut',
        data: {
            labels: @json($orderStatusLabels),
            datasets: [{
                data: @json($orderStatusData),
                backgroundColor: [
                    '#2A4563', '#F59E0B', '#10B981', '#EF4444',
                    '#8B5CF6', '#EC4899', '#3B82F6', '#14B8A6',
                ],
                borderColor: '#ffffff',
                borderWidth: 2,
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: {
                        boxWidth: 12,
                        padding: 12,
                        font: { size: 11 }
                    }
                }
            },
            cutout: '70%',
        }
    });

    // ===================== DEPOSIT TREND CHART =====================
    const depositCtx = document.getElementById('depositChart').getContext('2d');
    new Chart(depositCtx, {
        type: 'line',
        data: {
            labels: @json($depositChartLabels),
            datasets: [{
                label: 'Deposit Amount (Rs.)',
                data: @json($depositChartData),
                borderColor: '#F59E0B',
                backgroundColor: 'rgba(245, 158, 11, 0.1)',
                borderWidth: 2,
                tension: 0.35,
                fill: true,
                pointRadius: 3,
                pointBackgroundColor: '#F59E0B',
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { display: false }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: function(value) { return 'Rs. ' + value.toLocaleString(); }
                    }
                }
            }
        }
    });

    // ===================== WITHDRAW TREND CHART =====================
    const withdrawCtx = document.getElementById('withdrawChart').getContext('2d');
    new Chart(withdrawCtx, {
        type: 'line',
        data: {
            labels: @json($withdrawalChartLabels),
            datasets: [{
                label: 'Withdraw Amount (Rs.)',
                data: @json($withdrawalChartData),
                borderColor: '#10B981',
                backgroundColor: 'rgba(16, 185, 129, 0.1)',
                borderWidth: 2,
                tension: 0.35,
                fill: true,
                pointRadius: 3,
                pointBackgroundColor: '#10B981',
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { display: false }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: function(value) { return 'Rs. ' + value.toLocaleString(); }
                    }
                }
            }
        }
    });
});
</script>


<style>
    /* Custom Purple color class */
    .text-purple-500 {
        color: #8B5CF6;
    }
    .text-pink-500 {
        color: #EC4899;
    }
    .text-orange-500 {
        color: #F97316;
    }
    
    /* Card hover effect */
    .card {
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }
    .card:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(0,0,0,0.08) !important;
    }
    
    /* Badge styling */
    .badge.bg-light {
        background-color: #f8f9fa !important;
        color: #6c757d !important;
    }
    
    /* Responsive adjustments */
    @media (max-width: 768px) {
        .card-body {
            padding: 1.25rem !important;
        }
        .card-header {
            padding: 0.75rem 1.25rem !important;
        }
        .card-header h6 {
            font-size: 0.9rem;
        }
        .badge {
            font-size: 0.7rem !important;
            padding: 0.25rem 0.75rem !important;
        }
    }
</style>
@endsection