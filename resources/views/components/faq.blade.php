
  <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,400;0,600;0,700;1,400&display=swap" rel="stylesheet">

  <style>
    /* ===== ROOT VARIABLES – your color theme ===== */
    :root {
      --navy-deep: #2a4563;        /* main bg */
      --navy-line: rgba(255, 255, 255, 0.08);
      --cream: #f2eee9;
      --cream-dim: rgba(242, 238, 233, 0.7);
      --gold: #25D1E0;
      --accent-cyan: #25D1E0;      /* for open answer */
      --shadow-glow: 0 20px 40px -12px rgba(0,0,0,0.5);
    }

   
    /* ===== FAQ SECTION – refined, spacious, elegant ===== */
    .faq-section {
      background: var(--navy-deep);
      padding: 50px 0;
      border-radius: 48px;
      box-shadow: var(--shadow-glow);
      margin: 0 auto;
      width: 100%;
      max-width: 1200px;
      transition: all 0.2s;
    }

    .faq-section .wrap {
      max-width: 900px;
      margin: 0 auto;
      padding: 0 32px;
    }

    /* --- header --- */
    .sec-head {
      margin-bottom: 60px;
      text-align: center;
    }

    .host-label {
      display: inline-block;
      background: rgba(212, 175, 55, 0.12);
      color: var(--gold);
      font-size: 14px;
      font-weight: 600;
      letter-spacing: 2px;
      text-transform: uppercase;
      padding: 8px 20px;
      border-radius: 40px;
      border: 1px solid rgba(212, 175, 55, 0.2);
      margin-bottom: 16px;
      backdrop-filter: blur(2px);
    }

    .faq-heading {
      font-family: 'Cormorant Garamond', serif;
      font-weight: 700;
      font-size: 56px;
      color: var(--cream);
      letter-spacing: -0.02em;
      line-height: 1.1;
      margin-bottom: 12px;
    }

    .faq-sub {
      color: var(--cream-dim);
      font-size: 18px;
      font-weight: 300;
      max-width: 580px;
      margin: 12px auto 0;
      line-height: 1.6;
      letter-spacing: 0.2px;
    }

    /* --- faq items --- */
    .faq-list {
      display: flex;
      flex-direction: column;
      gap: 4px;
    }

    .faq-item {
      background: rgba(255, 255, 255, 0.02);
      border-radius: 20px;
      padding: 0 8px;
      border: 1px solid transparent;
      transition: border-color 0.2s, background 0.2s;
      margin-bottom: 4px;
    }

    .faq-item:hover {
      background: rgba(255, 255, 255, 0.04);
      border-color: rgba(255, 255, 255, 0.06);
    }

    .faq-item[open] {
      background: rgba(37, 209, 224, 0.04);
      border-color: rgba(37, 209, 224, 0.2);
      border-radius: 20px;
      box-shadow: 0 4px 20px rgba(0,0,0,0.2);
    }

    /* summary – the question row */
    .faq-q {
      display: flex;
      justify-content: space-between;
      align-items: center;
      cursor: pointer;
      font-size: 22px;
      color: var(--cream);
      font-family: 'Cormorant Garamond', serif;
      font-weight: 600;
      padding: 20px 12px;
      list-style: none;
      transition: color 0.2s;
      border-radius: 16px;
      user-select: none;
    }

    .faq-q::-webkit-details-marker {
      display: none;
    }
    .faq-q::marker {
      display: none;
    }

    .faq-q:hover {
      color: #ffffff;
    }

    .faq-q .faq-text {
      flex: 1;
      margin-right: 16px;
    }

    /* plus icon – fontawesome */
    .faq-plus {
      color: var(--gold);
      font-size: 26px;
      transition: transform 0.4s cubic-bezier(0.34, 1.56, 0.64, 1), color 0.2s;
      width: 32px;
      text-align: center;
      flex-shrink: 0;
      line-height: 1;
    }

    .faq-item[open] .faq-plus {
      transform: rotate(45deg);
      color: var(--accent-cyan);
    }

    /* answer */
    .faq-a {
      margin: 0 12px 24px 12px;
      padding: 8px 0 4px 0;
      color: var(--cream-dim);
      font-size: 16px;
      line-height: 1.8;
      max-width: 700px;
      transition: color 0.3s ease;
      border-top: 1px solid rgba(255,255,255,0.04);
      padding-top: 20px;
    }

    .faq-item[open] .faq-a {
      color: #eef4f8;  /* slightly brighter */
    }

    .faq-a i {
      color: var(--gold);
      margin-right: 8px;
      opacity: 0.6;
    }

    /* --- micro interaction: gold accent on answer text --- */
    .faq-item[open] .faq-a strong {
      color: var(--gold);
      font-weight: 500;
    }

    /* ===== responsive ===== */
    @media (max-width: 1024px) {
      .faq-section { padding: 60px 0; border-radius: 32px; }
      .faq-heading { font-size: 44px; }
    }

    @media (max-width: 768px) {
      body { padding: 1rem 0; }
      .faq-section { padding: 44px 0; border-radius: 24px; }
      .faq-section .wrap { padding: 0 20px; }
      .sec-head { margin-bottom: 40px; }
      .faq-heading { font-size: 34px; }
      .faq-sub { font-size: 16px; }
      .faq-q { font-size: 19px; padding: 16px 8px; }
      .faq-plus { font-size: 22px; width: 28px; }
      .faq-a { font-size: 15px; margin: 0 8px 20px 8px; }
    }

    @media (max-width: 480px) {
      .faq-section { padding: 28px 0; border-radius: 16px; }
      .faq-section .wrap { padding: 0 14px; }
      .faq-heading { font-size: 26px; }
      .host-label { font-size: 11px; padding: 5px 14px; }
      .faq-q { font-size: 17px; padding: 14px 4px; }
      .faq-plus { font-size: 20px; }
      .faq-a { font-size: 14px; margin: 0 4px 16px 4px; padding-top: 16px; }
    }

    /* small extra touch: divider line between items */
    .faq-item:not(:last-child) {
      border-bottom: 1px solid rgba(255,255,255,0.04);
    }
    .faq-item[open]:not(:last-child) {
      border-bottom-color: rgba(37, 209, 224, 0.15);
    }

    /* custom scrollbar (optional) */
    .faq-section::-webkit-scrollbar { width: 4px; }
    .faq-section::-webkit-scrollbar-track { background: transparent; }
    .faq-section::-webkit-scrollbar-thumb { background: var(--gold); border-radius: 12px; }
  </style>


