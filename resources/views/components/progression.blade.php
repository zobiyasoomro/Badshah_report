<style>
  /* ===== Progression / "How It Works" section â€” self-contained styles ===== */

  .progression-section { background: var(--bg-dark); padding-top: 24px; padding-bottom: 90px; }
  .progression-section .wrap { max-width: 1180px; margin: 0 auto; padding: 0 32px; }
  .progression-section .sec-head { margin-bottom: 80px; }
  .progression-label { color: var(--accent-cyan); font-size: 12px; text-transform: uppercase; letter-spacing: 2px; margin-bottom: 16px; }
  .progression-heading { font-size: 48px; color: var(--text-main); font-weight: 700; }

  .path-track { padding-left: 20px; border-left: 2px solid var(--accent-cyan); }
  .path-step { position: relative; padding: 0 0 60px 40px; }
  .path-marker {
    position: absolute; left: -31px; top: 0; width: 20px; height: 20px;
    background: var(--bg-dark); border: 2px solid var(--accent-cyan);
    transform: rotate(45deg); display: flex; align-items: center; justify-content: center;
  }
  .path-marker span { color: var(--accent-cyan); transform: rotate(-45deg); font-size: 12px; font-weight: bold; }
  .path-marker-check { color: #22C55E !important; font-size: 16px !important; }
  .path-marker-final { border-color: #FFFFFF !important; }
  .path-step h3 { font-size: 28px; color: var(--text-main); margin-bottom: 10px; }
  .path-step p { color: var(--text-dim); font-size: 16px; max-width: 500px; line-height: 1.6; }

  /* Responsive */
  @media (max-width: 1024px) {
    .progression-section { padding-top: 18px; padding-bottom: 64px; }
    .progression-section .wrap { padding: 0 24px; }
    .progression-section .sec-head { margin-bottom: 56px; }
    .progression-heading { font-size: 38px; }
  }
  @media (max-width: 768px) {
    .progression-section { padding-top: 14px; padding-bottom: 48px; }
    .progression-section .wrap { padding: 0 20px; }
    .progression-heading { font-size: 30px; }
    .path-step { padding: 0 0 44px 32px; }
    .path-marker { left: -27px; width: 16px; height: 16px; }
    .path-step h3 { font-size: 22px; }
  }
  @media (max-width: 480px) {
    .progression-section { padding-top: 10px; padding-bottom: 32px; }
    .progression-section .wrap { padding: 0 16px; }
    .progression-section .sec-head { margin-bottom: 40px; }
    .progression-heading { font-size: 24px; }
    .path-track { padding-left: 14px; }
    .path-step { padding: 0 0 36px 26px; }
    .path-marker { left: -21px; width: 14px; height: 14px; }
    .path-marker span { font-size: 10px; }
    .path-step h3 { font-size: 18px; margin-bottom: 6px; }
    .path-step p { font-size: 14px; }
  }
</style>

<section class="pad progression-section">
  <div class="wrap">
    <div class="sec-head">
      <div class="progression-label">How It Works</div>
      <h2 class="progression-heading">Your Path to VIP Status</h2>
    </div>

    <div class="path-track">
      @php
        $steps = [
          ['title' => 'Start', 'desc' => 'Review the tier ladder to see which status matches your play style.'],
          ['title' => 'Select Plan', 'desc' => 'Click the "Buy Now" button on your preferred tier to begin activation.'],
          ['title' => 'Verify Details', 'desc' => 'Enter your account information to link your wallet or profile.'],
          ['title' => 'Activation', 'desc' => 'Your status is updated instantlyâ€”welcome to the inner circle.'],
          ['title' => 'Enjoy', 'desc' => 'Settle in and make the most of your new tier\'s benefits, from priority support to exclusive invitations.']
        ];
      @endphp
@foreach($steps as $index => $step)
  <div class="path-step">
    <div class="path-marker {{ $loop->last ? 'path-marker-final' : '' }}">
      <span class="{{ $loop->last ? 'path-marker-check' : '' }}">
        {{ $loop->last ? '✓' : '→' }}
      </span>
    </div>

    <h3>0{{ $index + 1 }}. {{ $step['title'] }}</h3>
    <p>{{ $step['desc'] }}</p>
  </div>
@endforeach
    </div>
  </div>
</section>