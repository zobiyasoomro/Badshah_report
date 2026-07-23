@extends('admin.layouts.master')
@section('title', 'Planes')
@section('admin_content')

<style>
    .planes-header {
        padding: 1.5rem;
        margin-bottom: 1.5rem;
    }

    .planes-title {
        font-size: 1.875rem;
        font-weight: 600;
        color: #1f2937;
        margin-bottom: 0;
    }

    .planes-subtitle {
        color: #6b7280;
        margin-top: 4px;
        margin-bottom: 0;
    }

    .btn-add-plane {
        background-color: #2A4563;
        color: #ffffff;
        padding: 0.75rem 1.25rem;
        border-radius: 16px;
        font-weight: 500;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        border: none;
        transition: all 0.2s ease;
        text-decoration: none;
    }

    .btn-add-plane:hover {
        background-color: #1f334a;
        color: #ffffff;
        transform: translateY(-1px);
    }

    .table-container {
        background: #ffffff;
        border-radius: 24px;
        border: 1px solid #f3f4f6;
        box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05);
        overflow: hidden;
    }

    .table-custom {
        width: 100%;
        border-collapse: collapse;
    }

    .table-custom thead th {
        padding: 1.25rem 2rem;
        text-align: left;
        font-size: 0.875rem;
        font-weight: 600;
        color: #4b5563;
        border-bottom: 1px solid #f3f4f6;
    }

    .table-custom tbody td {
        padding: 1.5rem 2rem;
        border-bottom: 1px solid #f3f4f6;
        vertical-align: middle;
    }

    .table-custom tbody tr:last-child td {
        border-bottom: none;
    }

    .table-custom tbody tr:hover {
        background-color: #f9fafb;
        transition: background 0.2s ease;
    }

    .plane-icon-box {
        width: 40px;
        height: 40px;
        border-radius: 12px;
        background: #f3f4f6;
        border: 1px solid #f3f4f6;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #9ca3af;
        flex-shrink: 0;
    }

    .plane-icon-box i {
        font-size: 1rem;
    }

    .plane-name {
        font-weight: 600;
        color: #1f2937;
    }

    .plane-description {
        color: #4b5563;
    }

    .plane-price {
        font-size: 1.5rem;
        font-weight: 600;
        color: #059669;
    }

    .action-btn-edit {
        color: #2563eb;
        background: none;
        border: none;
        cursor: pointer;
        padding: 4px 8px;
        transition: color 0.2s ease;
    }

    .action-btn-edit:hover {
        color: #1d4ed8;
    }

    .action-btn-edit i {
        font-size: 1.25rem;
    }

    .action-btn-delete {
        color: #ef4444;
        background: none;
        border: none;
        cursor: pointer;
        padding: 4px 8px;
        transition: color 0.2s ease;
    }

    .action-btn-delete:hover {
        color: #dc2626;
    }

    .action-btn-delete i {
        font-size: 1.25rem;
    }

    .empty-state {
        padding: 3rem 2rem;
        text-align: center;
        color: #6b7280;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .planes-header {
            padding: 1rem;
        }

        .planes-title {
            font-size: 1.5rem;
        }

        .btn-add-plane {
            padding: 0.5rem 1rem;
            font-size: 0.875rem;
        }

        .table-custom thead th,
        .table-custom tbody td {
            padding: 0.75rem 1rem;
        }

        .plane-price {
            font-size: 1.25rem;
        }

        .table-custom {
            font-size: 0.875rem;
        }

        .action-btn-edit i,
        .action-btn-delete i {
            font-size: 1rem;
        }
    }

    @media (max-width: 576px) {
        .planes-header {
            flex-direction: column;
            align-items: flex-start;
            gap: 12px;
        }

        .table-custom thead th,
        .table-custom tbody td {
            padding: 0.5rem 0.75rem;
            font-size: 0.75rem;
        }

        .plane-icon-box {
            width: 32px;
            height: 32px;
        }

        .plane-icon-box i {
            font-size: 0.75rem;
        }

        .plane-price {
            font-size: 1rem;
        }

        .action-btn-edit i,
        .action-btn-delete i {
            font-size: 0.875rem;
        }
    }
</style>

<div class="planes-header">
    <div class="d-flex flex-wrap justify-content-between align-items-center gap-3">
        <div>
            <h1 class="planes-title">Planes</h1>
            <p class="planes-subtitle">Manage your planes</p>
        </div>

        <a href="{{ route('admin.planes.create') }}" class="btn-add-plane">
            <i class="fa-solid fa-plus"></i>
            Add New Plane
        </a>
    </div>
</div>

<div class="table-container">
    <div class="table-responsive">
        <table class="table-custom">
            <thead>
                <tr>
                    <th>PLANE NAME</th>
                    <th>SHORT DESCRIPTION</th>
                    <th>PRICE</th>
                    <th class="text-end" style="width: 130px;">ACTIONS</th>
                </tr>
            </thead>
            <tbody>
                @forelse($planes ?? [] as $plane)
                    <tr>
                        <td>
                            <div class="d-flex align-items-center gap-3">
                                <div class="plane-icon-box">
                                    <i class="fa-solid fa-plane"></i>
                                </div>
                                <div class="plane-name">{{ $plane->name }}</div>
                            </div>
                        </td>
                        <td class="plane-description">
                            {{ Str::limit($plane->short_description, 80) }}
                        </td>
                        <td>
                            <span class="plane-price">
                                Rs{{ number_format($plane->price) }}
                            </span>
                        </td>
                        <td class="text-end">
                            <div class="d-flex align-items-center justify-content-end gap-2">
                                <a href="{{ route('admin.planes.edit', $plane->id) }}" class="action-btn-edit">
                                    <i class="fa-solid fa-pen"></i>
                                </a>

                                <form action="{{ route('admin.planes.destroy', $plane->id) }}" method="POST"
                                    id="delete-form-{{ $plane->id }}" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="action-btn-delete"
                                        onclick="confirmDelete({{ $plane->id }}, '{{ $plane->name }}')">
                                        <i class="fa-regular fa-trash-can"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="empty-state">
                            No planes found.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    function confirmDelete(id, name) {
        Swal.fire({
            title: 'Delete plane?',
            text: `You're about to permanently delete ${name}. This action can't be undone.`,
            icon: 'warning',
            iconColor: '#ef4444',
            showCancelButton: true,
            confirmButtonColor: '#ef4444',
            cancelButtonColor: '#ffffff',
            confirmButtonText: 'Delete',
            cancelButtonText: 'Cancel',
            customClass: {
                popup: 'rounded-xl shadow-lg p-6',
                cancelButton: 'border border-gray-300 text-gray-700 font-medium px-4 py-2 rounded-lg',
                confirmButton: 'text-white font-medium px-4 py-2 rounded-lg'
            },
            buttonsStyling: true
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('delete-form-' + id).submit();
            }
        });
    }
</script>

@endsection