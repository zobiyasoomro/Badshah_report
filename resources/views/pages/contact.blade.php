@extends('layouts.master')

@section('content')
   @include('components.pagesbanner', [
        'banner_title' => 'CONTACT US',
        'banner_button_text' => 'Get In Touch',
        'banner_button_url' => 'Weâ€™re Here to Help',
        'banner_description' => 'Have questions, feedback, or want to talk with us? Our team is ready to assist you anytime.'
    ])
    <!-- Core Viewport Framework Matching Premium Dark Aesthetics -->
    <section class="contact-layout-engine position-relative min-vh-100 py-4 py-lg-5">
        <div class="container custom-premium-container text-white">

            <!-- Header Introduction Segment -->
            <div class="text-center mb-5 max-w-700 mx-auto">
                <span class="text-uppercase tracking-widest text-cyan fw-bold fs-7 mb-2 d-block opacity-90">Connect
                    Globally</span>
                <h1 class="fw-bold text-white mb-3 contact-main-title">
                    GET IN <span class="text-cyan text-glow-cyan">TOUCH</span>
                </h1>
                <p class="contact-description-text">
                    Have tactical questions regarding asset clearing, liquidity nodes, or account validation metrics? Our
                    support infrastructure operates continuously.
                </p>
            </div>

            <!-- Main Workspace: Asymmetric 2-Column Responsive Layout -->
            <div class="row g-4 align-items-stretch">

                <!-- Left Grid Pane: Direct Infrastructure Channels -->
                <div class="col-lg-5">
                    <div class="d-flex flex-column h-100 justify-content-between gap-4">

                        <!-- Channel Card 1 -->
                        <div class="premium-channel-card p-4">
                            <div class="d-flex align-items-center gap-3 mb-3">
                                <div class="channel-icon-wrapper d-flex align-items-center justify-content-center">
                                    <span class="text-cyan font-orbitron fw-bold">@</span>
                                </div>
                                <h4 class="h6 font-orbitron text-white mb-0 tracking-wide text-uppercase">Core Support Desk
                                </h4>
                            </div>
                            <p class="channel-body-text mb-2">For live account settlements, system security validation, or
                                balance transfers.</p>
                            <a href="mailto:support@betproexchange.com"
                                class="channel-link font-orbitron text-cyan text-decoration-none small">support@betproexchange.com
                                </a>
                        </div>

                        <!-- Channel Card 2 (UPDATED: Dual Numbers with Interactive WhatsApp Icon) -->
                        <div class="premium-channel-card p-4">
                            <div class="d-flex align-items-center gap-3 mb-3">
                                <div class="channel-icon-wrapper d-flex align-items-center justify-content-center">
        <i class="fab fa-whatsapp text-cyan" style="font-size: 24px;"></i>
    </div>
                                <h4 class="h6 font-orbitron text-white mb-0 tracking-wide text-uppercase">Contact Us via
                                    WhatsApp</h4>
                            </div>
                            <p class="channel-body-text mb-3">Connect instantly with our live operations team for immediate,
                                real-time message assistance and quick technical guidance.</p>

                            <!-- Side-by-Side Dual Number Interface -->
                            <div
                                class="d-flex align-items-center flex-wrap gap-2 font-orbitron text-cyan custom-whatsapp-row">
                                <a href="https://wa.me/1234567890" target="_blank"
                                    class="channel-link text-decoration-none">+1 (234) 567-890</a>
                                <i class="fab fa-whatsapp whatsapp-inline-icon mx-1"></i>
                                <a href="https://wa.me/1987654321" target="_blank"
                                    class="channel-link text-decoration-none">+1 (987) 654-321 </a>
                            </div>
                        </div>

                        <!-- Channel Card 3 (Info Banner Panel) -->
                        <div class="premium-interactive-status p-4 border-left-cyan">
                            <div class="panel-terminal-header mb-3 d-flex gap-2">
                                <span class="dot-green-pulse"></span>
                                <span class="font-orbitron text-white fs-8 tracking-wider text-uppercase">System Status:
                                    Optimal</span>
                            </div>
                            <p class="channel-body-text mb-0 small opacity-90">
                                Our primary global ticket routing servers are running at 100% capacity with sub-minute
                                delivery windows.
                            </p>
                        </div>

                    </div>
                </div>

                <!-- Right Grid Pane: Clean, Highly Visible Contact Form Frame -->
                <div class="col-lg-7">
                    <div class="premium-form-container p-4 p-md-5 h-100">
                        <h3 class="h5 font-orbitron text-white mb-4 tracking-wide text-uppercase">Transmit Secure Message
                        </h3>
@if(session('success'))
    <div class="alert alert-success" id="success-alert">
        {{ session('success') }}
    </div>
