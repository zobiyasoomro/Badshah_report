<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" />

<style>
    .testimonial-section {
        background: #1d334d;
        padding: 4rem 0 5rem 0;
        overflow: hidden;
    }

    .text-info {
        color: #00e5ff !important;
    }

    .text-secondary {
        color: #fff !important;
    }

    .display-4 {
        font-weight: 700;
        letter-spacing: -0.02em;
    }

    .display-4 span.text-info {
        color: #00e5ff !important;
    }

    .section-subhead {
        letter-spacing: 0.08rem;
        font-weight: 600;
    }

    .star-rating {
        color: #f9b84a;
        font-size: 1.1rem;
        letter-spacing: 0.1rem;
    }

    .card-testimonial {
        background: #16263a !important;
        border: 1px solid #2a3140 !important;
        border-radius: 20px;
        transition: border-color 0.2s ease, box-shadow 0.2s ease;
        height: 100%;
        min-height: 230px;
        width: 100%;
    }

    .card-testimonial .card-body {
        padding: 1.8rem 1.5rem;
    }

    .card-testimonial .card-text {
        color: #b7c0d0 !important;
        font-weight: 400;
        line-height: 1.6;
    }

    .card-testimonial .border-top {
        border-color: #2a3140 !important;
    }

    .avatar-circle {
        width: 44px;
        height: 44px;
        background: #2A4563;
        color: #fff;
        font-weight: 600;
        font-size: 0.9rem;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        flex-shrink: 0;
        box-shadow: 0 4px 8px rgba(12, 201, 226, 0.86);
    }

    .card-testimonial h6 {
        color: #f0f3f8;
        font-weight: 600;
    }

    .card-testimonial small {
        color: #7a8499 !important;
    }

    .card-testimonial:hover {
        border-color: #2A4563 !important;
        box-shadow: 0 8px 20px rgba(41, 166, 190, 0.87);
    }

    .scroll-row {
        overflow: hidden;
        width: 100%;
        padding: 0.5rem 0 0.8rem 0;
        position: relative;
        cursor: grab;
        user-select: none;
        -webkit-user-select: none;
    }

    .scroll-row:active {
        cursor: grabbing;
    }

    .scroll-track {
        display: flex;
        gap: 1.8rem;
        width: max-content;
        will-change: transform;
        transition: none;
    }

    .scroll-track .testimonial-card-wrap {
        flex: 0 0 320px;
        max-width: 320px;
        width: 320px;
    }

    .scroll-track .card {
        width: 100%;
    }

    @media (max-width: 576px) {
        .scroll-track .testimonial-card-wrap {
            flex: 0 0 260px;
            max-width: 260px;
            width: 260px;
        }

        .card-testimonial .card-body {
            padding: 1.2rem;
        }

        .display-4 {
            font-size: 2.4rem;
        }

        .testimonial-section {
            padding: 2.8rem 0 3.5rem 0;
        }
    }

    @media (min-width: 577px) and (max-width: 768px) {
        .scroll-track .testimonial-card-wrap {
            flex: 0 0 290px;
            max-width: 290px;
            width: 290px;
        }
    }

    .btn-outline-accent {
        border: 2px solid #00e5ff;
        color: #00e5ff;
        background: transparent;
        transition: 0.2s;
    }

    .btn-outline-accent:hover {
        background: #2A4563;
        color: #fff;
    }

    .text-muted {
        color: #a8b3c9 !important;
    }

    .review-overlay {
        position: fixed;
        top: 0;
        right: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.7);
        backdrop-filter: blur(4px);
        z-index: 1050;
        display: none;
        justify-content: flex-end;
        align-items: center;
        transition: all 0.3s ease;
    }

    .review-overlay.active {
        display: flex;
    }

    .review-panel {
        background: #1a1f2b;
        width: 100%;
        max-width: 480px;
        height: 100vh;
        padding: 2rem 2rem 2.5rem 2rem;
        overflow-y: auto;
        box-shadow: -8px 0 30px rgba(0, 0, 0, 0.6);
        transform: translateX(100%);
        transition: transform 0.35s cubic-bezier(0.22, 1, 0.36, 1);
        border-left: 1px solid #2a3140;
    }

    .review-overlay.active .review-panel {
        transform: translateX(0);
    }

    .review-panel .close-btn {
        background: transparent;
        border: none;
        color: #8b95ab;
        font-size: 1.8rem;
        line-height: 1;
        padding: 0 0 0.5rem 0;
        cursor: pointer;
        transition: 0.2s;
    }

    .review-panel .close-btn:hover {
        color: #fff;
        transform: rotate(90deg);
    }

    .review-panel h3 {
        font-weight: 600;
        color: #f0f3f8;
        border-bottom: 1px solid #2a3140;
        padding-bottom: 1rem;
    }

    .review-panel label {
        color: #b7c0d0;
        font-weight: 500;
        font-size: 0.9rem;
        margin-bottom: 0.3rem;
    }

    .review-panel .form-control,
    .review-panel .form-select {
        background: #0d1117 !important;
        border: 1px solid #2a3140 !important;
        color: #f0f3f8 !important;
        border-radius: 12px;
        padding: 0.7rem 1rem;
    }

    .review-panel .form-control:focus,
    .review-panel .form-select:focus {
        border-color: #00e5ff !important;
        box-shadow: 0 0 0 3px rgba(0, 229, 255, 0.15);
    }

    .review-panel .form-control::placeholder {
        color: #5a657a;
    }

    .review-panel .star-input {
        display: flex;
        gap: 0.5rem;
        font-size: 2rem;
        cursor: pointer;
        color: #3a4558;
        transition: 0.15s;
    }

    .review-panel .star-input .bi-star-fill {
        color: #f9b84a;
    }

    .review-panel .star-input .bi-star {
        color: #3a4558;
    }

    .review-panel .star-input span:hover {
        transform: scale(1.15);
    }

    .review-panel .btn-submit {
        background: #00e5ff;
        border: none;
        color: #0b0d11;
        font-weight: 600;
        padding: 0.8rem;
        border-radius: 50px;
        width: 100%;
        transition: 0.2s;
    }

    .review-panel .btn-submit:hover {
        background: #00c8e0;
        transform: scale(0.98);
    }

    .review-panel .image-preview {
        display: flex;
        align-items: center;
        gap: 1rem;
        margin-top: 0.5rem;
    }

    .review-panel .image-preview img {
        width: 60px;
        height: 60px;
        border-radius: 12px;
        object-fit: cover;
        border: 1px solid #2a3140;
    }

    .review-panel .image-preview .remove-img {
        color: #d93c3c;
        cursor: pointer;
        font-size: 0.8rem;
        font-weight: 600;
    }

    .review-panel .file-input-wrapper {
        position: relative;
        display: inline-block;
        width: 100%;
    }

    .review-panel .file-input-wrapper input[type="file"] {
        position: absolute;
        top: 0;
        left: 0;
        opacity: 0;
        width: 100%;
        height: 100%;
        cursor: pointer;
        z-index: 10;
    }

    .review-panel .file-input-wrapper .file-label {
        background: #0d1117;
        border: 1px dashed #2a3140;
        border-radius: 12px;
        padding: 0.7rem 1rem;
        color: #8b95ab;
        text-align: center;
        cursor: pointer;
        transition: 0.2s;
        position: relative;
        z-index: 1;
        pointer-events: none;
    }

    .review-panel .file-input-wrapper .file-label:hover {
        border-color: #00e5ff;
        color: #f0f3f8;
    }

    @media (max-width: 576px) {
        .review-panel {
            max-width: 100%;
            padding: 1.5rem;
        }
    }

    .alert-custom {
        padding: 1rem;
        border-radius: 12px;
        margin-bottom: 1rem;
    }

    .alert-success-custom {
        background: #0a3d2e;
        border: 1px solid #0f5a42;
        color: #a8f0d0;
    }

    .alert-danger-custom {
        background: #3d1a1a;
        border: 1px solid #5a2828;
        color: #f0a8a8;
    }

    .scroll-track {
        animation: none !important;
        gap: 1.8rem;
    }

    /* ===== FULL SCREEN SUCCESS OVERLAY ===== */
    .success-overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.85);
        backdrop-filter: blur(8px);
        z-index: 9999;
        display: none;
        justify-content: center;
        align-items: center;
        animation: fadeIn 0.5s ease;
    }

    .success-overlay.active {
        display: flex;
    }

    .success-content {
        text-align: center;
        padding: 2rem;
        animation: scaleIn 0.5s ease;
    }

    .success-content .check-icon {
        width: 100px;
        height: 100px;
        background: linear-gradient(135deg, #00e5ff, #00c8e0);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 2rem auto;
        box-shadow: 0 0 50px rgba(0, 229, 255, 0.3);
        animation: pulse 1.5s ease-in-out infinite;
    }

    .success-content .check-icon i {
        font-size: 3.5rem;
        color: #0b0d11;
    }

    .success-content h2 {
        color: #f0f3f8;
        font-size: 2.5rem;
        font-weight: 700;
        margin-bottom: 0.5rem;
    }

    .success-content p {
        color: #a8b3c9;
        font-size: 1.1rem;
        margin-bottom: 0;
    }

    .success-content .sub-text {
        color: #00e5ff;
        font-size: 0.9rem;
        margin-top: 0.5rem;
        opacity: 0.8;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
        }

        to {
            opacity: 1;
        }
    }

    @keyframes scaleIn {
        from {
            transform: scale(0.8);
            opacity: 0;
        }

        to {
            transform: scale(1);
            opacity: 1;
        }
    }

    @keyframes pulse {

        0%,
        100% {
            transform: scale(1);
        }

        50% {
            transform: scale(1.05);
        }
    }
