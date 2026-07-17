@extends('layouts.master')

@section('content')
@include('components.pagesbanner', [
        'banner_title' => 'Platforms',
        'banner_button_text' => 'Secure and Trusted Platforms',
        'banner_button_url' => '#',
        'banner_description' => 'Have questions, feedback, or want to talk with us? Our team is ready to assist you anytime.'
    ])

@include('components.btns')

<style>
    :root {
        --bg-dark: #2A4563;
        --bg-card: #121F2B;
        --accent-cyan: #00E5FF;
        --text-main: #FFFFFF;
        --text-dim: #A0B3C6;
        --border-line: rgba(0, 229, 255, 0.15);
    }

    body { background-color: var(--bg-dark); margin: 0; padding: 0; }
    .platforms-section { max-width: 980px; margin: 0 auto; padding: 64px 20px 100px; }
    
    .header-container { text-align: center; margin-bottom: 40px; }
    .page-title { 
        font-family: sans-serif;
        font-size: clamp(1.8rem, 5vw, 2.5rem); 
        font-weight: 700; 
        color: var(--accent-cyan); 
        text-transform: uppercase;
        letter-spacing: 1px;
        margin-bottom: 16px;
    }
    .page-subtitle { color: #dee2e6; font-size: 1.1rem; max-width: 687px; margin: 0 auto; line-height: 1.6; }
    
    .platform-list { display: flex; flex-direction: column; gap: 16px; }
    .platform-card { background: var(--bg-card); border: 1px solid var(--border-line); border-radius: 8px; overflow: hidden; transition: 0.3s; }
    .platform-card.is-open { border-color: var(--accent-cyan); }

    .platform-row { display: flex; align-items: stretch; padding: 0; }
    .platform-logo { 
        width: 150px; margin: 5px; padding: 15px;
        display: flex; align-items: center; justify-content: center; 
        background: rgba(0, 229, 255, 0.05); border-radius: 8px; 
        flex-shrink: 0; overflow: hidden;
    }
    .platform-logo img { max-width: 100%; max-height: 100%; object-fit: contain; }
    
    .platform-info { padding: 20px 24px; flex: 1; display: flex; flex-direction: column; justify-content: center; }
    .platform-name { color: var(--text-main); font-weight: 600; font-size: 1.05rem; margin-bottom: 4px; }
    .subtitle-text { color: var(--accent-cyan); font-size: 0.85rem; font-weight: 500; margin-bottom: 4px; }
    .status-pill { font-size: 0.65rem; color: var(--accent-cyan); background: rgba(0, 229, 255, 0.08); padding: 3px 10px; border-radius: 4px; border: 1px solid var(--border-line); display: inline-block; margin-top: 8px; align-self: flex-start; }
    .status-pill.is-offline { color: var(--text-dim); background: rgba(160, 179, 198, 0.08); border-color: rgba(160, 179, 198, 0.2); }
    
    .btn-action { background: transparent; border: 1px solid var(--accent-cyan); color: var(--accent-cyan); padding: 8px 20px; font-size: 0.85rem; font-weight: 600; border-radius: 4px; transition: 0.2s; align-self: center; margin-right: 24px; cursor: pointer; }
    .btn-action:hover { background: var(--accent-cyan); color: var(--bg-dark); }
    
    .platform-details { display: grid; grid-template-rows: 0fr; transition: 0.45s ease; }
    .platform-card.is-open .platform-details { grid-template-rows: 1fr; }
    .details-inner { overflow: hidden; }
    .details-content { padding: 40px 24px 24px 24px; border-top: 1px solid var(--border-line); background: var(--bg-dark); position: relative; }
    
    .cross-btn { position: absolute; top: 10px; right: 15px; cursor: pointer; color: var(--text-dim); font-size: 1.5rem; padding: 10px; }
    .cross-btn:hover { color: var(--text-main); }
    
    .btn-join { background: var(--accent-cyan); color: var(--bg-dark); padding: 10px 24px; font-size: 0.9rem; border-radius: 4px; text-decoration: none; font-weight: 700; display: inline-block; }

    @media (max-width: 768px) {
        .platform-row { flex-direction: column; text-align: center; padding: 15px 0; }
        .platform-logo { margin: 0 auto 15px auto; }
        .platform-info { align-items: center; padding: 0 20px; }
        .btn-action { margin: 15px 0 0 0; }
    }
</style>

<section class="platforms-section">
    <div class="header-container">
        <h1 class="page-title">Trusted Global Partnerships</h1>
        <p class="page-subtitle">We have curated a network of industry-leading platforms in partnership with Bet Pro Exchange.</p>
    </div>

    <div class="platform-list">
        @forelse($platforms as $platform)
        <div class="platform-card" id="card-{{ $platform->id }}">
            <div class="platform-row">
                <div class="platform-logo">
                    <img src="{{ $platform->logo ? asset($platform->logo) : asset('images/logo.png') }}" alt="{{ $platform->name }}">
                </div>
                
                <div class="platform-info">
                    <h5 class="platform-name">{{ $platform->name }}</h5>
                    @if($platform->subtitle)
                        <p class="subtitle-text">{{ $platform->subtitle }}</p>
                    @endif
                    <p class="text-secondary mb-0" style="font-size: 0.85rem;">{{ Str::limit($platform->description, 80) }}</p>
                    @if($platform->status)
                        <span class="status-pill">Online</span>
                    @else
                        <span class="status-pill is-offline">Offline</span>
                    @endif
                </div>
                <button type="button" class="btn-action" onclick="toggleCard('card-{{ $platform->id }}')">Learn More</button>
            </div>
            
            <div class="platform-details">
                <div class="details-inner">
                    <div class="details-content">
                        <span class="cross-btn" onclick="toggleCard('card-{{ $platform->id }}')"> <i class="fas fa-times"></i></span>
                        <p class="text-white" style="line-height: 1.6; font-size: 0.95rem; margin-bottom: 24px;">
                            {{ $platform->description }}
                        </p>
                        @if($platform->join_url)
                            <a href="{{ $platform->join_url }}" target="_blank" rel="noopener" class="btn-join">Join Now</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        @empty
            <p class="text-center text-secondary py-5">No partner platforms available right now.</p>
        @endforelse
    </div>
</section> 

@include('components.testimonial')

<script>
    function toggleCard(cardId) {
        document.getElementById(cardId).classList.toggle('is-open');
    }
</script>
@endsection