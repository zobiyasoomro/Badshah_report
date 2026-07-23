@extends('admin.layouts.master')
@section('title', 'Platforms')
@section('admin_content')

<div class="container-fluid py-4">
    <div class="row align-items-center mb-4">
        <div class="col">
            <h1 class="h2 fw-bold text-dark mb-1">Platforms</h1>
            <p class="text-muted small mt-1">Manage the partner platforms shown on the public site.</p>
        </div>
        <div class="col-auto">
            <a href="{{ route('admin.platforms.create') }}"
               class="btn btn-primary btn-sm fw-semibold px-4 py-2 rounded-3 shadow-lg" 
               style="background-color: #2A4563; border-color: #2A4563;">
                <i class="fa-solid fa-plus me-2"></i>
                Add Platform
            </a>
        </div>
    </div>

    @if(session('success'))
        <div id="successAlert" class="alert alert-success alert-dismissible fade show d-flex align-items-center gap-2 rounded-3 mb-4" role="alert" style="background-color: #f0fdf4; border-color: #bbf7d0; color: #166534;">
            <i class="fa-solid fa-circle-check"></i>
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
        <div class="card-body p-0">
            @if($platforms->count())
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="bg-light border-bottom" style="background-color: #f8f9fa;">
                            <tr>
                                <th class="px-3 py-3 text-uppercase fw-semibold small text-muted" style="width: 80px;">Logo</th>
                                <th class="px-3 py-3 text-uppercase fw-semibold small text-muted">Platform</th>
                                <th class="px-3 py-3 text-uppercase fw-semibold small text-muted" style="width: 120px;">Status</th>
                                <th class="px-3 py-3 text-uppercase fw-semibold small text-muted" style="width: 100px;">Order</th>
                                <th class="px-3 py-3 text-uppercase fw-semibold small text-muted text-end" style="width: 140px;">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($platforms as $platform)
                                <tr class="border-bottom">
                                    <td class="px-3 py-3">
                                        <div class="rounded-3 d-flex align-items-center justify-content-center overflow-hidden" 
                                             style="width: 44px; height: 44px; background-color: rgba(42, 69, 99, 0.1);">
                                            @if($platform->logo)
                                                <img src="{{ asset($platform->logo) }}" alt="{{ $platform->name }}" class="w-100 h-100 object-fit-cover">
                                            @else
                                                <i class="fa-solid fa-cubes" style="color: #2A4563;"></i>
                                            @endif
                                        </div>
                                    </td>
                                    <td class="px-3 py-3">
                                        <p class="fw-semibold text-dark mb-0">{{ $platform->name }}</p>
                                        <p class="text-muted small mb-0 text-truncate" style="max-width: 400px;">{{ $platform->description }}</p>
                                    </td>
                                    <td class="px-3 py-3">
                                        @if($platform->status)
                                            <span class="badge rounded-pill px-3 py-1 fw-semibold" style="background-color: #f0fdf4; color: #16a34a;">Online</span>
                                        @else
                                            <span class="badge rounded-pill px-3 py-1 fw-semibold" style="background-color: #f3f4f6; color: #6b7280;">Offline</span>
                                        @endif
                                    </td>
                                    <td class="px-3 py-3 text-secondary">{{ $platform->sort_order }}</td>
                                    <td class="px-3 py-3">
                                        <div class="d-flex justify-content-end gap-1">
                                            <a href="{{ route('admin.platforms.edit', $platform->id) }}"
                                               class="btn btn-link text-secondary text-decoration-none rounded-3 p-2"
                                               style="width: 36px; height: 36px;"
                                               title="Edit">
                                                <i class="fa-solid fa-pen"></i>
                                            </a>
                                            <!-- SIMPLE DELETE FORM - Each row has its own form -->
                                            <form action="{{ route('admin.platforms.destroy', $platform->id) }}" 
                                                  method="POST" 
                                                  style="display: inline-block;"
                                                  onsubmit="return confirm('Are you sure you want to delete "{{ $platform->name }}"? This action cannot be undone.');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" 
                                                        class="btn btn-link text-secondary text-decoration-none rounded-3 p-2"
                                                        style="width: 36px; height: 36px; cursor: pointer;"
                                                        title="Delete">
                                                    <i class="fa-solid fa-trash-can"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="text-center py-5">
                    <div class="rounded-circle bg-light d-flex align-items-center justify-content-center mx-auto mb-3" style="width: 56px; height: 56px;">
                        <i class="fa-solid fa-cubes text-secondary" style="font-size: 1.25rem;"></i>
                    </div>
                    <h5 class="text-secondary fw-semibold">No platforms yet</h5>
                    <p class="text-muted small mt-1 mb-4">Add your first partner platform to get started.</p>
                    <a href="{{ route('admin.platforms.create') }}"
                       class="btn btn-primary btn-sm fw-semibold px-4 py-2 rounded-3" 
                       style="background-color: #2A4563; border-color: #2A4563;">
                        <i class="fa-solid fa-plus me-2"></i>
                        Add Platform
                    </a>
                </div>
            @endif
        </div>
    </div>
</div>

<script>
    // Auto-hide success alert
    const successAlert = document.getElementById('successAlert');
    if (successAlert) {
        setTimeout(() => {
            successAlert.style.transition = 'opacity .3s ease, max-height .3s ease .2s, margin .3s ease .2s, padding .3s ease .2s';
            successAlert.style.maxHeight = successAlert.offsetHeight + 'px';
            successAlert.style.opacity = '0';
            requestAnimationFrame(() => {
                successAlert.style.maxHeight = '0px';
                successAlert.style.marginBottom = '0px';
                successAlert.style.paddingTop = '0px';
                successAlert.style.paddingBottom = '0px';
                successAlert.style.border = '0px';
            });
            setTimeout(() => successAlert.remove(), 550);
        }, 3000);
    }
</script>
@endsection