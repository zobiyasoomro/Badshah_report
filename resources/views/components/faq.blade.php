<style>
  /* ===== FAQ section â€” self-contained styles ===== */

  .faq-section { background: var(--navy-deep); padding: 90px 0; }
  .faq-section .wrap { max-width: 900px; margin: 0 auto; padding: 0 32px; }
  .faq-section .sec-head { margin-bottom: 60px; }
  .faq-heading { font-size: 56px; }
  .faq-sub { margin-top: 20px; color: var(--cream-dim); font-size: 18px; }

  .faq-item { border-top: 1px solid var(--navy-line); padding: 30px 0; }
  .faq-q {
    display: flex; justify-content: space-between; align-items: center;
    cursor: pointer; font-size: 22px; color: var(--cream);
    font-family: 'Cormorant Garamond', serif; font-weight: 600;
  }
  .faq-plus { color: var(--gold); font-size: 28px; transition: transform 0.3s ease; }
  .faq-a { margin-top: 20px; color: var(--cream-dim); font-size: 16px; line-height: 1.8; max-width: 700px; transition: color 0.3s ease; }
  .faq-item[open] .faq-a { color: var(--accent-cyan, #25D1E0) !important; }

  /* Responsive */
  @media (max-width: 1024px) {
    .faq-section { padding: 64px 0; }
    .faq-section .wrap { padding: 0 24px; }
    .faq-heading { font-size: 44px; }
  }
  @media (max-width: 768px) {
    .faq-section { padding: 48px 0; }
    .faq-section .wrap { padding: 0 20px; }
    .faq-section .sec-head { margin-bottom: 40px; }
    .faq-heading { font-size: 34px; }
    .faq-sub { font-size: 16px; }
    .faq-q { font-size: 18px; gap: 12px; }
    .faq-plus { font-size: 22px; }
  }
  @media (max-width: 480px) {
    .faq-section { padding: 32px 0; }
    .faq-section .wrap { padding: 0 16px; }
    .faq-heading { font-size: 26px; }
    .faq-item { padding: 22px 0; }
    .faq-q { font-size: 16px; }
    .faq-a { font-size: 14px; margin-top: 14px; }
  }
</style>

<section class="pad faq-section">
  <div class="wrap">
    <div class="sec-head">
      <div class="host-label">Support</div>
      <h2 class="faq-heading">Frequently Asked Questions</h2>
      <p class="faq-sub">
        Everything you need to know about your membership and the platform.
      </p>
    </div>

    <div class="faq-list">
      @php
        $faqs = [
          ['q' => 'Can my tier drop?', 'a' => 'Yes. Tiers are reviewed monthly on trailing play, so a quiet month can move you down a level. Your host will notify you in advance.'],
          ['q' => 'Is there a cost to join?', 'a' => 'No. Membership is automatic based on your activityâ€”there are no fees, applications, or codes for Ember through Platinum.'],
          ['q' => 'How is Obsidian different?', 'a' => 'Obsidian is by invitation only and carries individually negotiated terms rather than a fixed benefit table.'],
          ['q' => 'Does this affect responsible play tools?', 'a' => 'No. Deposit limits, cool-off periods, and self-exclusion remain fully available and unaffected by your tier status.'],
          ['q' => 'Can I upgrade my tier instantly?', 'a' => 'Upgrades are processed based on your monthly play volume. Once you cross a threshold, your status is updated in the next cycle.']
        ];
      @endphp

      @foreach($faqs as $faq)
        <details class="faq-item">
          <summary class="faq-q">
            {{ $faq['q'] }}
            <span class="faq-plus">+</span>
          </summary>
          <div class="faq-a">
            {{ $faq['a'] }}
          </div>
        </details>
      @endforeach
    </div>
  </div>
</section>

<script>
  // Dynamic interaction: Rotate the plus icon
  document.querySelectorAll('.faq-item').forEach((item) => {
    item.addEventListener('toggle', () => {
      const plus = item.querySelector('.faq-plus');
      if (item.open) {
        plus.style.transform = 'rotate(45deg)';
      } else {
        plus.style.transform = 'rotate(0deg)';
      }
    });
  });
</script>