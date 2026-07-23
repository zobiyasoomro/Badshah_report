@extends('admin.layouts.master')
@section('title', 'About Page Settings')
@section('admin_content')

    <div class="container-fluid about-editor-scope">
        <div class="row justify-content-center g-4">
            {{-- ===================== LIVE PREVIEW PANEL ===================== --}}
            <div class="col-12 col-xl-5">
                <div class="preview-sticky">
                    

                    <div class="preview-card">
                        <div class="preview-ring">
                            <img id="previewLogo"
                                src="{{ !empty($about->logo) ? asset($about->logo) : asset('images/nav_logo.png') }}"
                                alt="logo">
                        </div>
                        <span class="preview-subtitle"
                            id="previewSubtitle">{{ $about->subtitle ?? 'The Premium Platform' }}</span>
                        <h2 class="preview-title" id="previewTitle">{{ $about->title ?? 'Your Page Title' }}</h2>
                        <p class="preview-desc" id="previewDesc">
                            {{ $about->description ?? 'Your description will appear here as you type.' }}
                        </p>
                    </div>

                  
                </div>
            </div>

            {{-- ===================== FORM PANEL ===================== --}}
            <div class="col-12 col-xl-7">
                <div class="editor-card">
                    <div class="editor-card-head">
                        <div>
                            <h3 class="editor-title mb-1">About Page Content</h3>
                            <p class="editor-subtitle mb-0">Changes here update the public About page instantly.</p>
                        </div>
                        <span class="live-pill"><i class="dot"></i> Live</span>
                    </div>

                    @if(session('success'))
                        <div class="editor-toast" id="successToast">
                            <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
                        </div>
                    @endif

                    <form action="{{ route('admin.about.update') }}" method="POST" enctype="multipart/form-data"
                        id="aboutForm">
                        @csrf

                        <div class="field-group">
                            <label class="field-label">Page Title</label>
                            <input type="text" name="title" id="titleInput" class="field-input"
                                value="{{ old('title', $about->title ?? '') }}"
                                placeholder="e.g. Redefining the Trading Experience" required>
                            @error('title') <span class="field-error">{{ $message }}</span> @enderror
                        </div>

                        <div class="field-group">
                            <label class="field-label">Subtitle</label>
                            <input type="text" name="subtitle" id="subtitleInput" class="field-input"
                                value="{{ old('subtitle', $about->subtitle ?? '') }}"
                                placeholder="e.g. The Premium Platform">
                            @error('subtitle') <span class="field-error">{{ $message }}</span> @enderror
                        </div>

                        <div class="field-group">
                            <div class="d-flex justify-content-between align-items-center">
                                <label class="field-label mb-0">Description</label>
                                <span class="char-counter"><span id="charCount">0</span> characters</span>
                            </div>
                            <textarea name="description" id="descInput" class="field-input field-textarea" rows="7"
                                placeholder="Tell visitors who you are..."
                                required>{{ old('description', $about->description ?? '') }}</textarea>
                            @error('description') <span class="field-error">{{ $message }}</span> @enderror
                        </div>

                        <div class="field-group">
                            <label class="field-label">Logo</label>

                            <label for="logoInput" class="dropzone" id="dropzone">
                                <div class="dz-inner" id="dzPlaceholder"
                                    style="{{ !empty($about->logo) ? 'display:none;' : '' }}">
                                    <i class="bi bi-cloud-arrow-up dz-icon"></i>
                                    <p class="dz-text mb-0">Drag &amp; drop a logo, or <span>browse</span></p>
                                    <p class="dz-hint mb-0">PNG, JPG, WEBP or SVG · max 2MB</p>
                                </div>
                                <img id="dzPreview" src="{{ !empty($about->logo) ? asset($about->logo) : '' }}"
                                    alt="Logo preview" style="{{ empty($about->logo) ? 'display:none;' : '' }}">
                            </label>
                            <input type="file" name="logo" id="logoInput"
                                accept="image/png,image/jpeg,image/webp,image/svg+xml" hidden>
                            @error('logo') <span class="field-error">{{ $message }}</span> @enderror
                        </div>

                        <div class="text-end pt-3">
                            <button type="submit" class="save-btn" id="saveBtn">
                                <span class="btn-label">Save Changes</span>
                                <span class="btn-spinner" aria-hidden="true"></span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>

    <style>
        .about-editor-scope {
            --primary-gradient: linear-gradient(135deg, #3b5f86 0%, #2a4563 50%, #1f354d 100%);
            --primary-color: #2a4563;
            --primary-light: #3b5f86;
            --primary-dark: #1f354d;
            --accent-color: #00e5ff;
            --bg-deep: #0c1c38;
        }

        /* ---------- Form Card ---------- */
        .editor-card {
            background: linear-gradient(145deg, #2a4563, #0c1c38);
            border: 1px solid rgba(0, 229, 255, 0.15);
            border-radius: 18px;
            padding: 2rem 2.25rem;
            backdrop-filter: blur(14px);
            box-shadow: 0 20px 45px rgba(0, 0, 0, 0.35);
            position: relative;
            overflow: hidden;
        }

        .editor-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 2px;
            background: var(--primary-gradient);
            opacity: 0.8;
        }

        .editor-card-head {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            border-bottom: 1px solid rgba(255, 255, 255, 0.08);
            padding-bottom: 1.25rem;
            margin-bottom: 1.5rem;
        }

        .editor-title {
            color: #fff;
            font-weight: 800;
            letter-spacing: .5px;
            background: #fff;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .editor-subtitle {
            color: rgba(255, 255, 255, 0.55);
            font-size: .85rem;
            -webkit-text-fill-color: rgba(255, 255, 255, 0.55);
        }

        .live-pill {
            display: inline-flex;
            align-items: center;
            gap: .4rem;
            background: rgba(0, 229, 255, 0.08);
            color: var(--accent-color);
            border: 1px solid rgba(0, 229, 255, 0.3);
            font-size: .7rem;
            font-weight: 700;
            letter-spacing: 1px;
            text-transform: uppercase;
            padding: .35rem .7rem;
            border-radius: 999px;
            white-space: nowrap;
        }

        .live-pill .dot {
            width: 6px;
            height: 6px;
            border-radius: 50%;
            background: var(--accent-color);
            display: inline-block;
            box-shadow: 0 0 8px var(--accent-color);
            animation: pulseDot 1.6s ease-in-out infinite;
        }

        @keyframes pulseDot {

            0%,
            100% {
                opacity: 1
            }

            50% {
                opacity: .3
            }
        }

        .editor-toast {
            background: rgba(39, 201, 63, 0.12);
            border: 1px solid rgba(39, 201, 63, 0.4);
            color: #7CF29B;
            padding: .7rem 1rem;
            border-radius: 10px;
            font-size: .88rem;
            margin-bottom: 1.25rem;
        }

        .field-group {
            margin-bottom: 1.4rem;
        }

        .field-label {
            display: block;
            color: var(--accent-color);
            font-size: .72rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            margin-bottom: .5rem;
        }

        .field-input {
            width: 100%;
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.08);
            color: #fff;
            padding: .8rem 1rem;
            border-radius: 10px;
            font-size: .98rem;
            transition: border-color .25s, box-shadow .25s, background .25s;
        }

        .field-input::placeholder {
            color: rgba(255, 255, 255, 0.3);
        }

        .field-input:focus {
            outline: none;
            background: rgba(255, 255, 255, 0.08);
            border-color: var(--accent-color);
            box-shadow: 0 0 0 3px rgba(0, 229, 255, 0.15);
        }

        .field-textarea {
            resize: vertical;
            min-height: 140px;
            line-height: 1.6;
        }

        .field-error {
            color: #ff8080;
            font-size: .78rem;
            margin-top: .35rem;
            display: block;
        }

        .char-counter {
            color: rgba(255, 255, 255, 0.4);
            font-size: .72rem;
        }

        /* ---------- Dropzone ---------- */
        .dropzone {
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 150px;
            border: 1.5px dashed rgba(0, 229, 255, 0.3);
            border-radius: 12px;
            background: rgba(255, 255, 255, 0.03);
            cursor: pointer;
            padding: 1.25rem;
            transition: border-color .25s, background .25s;
        }

        .dropzone:hover,
        .dropzone.dz-drag {
            border-color: var(--accent-color);
            background: rgba(0, 229, 255, 0.05);
        }

        .dz-inner {
            text-align: center;
        }

        .dz-icon {
            font-size: 1.8rem;
            color: var(--accent-color);
            margin-bottom: .5rem;
        }

        .dz-text {
            color: rgba(255, 255, 255, 0.8);
            font-size: .92rem;
        }

        .dz-text span {
            color: var(--accent-color);
            text-decoration: underline;
        }

        .dz-hint {
            color: rgba(255, 255, 255, 0.35);
            font-size: .75rem;
            margin-top: .2rem;
        }

        .dropzone img#dzPreview {
            max-height: 110px;
            max-width: 100%;
            object-fit: contain;
            border-radius: 8px;
        }

        /* ---------- Save Button ---------- */
        .save-btn {
            position: relative;
            background: var(--primary-gradient);
            color: #fff;
            border: none;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            font-size: .85rem;
            padding: .85rem 2.5rem;
            border-radius: 10px;
            transition: transform .25s, box-shadow .25s;
            box-shadow: 0 4px 20px rgba(42, 69, 99, 0.3);
        }

        .save-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 30px rgba(42, 69, 99, 0.4);
        }

        .save-btn.is-loading .btn-label {
            visibility: hidden;
        }

        .btn-spinner {
            display: none;
            position: absolute;
            top: 50%;
            left: 50%;
            width: 16px;
            height: 16px;
            margin: -8px 0 0 -8px;
            border: 2px solid rgba(255, 255, 255, 0.3);
            border-top-color: #fff;
            border-radius: 50%;
            animation: spin .7s linear infinite;
        }

        .save-btn.is-loading .btn-spinner {
            display: inline-block;
        }

        @keyframes spin {
            to {
                transform: rotate(360deg);
            }
        }

        /* ---------- Preview Panel ---------- */
        .preview-sticky {
            position: sticky;
            top: 1.5rem;
        }

        .preview-label {
            color: rgba(255, 255, 255, 0.45);
            font-size: .75rem;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            font-weight: 700;
            margin-bottom: .75rem;
        }

        .preview-card {
            background: var(--primary-gradient);
            border: 1px solid rgba(0, 229, 255, 0.15);
            border-radius: 18px;
            padding: 2.5rem 2rem;
            text-align: center;
            box-shadow: 0 20px 45px rgba(0, 0, 0, 0.35);
            position: relative;
            overflow: hidden;
        }

        .preview-card::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -50%;
            width: 200px;
            height: 200px;
            background: rgba(0, 229, 255, 0.05);
            border-radius: 50%;
            animation: float 6s ease-in-out infinite;
        }

        .preview-card::after {
            content: '';
            position: absolute;
            bottom: -50%;
            left: -50%;
            width: 150px;
            height: 150px;
            background: rgba(0, 229, 255, 0.03);
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

        .preview-ring {
            width: 96px;
            height: 96px;
            border-radius: 50%;
            margin: 0 auto 1.25rem;
            border: 2px dashed rgba(0, 229, 255, 0.3);
            display: flex;
            align-items: center;
            justify-content: center;
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(10px);
            position: relative;
            z-index: 1;
        }

        .preview-ring img {
            width: 70%;
            height: 70%;
            object-fit: contain;
            border-radius: 50%;
        }

        .preview-subtitle {
            display: block;
            color: var(--accent-color);
            text-transform: uppercase;
            letter-spacing: 2px;
            font-size: .75rem;
            font-weight: 700;
            margin-bottom: .5rem;
            word-break: break-word;
            position: relative;
            z-index: 1;
        }

        .preview-title {
            color: #fff;
            font-weight: 800;
            font-size: 1.5rem;
            margin-bottom: .75rem;
            word-break: break-word;
            position: relative;
            z-index: 1;
        }

        .preview-desc {
            color: rgba(255, 255, 255, 0.8);
            font-size: .9rem;
            line-height: 1.6;
            max-height: 140px;
            overflow-y: auto;
            margin: 0;
            white-space: pre-line;
            position: relative;
            z-index: 1;
        }

        /* Custom scrollbar for preview description */
        .preview-desc::-webkit-scrollbar {
            width: 4px;
        }

        .preview-desc::-webkit-scrollbar-track {
            background: rgba(255, 255, 255, 0.05);
            border-radius: 2px;
        }

        .preview-desc::-webkit-scrollbar-thumb {
            background: var(--accent-color);
            border-radius: 2px;
        }

        .preview-footnote {
            color: rgba(255, 255, 255, 0.3);
            font-size: .72rem;
            text-align: center;
            margin-top: .75rem;
        }

        @media (max-width: 1199px) {
            .preview-sticky {
                position: static;
            }
        }

        /* ===== RESPONSIVE ===== */
        @media (max-width: 768px) {
            .editor-card {
                padding: 1.5rem;
            }

            .editor-card-head {
                flex-direction: column;
                gap: 1rem;
            }

            .preview-card {
                padding: 1.5rem;
            }

            .preview-ring {
                width: 80px;
                height: 80px;
            }

            .preview-title {
                font-size: 1.2rem;
            }

            .save-btn {
                width: 100%;
                justify-content: center;
            }
        }

        @media (max-width: 480px) {
            .editor-card {
                padding: 1rem;
            }

            .field-input {
                font-size: .85rem;
                padding: .6rem .8rem;
            }

            .preview-card {
                padding: 1rem;
            }

            .preview-title {
                font-size: 1rem;
            }
        }
    </style>

    <script>
        (function () {
            const titleInput = document.getElementById('titleInput');
            const subtitleInput = document.getElementById('subtitleInput');
            const descInput = document.getElementById('descInput');
            const charCount = document.getElementById('charCount');

            const previewTitle = document.getElementById('previewTitle');
            const previewSubtitle = document.getElementById('previewSubtitle');
            const previewDesc = document.getElementById('previewDesc');
            const previewLogo = document.getElementById('previewLogo');

            // --- live text sync ---
            const syncText = () => {
                previewTitle.textContent = titleInput.value.trim() || 'Your Page Title';
                previewSubtitle.textContent = subtitleInput.value.trim() || 'The Premium Platform';
                previewDesc.textContent = descInput.value.trim() || 'Your description will appear here as you type.';
                charCount.textContent = descInput.value.length;
            };
            [titleInput, subtitleInput, descInput].forEach(el => el.addEventListener('input', syncText));
            syncText();

            // --- dropzone / file preview ---
            const dropzone = document.getElementById('dropzone');
            const logoInput = document.getElementById('logoInput');
            const dzPreview = document.getElementById('dzPreview');
            const dzPlaceholder = document.getElementById('dzPlaceholder');

            const showFile = (file) => {
                if (!file) return;
                const reader = new FileReader();
                reader.onload = (e) => {
                    dzPreview.src = e.target.result;
                    dzPreview.style.display = 'block';
                    dzPlaceholder.style.display = 'none';
                    previewLogo.src = e.target.result;
                };
                reader.readAsDataURL(file);
            };

            logoInput.addEventListener('change', () => showFile(logoInput.files[0]));

            ['dragenter', 'dragover'].forEach(evt =>
                dropzone.addEventListener(evt, (e) => {
                    e.preventDefault();
                    dropzone.classList.add('dz-drag');
                })
            );
            ['dragleave', 'drop'].forEach(evt =>
                dropzone.addEventListener(evt, (e) => {
                    e.preventDefault();
                    dropzone.classList.remove('dz-drag');
                })
            );
            dropzone.addEventListener('drop', (e) => {
                const file = e.dataTransfer.files[0];
                if (file) {
                    logoInput.files = e.dataTransfer.files;
                    showFile(file);
                }
            });

            // --- submit loading state ---
            const form = document.getElementById('aboutForm');
            const saveBtn = document.getElementById('saveBtn');
            form.addEventListener('submit', () => saveBtn.classList.add('is-loading'));

            // --- auto-hide toast ---
            const toast = document.getElementById('successToast');
            if (toast) setTimeout(() => {
                toast.style.transition = 'opacity .4s';
                toast.style.opacity = '0';
            }, 3000);
        })();
    </script>
@endsection