</style>

<!-- ===== SUCCESS OVERLAY ===== -->
<div class="success-overlay" id="successOverlay">
    <div class="success-content">
        <div class="check-icon">
            <i class="bi bi-check-lg"></i>
        </div>
        <h2>Thank You!</h2>
        <p>Your review has been submitted successfully.</p>
        <p class="sub-text">It will be published after admin approval.</p>
    </div>
</div>

<section class="testimonial-section">
    <div class="container">

        <!-- header -->
        <div class="text-center py-3">
            <h6 class="text-uppercase text-info fw-bold small section-subhead">
                <i class="bi bi-chat-quote me-1"></i> Player stories
            </h6>
            <h1 class="display-4 fw-bold text-white mb-3">
                Real feedback from <span class="text-info">our guests</span>
            </h1>
            <p class="text-muted mx-auto" style="max-width: 560px;">
                See what our diners say about their experience at Bet Pro — then leave your own.
            </p>
        </div>

        <!-- Display success/error messages -->
        <!-- @if(session('success'))
      <div class="alert-custom alert-success-custom text-center">
        {{ session('success') }}
      </div>
    @endif
    @if(session('error'))
      <div class="alert-custom alert-danger-custom text-center">
        {{ session('error') }}
      </div>
    @endif
    @if($errors->any())
      <div class="alert-custom alert-danger-custom text-center">
        @foreach($errors->all() as $error)
          {{ $error }}<br>
        @endforeach
      </div>
    @endif -->

        <!-- single row with cloned cards for seamless loop -->
        <div class="scroll-row" id="scrollRow">
            <div class="scroll-track" id="primaryTrack">

                {{-- Use the variable $reviews passed from FrontPageController --}}
                @if(isset($reviews) && $reviews->count() > 0)
                    @foreach($reviews as $review)
                        <div class="testimonial-card-wrap">
                            <div class="card card-testimonial h-100">
                                <div class="card-body p-4">
                                    <div class="star-rating mb-2">
                                        {{-- Use the helper attribute from your model --}}
                                        {{ $review->stars }}
                                    </div>
                                    <p class="card-text">{{ $review->description }}</p>
                                    <div class="d-flex align-items-center mt-3 pt-3 border-top">
                                        @php
                                            $imagePath = $review->image ? public_path('reviews/' . $review->image) : null;
                                        @endphp
                                        @if($imagePath && file_exists($imagePath))
                                            <img src="{{ asset('reviews/' . $review->image) }}"
                                                style="width:44px;height:44px;border-radius:50%;object-fit:cover;margin-right:12px;border:2px solid #2A4563;"
                                                alt="{{ $review->name }}" />
                                        @else
                                            <div class="avatar-circle me-3">{{ $review->initials }}</div>
                                        @endif
                                        <div>
                                            <h6 class="mb-0">{{ $review->name }}</h6>
                                            <small class="text-secondary">{{ $review->created_at ? $review->created_at->format('F d, Y') : 'Date not available' }}</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach

                    {{-- Duplicate loop for the seamless infinite scroll effect --}}
                    @foreach($reviews as $review)
                        {{-- Repeat the exact same HTML block as above here --}}
                        <div class="testimonial-card-wrap">
                            <div class="card card-testimonial h-100">
                                <div class="card-body p-4">
                                    <div class="star-rating mb-2">{{ $review->stars }}</div>
                                    <p class="card-text">{{ $review->description }}</p>
                                    <div class="d-flex align-items-center mt-3 pt-3 border-top">
                                        @php $imagePath = $review->image ? public_path('reviews/' . $review->image) : null; @endphp
                                        @if($imagePath && file_exists($imagePath))
                                            <img src="{{ asset('reviews/' . $review->image) }}"
                                                style="width:44px;height:44px;border-radius:50%;object-fit:cover;margin-right:12px;border:2px solid #2A4563;"
                                                alt="{{ $review->name }}" />
                                        @else
                                            <div class="avatar-circle me-3">{{ $review->initials }}</div>
                                        @endif
                                        <div>
                                            <h6 class="mb-0">{{ $review->name }}</h6>
                                            <small class="text-secondary">{{ $review->created_at ? $review->created_at->format('F d, Y') : 'Date not available' }}</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach

                @else
                    <div class="testimonial-card-wrap">
                        <div class="card card-testimonial h-100">
                            <div class="card-body p-4 text-center">
                                <p class="card-text text-white">No reviews yet. Be the first to share your experience!</p>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>

        <!-- CTA -->
        <div class="text-center mt-5">
            <a href="#" class="btn btn-outline-accent btn-lg px-5 py-2 rounded-pill fw-semibold" id="openReviewBtn">
                <i class="bi bi-pencil-square me-2"></i>Leave your review
            </a>
        </div>

    </div>
