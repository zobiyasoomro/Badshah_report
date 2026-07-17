<style>
   

    /* ===================== ORIGINAL SECTION (unchanged) ===================== */
    .cta-section {
        background: linear-gradient(135deg, #2A4563 0%, #1B314A 100%);
        min-height: 280px;
        position: relative;
        overflow: hidden;
        display: flex;
        align-items: center;
        border-top: 2px solid #22D3EE;
        border-bottom: 2px solid #22D3EE;
    }
    .cta-section::before {
        content: '';
        position: absolute;
        top: 15%;
        right: 10%;
        width: 160px;
        height: 160px;
        background: rgba(42, 69, 238, 0.08);
        border: 2px solid rgba(34, 211, 238, 0.2);
        border-radius: 16px;
        transform: rotate(15deg);
        z-index: 1;
    }
    .cta-section::after {
        content: '';
        position: absolute;
        bottom: 18%;
        left: 8%;
        width: 130px;
        height: 130px;
        background: rgba(34, 211, 238, 0.06);
        border: 2px solid rgba(34, 211, 238, 0.18);
        border-radius: 16px;
        transform: rotate(-10deg);
        z-index: 1;
    }
    .cta-section__content { position: relative; z-index: 2; }
    .cta-section__heading {
        font-size: clamp(1.5rem, 4.5vw, 2.05rem);
        font-weight: 700;
        line-height: 1.15;
        color: #F1F5F9;
    }
    .cta-section__btn {
        color: #ffffff;
        border: none;
        padding: clamp(11px, 2vw, 14px) clamp(20px, 4vw, 34px);
        font-weight: 600;
        font-size: clamp(0.9rem, 2vw, 1.1rem);
        border-radius: 50px;
        transition: all 0.3s ease-in-out;
        cursor:pointer;
        white-space:nowrap;
    }
    .cta-section__btn:hover { transform: translateY(-4px); color: #ffffff; }
    .cta-section__btn--deposit { background: #00B282; box-shadow: 0 10px 25px rgba(34, 197, 94, 0.4); }
    .cta-section__btn--deposit:hover { background: #16A34A; }
    .cta-section__btn--withdraw { background: #ef5555; box-shadow: 0 10px 25px rgba(239, 68, 68, 0.4); }
    .cta-section__btn--withdraw:hover { background: #DC2626; }
    .cta-section__btn-icon { font-size: 1.45rem; margin-left: 8px; }

    /* ===================== POPUP / MODAL ===================== */

    /* Overlay dims the page but the panel itself is anchored top-right,
       leaving a small margin on all sides (not full screen). */
    /* z-index is pushed well above any navbar/header (Bootstrap navbars
       typically sit around 1030) so the popup + overlay always sit on top
       and the profile dropdown visually goes "behind" the popup while open. */
    .popup-overlay{
        display:none;
        position:fixed !important;
        inset:0;
        background:rgba(6,12,22,0.65);
        opacity:0;
        transition: opacity 0.25s ease;
        z-index:999998 !important;
        /* no backdrop-filter: blur() here on purpose — it forces the browser
           to repaint the whole page behind it on every frame and is the main
           cause of the laggy/janky feel, especially while the panel is
           animating in. A plain semi-transparent color is instant. */
    }
    .popup-overlay.active{
        display:block;
        opacity:1;
    }

    .popup-panel{
        position:fixed !important;
        top:20px;
        right:20px;
        bottom:20px;
        width:400px;
        max-width:calc(100% - 40px);
        background: linear-gradient(160deg, #23395B 0%, #16273D 100%);
        border:1px solid rgba(34,211,238,0.25);
        border-radius:18px;
        box-shadow: 0 20px 60px rgba(0,0,0,0.45);
        z-index:999999 !important;
        transform: translateX(120%);
        transition: transform 0.28s cubic-bezier(0.22, 1, 0.36, 1);
        will-change: transform;
        overflow-y:auto;
        padding:24px;
        /* isolates its own stacking context so nothing from the page
           (navbar, profile dropdown, etc.) can render above it */
        isolation: isolate;
    }
    .popup-panel.active{
        transform: translateX(0);
    }

    /* ===================== STYLED SCROLLBAR =====================
       Applies to the popup panel body and the floating bank dropdown
       list — a slim gradient cyan thumb that matches the theme instead
       of the default OS scrollbar, with a soft glow that intensifies
       on hover and a gentle idle pulse for a bit of life. */
    .popup-panel,
    .custom-select__list{
        scrollbar-width: thin;                 /* Firefox */
        scrollbar-color: #22D3EE rgba(255,255,255,0.06); /* Firefox */
    }
    .popup-panel::-webkit-scrollbar,
    .custom-select__list::-webkit-scrollbar{
        width:7px;
    }
    .popup-panel::-webkit-scrollbar-track,
    .custom-select__list::-webkit-scrollbar-track{
        background: rgba(255,255,255,0.04);
        border-radius:10px;
        margin:10px 2px;
    }
    .popup-panel::-webkit-scrollbar-thumb,
    .custom-select__list::-webkit-scrollbar-thumb{
        border-radius:10px;
        background: linear-gradient(180deg, #67E8F9 0%, #22D3EE 45%, #0E7490 100%);
        box-shadow: 0 0 6px rgba(34,211,238,0.55);
        animation: scrollbarPulse 3.2s ease-in-out infinite;
    }
    .popup-panel::-webkit-scrollbar-thumb:hover,
    .custom-select__list::-webkit-scrollbar-thumb:hover{
        background: linear-gradient(180deg, #A5F3FC 0%, #22D3EE 50%, #0891B2 100%);
        box-shadow: 0 0 12px rgba(34,211,238,0.85);
    }
    .popup-panel::-webkit-scrollbar-thumb:active,
    .custom-select__list::-webkit-scrollbar-thumb:active{
        background: linear-gradient(180deg, #22D3EE 0%, #0EA5E9 100%);
    }
    @keyframes scrollbarPulse{
        0%, 100% { box-shadow: 0 0 5px rgba(34,211,238,0.45); }
        50%      { box-shadow: 0 0 11px rgba(34,211,238,0.85); }
    }

    @media (max-width: 576px){
        .popup-panel{
            top:12px; right:12px; left:12px; bottom:12px;
            width:auto;
            padding:18px;
        }
        .popup-title{ font-size:1.2rem; }
        .method-row{ grid-template-columns: repeat(2, 1fr); gap:8px; }
        .method-card{ padding:10px 6px; }
        .method-card .method-icon{ width:28px; height:28px; font-size:0.95rem; }
        .method-card span.method-name{ font-size:0.7rem; }
    }

    @media (max-width: 360px){
        .popup-panel{ top:8px; right:8px; left:8px; bottom:8px; padding:14px; }
        .method-row{ grid-template-columns: repeat(2, 1fr); gap:6px; }
        .popup-input, .custom-select__toggle{ padding:10px 12px; font-size:0.88rem; }
    }

    @media (min-width: 577px) and (max-width: 900px){
        .popup-panel{ width:360px; }
    }

    .popup-close-btn{
        position:absolute;
        top:16px;
        right:16px;
        width:34px;
        height:34px;
        border-radius:50%;
        border:1px solid rgba(241,245,249,0.25);
        background:rgba(255,255,255,0.04);
        color:#F1F5F9;
        font-size:1.1rem;
        display:flex;
        align-items:center;
        justify-content:center;
        cursor:pointer;
        transition: all 0.2s ease;
    }
    .popup-close-btn:hover{
        background:rgba(239,85,85,0.85);
        border-color: transparent;
        transform: rotate(90deg);
    }

    .popup-title{
        color:#F1F5F9;
        font-weight:700;
        font-size:1.4rem;
        margin-top:6px;
        margin-bottom:4px;
    }
    .popup-subtitle{
        color:#9FB3C8;
        font-size:0.9rem;
        margin-bottom:22px;
    }

    .popup-label{
        color:#CBD5E1;
        font-size:0.85rem;
        font-weight:600;
        margin-bottom:6px;
        display:block;
    }

    .popup-input{
        width:100%;
        background:rgba(255,255,255,0.05);
        border:1px solid rgba(148,163,184,0.25);
        color:#F1F5F9;
        border-radius:10px;
        padding:12px 14px;
        font-size:0.95rem;
        margin-bottom:18px;
        outline:none;
        transition: border-color 0.2s ease, background 0.2s ease;
    }
    .popup-input::placeholder{ color:#7C8DA3; }
    .popup-input:focus{
        border-color:#22D3EE;
        background:rgba(255,255,255,0.08);
    }

    .method-label{
        color:#CBD5E1;
        font-size:0.85rem;
        font-weight:600;
        margin-bottom:10px;
        display:block;
    }

    .method-row{
        display:grid;
        grid-template-columns: repeat(3, 1fr);
        gap:10px;
        margin-bottom:10px;
    }

    /* Icon-card method selector (replaces checkboxes).
       Click toggles selection; only one can be active at a time
       (works like a radio group) and the active one glows/highlights. */
    .method-card{
        flex:1;
        display:flex;
        flex-direction:column;
        align-items:center;
        justify-content:center;
        gap:8px;
        background:rgba(255,255,255,0.04);
        border:1.5px solid rgba(148,163,184,0.2);
        border-radius:12px;
        padding:14px 8px;
        cursor:pointer;
        transition: all 0.2s ease;
        text-align:center;
    }
    .method-card:hover{
        border-color: rgba(34,211,238,0.4);
        transform: translateY(-2px);
    }
    .method-card.active{
        border-color:#22D3EE;
        background:rgba(34,211,238,0.12);
        box-shadow: 0 0 0 1px rgba(34,211,238,0.3), 0 8px 20px rgba(34,211,238,0.15);
    }
    .method-card .method-icon{
        width:34px;
        height:34px;
        border-radius:50%;
        display:flex;
        align-items:center;
        justify-content:center;
        font-size:1.1rem;
        flex-shrink:0;
        overflow:hidden;
    }
    .method-card .method-icon img{
        width:100%;
        height:100%;
        object-fit:contain;
        display:block;
    }
    /* white backing behind logos so transparent-background PNGs stay
       legible against the dark card */
    .method-card .method-icon.icon-logo{
        background:#ffffff;
        padding:5px;
    }
    .method-card .method-icon.icon-bank{ background:#22D3EE; color:#0f1c2e; }

    .method-card span.method-name{
        color:#F1F5F9;
        font-size:0.75rem;
        font-weight:700;
        white-space:nowrap;
    }

    .bank-fields{
        max-height:0;
        overflow:hidden;
        opacity:0;
        transition: max-height 0.4s ease, opacity 0.3s ease, margin 0.3s ease;
        margin-top:0;
    }
    .bank-fields.open{
        max-height:500px;
        opacity:1;
        margin-top:14px;
    }

    /* ===================== CUSTOM BANK DROPDOWN =====================
       Native <select> option lists get trapped/clipped inside .popup-panel
       because that panel has both `transform` and `overflow-y:auto` — a
       transformed ancestor becomes the containing block for anything
       position:fixed inside it, so the dropdown was rendering "inside"
       the popup instead of floating freely below the field.
       Fix: build our own dropdown list and append it directly to <body>
       (a sibling of the popup, not a descendant), then position it with
       JS using getBoundingClientRect(). That escapes the transform/overflow
       trap entirely and it always opens downward below the field. */
    .custom-select{
        position:relative;
        margin-bottom:18px;
    }
    .custom-select__toggle{
        width:100%;
        display:flex;
        align-items:center;
        justify-content:space-between;
        gap:10px;
        background:rgba(255,255,255,0.05);
        border:1px solid rgba(148,163,184,0.25);
        color:#F1F5F9;
        border-radius:10px;
        padding:12px 14px;
        font-size:0.95rem;
        cursor:pointer;
        transition: border-color 0.2s ease, background-color 0.2s ease;
    }
    .custom-select__toggle:hover,
    .custom-select__toggle.open{
        border-color:#22D3EE;
        background-color:rgba(255,255,255,0.08);
    }
    .custom-select__value{
        white-space:nowrap;
        overflow:hidden;
        text-overflow:ellipsis;
        text-align:left;
    }
    .custom-select__value.placeholder{
        color:#7C8DA3;
    }
    .custom-select__arrow{
        color:#22D3EE;
        font-size:0.75rem;
        flex-shrink:0;
        transition: transform 0.2s ease;
    }
    .custom-select__toggle.open .custom-select__arrow{
        transform: rotate(180deg);
    }

    /* the floating list itself — lives at the end of <body>, positioned
       via JS, always anchored below its toggle button */
    .custom-select__list{
        position:fixed;
        display:none;
        flex-direction:column;
        gap:2px;
        background:#16273D;
        border:1px solid rgba(34,211,238,0.3);
        border-radius:10px;
        box-shadow: 0 20px 45px rgba(0,0,0,0.5);
        padding:6px;
        max-height:260px;
        overflow-y:auto;
        z-index:2147483000;
    }
    .custom-select__list.open{
        display:flex;
    }
    .custom-select__option{
        padding:10px 12px;
        border-radius:8px;
        color:#F1F5F9;
        font-size:0.88rem;
        cursor:pointer;
        transition: background-color 0.15s ease;
    }
    .custom-select__option:hover,
    .custom-select__option.highlighted{
        background:rgba(34,211,238,0.15);
    }
    .custom-select__option.selected{
        background:rgba(34,211,238,0.22);
        font-weight:600;
    }

    .popup-submit-btn{
        width:100%;
        border:none;
        padding:13px;
        border-radius:50px;
        font-weight:700;
        font-size:1rem;
        color:#fff;
        cursor:pointer;
        margin-top:8px;
        transition: all 0.25s ease;
    }
    .popup-submit-btn:hover{ transform: translateY(-3px); }

    .popup-submit-btn--deposit{
        background:#00B282;
        box-shadow: 0 10px 25px rgba(34,197,94,0.35);
    }
    .popup-submit-btn--deposit:hover{ background:#16A34A; }

    .popup-submit-btn--withdraw{
        background:#ef5555;
        box-shadow: 0 10px 25px rgba(239,68,68,0.35);
    }
    .popup-submit-btn--withdraw:hover{ background:#DC2626; }

    .popup-note{
        font-size:0.72rem;
        color:#7C8DA3;
        margin-top:14px;
        text-align:center;
    }
</style>
</head>
<body>

<section class="cta-section py-5">
    <div class="container">
        <div class="row align-items-center cta-section__content">

            <div class="col-lg-7">
                <h1 class="cta-section__heading mb-0">
                    THE PASSION TRYING &amp; SKILL CAN MAKE<br>
                    A TOP-PERFORMING COMPANY
                </h1>
            </div>

            <div class="col-lg-5 text-lg-end mt-4 mt-lg-0">
                <div class="d-flex flex-column flex-sm-row gap-3 justify-content-lg-end align-items-center">

                    <button onclick="openPopup('deposit')" class="cta-section__btn cta-section__btn--deposit d-flex align-items-center">
                        DEPOSIT <span class="cta-section__btn-icon">↑</span>
                    </button>

                    <button onclick="openPopup('withdraw')" class="cta-section__btn cta-section__btn--withdraw d-flex align-items-center">
                        WITHDRAW <span class="cta-section__btn-icon">↓</span>
                    </button>

                </div>
            </div>

        </div>
    </div>
</section>

<!-- ===================== OVERLAY ===================== -->
<div class="popup-overlay" id="popupOverlay" onclick="closePopupOnOverlay(event)"></div>

<!-- ===================== DEPOSIT POPUP ===================== -->
<div class="popup-panel" id="depositPopup">
    <button class="popup-close-btn" onclick="closePopup('deposit')">&times;</button>

    <div class="popup-title">Deposit Funds</div>
    <div class="popup-subtitle">Add money to your account instantly.</div>

    <label class="popup-label">Account Name</label>
    <input type="text" class="popup-input" placeholder="Enter account holder name">

    <label class="popup-label">Amount</label>
    <input type="number" class="popup-input" placeholder="Enter amount">

    <span class="method-label">Payment Method</span>
    <div class="method-row" id="depositMethodRow" data-group="deposit" data-target="depositBankFields">
        <div class="method-card" data-method="easypaisa">
            <div class="method-icon icon-logo"><img src="{{ asset('images/easypaisa.jpg') }}" alt="Easypaisa"></div>
            <span class="method-name">Easypaisa</span>
        </div>
        <div class="method-card" data-method="jazzcash">
            <div class="method-icon icon-logo"><img src="{{ asset('images/jazzcash.png') }}" alt="JazzCash"></div>
            <span class="method-name">JazzCash</span>
        </div>
      
        <div class="method-card" data-method="bank">
            <div class="method-icon icon-bank">🏦</div>
            <span class="method-name">Bank</span>
        </div>
    </div>

    <div class="bank-fields" id="depositBankFields">
        <label class="popup-label">Select Bank</label>
        <div class="custom-select" id="dep_bank_select">
            <button type="button" class="custom-select__toggle" data-list="dep_bank_list">
                <span>Choose your bank</span>
                <span class="custom-select__arrow">▾</span>
            </button>
            <input type="hidden" name="bank_name" data-hidden-for="dep_bank_select">
        </div>

        <label class="popup-label">Account / Card Holder Name</label>
        <input type="text" class="popup-input" placeholder="Enter account or card holder name">

        <label class="popup-label">Account Number / IBAN</label>
        <input type="text" class="popup-input" placeholder="Enter account number or IBAN">

        <label class="popup-label">Branch Code <span style="font-weight:400;color:#7C8DA3;">(optional)</span></label>
        <input type="text" class="popup-input" placeholder="Enter branch code">
    </div>

    <button class="popup-submit-btn popup-submit-btn--deposit">Confirm Deposit</button>
    <div class="popup-note">This is a frontend preview only, no data is submitted.</div>
</div>

<!-- ===================== WITHDRAW POPUP ===================== -->
<div class="popup-panel" id="withdrawPopup">
    <button class="popup-close-btn" onclick="closePopup('withdraw')">&times;</button>

    <div class="popup-title">Withdraw Funds</div>
    <div class="popup-subtitle">Cash out from your account balance.</div>

    <label class="popup-label">Account Name</label>
    <input type="text" class="popup-input" placeholder="Enter account holder name">

    <label class="popup-label">Amount</label>
    <input type="number" class="popup-input" placeholder="Enter amount">

    <span class="method-label">Payment Method</span>
    <div class="method-row" id="withdrawMethodRow" data-group="withdraw" data-target="withdrawBankFields">
        <div class="method-card" data-method="easypaisa">
            <div class="method-icon icon-logo"><img src="{{ asset('images/easypaisa.jpg') }}" alt="Easypaisa"></div>
            <span class="method-name">Easypaisa</span>
        </div>
        <div class="method-card" data-method="jazzcash">
            <div class="method-icon icon-logo"><img src="{{ asset('images/jazzcash.png') }}" alt="JazzCash"></div>
            <span class="method-name">JazzCash</span>
        </div>
      
        <div class="method-card" data-method="bank">
            <div class="method-icon icon-bank">🏦</div>
            <span class="method-name">Bank</span>
        </div>
    </div>

    <div class="bank-fields" id="withdrawBankFields">
        <label class="popup-label">Select Bank</label>
        <div class="custom-select" id="wd_bank_select">
            <button type="button" class="custom-select__toggle" data-list="wd_bank_list">
                <span>Choose your bank</span>
                <span class="custom-select__arrow">▾</span>
            </button>
            <input type="hidden" name="bank_name" data-hidden-for="wd_bank_select">
        </div>

        <label class="popup-label">Account / Card Holder Name</label>
        <input type="text" class="popup-input" placeholder="Enter account or card holder name">

        <label class="popup-label">Account Number / IBAN</label>
        <input type="text" class="popup-input" placeholder="Enter account number or IBAN">

        <label class="popup-label">Branch Code <span style="font-weight:400;color:#7C8DA3;">(optional)</span></label>
        <input type="text" class="popup-input" placeholder="Enter branch code">
    </div>

    <button class="popup-submit-btn popup-submit-btn--withdraw">Confirm Withdraw</button>
    <div class="popup-note">This is a frontend preview only, no data is submitted.</div>
</div>


<script>
    const overlay = document.getElementById('popupOverlay');

    function closeAllBankDropdowns(){
        document.querySelectorAll('.custom-select__list.open').forEach(l => l.classList.remove('open'));
        document.querySelectorAll('.custom-select__toggle.open').forEach(t => t.classList.remove('open'));
    }

    function openPopup(type){
        overlay.classList.add('active');
        document.getElementById(type + 'Popup').classList.add('active');
        document.body.style.overflow = 'hidden';
    }

    function closePopup(type){
        document.getElementById(type + 'Popup').classList.remove('active');
        closeAllBankDropdowns();
        // only remove overlay if no popup is open
        const anyOpen = document.querySelector('.popup-panel.active');
        if(!anyOpen){
            overlay.classList.remove('active');
            document.body.style.overflow = '';
        }
    }

    function closePopupOnOverlay(e){
        if(e.target === overlay){
            document.querySelectorAll('.popup-panel.active').forEach(p => p.classList.remove('active'));
            closeAllBankDropdowns();
            overlay.classList.remove('active');
            document.body.style.overflow = '';
        }
    }

    // Escape key closes any open popup
    document.addEventListener('keydown', function(e){
        if(e.key === 'Escape'){
            document.querySelectorAll('.popup-panel.active').forEach(p => p.classList.remove('active'));
            closeAllBankDropdowns();
            overlay.classList.remove('active');
            document.body.style.overflow = '';
        }
    });

    /*
      Custom bank dropdown.
      Each list is appended straight to <body> (not inside .popup-panel),
      so it is never subject to the popup's `transform` + `overflow-y:auto`
      combo that was trapping/clipping the native <select> list. Position
      is calculated live from the toggle button's bounding rect, so it
      always opens downward directly under the field — and re-closes on
      scroll/resize/outside-click so it never drifts out of place.
    */
    const PK_BANKS = [
        "Allied Bank Limited (ABL)", "Al Baraka Bank Pakistan", "Askari Bank",
        "Bank Alfalah", "Bank Al Habib", "Bank of Khyber", "Bank of Punjab",
        "BankIslami Pakistan", "Dubai Islamic Bank Pakistan", "Faysal Bank",
        "First Women Bank", "Habib Bank Limited (HBL)", "Habib Metropolitan Bank",
        "Industrial and Commercial Bank of China (ICBC Pakistan)", "JS Bank",
        "MCB Bank", "MCB Islamic Bank", "Meezan Bank",
        "National Bank of Pakistan (NBP)", "Samba Bank", "Silk Bank",
        "Sindh Bank", "Soneri Bank", "Standard Chartered Bank Pakistan",
        "Summit Bank", "United Bank Limited (UBL)", "Zarai Taraqiati Bank Limited (ZTBL)"
    ];

    function initCustomDropdown(wrapperId){
        const wrapper = document.getElementById(wrapperId);
        if(!wrapper) return;

        const toggle = wrapper.querySelector('.custom-select__toggle');
        const valueEl = toggle.querySelector('.custom-select__value');
        const hiddenInput = wrapper.querySelector('input[type="hidden"]');

        // build the floating list and attach it to <body>, not the wrapper
        const list = document.createElement('div');
        list.className = 'custom-select__list';
        list.setAttribute('role', 'listbox');

        PK_BANKS.forEach(bankName => {
            const opt = document.createElement('div');
            opt.className = 'custom-select__option';
            opt.textContent = bankName;
            opt.addEventListener('click', () => {
                valueEl.textContent = bankName;
                valueEl.classList.remove('placeholder');
                hiddenInput.value = bankName;
                list.querySelectorAll('.custom-select__option').forEach(o => o.classList.remove('selected'));
                opt.classList.add('selected');
                closeDropdown();
            });
            list.appendChild(opt);
        });

        document.body.appendChild(list);

        function positionList(){
            const rect = toggle.getBoundingClientRect();
            const spaceBelow = window.innerHeight - rect.bottom;
            const listHeight = Math.min(260, list.scrollHeight || 260);

            list.style.left = rect.left + 'px';
            list.style.width = rect.width + 'px';

            // open downward by default; flip above only if there truly
            // isn't enough room below AND there's more room above
            if(spaceBelow < listHeight + 10 && rect.top > spaceBelow){
                list.style.top = Math.max(10, rect.top - listHeight - 6) + 'px';
            } else {
                list.style.top = (rect.bottom + 6) + 'px';
            }
        }

        function openDropdown(){
            document.querySelectorAll('.custom-select__list.open').forEach(l => {
                if(l !== list) l.classList.remove('open');
            });
            document.querySelectorAll('.custom-select__toggle.open').forEach(t => {
                if(t !== toggle) t.classList.remove('open');
            });
            positionList();
            list.classList.add('open');
            toggle.classList.add('open');
            window.addEventListener('scroll', positionList, true);
            window.addEventListener('resize', positionList);
        }

        function closeDropdown(){
            list.classList.remove('open');
            toggle.classList.remove('open');
            window.removeEventListener('scroll', positionList, true);
            window.removeEventListener('resize', positionList);
        }

        toggle.addEventListener('click', function(e){
            e.stopPropagation();
            if(list.classList.contains('open')){
                closeDropdown();
            } else {
                openDropdown();
            }
        });

        document.addEventListener('click', function(e){
            if(!list.contains(e.target) && !toggle.contains(e.target)){
                closeDropdown();
            }
        });

        document.addEventListener('keydown', function(e){
            if(e.key === 'Escape') closeDropdown();
        });
    }

    initCustomDropdown('dep_bank_select');
    initCustomDropdown('wd_bank_select');

    /*
      Payment method selector (icon cards):
      - Clicking a card selects it and highlights it (adds .active).
      - Clicking the already-active card deselects it (toggle off).
      - Selecting a different card automatically deselects the previous
        one, since only one payment method applies at a time.
      - When the "Bank" card is active, the extra bank fields
        (bank dropdown, account/card holder name, account number, branch
        code) slide open underneath.
    */
    document.querySelectorAll('.method-row').forEach(row => {
        const targetId = row.dataset.target;
        const bankFields = document.getElementById(targetId);
        const cards = row.querySelectorAll('.method-card');

        cards.forEach(card => {
            card.addEventListener('click', function(){
                const alreadyActive = card.classList.contains('active');

                // clear all in this row first
                cards.forEach(c => c.classList.remove('active'));

                if(!alreadyActive){
                    card.classList.add('active');
                }

                const bankSelected = card.classList.contains('active') && card.dataset.method === 'bank';
                bankFields.classList.toggle('open', bankSelected);
            });
        });
    });
</script>