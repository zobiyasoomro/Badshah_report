<style>
  /* ===== Host / Concierge section â€” self-contained styles ===== */

  .host { padding-top: 90px; padding-bottom: 24px; background: var(--bg-dark); }
  .host .wrap { max-width: 1180px; margin: 0 auto; padding: 0 32px; }

  .host-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 48px; align-items: start; }

  .host-media { display: flex; flex-direction: column; gap: 20px; }
  .host-image-box { width: 100%; aspect-ratio: 4/5; max-width: 280px; border: 1px solid var(--border-line); background: var(--bg-card); border-radius: 8px; overflow: hidden; }
  .host-image-box img { width: 100%; height: 100%; object-fit: cover; display: block; }
  .host-name { font-size: 24px; color: var(--text-main); margin-bottom: 4px; }
  .host-role { color: var(--accent-cyan); font-weight: 500; }

  .host-content .sec-head { margin-bottom: 36px; }
  .host-label { color: var(--accent-cyan); font-size: 12px; text-transform: uppercase; letter-spacing: 2px; margin-bottom: 16px; }
  .host-heading { font-size: 48px; line-height: 1.1; color: var(--text-main); margin-bottom: 30px; }
  .host-desc { color: var(--text-dim); font-size: 18px; line-height: 1.6; max-width: 500px; }
  .host-btn { background: var(--accent-cyan); color: var(--bg-dark); border: none; padding: 14px 28px; font-size: 14px; font-weight: 700; border-radius: 4px; cursor: pointer; }

  /* Responsive */
  @media (max-width: 1024px) {
    .host { padding-top: 64px; padding-bottom: 18px; }
    .host .wrap { padding: 0 24px; }
    .host-heading { font-size: 38px; }
  }

  /* Two columns are kept all the way down to 768px â€” only below that does it stack */
  @media (max-width: 767px) {
    .host { padding-top: 48px; padding-bottom: 14px; }
    .host .wrap { padding: 0 20px; }
    .host-grid { grid-template-columns: 1fr; gap: 32px; }
    .host-media { order: 2; align-items: center; text-align: center; }
    .host-image-box { margin: 0 auto; }
    .host-content { order: 1; }
    .host-content .sec-head { text-align: center; }
    .host-desc { max-width: 100%; margin-left: auto; margin-right: auto; }
    .host-content { display: flex; flex-direction: column; align-items: center; }
  }

  @media (max-width: 480px) {
    .host { padding-top: 32px; padding-bottom: 10px; }
    .host .wrap { padding: 0 16px; }
    .host-image-box { max-width: 180px; }
    .host-heading { font-size: 30px; }
    .host-desc { font-size: 16px; }
  }
</style>

<section class="host" id="host">
  <div class="wrap host-grid">

    <!-- Left Column: Image Card + Profile Info -->
    <div class="host-media">
        @php
          $host = [
            'name' => 'Sarah Jenkins',
            'role' => 'Senior VIP Concierge',
            'image' => 'images/host/sarah-jenkins.jpg', // put your image at public/images/host/sarah-jenkins.jpg
          ];
        @endphp

        <!-- Image Section -->
        <div class="host-image-box">
          @if(!empty($host['image']) && file_exists(public_path($host['image'])))
            <img src="{{ asset($host['image']) }}" alt="{{ $host['name'] }}">
          @endif
        </div>

        <!-- Profile Info -->
        <div>
            <h3 class="host-name">{{ $host['name'] }}</h3>
            <p class="host-role">{{ $host['role'] }}</p>
        </div>
    </div>

    <!-- Right Column: Content Area -->
    <div class="host-content">
      <div class="sec-head">
        <div class="host-label">Concierge</div>
        <h2 class="host-heading">One person who knows your table.</h2>
        <p class="host-desc">
          From Gold Room upward, you are paired with a named host. They are your direct point of contact for priority support, custom requests, and exclusive event invitations.
        </p>
      </div>

      <button class="host-btn">Contact Your Host</button>
    </div>

  </div>
</section>