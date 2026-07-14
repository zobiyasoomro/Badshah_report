@extends('layouts.master')

@section('content')


@include('components.pagesbanner', [
        'banner_title' => 'ABOUT US',
        'banner_button_text' => 'LEARN MORE',
        'banner_button_url' => 'WHY YOU CHOOSE US',
        'banner_description' => 'Have questions, feedback, or want to talk with us? Our team is ready to assist you anytime.'
    ])
  
    <section class="about-hero-layout position-relative min-vh-100 py-4 py-lg-5">
        <div class="container custom-premium-container text-white">
<div class="row align-items-center gy-5 mb-5 py-3">

    <!-- Left Content -->
<div class="col-lg-7 col-md-6 order-1 text-center text-md-start">
            <span class="text-uppercase tracking-widest text-cyan fw-bold fs-7 mb-2 d-block opacity-90">
            {{ $about->subtitle }}
        </span>

        <h1 class="fw-bold text-white mb-4 main-crypto-title">
            {{ $about->title }}
        </h1>

      <p class="hero-description-text mb-4 secondary-paragraph text-break">
    {!! nl2br(e($about->description)) !!}
</p>

<div class="mt-4 pt-1 d-flex justify-content-center justify-content-md-start">
                <button
                class="btn btn-cyber-cyan-premium px-4 py-25 fw-bold text-white text-uppercase tracking-wider">
                Our Strategic Vision
            </button>
        </div>

    </div>

    <!-- Right Logo -->
<div class="col-lg-5 col-md-6 text-center order-2">
        <div class="original-portal-ring-frame mx-auto">
            <div class="portal-tracer ring-dashed-glow"></div>

            <div class="portal-center-core d-flex align-items-center justify-content-center overflow-hidden">
                <img src="{{ asset('images/logo.png') }}" alt="bpn" class="img-fluid brand-logo-image">
            </div>
        </div>

    </div>

