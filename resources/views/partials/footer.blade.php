<style>
    html,
    body {
        margin: 0;
        padding: 0;
        overflow-x: hidden;
        overflow-y: auto;
    }

    * {
        box-sizing: border-box;
    }

    .custom-footer {
        background-color: #2A4563;
        color: #a5bacc;
        padding-top: 44px;
        padding-bottom: 10px;
        font-size: 18px;
        position: relative;
        z-index: 1;
        overflow: hidden;
        min-height: 312px;
    }

    /* Pseudo-element for the background card image */
    .custom-footer::after {
        margin-top: 10px;
        content: "";
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-position: right bottom;
        background-repeat: no-repeat;
        background-size: auto 85%;
        opacity: 0.10;
        z-index: -1;
        pointer-events: none;
        transform: rotate(-25deg);
        transform-origin: right bottom;
    }

    .custom-footer .container {
        position: relative;
        z-index: 2;
    }

    .custom-footer h5 {
        color: #ffffff;
        font-size: 22px;
        font-weight: 600;
        margin-bottom: 25px;
    }

    .custom-footer p {
        line-height: 1.6;
    }

    .custom-footer ul {
        padding-left: 0;
        list-style: none;
    }

    .custom-footer ul li {
        margin-bottom: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    @media (min-width: 768px) {
        .custom-footer ul li {
            justify-content: flex-start;
        }
    }

    .custom-footer ul li i {
        font-size: 12px;
        margin-right: 10px;
        color: #a5bacc;
    }

    .custom-footer ul li a {
        color: #a5bacc;
        text-decoration: none;
        transition: color 0.2s ease;
    }

    .custom-footer ul li a:hover {
        color: #ffffff;
    }

    .social-icons a {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 36px;
        height: 36px;
        border-radius: 50%;
        color: #ffffff;
        margin: 0 5px;
        text-decoration: none;
        font-size: 14px;
    }

    @media (min-width: 768px) {
        .social-icons a {
            margin: 0 10px 0 0;
        }
    }

    .social-facebook {
        background-color: #3b5998;
    }

    .social-twitter {
        background-color: #1da1f2;
    }

    .social-youtube {
        background-color: #ff0000;
    }

    .social-pinterest {
        background-color: #bd081c;
    }

    .footer-bottom {
        background-color: #1d334d;
        ;
        color: #ffffffef;
        padding: 20px 0;
        font-size: 13px;
        border-top: 1px solid rgba(255, 255, 255, .05);
        position: relative;
        z-index: 3;
        overflow: hidden;
    }

    .footer-bottom a {
        color: #ffffff;
        text-decoration: none;
        margin: 0 8px;
    }

    @media (min-width: 768px) {
        .footer-bottom a {
            margin-left: 15px;
            margin-right: 0;
        }
    }

    .footer-bottom a:hover {
        color: #ffffff;
    }

    /* Footer card images - Responsive positioning */
    .footer-card-wrapper {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        pointer-events: none;
        z-index: 9999;
        overflow: hidden;
    }

    .footer-card {
        position: absolute;
        pointer-events: none;
        z-index: 9999;
        opacity: 0.15;
    }

    /* Right card - positioned at bottom-right corner */
    .footer-card-right {
        bottom: 20px;
        right: -20px;
        width: 260px;
        transform: rotate(-25deg);
        transform-origin: bottom right;
    }

    /* Left card - positioned at bottom-left corner */
    .footer-card-left {
        bottom: 20px;
        left: -20px;
        width: 260px;
        transform: scaleX(-1) rotate(-25deg);
        transform-origin: bottom left;
    }

    .scroll-top-btn {
        background-color: #2A4563;
        color: #fff;
        width: 40px;
        height: 40px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        position: absolute;
        right: 30px;
        bottom: 12px;
        cursor: pointer;
        z-index: 99999;
    }

    /* ========== RESPONSIVE BREAKPOINTS ========== */

    /* Large screens (1200px and above) */
    @media (min-width: 1200px) {
        .footer-card-right {
            width: 280px;
            bottom: 55px;
            right: -30px;
        }

        .footer-card-left {
            width: 280px;
            bottom: -60px;
            left: 180px;
        }
    }

    /* Medium screens (992px - 1199px) */
    @media (min-width: 992px) and (max-width: 1199px) {
        .footer-card-right {
            width: 240px;
            bottom: 50px;
            right: -50px;
        }

        .footer-card-left {
            width: 240px;
            bottom: -50px;
            left: 180px;
        }
    }

    /* Tablet screens (768px - 991px) */
    @media (min-width: 768px) and (max-width: 991px) {
        .footer-card-right {
            width: 240px;
            bottom: 40px;
            right: -50px;
        }

        .footer-card-left {
            width: 240px;
            bottom: -60px;
            left: 170px;
        }
    }

    /* Small tablets / Large phones (576px - 767px) */
    @media (min-width: 576px) and (max-width: 767px) {
        .footer-card-right {
            width: 140px;
            bottom: 15px;
            right: -10px;
            /* transform: scaleX(-) rotate(25deg); */

            /* opacity: 0.10; */
        }

        .footer-card-left {
            width: 140px;
            bottom: 15px;
            left: -10px;
            /* opacity: 0.10; */
        }
    }




    /* ==========================================
   Mobile Large (480px - 575px)
========================================== */
    @media (min-width: 480px) and (max-width: 575px) {
        .footer-card-right {
            width: 110px;
            bottom: 12px;
            right: -8px;
            opacity: 0.08;
        }

        .footer-card-left {
            width: 110px;
            bottom: 12px;
            left: -8px;
            opacity: 0.08;
        }
    }

    /* ==========================================
   Mobile Medium (425px - 479px)
========================================== */
    @media (min-width: 425px) and (max-width: 479px) {
        .footer-card-right {
            width: 200px;
            bottom: 40px;
            right: -50px;
            /* opacity: 0.07; */
        }

        .footer-card-left {
            width: 200px;
            bottom: 500px;
            left: 130px;
            /* opacity: 0.07; */
        }
    }

    /* ==========================================
   Mobile Small (375px - 424px)
========================================== */
    @media (min-width: 375px) and (max-width: 424px) {
        .footer-card-right {
            width: 200px;
            bottom: 40px;
            right: -50px;
            /* opacity: 0.07; */
        }

        .footer-card-left {
            width: 200px;
            bottom: 500px;
            left: 130px;
            /* opacity: 0.07; */
        }
    }

    /* ==========================================
   Very Small Devices (360px - 374px)
========================================== */
    @media (min-width: 360px) and (max-width: 374px) {
        .footer-card-right {
            width: 200px;
            bottom: 40px;
            right: -50px;
            /* opacity: 0.07; */
        }

        .footer-card-left {
            width: 200px;
            bottom: 500px;
            left: 130px;
            /* opacity: 0.07; */
        }
    }

    /* ==========================================
   Extra Small Devices (320px - 359px)
========================================== */
    @media (min-width: 320px) and (max-width: 359px) {
        .footer-card-right {
            width: 200px;
            bottom: 40px;
            right: -50px;
            /* opacity: 0.07; */
        }

        .footer-card-left {
            width: 200px;
            bottom: 500px;
            left: 130px;
            /* opacity: 0.07; */
        }
    }

    /* ==========================================
   Ultra Small Devices (Below 320px)
========================================== */
    @media (max-width: 319px) {
        .footer-card-right {
            width: 200px;
            bottom: 40px;
            right: -50px;
            /* opacity: 0.07; */
        }

        .footer-card-left {
            width: 200px;
            bottom: 500px;
            left: 130px;
            /* opacity: 0.07; */
        }
    }
</style>

<footer class="custom-footer">
    <!-- Card images placed inside footer for proper layering -->
    <div class="footer-card-wrapper">
        <img src="{{ asset('images/footer_cards.png') }}" class="footer-card footer-card-right" alt="Footer Cards">
        <img src="{{ asset('images/footer_cards.png') }}" class="footer-card footer-card-left" alt="Footer Cards">
    </div>

    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-6 mb-5 mb-lg-0 text-center text-md-start">
                <h5>About Kusin</h5>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quis dicta dignissimos enim reprehenderit
                    minima repudiandae animi.</p>
                <div class="social-icons mt-4">
                    <a href="#" class="social-facebook"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="social-twitter"><i class="fab fa-twitter"></i></a>
                    <a href="#" class="social-youtube"><i class="fab fa-youtube"></i></a>
                    <a href="#" class="social-pinterest"><i class="fab fa-pinterest-p"></i></a>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 mb-2 mb-lg-0 ps-md-5 text-center text-md-start">
                <h5>Regular Links</h5>
                <ul>
                    <li><i class="fas fa-angle-right"></i><a href="{{ route('pages.home') }}">Home</a></li>
                    <li><i class="fas fa-angle-right"></i><a href="{{ route('pages.about') }}">About Us</a></li>
                    <li><i class="fas fa-angle-right"></i><a href="{{ route('pages.platforms') }}">Platforms</a></li>
                    <li><i class="fas fa-angle-right"></i><a href="{{ route('pages.planes') }}">Planes</a></li>
                    <li><i class="fas fa-angle-right"></i><a href="{{ route('pages.contact') }}">Contact Us</a></li>
                </ul>
            </div>

            <div class="col-lg-3 col-md-6 mb-5 mb-md-0 text-center text-md-start">
                <h5>Essentials</h5>
                <ul>
                    <li><i class="fas fa-angle-right"></i><a href="#">BetPro PK</a></li>
                    <li><i class="fas fa-angle-right"></i><a href="#">BetPro Dubai</a></li>
                    <li><i class="fas fa-angle-right"></i><a href="#">BetPro Saudi</a></li>

                </ul>
            </div>

            <div class="col-lg-3 col-md-6 text-center text-md-start">
                <h5>Help & Support</h5>
                <ul>
                    <li><i class="fas fa-angle-right"></i><a href="#">Help Center</a></li>
                    <li><i class="fas fa-angle-right"></i><a href="#">Forum</a></li>
                    <li><i class="fas fa-angle-right"></i><a href="#">FAQ</a></li>
                    <li><i class="fas fa-angle-right"></i><a href="{{ route('pages.blog') }}">Blog</a></li>
                    <li><i class="fas fa-angle-right"></i><a href="{{ route('pages.contact') }}">Contact Us</a>
                </ul>
            </div>
        </div>
    </div>
</footer>

<div class="footer-bottom">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-6 text-center text-md-start mb-3 mb-md-0" style="font-weight: bold;">
                Copyright © 2026 All rights reserved
            </div>
            <div class="col-md-6 text-center text-md-end pe-md-5" style="font-weight: bold;">
                <a href="#">Privacy</a>
                <a href="#">Contact</a>
                <a href="#">Terms & Service</a>
                <a href="#">Conditions</a>
            </div>
        </div>
    </div>

    <div class="scroll-top-btn d-none d-md-flex">
        <i class="fas fa-chevron-up"></i>
    </div>
</div>