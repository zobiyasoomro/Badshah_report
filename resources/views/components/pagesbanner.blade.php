<style>
    /* Dull background overlay */
    .banner-wrapper::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.65);
        /* Change 0.65 to adjust darkness (0 = light, 1 = totally black) */
        z-index: 1;
        pointer-events: none;
        /* Let clicks pass through to buttons if needed */
    }

    /* Keep your content above the overlay */
    .banner-wrapper .container,
    .banner-wrapper .container * {
        position: relative;
        z-index: 2;
    }
</style>
<div class="banner-wrapper"
    style="position: relative; background-image: url('{{ asset('images/banner_image.png') }}'); background-size: cover; background-position: center; min-height: 450px; display: flex; align-items: center; justify-content: center; overflow: hidden; padding: 20px;">

    <div class="container" style="max-width: 1200px; width: 100%;">
        <div class="row align-items-center">

            <!-- Left Side: Title, Description, and Buttons -->
            <div class="col-lg-6 col-md-8 text-start ps-lg-0">
                <h1 class="fw-bold mb-3"
                    style="font-family:'Orbitron',sans-serif; font-size:clamp(2.5rem,5vw,4.5rem); color:#00f3ff; text-shadow: 0 0 25px rgba(0, 243, 255, 0.5); line-height: 1.1;">
                    {{ $banner_title }}
                </h1>

                <p class="text-white mb-4" style="font-size:clamp(1rem,1.5vw,1.3rem); opacity:0.9; max-width: 500px;">
                    {{ $banner_description }}
                </p>

                <div class="d-flex flex-wrap gap-3 mt-2">
                    <!-- Primary Button (Register) -->
                    <a href="{{ $banner_button_url ?? '#' }}" class="btn rounded-pill px-4 py-2"
                        style="background:#00f3ff; color:#050b11; font-weight:bold; font-size:1rem; min-width: 140px; border: none;">
                        {{ $banner_button_text ?? 'Register' }}
                    </a>

                    <!-- Secondary Button (Get Bonus - Added to match screenshot) -->
                    <a href="#" class="btn rounded-pill px-4 py-2"
                        style="background:transparent; border: 2px solid #00f3ff; color:#00f3ff; font-weight:bold; font-size:1rem; min-width: 140px;">
                        Get Bonus
                    </a>
                </div>
            </div>

            <!-- Right Side: Casino Graphic Image Slot -->
            <div class="col-lg-6 col-md-4 text-end mt-4 mt-md-0 pe-lg-0">
                <!-- Replace 'casino-graphic.png' with your actual right-side image -->
               <img src="{{ asset('images/banner_images_2.png') }}" alt="Casino Graphic"
                    style="max-width: 100%; max-height: 350px; object-fit: contain;">
            </div>

        </div>
    </div>
</div>