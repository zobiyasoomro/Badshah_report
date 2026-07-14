<style>
  /* ===== Tiers section â€” self-contained styles ===== */

  .ladder-wrap { background: var(--bg-dark); }
  .ladder-wrap .wrap { max-width: 1180px; margin: 0 auto; padding: 0 32px; }
  .ladder-wrap.pad { padding: 90px 0; }
  .ladder-wrap .sec-head { margin-bottom: 56px; }
  .ladder-wrap .sec-num { color: var(--accent-cyan); font-size: 12px; margin-bottom: 16px; text-transform: uppercase; letter-spacing: 2px; }
  .ladder-wrap h2 { font-size: 48px; font-weight: 700; }

  .tier-row { display: flex; align-items: center; justify-content: space-between; padding: 30px 0; border-bottom: 1px solid var(--border-line); gap: 20px; transition: 0.3s; }
  .tier-left { display: flex; align-items: center; width: 300px; gap: 15px; }
  .tier-check { appearance: none; width: 22px; height: 22px; border: 2px solid var(--accent-cyan); border-radius: 4px; cursor: pointer; }
  .tier-check:checked { background-color: var(--accent-cyan); }
  .tier-desc { flex: 1; color: var(--text-dim); }
  .tier-btn { background: var(--accent-cyan); color: var(--bg-dark); border: none; padding: 10px 20px; font-weight: 700; border-radius: 4px; cursor: pointer; }

  .tier-action { display: flex; align-items: center; gap: 16px; }
  .tier-price { color: var(--accent-cyan); font-weight: 700; font-size: 15px; white-space: nowrap; }

  /* Responsive */
  @media (max-width: 1024px) {
    .ladder-wrap .wrap { padding: 0 24px; }
    .ladder-wrap.pad { padding: 64px 0; }
    .ladder-wrap h2 { font-size: 38px; }
    .ladder-wrap .sec-head { margin-bottom: 40px; }
    .tier-left { width: 220px; }
  }

  @media (max-width: 768px) {
    .ladder-wrap .wrap { padding: 0 20px; }
    .ladder-wrap.pad { padding: 48px 0; }
    .ladder-wrap h2 { font-size: 32px; }

    .tier-row { flex-wrap: wrap; row-gap: 14px; padding: 24px 0; }
    .tier-left { width: 100%; }
    .tier-desc { width: 100%; order: 3; flex-basis: 100%; }
    .tier-action { margin-left: auto; }
  }

  @media (max-width: 480px) {
    .ladder-wrap .wrap { padding: 0 16px; }
    .ladder-wrap.pad { padding: 32px 0; }
    .ladder-wrap h2 { font-size: 26px; line-height: 1.2; }
    .ladder-wrap .sec-num { font-size: 11px; margin-bottom: 12px; }
    .ladder-wrap .sec-head { margin-bottom: 28px; }

    .tier-row { padding: 18px 0; gap: 10px; }
    .tier-check { width: 20px; height: 20px; }
    .tier-btn { padding: 8px 16px; font-size: 13px; }
    .tier-price { font-size: 13px; }
  }
  
</style>

<section class="ladder-wrap pad" id="tiers">
  <div class="wrap">
    <div class="sec-head">
      <div class="sec-num mono">Membership</div>
      <h2>Five tiers, one ladder.</h2>
    </div>
    
    <div class="ladder">
      @php
        $tiers = [
          ['name' => 'Ember', 'desc' => 'Entry standing. Faster support replies.', 'price' => 5000],
          ['name' => 'Silver Table', 'desc' => 'Priority withdrawals, weekly cashback.', 'price' => 15000],
          ['name' => 'Gold Room', 'desc' => 'A named host, raised limits.', 'price' => 50000],
          ['name' => 'Platinum Circle', 'desc' => 'Custom limits, event invitations.', 'price' => 150000],
          ['name' => 'Obsidian', 'desc' => 'By invitation only. Negotiated terms.', 'price' => null]
        ];
      @endphp

      @foreach($tiers as $tier)
        <div class="tier-row" onclick="selectTier(event, this)">
          <div class="tier-left">
            <input type="checkbox" name="tier_selection[]" class="tier-check">
            <h3>{{ $tier['name'] }}</h3>
          </div>
          <div class="tier-desc">{{ $tier['desc'] }}</div>
          <div class="tier-action">
            <span class="tier-price">
              {{ $tier['price'] ? 'PKR ' . number_format($tier['price']) : 'Custom' }}
            </span>
            <button class="tier-btn" onclick="event.stopPropagation(); alert('Redirecting to payment for {{ $tier['name'] }}');">
              Buy Now
            </button>
          </div>
        </div>
      @endforeach
    </div>
  </div>
</section>

<script>
  function selectTier(event, row) {
    const checkbox = row.querySelector('.tier-check');

    // If the click landed directly on the checkbox, let the browser's
    // native toggle happen first, then just sync the "only one" rule below.
    const isDirectClick = event.target === checkbox;
    const willBeChecked = isDirectClick ? checkbox.checked : !checkbox.checked;

    if (!isDirectClick) {
      checkbox.checked = willBeChecked;
    }

    // Enforce single-selection: if this one is now checked, uncheck every other tier.
    if (willBeChecked) {
      document.querySelectorAll('.tier-check').forEach(function (box) {
        if (box !== checkbox) box.checked = false;
      });
    }
  }
</script>