</div>
                    

            <!-- Middle Section: Horizontal Metric Grid System -->
            <div class="row g-4 mb-5 py-4">
                <div class="col-md-4">
                    <div class="metric-card-horizontal">
                        <h3 class="metric-value-display text-white fw-bold mb-1" data-target="25">$0M+</h3>
                        <p class="metric-sublabel text-cyan-muted mb-0 text-uppercase tracking-wider">24h Trading Volume</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="metric-card-horizontal">
                        <h3 class="metric-value-display text-white fw-bold mb-1" data-target="99">0%</h3>
                        <p class="metric-sublabel text-cyan-muted mb-0 text-uppercase tracking-wider">Core Ecosystem Uptime
                        </p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="metric-card-horizontal">
                        <h3 class="metric-value-display text-white fw-bold mb-1" data-target="150">0K+</h3>
                        <p class="metric-sublabel text-cyan-muted mb-0 text-uppercase tracking-wider">Active Global Accounts
                        </p>
                    </div>
                </div>
            </div>

            <!-- Section 3: Why Leaders Choose BetPro -->
            <div class="extended-proposition-block py-4 border-top border-dark-cyan mb-5">
                <div class="text-center mb-5">
                    <h2 class="h3 fw-bold text-white mb-3 secondary-crypto-heading tracking-wide">
                        WHY LEADERS CHOOSE <span class="text-cyan">BETPRO</span>
                    </h2>
                    <p class="feature-section-intro mx-auto col-lg-8">
                        Built completely from scratch to deliver your sports market execution and completely eliminate
                        traditional platform friction.
                    </p>
                </div>

                <div class="row g-4 justify-content-center">
                    <div class="col-xl-4 col-md-6 text-start">
                        <div class="premium-architecture-card">
                            <h4 class="text-cyan font-orbitron h5 mb-3 fw-bold">01. Peer Trading</h4>
                            <p class="architecture-card-text mb-0">Trade directly against logic and peer positions instead
                                of dealing with fixed house margins.</p>
                        </div>
                    </div>
                    <div class="col-xl-4 col-md-6 text-start">
                        <div class="premium-architecture-card">
                            <h4 class="text-cyan font-orbitron h5 mb-3 fw-bold">02. Ultra Latency</h4>
                            <p class="architecture-card-text mb-0">Low-latency approach built on top of modern
                                infrastructure so you never miss an execution window.</p>
                        </div>
                    </div>
                    <div class="col-xl-4 col-md-6 text-start">
                        <div class="premium-architecture-card">
                            <h4 class="text-cyan font-orbitron h5 mb-3 fw-bold">03. Secure Balances</h4>
                            <p class="architecture-card-text mb-0">Advanced balance management system with multi-layer
                                verification checks for complete safety.</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Section 4: Advanced Trading Capabilities -->
            <div class="extended-proposition-block py-4 border-top border-dark-cyan mb-5">
                <div class="row align-items-center gy-5">
                    <div class="col-lg-6 text-start">
                        <h2 class="h3 fw-bold text-white mb-3 secondary-crypto-heading tracking-wide">
                            NEXT-GEN <span class="text-cyan">LIQUIDITY POOLS</span>
                        </h2>
                        <p class="hero-description-text secondary-paragraph mb-4">
                            Our specialized core ledger routes trade data coordinates directly to high-capacity nodes,
                            maintaining consistent dynamic matching depth even during peak sports field events.
                        </p>
                        <ul class="list-unstyled feature-checklist-premium architecture-card-text">
                            <li class="mb-2"><span class="text-cyan me-2">âœ“</span> Automated matching index settlement</li>
                            <li class="mb-2"><span class="text-cyan me-2">âœ“</span> Zero margin spread inflation gates</li>
                            <li class="mb-2"><span class="text-cyan me-2">âœ“</span> Independent security clearing layers</li>
                        </ul>
                    </div>
                    <div class="col-lg-6">
                        <div class="premium-interactive-panel p-4 text-start">
                            <div class="panel-terminal-header mb-3 d-flex gap-2">
                                <span class="dot-red"></span><span class="dot-yellow"></span><span class="dot-green"></span>
                            </div>
                            <h5 class="font-orbitron text-white mb-2 fs-6">Ecosystem Security Architecture</h5>
                            <p class="architecture-card-text small mb-0 opacity-90">
                                Platform active integrity monitoring processes thousands of trade units per second.
                                Encrypted validation states keep your operational funds separate from core market processing
                                logic layers continuously.
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Section 5: Strategic Execution Pipeline -->
            <div class="extended-proposition-block py-4 border-top border-dark-cyan text-center">
                <h2 class="h3 fw-bold text-white mb-3 secondary-crypto-heading tracking-wide">
                    OPERATIONAL <span class="text-cyan">PIPELINE</span>
                </h2>
                <p class="feature-section-intro mx-auto col-lg-8 mb-5">
                    Get up and running within our optimized smart interface environments in simple, straightforward
                    framework stages.
                </p>
                <div class="row g-4 text-start">
                    <div class="col-md-4">
                        <div class="step-card-premium p-4">
                            <div class="step-badge mb-3 font-orbitron">STAGE 01</div>
                            <h5 class="text-white mb-2 font-orbitron fs-6">Secure Entry Mapping</h5>
                            <p class="architecture-card-text small mb-0">Initialize parameters via encrypted auth handshakes
                                quickly.</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="step-card-premium p-4">
                            <div class="step-badge mb-3 font-orbitron">STAGE 02</div>
                            <h5 class="text-white mb-2 font-orbitron fs-6">Liquidity Sync</h5>
                            <p class="architecture-card-text small mb-0">Connect directly into global active matching
                                streams instantly.</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="step-card-premium p-4">
                            <div class="step-badge mb-3 font-orbitron">STAGE 03</div>
                            <h5 class="text-white mb-2 font-orbitron fs-6">Instant Verification</h5>
                            <p class="architecture-card-text small mb-0">Execute orders seamlessly with sub-millisecond
                                return fields.</p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>

    <!-- Custom Scoped Style Engine Matching Original Look Properties -->
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Orbitron:wght@700;800;900&display=swap');

        :root {
            --deep-background: #2A4563 ;
            --neon-cyan-color: #00f3ff;
            --glow-depth-shadow: rgba(0, 243, 255, 0.4);
            --text-pure-clear: rgba(255, 255, 255, 0.98);
            --text-mid-clear: rgba(255, 255, 255, 0.85);
        }

        .about-hero-layout {
            background: radial-gradient(circle at 75% 20%, #0c1c38 0%, var(--deep-background) 80%);
            overflow: hidden;
        }

        .custom-premium-container {
            max-width: 1280px;
        }

        @media (min-width: 1400px) {
            .custom-premium-container {
                max-width: 1440px;
            }

            .main-crypto-title {
                font-size: 3.8rem !important;
            }
        }

        @media (min-width: 320px) {

            .main-crypto-title {
                font-size: 2.5rem !important;
            }
        }

        /* Headings Style Declarations */
        .main-crypto-title {
            font-family: 'Orbitron', sans-serif;
            font-size: 3.2rem;
            letter-spacing: 1px;
            line-height: 1.05;
        }

        .text-cyan {
            color: var(--neon-cyan-color) !important;
        }

        .text-glow-cyan {
            text-shadow: 0 0 15px var(--glow-depth-shadow);
        }

        /* Standard Readable Font Updates */
        .hero-description-text {
            font-family: 'Inter', -apple-system, sans-serif;
            font-size: 1.1rem;
            font-weight: 400;
            line-height: 1.6;
            color: var(--text-pure-clear);
            max-width: 620px;
        }

        .secondary-paragraph {
            color: var(--text-mid-clear);
            font-size: 1.05rem;
        }

        .feature-section-intro {
            font-family: 'Inter', -apple-system, sans-serif;
            font-size: 1.1rem;
            color: var(--text-mid-clear);
            font-weight: 400;
            line-height: 1.6;
        }

        .architecture-card-text {
            font-family: 'Inter', -apple-system, sans-serif;
            font-size: 1rem;
            line-height: 1.55;
            color: var(--text-mid-clear);
            font-weight: 400;
        }

        .architecture-card-text.small {
            font-size: 0.92rem;
        }

        /* Strategic Vision Button Properties */
        .btn-cyber-cyan-premium {
            background: var(--neon-cyan-color);
            color: var(--deep-background) !important;
            border: 2px solid var(--neon-cyan-color);
            font-family: 'Orbitron', sans-serif;
            border-radius: 4px;
            font-size: 0.85rem;
            box-shadow: 0 0 12px rgba(0, 243, 255, 0.2);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .btn-cyber-cyan-premium:hover {
            background: transparent;
            color: #ffffff !important;
            box-shadow: 0 0 25px var(--neon-cyan-color);
            transform: translateY(-2px);
        }

        .py-25 {
            padding-top: 0.7rem;
            padding-bottom: 0.7rem;
        }

        /* Circular Frame Asset Optimization (No Overlap/Clipping) */
        .original-portal-ring-frame {
            position: relative;
            width: 280px;
            height: 280px;
            border-radius: 50%;
        }

        @media (min-width: 1200px) {
            .original-portal-ring-frame {
                width: 340px;
                height: 340px;
            }
        }

        .portal-center-core {
            width: 100%;
            height: 100%;
            border-radius: 50%;
            background: #060c18;
            border: 2px solid rgba(0, 243, 255, 0.25);
            box-shadow: inset 0 0 30px rgba(0, 243, 255, 0.1);
            backdrop-filter: blur(6px);
        }

        .brand-logo-image {
            width: 100%;
            height: 100%;
            object-fit: contain;
            border-radius: 50%;
            transform: scale(0.92);
        }

        .portal-tracer {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            border-radius: 50%;
            pointer-events: none;
        }

        .ring-dashed-glow {
            transform: scale(1.05);
            border: 2px dashed rgba(0, 243, 255, 0.3);
            animation: spinClockwise 60s linear infinite;
        }

        /* Metric Display Panels */
        .metric-card-horizontal {
            background: rgba(255, 255, 255, 0.02);
            border-left: 3px solid var(--neon-cyan-color);
            padding: 1.25rem 1.5rem;
            border-radius: 0 4px 4px 0;
            backdrop-filter: blur(4px);
        }

        .metric-value-display {
            font-family: 'Orbitron', sans-serif;
            font-size: 1.8rem;
            letter-spacing: 0.5px;
        }

        .text-cyan-muted {
            color: rgba(0, 243, 255, 0.85) !important;
            font-family: 'Inter', -apple-system, sans-serif;
            font-weight: 600;
            font-size: 0.85rem;
        }

        /* Sub Proposition Cards */
        .secondary-crypto-heading {
            font-family: 'Orbitron', sans-serif;
            letter-spacing: 2px;
        }

        .border-dark-cyan {
            border-color: rgba(0, 243, 255, 0.08) !important;
        }

        .premium-architecture-card,
        .premium-interactive-panel,
        .step-card-premium {
            background: rgba(255, 255, 255, 0.01);
            border: 1px solid rgba(0, 243, 255, 0.05);
            padding: 2rem 1.75rem;
            border-radius: 4px;
            height: 100%;
            transition: all 0.3s ease;
        }

        .premium-architecture-card:hover,
        .step-card-premium:hover {
            transform: translateY(-2px);
            background: rgba(0, 243, 255, 0.02);
            border-color: rgba(0, 243, 255, 0.12);
        }

        .premium-interactive-panel {
            background: #2a4563;
            border-left: 3px solid var(--neon-cyan-color);
        }

        .step-badge {
            font-size: 0.75rem;
            background: rgba(0, 243, 255, 0.1);
            color: var(--neon-cyan-color);
            padding: 0.25rem 0.5rem;
            display: inline-block;
            border-radius: 2px;
            letter-spacing: 1px;
        }

        .dot-red,
        .dot-yellow,
        .dot-green {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            display: inline-block;
        }

        .dot-red {
            background: #ff5f56;
        }

        .dot-yellow {
            background: #ffbd2e;
        }

        .dot-green {
            background: #27c93f;
        }

        .font-orbitron {
            font-family: 'Orbitron', sans-serif;
        }

        .fs-7 {
            font-size: 0.85rem;
        }

        .mb-5 {
            margin-bottom: 3.5rem !important;
        }

        .opacity-90 {
            opacity: 0.9;
        }

        /* Keyframe Animations */
        @keyframes spinClockwise {
            0% {
                transform: scale(1.05) rotate(0deg);
            }

            100% {
                transform: scale(1.05) rotate(360deg);
            }
        }
    </style>


    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const metrics = document.querySelectorAll('.metric-value-display');

            const triggerCounters = () => {
                metrics.forEach(element => {
                    const target = parseInt(element.getAttribute('data-target'));
                    let current = 0;
                    const incrementalStep = target / 40;

                    const processIncrement = () => {
                        current += incrementalStep;
                        if (current < target) {
                            if (target === 25) element.textContent = `$${Math.floor(current)}.5M+`;
                            else if (target === 99) element.textContent = `${Math.floor(current)}.99%`;
                            else element.textContent = `${Math.floor(current)}K+`;
                            setTimeout(processIncrement, 25);
                        } else {
                            if (target === 25) element.textContent = "$2.5M+";
                            else if (target === 99) element.textContent = "99.99%";
                            else element.textContent = "150K+";
                        }
                    };
                    processIncrement();
                });
            };

            const viewObserver = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        triggerCounters();
                        viewObserver.disconnect();
                    }
                });
            }, { threshold: 0.1 });

            if (metrics.length > 0) viewObserver.observe(metrics[0]);
        });
    </script>
@endsection