<!-- navbar.blade.php -->
<nav class="navbar navbar-expand-lg navbar-dark" style="background: linear-gradient(90deg, #1e3a8a 0%, #1e40af 100%); box-shadow: 0 4px 12px rgba(0, 0, 0, 0.3);">
    <div class="container-fluid px-4">
        
        <!-- Logo -->
        <a class="navbar-brand d-flex align-items-center gap-2 fw-bold fs-4" href="#" style="color: #fff; font-family: system-ui, -apple-system, sans-serif;">
            <!-- Yellow Clover Icon (SVG) -->
            <svg width="32" height="32" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M12 4C12 4 8 8 8 12C8 15.3137 10.6863 18 14 18C17.3137 18 20 15.3137 20 12C20 8 16 4 12 4Z" fill="#facc15"/>
                <path d="M12 4C12 4 16 8 16 12C16 15.3137 13.3137 18 10 18C6.68629 18 4 15.3137 4 12C4 8 8 4 12 4Z" fill="#facc15"/>
                <circle cx="12" cy="12" r="3" fill="#eab308"/>
            </svg>
            Goling
        </a>

        <!-- Toggler -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" 
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Menu -->
        <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
            <ul class="navbar-nav gap-4">
                <li class="nav-item">
                    <a class="nav-link text-white fw-medium" href="#">Homes</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white fw-medium" href="#">Games</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white fw-medium" href="#">Tournament</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white fw-medium" href="#">Jackpot Game</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white fw-medium" href="#">Promotions</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white fw-medium" href="#">Winners</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white fw-medium" href="#">FAQ</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white fw-medium" href="#">Support</a>
                </li>
            </ul>
        </div>

        <!-- Right Side Buttons -->
        <div class="d-flex align-items-center gap-3 ms-auto">
            <a href="#" 
               class="btn btn-outline-light px-4 py-2 fw-medium"
               style="background: rgba(255,255,255,0.15); border: 1px solid rgba(255,255,255,0.4); color: #fff; border-radius: 50px;">
                Sign In
            </a>
            <a href="#" 
               class="btn px-5 py-2 fw-medium text-white"
               style="background: linear-gradient(90deg, #f59e0b, #fb923c); border: none; border-radius: 50px; box-shadow: 0 4px 12px rgba(251, 146, 60, 0.4);">
                Sign Up
            </a>
        </div>
    </div>
</nav>

<!-- Include Bootstrap 5 -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>