</section>

<!-- ===== REVIEW FORM OVERLAY (SIDE PANEL) ===== -->
<div class="review-overlay" id="reviewOverlay">
    <div class="review-panel">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h3 class="mb-0"><i class="bi bi-star me-2 text-info"></i>Write a Review</h3>
            <button class="close-btn" id="closeReviewBtn">&times;</button>
        </div>

        <form action="{{ route('reviews.store') }}" method="POST" enctype="multipart/form-data" id="reviewForm">
            @csrf

            <!-- Image Upload - FIXED -->
            <div class="mb-3">
                <label class="form-label">Upload Image (optional)</label>
                <div class="file-input-wrapper">
                    <div class="file-label" id="fileLabel">
                        <i class="bi bi-cloud-upload me-2"></i> Click to upload or drag & drop
                    </div>
                    <input type="file" id="reviewImage" name="image" accept="image/*" />
                </div>
                <div class="image-preview mt-2" id="imagePreview" style="display: none;">
                    <img id="previewImg" src="#" alt="preview" />
                    <span class="remove-img" id="removeImageBtn">Remove</span>
                </div>
            </div>

            <!-- Name -->
            <div class="mb-3">
                <label for="reviewName" class="form-label">Full Name</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" id="reviewName" name="name"
                    placeholder="e.g. John Doe" value="{{ old('name') }}" required />
                @error('name')
                    <div class="text-danger small">{{ $message }}</div>
                @enderror
            </div>

            <!-- Description -->
            <div class="mb-3">
                <label for="reviewDesc" class="form-label">Your Message</label>
                <textarea class="form-control @error('description') is-invalid @enderror" id="reviewDesc"
                    name="description" rows="3" placeholder="Share your dining experience..."
                    required>{{ old('description') }}</textarea>
                @error('description')
                    <div class="text-danger small">{{ $message }}</div>
                @enderror
            </div>

            <!-- Rating (Star selector) -->
            <div class="mb-3">
                <label class="form-label">Rating</label>
                <div class="star-input" id="starInput">
                    <span data-value="1" class="bi bi-star"></span>
                    <span data-value="2" class="bi bi-star"></span>
                    <span data-value="3" class="bi bi-star"></span>
                    <span data-value="4" class="bi bi-star"></span>
                    <span data-value="5" class="bi bi-star"></span>
                </div>
                <input type="hidden" id="ratingValue" name="rating" value="{{ old('rating', 0) }}" />
                <small class="text-muted" id="ratingLabel">Select a rating</small>
                @error('rating')
                    <div class="text-danger small">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn-submit">
                <i class="bi bi-send me-2"></i>Submit Review
            </button>
        </form>
    </div>