@endif


                       <form action="{{ route('contact.store') }}" method="POST">
    @csrf
                            <div class="row g-3">
                                <!-- Identity Inputs -->
                                <div class="col-md-6">
                                    <div class="form-group-premium">
                                        <label class="form-label-premium font-orbitron">Name</label>
                                        <input type="text" name="name" class="form-control-premium"
                                            placeholder="e.g. Alex Mercer" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group-premium">
                                        <label class="form-label-premium font-orbitron">Your Email</label>
                                        <input type="email" name="email" class="form-control-premium"
                                            placeholder="name@domain.com" required>
                                    </div>
                                </div>

                                <!-- Context/Subject Header Input -->
                                <div class="col-12">
                                    <div class="form-group-premium">
                                        <label class="form-label-premium font-orbitron">Title/
                                            Subject</label>
                                        <input type="text" name="subject" class="form-control-premium"
                                            placeholder="e.g. API Node Latency Optimization Check" required>
                                    </div>
                                </div>

                                <!-- Detailed Text Content Block -->
                                <div class="col-12">
                                    <div class="form-group-premium">
                                        <label class="form-label-premium font-orbitron">Content/Description</label>
                                        <textarea name="description" rows="5" class="form-control-premium textarea-premium"
                                            placeholder="Detail your exact query or required technical parameters here..."
                                            required></textarea>
                                    </div>
                                </div>

                                <!-- Action Trigger Button -->
                                <div class="col-12 pt-2">
                                    <button type="submit"
                                        class="btn btn-cyber-cyan-premium w-100 py-3 fw-bold text-white text-uppercase tracking-wider">
                                        Submit
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- Custom Scoped Style Engine Matching About Look Properties -->
    <style>
      

        :root {
            --deep-background: #2A4563;
            --neon-cyan-color: #00f3ff;
            --glow-depth-shadow: rgba(0, 243, 255, 0.4);
            --text-pure-clear: rgba(255, 255, 255, 0.98);
            --text-mid-clear: rgba(255, 255, 255, 0.85);
        }
        

        .contact-layout-engine {
            background: radial-gradient(circle at 25% 20%, #0c1c38 0%, var(--deep-background) 80%);
            overflow: hidden;
        }

        .custom-premium-container {
            max-width: 1280px;
        }

        @media (min-width: 1400px) {
            .custom-premium-container {
                max-width: 1440px;
            }
        }

        /* Headings Style Declarations */
        .contact-main-title {
            font-family: 'Orbitron', sans-serif;
            font-size: 3.2rem;
            letter-spacing: 1px;
        }

        .text-cyan {
            color: var(--neon-cyan-color) !important;
        }

        .text-glow-cyan {
            text-shadow: 0 0 15px var(--glow-depth-shadow);
        }

        /* Descriptions & Typography Visibility Maps */
        .contact-description-text {
            font-family: 'Inter', -apple-system, sans-serif;
            font-size: 1.1rem;
            font-weight: 400;
            line-height: 1.6;
            color: var(--text-mid-clear);
        }

        .channel-body-text {
            font-family: 'Inter', -apple-system, sans-serif;
            font-size: 0.95rem;
            line-height: 1.5;
            color: var(--text-mid-clear);
        }

        /* Channel Card Components */
        .premium-channel-card,
        .premium-form-container {
            background: rgba(255, 255, 255, 0.01);
            border: 1px solid rgba(0, 243, 255, 0.05);
            border-radius: 4px;
            transition: all 0.3s ease;
        }

        .premium-channel-card:hover {
            transform: translateY(-2px);
            background: rgba(0, 243, 255, 0.02);
            border-color: rgba(0, 243, 255, 0.12);
        }

        .channel-icon-wrapper {
            width: 36px;
            height: 36px;
            background: rgba(0, 243, 255, 0.08);
            border: 1px solid rgba(0, 243, 255, 0.2);
            border-radius: 4px;
            font-size: 1.1rem;
        }

        .custom-whatsapp-row {
            font-size: 0.85rem;
        }

        .whatsapp-inline-icon {
            color: #25D366;
            /* Official WhatsApp Brand Green */
            font-size: 1.05rem;
            text-shadow: 0 0 8px rgba(37, 211, 102, 0.4);
        }

        .channel-link {
            color: var(--neon-cyan-color);
            letter-spacing: 0.5px;
            transition: all 0.2s ease;
        }

        .channel-link:hover {
            opacity: 0.8;
            color: #ffffff !important;
        }

        /* Custom Form & Control Processing Elements */
        .form-group-premium {
            margin-bottom: 1.25rem;
        }

        .form-label-premium {
            display: block;
            font-size: 0.72rem;
            color: var(--neon-cyan-color);
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 0.5rem;
            font-weight: 700;
        }

        .form-control-premium {
            width: 100%;
            background: var(--input-bg-dark);
            border: 1px solid rgba(0, 243, 255, 0.1);
            border-radius: 4px;
            padding: 0.75rem 1rem;
            color: #ffffff;
            font-family: 'Inter', -apple-system, sans-serif;
            font-size: 0.95rem;
            transition: all 0.25s ease;
        }

        .form-control-premium:focus {
            outline: none;
            border-color: var(--neon-cyan-color);
            background: rgba(0, 243, 255, 0.02);
            box-shadow: 0 0 10px rgba(0, 243, 255, 0.1);
        }

        .form-control-premium::placeholder {
            color: rgba(255, 255, 255, 0.25);
        }

        .textarea-premium {
            resize: none;
        }

        /* Callout & Interactive Framework Components */
        .border-left-cyan {
            border-left: 3px solid var(--neon-cyan-color);
        }

        .premium-interactive-status {
            background: #2a4563;
            border: 1px solid rgba(0, 243, 255, 0.05);
            border-left: 3px solid var(--neon-cyan-color);
            border-radius: 0 4px 4px 0;
        }

        /* Action Trigger Button Properties */
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

        /* Global Utilities */
        .font-orbitron {
            font-family: 'Orbitron', sans-serif;
        }

        .fs-7 {
            font-size: 0.85rem;
        }

        .fs-8 {
            font-size: 0.75rem;
        }

        .max-w-700 {
            max-width: 700px;
        }

        .opacity-90 {
            opacity: 0.9;
        }

        .dot-green-pulse {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: #27c93f;
            display: inline-block;
            box-shadow: 0 0 8px #27c93f;
        }
    </style>

    <script>
    setTimeout(function () {
        let alert = document.getElementById('success-alert');

        if (alert) {
            alert.style.display = 'none';
        }
    }, 4000);
</script>
@endsection