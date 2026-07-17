@extends('admin.layouts.master')
@section('title', 'Manage Blogs')
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
    .blog-index-page {
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
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .blog-header-badge .count {
        background: rgba(255, 255, 255, 0.2);
        padding: 2px 10px;
        border-radius: 50px;
        font-size: 12px;
    }

    /* ===== BODY SECTION ===== */
    .blog-body {
        padding: 45px;
    }

    /* ===== TABLE STYLES ===== */
    .table-modern {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0;
        font-size: 14px;
    }

    .table-modern thead th {
        background: linear-gradient(135deg, #3b5f86 0%, #2a4563 50%, #1f354d 100%);
        color: #ffffff;
        padding: 15px 20px;
        font-weight: 600;
        font-size: 13px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        border: none;
        position: sticky;
        top: 0;
        z-index: 10;
    }

    .table-modern thead th:first-child {
        border-radius: 12px 0 0 0;
    }

    .table-modern thead th:last-child {
        border-radius: 0 12px 0 0;
    }

    .table-modern tbody tr {
        transition: var(--transition);
        border-bottom: 1px solid #e5e7eb;
    }

    .table-modern tbody tr:last-child {
        border-bottom: none;
    }

    .table-modern tbody tr:hover {
        background: #f0f4f8;
        transform: translateX(5px);
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
    }

    .table-modern tbody td {
        padding: 16px 20px;
        vertical-align: middle;
        color: #1a1a2e;
        border: none;
    }

    /* ===== IMAGE THUMBNAIL ===== */
    .blog-thumbnail {
        width: 60px;
        height: 60px;
        border-radius: 10px;
        overflow: hidden;
        border: 2px solid #e5e7eb;
        flex-shrink: 0;
        background: #f3f4f6;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .blog-thumbnail img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .blog-thumbnail .no-image {
        color: #9ca3af;
        font-size: 20px;
    }

    .blog-title-cell {
        display: flex;
        align-items: center;
        gap: 15px;
    }

    .blog-title-cell .title-text {
        font-weight: 600;
        color: #1a1a2e;
        font-size: 14px;
    }

    .blog-title-cell .title-text a {
        color: #1a1a2e;
        text-decoration: none;
        transition: var(--transition);
    }

    .blog-title-cell .title-text a:hover {
        color: var(--primary-color);
    }

    .blog-description-preview {
        color: #6b7280;
        font-size: 13px;
        max-width: 250px;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
        display: block;
    }

    /* ===== BADGES ===== */
    .badge-id {
        background: #e5e7eb;
        color: #4b5563;
        padding: 4px 10px;
        border-radius: 50px;
        font-size: 12px;
        font-weight: 600;
    }

    .badge-status {
        padding: 5px 14px;
        border-radius: 50px;
        font-size: 12px;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        gap: 5px;
    }

    .badge-status.published {
        background: #d1fae5;
        color: #065f46;
    }

    .badge-status.draft {
        background: #fef3c7;
        color: #92400e;
    }

    .badge-status.archived {
        background: #f3f4f6;
        color: #4b5563;
    }

    /* ===== ACTION BUTTONS ===== */
    .action-buttons {
        display: flex;
        gap: 8px;
        flex-wrap: wrap;
    }

    .btn-action {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 8px 16px;
        border-radius: 10px;
        font-size: 13px;
        font-weight: 600;
        text-decoration: none;
        transition: var(--transition);
        border: none;
        cursor: pointer;
    }

    .btn-action i {
        font-size: 14px;
    }

    .btn-action-edit {
        background: linear-gradient(135deg, #3b82f6, #2563eb);
        color: #fff;
        box-shadow: 0 2px 10px rgba(59, 130, 246, 0.3);
    }

    .btn-action-edit:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 20px rgba(59, 130, 246, 0.4);
        color: #fff;
    }

    .btn-action-delete {
        background: linear-gradient(135deg, #ef4444, #dc2626);
        color: #fff;
        box-shadow: 0 2px 10px rgba(239, 68, 68, 0.3);
    }

    .btn-action-delete:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 20px rgba(239, 68, 68, 0.4);
        color: #fff;
    }

    /* ===== TOOLBAR ===== */
    .table-toolbar {
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 15px;
        margin-bottom: 25px;
        padding: 15px 20px;
        background: #f8fafc;
        border-radius: 14px;
        border: 1px solid #e5e7eb;
    }

    .table-toolbar .toolbar-left {
        display: flex;
        align-items: center;
        gap: 15px;
        flex-wrap: wrap;
    }

    .table-toolbar .toolbar-right {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .btn-create-new {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 10px 24px;
        background: linear-gradient(135deg, #3b5f86 0%, #2a4563 50%, #1f354d 100%);
        color: #fff;
        border: none;
        border-radius: 12px;
        font-weight: 600;
        font-size: 14px;
        text-decoration: none;
        transition: var(--transition);
        box-shadow: 0 2px 15px rgba(42, 69, 99, 0.3);
    }

    .btn-create-new:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 25px rgba(42, 69, 99, 0.4);
        color: #fff;
    }

    .search-box {
        display: flex;
        align-items: center;
        gap: 8px;
        background: #fff;
        border: 2px solid #e5e7eb;
        border-radius: 12px;
        padding: 8px 16px;
        transition: var(--transition);
    }

    .search-box:focus-within {
        border-color: var(--primary-color);
        box-shadow: 0 0 0 4px rgba(42, 69, 99, 0.1);
    }

    .search-box input {
        border: none;
        outline: none;
        background: transparent;
        padding: 4px 0;
        font-size: 14px;
        color: #1a1a2e;
        width: 200px;
    }

    .search-box input::placeholder {
        color: #9ca3af;
    }

    .search-box i {
        color: #9ca3af;
        font-size: 16px;
    }

    /* ===== PAGINATION ===== */
    .pagination-modern {
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 15px;
        margin-top: 30px;
        padding-top: 20px;
        border-top: 2px solid #f3f4f6;
    }

    .pagination-modern .pagination-info {
        color: #6b7280;
        font-size: 14px;
    }

    .pagination-modern .pagination-links {
        display: flex;
        gap: 5px;
    }

    .pagination-modern .pagination-links .page-link {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-width: 40px;
        height: 40px;
        padding: 0 12px;
        border-radius: 10px;
        border: 2px solid #e5e7eb;
        color: #4b5563;
        text-decoration: none;
        font-weight: 600;
        font-size: 14px;
        transition: var(--transition);
    }

    .pagination-modern .pagination-links .page-link:hover {
        background: #f3f4f6;
        border-color: #d1d5db;
    }

    .pagination-modern .pagination-links .page-link.active {
        background: linear-gradient(135deg, #3b5f86 0%, #2a4563 50%, #1f354d 100%);
        color: #fff;
        border-color: var(--primary-color);
    }

    .pagination-modern .pagination-links .page-link.disabled {
        opacity: 0.5;
        pointer-events: none;
    }

    /* ===== EMPTY STATE ===== */
    .empty-state {
        text-align: center;
        padding: 60px 20px;
    }

    .empty-state i {
        font-size: 60px;
        color: #d1d5db;
        margin-bottom: 20px;
    }

    .empty-state h3 {
        color: #1a1a2e;
        font-size: 22px;
        font-weight: 700;
        margin-bottom: 10px;
    }

    .empty-state p {
        color: #6b7280;
        font-size: 15px;
        margin-bottom: 25px;
    }

    /* ===== SUCCESS MESSAGE ===== */
    .alert-modern {
        padding: 16px 24px;
        border-radius: 14px;
        display: flex;
        align-items: center;
        gap: 12px;
        margin-bottom: 25px;
        animation: slideDown 0.4s ease;
    }

    .alert-modern.success {
        background: #d1fae5;
        color: #065f46;
        border-left: 4px solid #10b981;
    }

    .alert-modern i {
        font-size: 20px;
    }

    /* ===== CUSTOM DELETE MODAL ===== */
    .delete-modal-overlay {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.6);
        backdrop-filter: blur(8px);
        z-index: 9999;
        animation: fadeIn 0.3s ease;
        align-items: center;
        justify-content: center;
    }

    .delete-modal-overlay.active {
        display: flex;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
        }
        to {
            opacity: 1;
        }
    }

    @keyframes slideUp {
        from {
            opacity: 0;
            transform: translateY(30px) scale(0.95);
        }
        to {
            opacity: 1;
            transform: translateY(0) scale(1);
        }
    }

    .delete-modal {
        background: #ffffff;
        border-radius: 24px;
        padding: 40px;
        max-width: 440px;
        width: 90%;
        text-align: center;
        animation: slideUp 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
        box-shadow: 0 30px 80px rgba(0, 0, 0, 0.3);
        position: relative;
        overflow: hidden;
    }

    .delete-modal::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(90deg, #ef4444, #dc2626);
    }

    .delete-modal-icon {
        width: 80px;
        height: 80px;
        background: linear-gradient(135deg, #fef2f2, #fee2e2);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 20px;
        font-size: 36px;
        color: #ef4444;
        animation: pulse 2s ease-in-out infinite;
    }

    @keyframes pulse {
        0%, 100% {
            transform: scale(1);
        }
        50% {
            transform: scale(1.05);
        }
    }

    .delete-modal-title {
        font-size: 22px;
        font-weight: 700;
        color: #1a1a2e;
        margin-bottom: 8px;
    }

    .delete-modal-subtitle {
        font-size: 15px;
        color: #6b7280;
        margin-bottom: 6px;
        line-height: 1.6;
    }

    .delete-modal-blog-title {
        font-weight: 600;
        color: #dc2626;
        background: #fef2f2;
        padding: 8px 16px;
        border-radius: 10px;
        display: inline-block;
        margin: 10px 0 20px;
        font-size: 14px;
        max-width: 100%;
        word-break: break-word;
    }

    .delete-modal-actions {
        display: flex;
        gap: 12px;
        justify-content: center;
        flex-wrap: wrap;
    }

    .delete-modal-btn {
        padding: 12px 30px;
        border-radius: 12px;
        font-weight: 600;
        font-size: 14px;
        border: none;
        cursor: pointer;
        transition: var(--transition);
        min-width: 120px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
    }

    .delete-modal-btn-cancel {
        background: #f3f4f6;
        color: #4b5563;
        border: 2px solid #e5e7eb;
    }

    .delete-modal-btn-cancel:hover {
        background: #e5e7eb;
        transform: translateY(-2px);
    }

    .delete-modal-btn-confirm {
        background: linear-gradient(135deg, #ef4444, #dc2626);
        color: #fff;
        box-shadow: 0 4px 20px rgba(239, 68, 68, 0.3);
    }

    .delete-modal-btn-confirm:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 30px rgba(239, 68, 68, 0.4);
    }

    .delete-modal-btn-confirm:active {
        transform: scale(0.95);
    }

    .delete-modal-btn .spinner-small {
        display: none;
        width: 18px;
        height: 18px;
        border: 2px solid rgba(255, 255, 255, 0.3);
        border-radius: 50%;
        border-top-color: #fff;
        animation: spin 0.8s ease infinite;
    }

    .delete-modal-btn.loading .spinner-small {
        display: inline-block;
    }

    .delete-modal-btn.loading .btn-text {
        display: none;
    }

    @keyframes spin {
        to {
            transform: rotate(360deg);
        }
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

        .table-modern thead th,
        .table-modern tbody td {
            padding: 12px 15px;
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
            justify-content: center;
        }

        .blog-header-title {
            font-size: 20px;
        }

        .blog-header-icon {
            width: 50px;
            height: 50px;
            font-size: 22px;
        }

        .table-toolbar {
            flex-direction: column;
            align-items: stretch;
        }

        .table-toolbar .toolbar-left {
            flex-direction: column;
            align-items: stretch;
        }

        .search-box input {
            width: 100%;
        }

        .btn-create-new {
            justify-content: center;
        }

        .table-modern {
            font-size: 13px;
        }

        .table-modern thead th,
        .table-modern tbody td {
            padding: 10px 12px;
        }

        .blog-title-cell {
            flex-direction: column;
            align-items: flex-start;
        }

        .blog-thumbnail {
            width: 50px;
            height: 50px;
        }

        .blog-description-preview {
            max-width: 150px;
        }

        .action-buttons {
            flex-direction: column;
        }

        .btn-action {
            padding: 6px 12px;
            font-size: 12px;
            justify-content: center;
        }

        .pagination-modern {
            flex-direction: column;
            align-items: center;
            text-align: center;
        }

        .delete-modal {
            padding: 30px 20px;
        }

        .delete-modal-icon {
            width: 60px;
            height: 60px;
            font-size: 28px;
        }

        .delete-modal-title {
            font-size: 19px;
        }

        .delete-modal-actions {
            flex-direction: column;
        }

        .delete-modal-btn {
            width: 100%;
            justify-content: center;
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

        .table-modern {
            font-size: 12px;
        }

        .table-modern thead th,
        .table-modern tbody td {
            padding: 8px 10px;
        }

        .blog-thumbnail {
            width: 40px;
            height: 40px;
        }
    }

    /* ===== SCROLLBAR ===== */
    .table-wrapper {
        overflow-x: auto;
        border-radius: 12px;
        border: 1px solid #e5e7eb;
    }

    .table-wrapper::-webkit-scrollbar {
        height: 6px;
    }

    .table-wrapper::-webkit-scrollbar-track {
        background: #f1f1f1;
        border-radius: 3px;
    }

    .table-wrapper::-webkit-scrollbar-thumb {
        background: #c1c1c1;
        border-radius: 3px;
    }

    .table-wrapper::-webkit-scrollbar-thumb:hover {
        background: #a8a8a8;
    }
</style>

<div class="blog-index-page">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12">

                <!-- Blog Card -->
                <div class="blog-card">

                    <!-- Header -->
                    <div class="blog-header">
                        <div class="blog-header-content">
                            <div class="blog-header-left">
                                <div class="blog-header-icon">
                                    <i class="fas fa-blog"></i>
                                </div>
                                <div>
                                    <h1 class="blog-header-title">Manage Blogs</h1>
                                    <p class="blog-header-subtitle">View and manage all your blog posts</p>
                                </div>
                            </div>
                            <div class="blog-header-badge">
                                <i class="fas fa-file-alt me-1"></i>
                                Total Blogs
                                <span class="count">{{ $blogs->total() }}</span>
                            </div>
                        </div>
                    </div>

                    <!-- Body -->
                    <div class="blog-body">

                        <!-- Success Message -->
                        @if(session('success'))
                            <div class="alert-modern success">
                                <i class="fas fa-check-circle"></i>
                                {{ session('success') }}
                            </div>
                        @endif

                        <!-- Toolbar -->
                        <div class="table-toolbar">
                            <div class="toolbar-left">
                                <a href="{{ route('admin.blog.create') }}" class="btn-create-new">
                                    <i class="fas fa-plus-circle"></i>
                                    Create New Blog
                                </a>
                            </div>
                            <div class="toolbar-right">
                                <div class="search-box">
                                    <i class="fas fa-search"></i>
                                    <input type="text" id="searchInput" placeholder="Search blogs..." onkeyup="searchTable()">
                                </div>
                            </div>
                        </div>

                        <!-- Table -->
                        <div class="table-wrapper">
                            <table class="table-modern" id="blogTable">
                                <thead>
                                    <tr>
                                        <th style="width: 60px;">#</th>
                                        <th style="min-width: 250px;">Title</th>
                                        <th>Description</th>
                                        <th style="width: 120px;">Image</th>
                                        <th style="width: 100px;">Status</th>
                                        <th style="width: 100px;">Created</th>
                                        <th style="width: 200px;">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($blogs as $blog)
                                        <tr>
                                            <td>
                                                <span class="badge-id">#{{ $blog->id }}</span>
                                            </td>
                                            <td>
                                                <div class="blog-title-cell">
                                                    <div class="blog-thumbnail">
                                                        @if($blog->image)
                                                            <img src="{{ asset('blogs/' . $blog->image) }}" alt="{{ $blog->title }}">
                                                        @else
                                                            <span class="no-image">
                                                                <i class="fas fa-image"></i>
                                                            </span>
                                                        @endif
                                                    </div>
                                                    <div>
                                                        <div class="title-text">
                                                            <a href="{{ route('admin.blog.edit', $blog->id) }}">
                                                                {{ Str::limit($blog->title, 50) }}
                                                            </a>
                                                        </div>
                                                        <small style="color: #9ca3af;">
                                                            <i class="far fa-calendar-alt me-1"></i>
                                                            {{ $blog->created_at->format('M d, Y') }}
                                                        </small>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <span class="blog-description-preview">
                                                    {{ Str::limit($blog->description, 80) }}
                                                </span>
                                            </td>
                                            <td>
                                                @if($blog->image)
                                                    <div class="blog-thumbnail" style="width: 50px; height: 50px;">
                                                        <img src="{{ asset('blogs/' . $blog->image) }}" alt="{{ $blog->title }}">
                                                    </div>
                                                @else
                                                    <span style="color: #9ca3af; font-size: 12px;">No image</span>
                                                @endif
                                            </td>
                                            <td>
                                                <span class="badge-status published">
                                                    <i class="fas fa-circle" style="font-size: 8px;"></i>
                                                    Published
                                                </span>
                                            </td>
                                            <td style="font-size: 12px; color: #6b7280;">
                                                {{ $blog->created_at->format('d/m/Y') }}
                                            </td>
                                            <td>
                                                <div class="action-buttons">
                                                    <a href="{{ route('admin.blog.edit', $blog->id) }}" class="btn-action btn-action-edit">
                                                        <i class="fas fa-edit"></i>
                                                        Edit
                                                    </a>
                                                    <button type="button" class="btn-action btn-action-delete" onclick="openDeleteModal({{ $blog->id }}, '{{ addslashes($blog->title) }}')">
                                                        <i class="fas fa-trash-alt"></i>
                                                        Delete
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="7">
                                                <div class="empty-state">
                                                    <i class="fas fa-blog"></i>
                                                    <h3>No Blogs Found</h3>
                                                    <p>Start creating your first blog post now!</p>
                                                    <a href="{{ route('admin.blog.create') }}" class="btn-create-new">
                                                        <i class="fas fa-plus-circle"></i>
                                                        Create Your First Blog
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        <!-- Pagination -->
                        @if($blogs->hasPages())
                            <div class="pagination-modern">
                                <div class="pagination-info">
                                    Showing {{ $blogs->firstItem() }} to {{ $blogs->lastItem() }} of {{ $blogs->total() }} entries
                                </div>
                                <div class="pagination-links">
                                    {{ $blogs->links('pagination::bootstrap-4') }}
                                </div>
                            </div>
                        @endif

                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<!-- ===== DELETE CONFIRMATION MODAL ===== -->
<div class="delete-modal-overlay" id="deleteModal">
    <div class="delete-modal">
        <div class="delete-modal-icon">
            <i class="fas fa-exclamation-triangle"></i>
        </div>
        <h3 class="delete-modal-title">Delete Blog Post</h3>
        <p class="delete-modal-subtitle">Are you sure you want to delete this blog post?</p>
        <p class="delete-modal-subtitle" style="font-size: 13px; color: #9ca3af;">This action cannot be undone.</p>
        <div class="delete-modal-blog-title" id="deleteBlogTitle">"Blog Title Here"</div>
        
        <div class="delete-modal-actions">
            <button type="button" class="delete-modal-btn delete-modal-btn-cancel" onclick="closeDeleteModal()">
                <i class="fas fa-times"></i>
                Cancel
            </button>
            <form id="deleteForm" method="POST" style="display: inline-block;">
                @csrf
                @method('DELETE')
                <button type="submit" class="delete-modal-btn delete-modal-btn-confirm" id="confirmDeleteBtn">
                    <i class="fas fa-trash-alt"></i>
                    <span class="btn-text">Delete Permanently</span>
                    <span class="spinner-small"></span>
                </button>
            </form>
        </div>
    </div>
</div>

<script>
    // ===== DELETE MODAL FUNCTIONS =====
    let currentDeleteId = null;

    function openDeleteModal(id, title) {
        currentDeleteId = id;
        document.getElementById('deleteBlogTitle').textContent = '"' + title + '"';
        // Build the URL dynamically in JavaScript (FIXED)
        const deleteUrl = '/admin/blog/' + id + '/delete';
        document.getElementById('deleteForm').action = deleteUrl;
        document.getElementById('deleteModal').classList.add('active');
        document.body.style.overflow = 'hidden';
    }

    function closeDeleteModal() {
        document.getElementById('deleteModal').classList.remove('active');
        document.body.style.overflow = '';
        // Reset loading state
        const btn = document.getElementById('confirmDeleteBtn');
        btn.classList.remove('loading');
        btn.disabled = false;
    }

    // Close modal on overlay click
    document.getElementById('deleteModal').addEventListener('click', function(e) {
        if (e.target === this) {
            closeDeleteModal();
        }
    });

    // Close modal on Escape key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closeDeleteModal();
        }
    });

    // ===== DELETE FORM SUBMIT WITH LOADING =====
    document.getElementById('deleteForm').addEventListener('submit', function(e) {
        const btn = document.getElementById('confirmDeleteBtn');
        btn.classList.add('loading');
        btn.disabled = true;
        // The form will submit normally after this
    });

    // ===== SEARCH FUNCTION =====
    function searchTable() {
        const input = document.getElementById('searchInput');
        const filter = input.value.toUpperCase();
        const table = document.getElementById('blogTable');
        const rows = table.getElementsByTagName('tr');

        for (let i = 1; i < rows.length; i++) {
            const row = rows[i];
            let found = false;
            const cells = row.getElementsByTagName('td');

            for (let j = 0; j < cells.length; j++) {
                const cell = cells[j];
                if (cell) {
                    const text = cell.textContent || cell.innerText;
                    if (text.toUpperCase().indexOf(filter) > -1) {
                        found = true;
                        break;
                    }
                }
            }

            row.style.display = found ? '' : 'none';
        }
    }

    // ===== AUTO-HIDE ALERT =====
    document.addEventListener('DOMContentLoaded', function() {
        const alert = document.querySelector('.alert-modern');
        if (alert) {
            setTimeout(function() {
                alert.style.opacity = '0';
                alert.style.transform = 'translateY(-20px)';
                alert.style.transition = 'all 0.5s ease';
                setTimeout(function() {
                    alert.style.display = 'none';
                }, 500);
            }, 5000);
        }

        console.log('📊 Blog management page loaded successfully!');
        console.log('💡 Tip: Use the search box to filter blogs');
    });
</script>

@endsection