<div class="container-fluid px-0">
  <div class="row justify-content-center">
    <div class="col-12 col-xl-10 col-xxl-9">

      <!-- FAQ section – with your color theme & bootstrap grid -->
      <section class="faq-section">
        <div class="wrap">

          <!-- header -->
          <div class="sec-head">
            <span class="host-label">
              <i class="fas fa-circle-question me-2" style="color: var(--gold);"></i> Support
            </span>
            <h2 class="faq-heading"> <span style="color: #25D1E0;"> Frequently </span> Asked Questions</h2>
            <p class="faq-sub">
              Everything you need to know about your membership and the platform.
            </p>
          </div>

          <!-- FAQ list – using details/summary with plus icon (fontawesome) -->
          <div class="faq-list">

            <!-- 1 -->
            <details class="faq-item">
              <summary class="faq-q">
                <span class="faq-text">Can my tier drop?</span>
                <span class="faq-plus"><i class="fas fa-plus"></i></span>
              </summary>
              <div class="faq-a">
                <i class="fas fa-chevron-right"></i> Yes. Tiers are reviewed monthly on trailing play, so a quiet month can move you down a level. Your host will notify you in advance.
              </div>
            </details>

            <!-- 2 -->
            <details class="faq-item">
              <summary class="faq-q">
                <span class="faq-text">Is there a cost to join?</span>
                <span class="faq-plus"><i class="fas fa-plus"></i></span>
              </summary>
              <div class="faq-a">
                <i class="fas fa-chevron-right"></i> No. Membership is automatic based on your activity—there are no fees, applications, or codes for Ember through Platinum.
              </div>
            </details>

            <!-- 3 -->
            <details class="faq-item">
              <summary class="faq-q">
                <span class="faq-text">How is Obsidian different?</span>
                <span class="faq-plus"><i class="fas fa-plus"></i></span>
              </summary>
              <div class="faq-a">
                <i class="fas fa-chevron-right"></i> Obsidian is by invitation only and carries individually negotiated terms rather than a fixed benefit table.
              </div>
            </details>

            <!-- 4 -->
            <details class="faq-item">
              <summary class="faq-q">
                <span class="faq-text">Does this affect responsible play tools?</span>
                <span class="faq-plus"><i class="fas fa-plus"></i></span>
              </summary>
              <div class="faq-a">
                <i class="fas fa-chevron-right"></i> No. Deposit limits, cool-off periods, and self-exclusion remain fully available and unaffected by your tier status.
              </div>
            </details>

            <!-- 5 -->
            <details class="faq-item">
              <summary class="faq-q">
                <span class="faq-text">Can I upgrade my tier instantly?</span>
                <span class="faq-plus"><i class="fas fa-plus"></i></span>
              </summary>
              <div class="faq-a">
                <i class="fas fa-chevron-right"></i> Upgrades are processed based on your monthly play volume. Once you cross a threshold, your status is updated in the next cycle.
              </div>
            </details>

          </div> <!-- /faq-list -->

          <!-- subtle extra hint (design detail) -->
          <div class="text-center mt-5 pt-2">
            <span style="color: rgb(255, 255, 255); font-size: 13px; letter-spacing: 1px;">
              <i class="fas fa-gem me-1" style="color: var(--gold); "></i> 
              premium support · 24/7
            </span>
          </div>

        </div> <!-- /wrap -->
      </section>

    </div>
  </div>
</div>


<script>
  (function() {
    document.querySelectorAll('.faq-item').forEach((item) => {
      item.addEventListener('toggle', function() {
        const plus = this.querySelector('.faq-plus i');
        if (this.open) {
          // rotation is handled via CSS on .faq-plus, but we ensure icon swap if needed
          plus.style.transition = 'transform 0.3s';
        } else {
          // nothing else needed – css handles rotation
        }
      });
    });
  })();
</script>

