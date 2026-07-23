<style>
  /* ===== Tiers section — self-contained styles ===== */

  .ladder-wrap {
    background: var(--bg-dark);
  }

  .ladder-wrap .wrap {
    max-width: 1180px;
    margin: 0 auto;
    padding: 0 32px;
  }

  .ladder-wrap.pad {
    padding: 90px 0;
  }

  .ladder-wrap .sec-head {
    margin-bottom: 56px;
  }

  .ladder-wrap .sec-num {
    color: var(--accent-cyan);
    font-size: 12px;
    margin-bottom: 16px;
    text-transform: uppercase;
    letter-spacing: 2px;
  }

  .ladder-wrap h2 {
    font-size: 48px;
    font-weight: 700;
  }

  .tier-row {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 30px 0;
    border-bottom: 1px solid var(--border-line);
    gap: 20px;
    transition: 0.3s;
  }

  .tier-left {
    display: flex;
    align-items: center;
    width: 300px;
    gap: 15px;
  }

  .tier-check {
    appearance: none;
    width: 22px;
    height: 22px;
    border: 2px solid var(--accent-cyan);
    border-radius: 4px;
    cursor: pointer;
  }

  .tier-check:checked {
    background-color: var(--accent-cyan);
  }

  .tier-desc {
    flex: 1;
    color: var(--text-dim);
  }

  .tier-btn {
    background: var(--accent-cyan);
    color: var(--bg-dark);
    border: none;
    padding: 10px 20px;
    font-weight: 700;
    border-radius: 4px;
    cursor: pointer;
  }

  .tier-action {
    display: flex;
    align-items: center;
    gap: 16px;
  }

  .tier-price {
    color: var(--accent-cyan);
    font-weight: 700;
    font-size: 15px;
    white-space: nowrap;
  }

  /* Modal Styles matching the dark aesthetic */
  .modal-content-custom {
    background-color: var(--bg-card, #1E3A52);
    color: var(--text-main, #ffffff);
    border: 1px solid var(--accent-cyan);
  }

  .modal-header-custom {
    border-bottom: 1px solid var(--border-line);
  }

  .modal-footer-custom {
    border-top: 1px solid var(--border-line);
  }

  .modal-error {
    background-color: rgba(220, 53, 69, 0.15);
    border: 1px solid #dc3545;
    color: #ff8f9b;
    padding: 10px 14px;
    border-radius: 6px;
    font-size: 13px;
    margin-bottom: 16px;
  }

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
      @foreach($planes as $tier)
        <div class="tier-row" onclick="selectTier(event, this)">
          <div class="tier-left">
            <input type="checkbox" name="tier_selection[]" class="tier-check">
            <h3>{{ $tier->name }}</h3>
          </div>

          <div class="tier-desc">
            {{ $tier->short_description }}
          </div>

          <div class="tier-action">
            <span class="tier-price">
              @if(strtolower($tier->name) == 'obsidian' || $tier->price <= 0)
                Custom
              @else
                Rs. {{ number_format($tier->price, 0) }}
              @endif
            </span>

            <button class="tier-btn" 
                    data-bs-toggle="modal" 
                    data-bs-target="#paymentModal" 
                    data-plane-id="{{ $tier->id }}"
                    data-plane-name="{{ $tier->name }}"
                    onclick="event.stopPropagation(); openPaymentModal(this)">
              Buy Now
            </button>
          </div>
        </div>
      @endforeach
    </div>
  </div>
</section>

<div class="modal fade" id="paymentModal" tabindex="-1" aria-labelledby="paymentModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content modal-content-custom">
      <div class="modal-header modal-header-custom">
        <h5 class="modal-title fw-bold" id="paymentModalLabel">Payment For Buying ( <span id="modal-plane-name" style="color: var(--accent-cyan);"></span> ) Plane</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      
      <form action="{{ route('pages.planes.submit-payment') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="plane_id" id="modal-plane-id" value="{{ old('plane_id') }}">

        <div class="modal-body">

          @if ($errors->any())
            <div class="modal-error">
              <strong>Please fix the following:</strong>
              <ul class="mb-0 ps-3">
                @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
                @endforeach
              </ul>
            </div>
          @endif

          @if (session('error'))
            <div class="modal-error">{{ session('error') }}</div>
          @endif

          <h6 class="fw-bold mb-2" style="color: var(--accent-cyan);">Instructions:</h6>
          <ol class="small text-white-50 mb-3 ps-3">
            <li>Transfer the specific tier amount to our designated merchant account number.</li>
            <li>Double check the payment details before finalizing the transaction.</li>
            <li>Capture a clear screenshot showing the transaction details visibly.</li>
          </ol>

          <p class="text-danger small fw-bold mb-4" style="border-left: 3px solid red; padding-left: 8px;">
            IMPORTANT: Wrong or edited screenshot submissions will lead to immediate account suspension.
          </p>

          <div class="mb-3">
            <label class="form-label small fw-semibold text-white">Upload Screenshot <span class="text-danger">*</span></label>
            <input type="file" name="screenshot" class="form-control bg-dark text-white border-secondary" required>
          </div>

        </div>

        <div class="modal-footer modal-footer-custom">
          <button type="button" class="btn btn-secondary text-white btn-sm px-3" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" class="btn fw-bold btn-sm px-4 text-dark" style="background-color: var(--accent-cyan);">Submit Details</button>
        </div>
      </form>
    </div>
  </div>
</div>

<script>
  // Modal runtime setup handler
  function openPaymentModal(button) {
    const planeId = button.getAttribute('data-plane-id');
    const planeName = button.getAttribute('data-plane-name');

    document.getElementById('modal-plane-id').value = planeId;
    document.getElementById('modal-plane-name').innerText = planeName;
  }

  function selectTier(event, row) {
    const checkbox = row.querySelector('.tier-check');
    const isDirectClick = event.target === checkbox;
    const willBeChecked = isDirectClick ? checkbox.checked : !checkbox.checked;

    if (!isDirectClick) {
      checkbox.checked = willBeChecked;
    }

    if (willBeChecked) {
      document.querySelectorAll('.tier-check').forEach(function (box) {
        if (box !== checkbox) box.checked = false;
      });
    }
  }

  // Reopen modal automatically if validation failed, so the user sees the errors
  document.addEventListener('DOMContentLoaded', function () {
    @if ($errors->any())
      var paymentModalEl = document.getElementById('paymentModal');
      if (paymentModalEl && window.bootstrap) {
        var modal = new bootstrap.Modal(paymentModalEl);
        modal.show();
      }
    @endif
  });
</script>