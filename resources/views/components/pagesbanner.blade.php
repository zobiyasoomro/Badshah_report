<div class="banner-wrapper"
    style="position: relative; background-image: url('{{ asset('images/main-banner.png') }}'); background-size: cover; background-position: center; min-height: 450px; display: flex; align-items: center; justify-content: center; overflow: hidden;">

    <!-- Central Content Container -->
    <div class="container text-center" style="max-width: 100%; padding: 20px;">

        <!-- Larger Logo -->
        <div class="mb-3">
            <img src="{{ asset('images/logo.png') }}" alt="BetPro Logo"
                style="width: 160px; height: 160px; border-radius: 50%; border: 3px solid #00f3ff; box-shadow: 0 0 25px rgba(0, 243, 255, 0.6);">
        </div>

        <!-- Dynamic Title: Fits perfectly inside the visual circle -->
        <h1 class="text-white fw-bold text-uppercase mb-2"
            style="font-family:'Orbitron',sans-serif;font-size:clamp(1.5rem,4vw,2.8rem);letter-spacing:2px;text-shadow:0 0 15px #00f3ff;">
            {{ $banner_title }}
        </h1>

        <!-- Dynamic Description: Clean and readable -->
        <p class="text-white mx-auto mb-4"
            style="max-width:650px;font-size:clamp(.9rem,2vw,1.2rem);opacity:.95;line-height:1.5;">
            {{ $banner_description }}
        </p>

        <!-- Dynamic Button -->
        @if(!empty($banner_button_text))
            <a href="{{ $banner_button_url ?? '#' }}" class="btn"
                style="background:#00f3ff;color:#050b11;font-weight:bold;padding:12px 40px;text-transform:uppercase;border-radius:4px;">
                {{ $banner_button_text }}
            </a>
        @endif
    </div>
</div>