</div>

<script>
    // ===================== SUCCESS OVERLAY =====================
    document.addEventListener('DOMContentLoaded', function () {
        // Check if we have a success message from session
        @if(session('success'))
            showSuccessOverlay();
        @endif
    });

    function showSuccessOverlay() {
        const overlay = document.getElementById('successOverlay');
        overlay.classList.add('active');

        // Auto dismiss after 3 seconds
        setTimeout(function () {
            overlay.classList.remove('active');
        }, 3000);
    }

    // ===================== SCROLL LOGIC =====================
    (function () {
        const scrollRow = document.getElementById('scrollRow');
        const primaryTrack = document.getElementById('primaryTrack');

        if (scrollRow && primaryTrack) {
            let isDragging = false;
            let startX = 0;
            let currentTranslate = 0;
            let lastTranslate = 0;
            let animationID = null;
            let autoScrollSpeed = 0.8;
            let isAutoScrolling = true;

            const getHalfWidth = () => {
                const totalWidth = primaryTrack.scrollWidth;
                return totalWidth / 2;
            };

            const clampTranslate = (x) => {
                const halfWidth = getHalfWidth();
                if (x < -halfWidth) return x + halfWidth;
                if (x > 0) return x - halfWidth;
                return x;
            };

            const setTransform = (x) => {
                primaryTrack.style.transform = `translateX(${x}px)`;
            };

            const autoScroll = () => {
                if (!isAutoScrolling || isDragging) {
                    animationID = requestAnimationFrame(autoScroll);
                    return;
                }
                let newTranslate = lastTranslate - autoScrollSpeed;
                newTranslate = clampTranslate(newTranslate);
                lastTranslate = newTranslate;
                currentTranslate = newTranslate;
                setTransform(newTranslate);
                animationID = requestAnimationFrame(autoScroll);
            };

            const startAutoScroll = () => {
                if (animationID) cancelAnimationFrame(animationID);
                isAutoScrolling = true;
                autoScroll();
            };

            const stopAutoScroll = () => {
                isAutoScrolling = false;
                if (animationID) {
                    cancelAnimationFrame(animationID);
                    animationID = null;
                }
            };

            const onStart = (clientX) => {
                stopAutoScroll();
                isDragging = true;
                startX = clientX;
                const currentTransform = primaryTrack.style.transform;
                if (currentTransform) {
                    const match = currentTransform.match(/translateX\(([-.\d]+)px\)/);
                    if (match) {
                        lastTranslate = parseFloat(match[1]);
                    } else {
                        lastTranslate = 0;
                    }
                } else {
                    lastTranslate = 0;
                }
                currentTranslate = lastTranslate;
                primaryTrack.style.transition = 'none';
            };

            const onMove = (clientX) => {
                if (!isDragging) return;
                const deltaX = clientX - startX;
                let newTranslate = lastTranslate + deltaX;
                newTranslate = clampTranslate(newTranslate);
                currentTranslate = newTranslate;
                setTransform(newTranslate);
            };

            const onEnd = () => {
                if (isDragging) {
                    isDragging = false;
                    lastTranslate = currentTranslate;
                    setTimeout(() => {
                        if (!isDragging) {
                            startAutoScroll();
                        }
                    }, 1000);
                }
            };

            scrollRow.addEventListener('mousedown', (e) => {
                e.preventDefault();
                onStart(e.clientX);
            });
            window.addEventListener('mousemove', (e) => {
                onMove(e.clientX);
            });
            window.addEventListener('mouseup', () => {
                onEnd();
            });

            scrollRow.addEventListener('touchstart', (e) => {
                const touch = e.touches[0];
                if (touch) {
                    onStart(touch.clientX);
                }
            }, { passive: true });
            window.addEventListener('touchmove', (e) => {
                const touch = e.touches[0];
                if (touch) {
                    onMove(touch.clientX);
                }
            }, { passive: true });
            window.addEventListener('touchend', () => {
                onEnd();
            }, { passive: true });

            window.addEventListener('resize', () => {
                if (!isDragging) {
                    lastTranslate = clampTranslate(lastTranslate);
                    setTransform(lastTranslate);
                }
            });

            startAutoScroll();
        }
    })();

    // ===================== REVIEW FORM UI LOGIC =====================
    (function () {
        const overlay = document.getElementById('reviewOverlay');
        const openBtn = document.getElementById('openReviewBtn');
        const closeBtn = document.getElementById('closeReviewBtn');
        const form = document.getElementById('reviewForm');
        const starSpans = document.querySelectorAll('#starInput span');
        const ratingInput = document.getElementById('ratingValue');
        const ratingLabel = document.getElementById('ratingLabel');
        const fileInput = document.getElementById('reviewImage');
        const imagePreview = document.getElementById('imagePreview');
        const previewImg = document.getElementById('previewImg');
        const removeImgBtn = document.getElementById('removeImageBtn');
        let selectedRating = parseInt(ratingInput.value) || 0;

        // Open panel
        openBtn.addEventListener('click', (e) => {
            e.preventDefault();
            overlay.classList.add('active');
            document.body.style.overflow = 'hidden';
        });

        // Close panel
        const closePanel = () => {
            overlay.classList.remove('active');
            document.body.style.overflow = '';
        };

        closeBtn.addEventListener('click', closePanel);
        overlay.addEventListener('click', (e) => {
            if (e.target === overlay) closePanel();
        });

        // Star rating
        starSpans.forEach(span => {
            span.addEventListener('click', function () {
                const val = parseInt(this.dataset.value);
                selectedRating = val;
                ratingInput.value = val;
                updateStars(val);
                const labels = ['', 'Terrible', 'Poor', 'Average', 'Good', 'Excellent'];
                ratingLabel.textContent = labels[val] || 'Select a rating';
            });
            span.addEventListener('mouseenter', function () {
                const val = parseInt(this.dataset.value);
                updateStars(val, true);
            });
            span.addEventListener('mouseleave', function () {
                updateStars(selectedRating);
            });
        });

        function updateStars(rating, hover = false) {
            starSpans.forEach(span => {
                const val = parseInt(span.dataset.value);
                if (val <= rating) {
                    span.className = 'bi bi-star-fill';
                } else {
                    span.className = 'bi bi-star';
                }
            });
        }

        // Initialize stars if there's a value
        if (selectedRating > 0) {
            updateStars(selectedRating);
            const labels = ['', 'Terrible', 'Poor', 'Average', 'Good', 'Excellent'];
            ratingLabel.textContent = labels[selectedRating] || 'Select a rating';
        }

        // Image upload preview - FIXED
        fileInput.addEventListener('change', function (e) {
            const file = this.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function (ev) {
                    previewImg.src = ev.target.result;
                    imagePreview.style.display = 'flex';
                };
                reader.readAsDataURL(file);
            }
        });

        removeImgBtn.addEventListener('click', function () {
            fileInput.value = '';
            imagePreview.style.display = 'none';
            previewImg.src = '#';
        });

        // On form submit success, show overlay
        form.addEventListener('submit', function () {
            // The overlay will be shown by the session check after page reload
        });
    })();
</script>