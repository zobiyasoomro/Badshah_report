{{-- resources/views/components/btns.blade.php --}}
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

    .cta-section__content {
        position: relative;
        z-index: 2;
    }

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
        cursor: pointer;
        white-space: nowrap;
    }

    .cta-section__btn:hover {
        transform: translateY(-4px);
        color: #ffffff;
    }

    .cta-section__btn--deposit {
        background: #00B282;
        box-shadow: 0 10px 25px rgba(34, 197, 94, 0.4);
    }

    .cta-section__btn--deposit:hover {
        background: #16A34A;
    }

    .cta-section__btn--withdraw {
        background: #ef5555;
        box-shadow: 0 10px 25px rgba(239, 68, 68, 0.4);
    }

    .cta-section__btn--withdraw:hover {
        background: #DC2626;
    }

    .cta-section__btn-icon {
        font-size: 1.45rem;
        margin-left: 8px;
    }

    /* ===================== POPUP / MODAL ===================== */

    .popup-overlay {
        display: none;
        position: fixed !important;
        inset: 0;
        background: rgba(6, 12, 22, 0.65);
        opacity: 0;
        transition: opacity 0.25s ease;
        z-index: 999998 !important;
    }

    .popup-overlay.active {
        display: block;
        opacity: 1;
    }

    .popup-panel {
        position: fixed !important;
        top: 20px;
        right: 20px;
        bottom: 20px;
        width: 400px;
        max-width: calc(100% - 40px);
        background: linear-gradient(160deg, #23395B 0%, #16273D 100%);
        border: 1px solid rgba(34, 211, 238, 0.25);
        border-radius: 18px;
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.45);
        z-index: 999999 !important;
        transform: translateX(120%);
        transition: transform 0.28s cubic-bezier(0.22, 1, 0.36, 1);
        will-change: transform;
        overflow-y: auto;
        padding: 24px;
        isolation: isolate;
    }

    .popup-panel.active {
        transform: translateX(0);
    }

    /* Scrollbar */
    .popup-panel {
        scrollbar-width: thin;
        scrollbar-color: #22D3EE rgba(255, 255, 255, 0.06);
    }

    .popup-panel::-webkit-scrollbar {
        width: 7px;
    }

    .popup-panel::-webkit-scrollbar-track {
        background: rgba(255, 255, 255, 0.04);
        border-radius: 10px;
        margin: 10px 2px;
    }

    .popup-panel::-webkit-scrollbar-thumb {
        border-radius: 10px;
        background: linear-gradient(180deg, #67E8F9 0%, #22D3EE 45%, #0E7490 100%);
        box-shadow: 0 0 6px rgba(34, 211, 238, 0.55);
        animation: scrollbarPulse 3.2s ease-in-out infinite;
    }

    .popup-panel::-webkit-scrollbar-thumb:hover {
        background: linear-gradient(180deg, #A5F3FC 0%, #22D3EE 50%, #0891B2 100%);
        box-shadow: 0 0 12px rgba(34, 211, 238, 0.85);
    }

    @keyframes scrollbarPulse {

        0%,
        100% {
            box-shadow: 0 0 5px rgba(34, 211, 238, 0.45);
        }

        50% {
            box-shadow: 0 0 11px rgba(34, 211, 238, 0.85);
        }
    }

    @media (max-width: 576px) {
        .popup-panel {
            top: 12px;
            right: 12px;
            left: 12px;
            bottom: 12px;
            width: auto;
            padding: 18px;
        }

        .popup-title {
            font-size: 1.2rem;
        }

        .method-row {
            grid-template-columns: repeat(2, 1fr);
            gap: 8px;
        }

        .method-card {
            padding: 10px 6px;
        }

        .method-card .method-icon {
            width: 28px;
            height: 28px;
            font-size: 0.95rem;
        }

        .method-card span.method-name {
            font-size: 0.7rem;
        }
    }

    @media (max-width: 360px) {
        .popup-panel {
            top: 8px;
            right: 8px;
            left: 8px;
            bottom: 8px;
            padding: 14px;
        }

        .method-row {
            grid-template-columns: repeat(2, 1fr);
            gap: 6px;
        }

        .popup-input,
        .custom-select__toggle {
            padding: 10px 12px;
            font-size: 0.88rem;
        }
    }

    @media (min-width: 577px) and (max-width: 900px) {
        .popup-panel {
            width: 360px;
        }
    }

    .popup-close-btn {
        position: absolute;
        top: 16px;
        right: 16px;
        width: 34px;
        height: 34px;
        border-radius: 50%;
        border: 1px solid rgba(241, 245, 249, 0.25);
        background: rgba(255, 255, 255, 0.04);
        color: #F1F5F9;
        font-size: 1.1rem;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.2s ease;
    }

    .popup-close-btn:hover {
        background: rgba(239, 85, 85, 0.85);
        border-color: transparent;
        transform: rotate(90deg);
    }

    .popup-title {
        color: #F1F5F9;
        font-weight: 700;
        font-size: 1.4rem;
        margin-top: 6px;
        margin-bottom: 4px;
    }

    .popup-subtitle {
        color: #9FB3C8;
        font-size: 0.9rem;
        margin-bottom: 22px;
    }

    .popup-label {
        color: #CBD5E1;
        font-size: 0.85rem;
        font-weight: 600;
        margin-bottom: 6px;
        display: block;
    }

    .popup-input {
        width: 100%;
        background: rgba(255, 255, 255, 0.05);
        border: 1px solid rgba(148, 163, 184, 0.25);
        color: #F1F5F9;
        border-radius: 10px;
        padding: 12px 14px;
        font-size: 0.95rem;
        margin-bottom: 18px;
        outline: none;
        transition: border-color 0.2s ease, background 0.2s ease;
    }

    .popup-input::placeholder {
        color: #7C8DA3;
    }

    .popup-input:focus {
        border-color: #22D3EE;
        background: rgba(255, 255, 255, 0.08);
    }

    /* ===== INPUT VALIDATION STYLES ===== */
    .popup-input.error {
        border-color: #ef5555 !important;
        background: rgba(239, 85, 85, 0.08) !important;
        box-shadow: 0 0 0 3px rgba(239, 85, 85, 0.15);
    }

    .popup-input.success {
        border-color: #00B282 !important;
        background: rgba(0, 178, 130, 0.08) !important;
    }

    .field-error {
        color: #ef5555;
        font-size: 0.75rem;
        margin-top: -12px;
        margin-bottom: 12px;
        display: none;
        padding-left: 4px;
    }

    .field-error.show {
        display: block;
        animation: slideDown 0.3s ease;
    }

    @keyframes slideDown {
        from {
            opacity: 0;
            transform: translateY(-5px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* ===== TOAST NOTIFICATIONS ===== */
    .toast-container {
        position: fixed;
        top: 20px;
        right: 20px;
        z-index: 99999999;
        display: flex;
        flex-direction: column;
        gap: 10px;
        max-width: 400px;
        width: 100%;
        pointer-events: none;
    }

    .toast {
        background: linear-gradient(160deg, #23395B 0%, #16273D 100%);
        border: 1px solid rgba(34, 211, 238, 0.25);
        border-radius: 12px;
        padding: 16px 20px;
        color: #F1F5F9;
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.5);
        display: flex;
        align-items: center;
        gap: 14px;
        transform: translateX(120%);
        opacity: 0;
        transition: all 0.4s cubic-bezier(0.22, 1, 0.36, 1);
        pointer-events: auto;
        min-height: 60px;
    }

    .toast.show {
        transform: translateX(0);
        opacity: 1;
    }

    .toast.hide {
        transform: translateX(120%);
        opacity: 0;
    }

    .toast-icon {
        font-size: 1.5rem;
        flex-shrink: 0;
        width: 40px;
        height: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.05);
    }

    .toast-icon.error {
        background: rgba(239, 85, 85, 0.2);
        color: #ef5555;
    }

    .toast-icon.success {
        background: rgba(0, 178, 130, 0.2);
        color: #00B282;
    }

    .toast-icon.warning {
        background: rgba(255, 165, 0, 0.2);
        color: #FFA500;
    }

    .toast-icon.info {
        background: rgba(34, 211, 238, 0.2);
        color: #22D3EE;
    }

    .toast-content {
        flex: 1;
    }

    .toast-title {
        font-weight: 700;
        font-size: 0.9rem;
        margin-bottom: 2px;
    }

    .toast-message {
        font-size: 0.8rem;
        color: #9FB3C8;
        line-height: 1.4;
    }

    .toast-progress {
        position: absolute;
        bottom: 0;
        left: 0;
        height: 3px;
        background: linear-gradient(90deg, #22D3EE, #0EA5E9);
        border-radius: 0 0 12px 12px;
        animation: progressBar 4s linear forwards;
    }

    .toast-progress.error {
        background: linear-gradient(90deg, #ef5555, #DC2626);
    }

    .toast-progress.success {
        background: linear-gradient(90deg, #00B282, #16A34A);
    }

    @keyframes progressBar {
        from {
            width: 100%;
        }

        to {
            width: 0%;
        }
    }

    /* ===== REST OF YOUR STYLES ===== */
    .method-label {
        color: #CBD5E1;
        font-size: 0.85rem;
        font-weight: 600;
        margin-bottom: 10px;
        display: block;
    }

    .method-row {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 10px;
        margin-bottom: 10px;
    }

    .method-card {
        flex: 1;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        gap: 8px;
        background: rgba(255, 255, 255, 0.04);
        border: 1.5px solid rgba(148, 163, 184, 0.2);
        border-radius: 12px;
        padding: 14px 8px;
        cursor: pointer;
        transition: all 0.2s ease;
        text-align: center;
    }

    .method-card:hover {
        border-color: rgba(34, 211, 238, 0.4);
        transform: translateY(-2px);
    }

    .method-card.active {
        border-color: #22D3EE;
        background: rgba(34, 211, 238, 0.12);
        box-shadow: 0 0 0 1px rgba(34, 211, 238, 0.3), 0 8px 20px rgba(34, 211, 238, 0.15);
    }

    .method-card .method-icon {
        width: 34px;
        height: 34px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.1rem;
        flex-shrink: 0;
        overflow: hidden;
    }

    .method-card .method-icon img {
        width: 100%;
        height: 100%;
        object-fit: contain;
        display: block;
    }

    .method-card .method-icon.icon-logo {
        background: #ffffff;
        padding: 5px;
    }

    .method-card .method-icon.icon-bank {
        background: #22D3EE;
        color: #0f1c2e;
    }

    .method-card span.method-name {
        color: #F1F5F9;
        font-size: 0.75rem;
        font-weight: 700;
        white-space: nowrap;
    }

    .bank-fields {
        max-height: 0;
        overflow: hidden;
        opacity: 0;
        transition: max-height 0.4s ease, opacity 0.3s ease, margin 0.3s ease;
        margin-top: 0;
    }

    .bank-fields.open {
        max-height: 1180px;
        opacity: 1;
        margin-top: 14px;
    }

    .quick-amounts {
        display: flex;
        gap: 8px;
        flex-wrap: wrap;
        margin-bottom: 15px;
    }

    .quick-amount-btn {
        background: rgba(255, 255, 255, 0.05);
        border: 1px solid rgba(148, 163, 184, 0.2);
        color: #F1F5F9;
        padding: 8px 12px;
        border-radius: 20px;
        font-size: 0.8rem;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.2s;
        flex: 1;
        min-width: 60px;
    }

    .quick-amount-btn:hover {
        background: rgba(34, 211, 238, 0.15);
        border-color: #22D3EE;
        transform: translateY(-2px);
    }

    .quick-amount-btn.active {
        background: #22D3EE;
        color: #0f1c2e;
        border-color: #22D3EE;
        box-shadow: 0 4px 15px rgba(34, 211, 238, 0.3);
    }

    .popup-submit-btn {
        width: 100%;
        border: none;
        padding: 13px;
        border-radius: 50px;
        font-weight: 700;
        font-size: 1rem;
        color: #fff;
        cursor: pointer;
        margin-top: 8px;
        transition: all 0.25s ease;
    }

    .popup-submit-btn:hover {
        transform: translateY(-3px);
    }

    .popup-submit-btn--deposit {
        background: #00B282;
        box-shadow: 0 10px 25px rgba(34, 197, 94, 0.35);
    }

    .popup-submit-btn--deposit:hover {
        background: #16A34A;
    }

    .popup-submit-btn--withdraw {
        background: #ef5555;
        box-shadow: 0 10px 25px rgba(239, 68, 68, 0.35);
    }

    .popup-submit-btn--withdraw:hover {
        background: #DC2626;
    }

    .popup-note {
        font-size: 0.72rem;
        color: #7C8DA3;
        margin-top: 14px;
        text-align: center;
    }

    .custom-select {
        position: relative;
        margin-bottom: 18px;
    }

    .custom-select__toggle {
        width: 100%;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 10px;
        background: rgba(255, 255, 255, 0.05);
        border: 1px solid rgba(148, 163, 184, 0.25);
        color: #F1F5F9;
        border-radius: 10px;
        padding: 12px 14px;
        font-size: 0.95rem;
        cursor: pointer;
        transition: border-color 0.2s ease, background-color 0.2s ease;
    }

    .custom-select__toggle.error {
        border-color: #ef5555 !important;
        background: rgba(239, 85, 85, 0.08) !important;
    }

    .custom-select__toggle:hover,
    .custom-select__toggle.open {
        border-color: #22D3EE;
        background-color: rgba(255, 255, 255, 0.08);
    }

    .custom-select__arrow {
        color: #22D3EE;
        font-size: 0.75rem;
        flex-shrink: 0;
        transition: transform 0.2s ease;
    }

    .custom-select__toggle.open .custom-select__arrow {
        transform: rotate(180deg);
    }

    .custom-select__list {
        position: fixed;
        display: none;
        flex-direction: column;
        gap: 2px;
        background: #16273D;
        border: 1px solid rgba(34, 211, 238, 0.3);
        border-radius: 10px;
        box-shadow: 0 20px 45px rgba(0, 0, 0, 0.5);
        padding: 6px;
        max-height: 260px;
        overflow-y: auto;
        z-index: 2147483000;
        scrollbar-width: thin;
        scrollbar-color: #22D3EE rgba(255, 255, 255, 0.06);
    }

    .custom-select__list.open {
        display: flex;
    }

    .custom-select__list::-webkit-scrollbar {
        width: 7px;
    }

    .custom-select__list::-webkit-scrollbar-track {
        background: rgba(255, 255, 255, 0.04);
        border-radius: 10px;
        margin: 10px 2px;
    }

    .custom-select__list::-webkit-scrollbar-thumb {
        border-radius: 10px;
        background: linear-gradient(180deg, #67E8F9 0%, #22D3EE 45%, #0E7490 100%);
        box-shadow: 0 0 6px rgba(34, 211, 238, 0.55);
    }

    .custom-select__option {
        padding: 10px 12px;
        border-radius: 8px;
        color: #F1F5F9;
        font-size: 0.88rem;
        cursor: pointer;
        transition: background-color 0.15s ease;
    }

    .custom-select__option:hover,
    .custom-select__option.highlighted {
        background: rgba(34, 211, 238, 0.15);
    }

    .custom-select__option.selected {
        background: rgba(34, 211, 238, 0.22);
        font-weight: 600;
    }

    .payment-details-box {
        background: rgba(255, 255, 255, 0.05);
        border: 1px solid rgba(34, 211, 238, 0.2);
        border-radius: 12px;
        padding: 15px;
        margin-bottom: 18px;
        transition: all 0.3s ease;
        display: none;
    }

    .payment-details-box.visible {
        display: block;
        animation: fadeSlide 0.3s ease;
    }

    @keyframes fadeSlide {
        from {
            opacity: 0;
            transform: translateY(-10px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .payment-details-box .detail-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 6px 0;
        border-bottom: 1px solid rgba(255, 255, 255, 0.05);
    }

    .payment-details-box .detail-row:last-child {
        border-bottom: none;
    }

    .payment-details-box .detail-label {
        color: #7C8DA3;
        font-size: 0.75rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .payment-details-box .detail-value {
        color: #F1F5F9;
        font-size: 0.9rem;
        font-weight: 600;
        word-break: break-all;
        text-align: right;
    }

    .payment-details-box .detail-value .copy-btn {
        background: rgba(34, 211, 238, 0.1);
        border: 1px solid rgba(34, 211, 238, 0.3);
        color: #22D3EE;
        padding: 2px 10px;
        border-radius: 5px;
        font-size: 0.7rem;
        cursor: pointer;
        margin-left: 8px;
        transition: all 0.2s;
    }

    .payment-details-box .detail-value .copy-btn:hover {
        background: rgba(34, 211, 238, 0.2);
    }

    .payment-details-box .detail-value.amount {
        color: #22D3EE;
        font-size: 1.1rem;
    }

    .loading-spinner {
        display: inline-block;
        width: 20px;
        height: 20px;
        border: 3px solid rgba(255, 255, 255, 0.3);
        border-radius: 50%;
        border-top-color: #fff;
        animation: spin 0.8s ease-in-out infinite;
        margin-right: 8px;
        vertical-align: middle;
    }

    @keyframes spin {
        to {
            transform: rotate(360deg);
        }
    }

    .btn-loading {
        opacity: 0.7;
        cursor: not-allowed;
    }

    .mobile-wallet-fields {
        background: rgba(34, 211, 238, 0.05);
        border: 1px solid rgba(34, 211, 238, 0.2);
        border-radius: 12px;
        padding: 15px;
        margin-bottom: 15px;
        display: none;
    }

    .mobile-wallet-fields.show {
        display: block;
        animation: fadeSlide 0.3s ease;
    }

    .common-fields {
        margin-bottom: 15px;
    }

    .common-fields.hidden {
        display: none !important;
    }

    .confirm-overlay {
        position: fixed;
        inset: 0;
        background: rgba(0, 0, 0, 0.92);
        z-index: 99999999;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 20px;
        animation: fadeIn 0.3s ease;
    }

    .confirm-modal {
        background: linear-gradient(160deg, #23395B 0%, #16273D 100%);
        border: 2px solid #22D3EE;
        border-radius: 20px;
        padding: 35px;
        max-width: 520px;
        width: 100%;
        color: #F1F5F9;
        text-align: center;
        max-height: 90vh;
        overflow-y: auto;
        position: relative;
    }

    .confirm-modal .close-btn {
        position: absolute;
        top: 12px;
        right: 12px;
        background: rgba(255, 255, 255, 0.1);
        border: none;
        color: #F1F5F9;
        width: 32px;
        height: 32px;
        border-radius: 50%;
        font-size: 1.2rem;
        cursor: pointer;
        transition: all 0.2s;
    }

    .confirm-modal .close-btn:hover {
        background: rgba(239, 85, 85, 0.8);
    }

    .confirm-modal .payment-detail {
        background: rgba(255, 255, 255, 0.05);
        padding: 10px 15px;
        border-radius: 10px;
        margin-bottom: 8px;
    }

    .deep-link-btn {
        background: linear-gradient(135deg, #22D3EE 0%, #0EA5E9 100%);
        color: #0f1c2e;
        border: none;
        padding: 14px 30px;
        border-radius: 50px;
        font-weight: 700;
        cursor: pointer;
        font-size: 1rem;
        width: 100%;
        transition: all 0.3s;
        box-shadow: 0 4px 15px rgba(34, 211, 238, 0.3);
        margin-bottom: 8px;
    }

    .deep-link-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(34, 211, 238, 0.5);
    }

    .deep-link-btn-web {
        background: rgba(255, 255, 255, 0.08);
        color: #F1F5F9;
        border: 1px solid rgba(255, 255, 255, 0.2);
        padding: 14px 30px;
        border-radius: 50px;
        font-weight: 600;
        cursor: pointer;
        font-size: 1rem;
        width: 100%;
        transition: all 0.3s;
        margin-top: 8px;
    }

    .deep-link-btn-web:hover {
        background: rgba(255, 255, 255, 0.15);
        transform: translateY(-2px);
    }

    .confirm-submit-btn {
        background: #00B282;
        border: none;
        padding: 14px 30px;
        border-radius: 50px;
        font-weight: 700;
        font-size: 1rem;
        color: #fff;
        cursor: pointer;
        width: 100%;
        transition: all 0.3s;
        margin-top: 10px;
    }

    .confirm-submit-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(34, 197, 94, 0.4);
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: scale(0.95);
        }

        to {
            opacity: 1;
            transform: scale(1);
        }
    }

    /* CTA Section Styles */
    .cta-section {
        background: linear-gradient(135deg, #ffffff 0%, #f8f9fa 100%);

        box-shadow: 0 2px 20px rgba(0, 0, 0, 0.05);
    }

    .cta-section__heading {
        font-family: 'Oswald', 'Poppins', sans-serif;
        text-transform: uppercase;
    }

    .cta-text-wrapper {
        transition: all 0.3s ease;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
    }

    .cta-text-wrapper:hover {
        transform: translateX(5px);
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
    }

    /* Urdu Font */
    @import url('https://fonts.googleapis.com/css2?family=Noto+Nastaliq+Urdu:wght@400;500;700&display=swap');

    /* Arabic Font */
    @import url('https://fonts.googleapis.com/css2?family=Noto+Naskh+Arabic:wght@400;500;700&display=swap');

    /* English Font */
    @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap');

    /* Responsive */
    @media (max-width: 768px) {
        .cta-section__heading {
            font-size: 1.6rem !important;
        }

        .cta-section__text {
            font-size: 0.9rem !important;
        }

        .cta-text-wrapper {
            padding: 12px 15px !important;
        }
    }

    /* Urdu specific styling */
    .urdu-text {
        font-family: 'Noto Nastaliq Urdu', 'Jameel Noori Nastaleeq', 'Urdu Typesetting', serif;
        line-height: 2.2 !important;
    }

    /* Arabic specific styling */
    .arabic-text {
        font-family: 'Noto Naskh Arabic', 'Amiri', 'Traditional Arabic', serif;
        line-height: 2.2 !important;
    }

    /* English specific styling */
    .english-text {
        font-family: 'Inter', 'Segoe UI', sans-serif;
    }
</style>

<!-- ===================== CTA SECTION ===================== -->
<style>
    /* ===== FONT IMPORTS ===== */
    @import url('https://fonts.googleapis.com/css2?family=Noto+Nastaliq+Urdu:wght@400;500;700&display=swap');
    @import url('https://fonts.googleapis.com/css2?family=Noto+Naskh+Arabic:wght@400;500;700&display=swap');
    @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap');

    /* ===== CTA SECTION ===== */
    .cta-section {
        background: linear-gradient(135deg, #ffffff 0%, #f8f9fa 100%);
        box-shadow: 0 2px 20px rgba(0, 0, 0, 0.05);
        padding: 20px 0;
    }

    /* ===== BUTTON WRAPPER - 70% WIDTH ===== */
    .button-wrapper {
        max-width: 70%;
        margin: 0 auto;
    }

    /* ===== DEPOSIT BUTTON ===== */
    .deposit-btn {
        padding: 12px 25px;
        font-size: 1rem;
        border-radius: 8px;
        border: none;
        background: linear-gradient(135deg, #00b282, #00b283bc);
        color: #ffffff;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 1.5px;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(40, 167, 69, 0.3);
        min-width: 140px;
        cursor: pointer;
    }

    .deposit-btn:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 25px rgba(40, 167, 69, 0.4);
        background: linear-gradient(135deg, #14a550, #14a550bc);
    }

    /* ===== WITHDRAW BUTTON ===== */
    .withdraw-btn {
        padding: 12px 25px;
        font-size: 1rem;
        border-radius: 8px;
        border: none;
        background: linear-gradient(135deg, #ef5555, #ef5555d2);
        color: #ffffff;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 1.5px;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(197, 72, 56, 0.89);
        min-width: 140px;
        cursor: pointer;
    }

    .withdraw-btn:hover {
        transform: translateY(-3px);
        box-shadow: 0 4px 15px rgba(197, 72, 56, 0.89);
        background: linear-gradient(135deg, #f63535, #f92f2fd2);
    }

    /* ===== RESPONSIVE BUTTON SIZING ===== */
    @media (max-width: 576px) {
        .button-wrapper {
            max-width: 90% !important;
        }
        .deposit-btn,
        .withdraw-btn {
            padding: 10px 15px;
            font-size: 0.7rem;
            letter-spacing: 1px;
            min-width: 100px;
        }
        .deposit-btn .cta-section__btn-icon,
        .withdraw-btn .cta-section__btn-icon {
            font-size: 0.8rem;
        }
    }

    @media (min-width: 577px) and (max-width: 768px) {
        .button-wrapper {
            max-width: 80% !important;
        }
        .deposit-btn,
        .withdraw-btn {
            padding: 11px 20px;
            font-size: 0.8rem;
            min-width: 120px;
        }
    }

    @media (min-width: 769px) and (max-width: 992px) {
        .button-wrapper {
            max-width: 70% !important;
        }
        .deposit-btn,
        .withdraw-btn {
            padding: 12px 25px;
            font-size: 0.9rem;
            min-width: 140px;
        }
    }

    @media (min-width: 993px) {
        .button-wrapper {
            max-width: 70% !important;
        }
        .deposit-btn,
        .withdraw-btn {
            padding: 14px 35px;
            font-size: 1rem;
            min-width: 160px;
        }
    }

    /* ===== TEXT STYLES ===== */
    .urdu-text {
        font-family: 'Noto Nastaliq Urdu', 'Jameel Noori Nastaleeq', serif;
        font-size: 1rem;
        color: #1a1a1a;
        line-height: 1.9;
        font-weight: 700;
        text-align: right;
        direction: rtl;
        margin: 0;
    }

    .english-text {
        font-family: 'Inter', 'Segoe UI', sans-serif;
        font-size: 1rem;
        color: #1a1a1a;
        line-height: 1.7;
        font-weight: 700;
        margin: 0;
    }

    .arabic-text {
        font-family: 'Noto Naskh Arabic', 'Amiri', serif;
        font-size: 1rem;
        color: #1a1a1a;
        line-height: 1.9;
        font-weight: 700;
        text-align: right;
        direction: rtl;
        margin: 0;
    }

    /* ===== TEXT WRAPPER ===== */
    .cta-text-wrapper {
        border-radius: 10px;
        padding: 15px 20px;
        transition: all 0.3s ease;
    }

    .cta-text-wrapper:hover {
        transform: translateX(5px);
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
    }

    /* ===== HEADING ===== */
    .cta-section__heading {
        font-size: 2.2rem;
        font-weight: 700;
        color: #110722;
        letter-spacing: 1px;
    }

    /* ===== RESPONSIVE TEXT SIZING ===== */
    @media (max-width: 576px) {
        .cta-section__heading {
            font-size: 1.5rem !important;
        }
        .urdu-text,
        .english-text,
        .arabic-text {
            font-size: 0.8rem !important;
        }
        .cta-text-wrapper {
            padding: 10px 12px !important;
        }
    }

    @media (min-width: 577px) and (max-width: 768px) {
        .cta-section__heading {
            font-size: 1.8rem !important;
        }
        .urdu-text,
        .english-text,
        .arabic-text {
            font-size: 0.85rem !important;
        }
    }

    @media (min-width: 769px) and (max-width: 992px) {
        .cta-section__heading {
            font-size: 2rem !important;
        }
    }

    @media (min-width: 993px) {
        .cta-section__heading {
            font-size: 2.2rem !important;
        }
        .urdu-text,
        .english-text,
        .arabic-text {
            font-size: 1rem !important;
        }
    }

    /* ===== BUTTON ICON ===== */
    .cta-section__btn-icon {
        font-size: 1.2rem;
        line-height: 1;
    }

    @media (max-width: 576px) {
        .cta-section__btn-icon {
            font-size: 0.9rem !important;
        }
    }

    /* ===== FLEX UTILITIES ===== */
    .d-flex {
        display: flex;
    }
    .flex-wrap {
        flex-wrap: wrap;
    }
    .flex-grow-1 {
        flex-grow: 1;
    }
    .justify-content-center {
        justify-content: center;
    }
    .align-items-center {
        align-items: center;
    }
    .gap-3 {
        gap: 1rem;
    }
    .text-center {
        text-align: center;
    }
    .mb-0 {
        margin-bottom: 0;
    }
    .mb-2 {
        margin-bottom: 0.5rem;
    }
    .mb-3 {
        margin-bottom: 1rem;
    }
    .mb-4 {
        margin-bottom: 1.5rem;
    }
    .ms-2 {
        margin-left: 0.5rem;
    }
    .py-4 {
        padding-top: 1.5rem;
        padding-bottom: 1.5rem;
    }
    .col-12 {
        width: 100%;
    }
    .container {
        max-width: 1140px;
        margin: 0 auto;
        padding: 0 15px;
    }
    .row {
        display: flex;
        flex-wrap: wrap;
        margin: 0 -15px;
    }
    .justify-content-center {
        justify-content: center;
    }
</style>

<section class="cta-section py-4">
    <div class="container">
        <div class="row cta-section__content justify-content-center">

            <!-- ===== BUTTONS - TOP (CENTER) with 70% width ===== -->
            <div class="col-12 text-center mb-4">
                <div class="d-flex flex-wrap gap-3 justify-content-center align-items-center button-wrapper">
                    <button onclick="openPopup('deposit')"
                        class="cta-section__btn cta-section__btn--deposit d-flex align-items-center deposit-btn flex-grow-1 justify-content-center">
                        DEPOSIT <span class="cta-section__btn-icon ms-2">↑</span>
                    </button>
                    <button onclick="openPopup('withdraw')"
                        class="cta-section__btn cta-section__btn--withdraw d-flex align-items-center withdraw-btn flex-grow-1 justify-content-center">
                        WITHDRAW <span class="cta-section__btn-icon ms-2">↓</span>
                    </button>
                </div>
            </div>

            <!-- ===== TEXT - BOTTOM ===== -->
            <div class="col-12">
                <h1 class="cta-section__heading mb-3 text-center">
                    ⚡ "Instant Banking Services"
                </h1>

                <!-- ===== URDU TEXT ===== -->
                <div class="cta-text-wrapper mb-2" style="background: #f0f0f5; border-right: 3px solid #6610f2;">
                    <p class="cta-section__text mb-0 urdu-text">
                        ۲۴ گھنٹے سروس — فوری ڈپازٹ اور لامحدود ودڈراؤ، جب چاہیں اور جتنی بار چاہیں۔ اب سب کچھ فوراً اور
                        بے فکری کے ساتھ ممکن ہے۔
                    </p>
                </div>

                <!-- ===== ENGLISH TEXT ===== -->
                <div class="cta-text-wrapper mb-2" style="background: #f0f5f0; border-left: 3px solid #28a745;">
                    <p class="cta-section__text mb-0 english-text">
                        24/7 Service — Instant Deposits &amp; Unlimited Withdrawals, anytime and as many times as you
                        want. Everything is now instant and hassle-free!
                    </p>
                </div>

                <!-- ===== ARABIC TEXT ===== -->
                <div class="cta-text-wrapper" style="background: #f5f0f0; border-right: 3px solid #dc3545;">
                    <p class="cta-section__text mb-0 arabic-text">
                        خدمة ۲۴ ساعة — إيداع فوري وسحب غير محدود، في أي وقت ولأي عدد من المرات. الآن كل شيء فوري وبكل
                        راحة بال!
                    </p>
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

    <div id="step1">
        <span class="method-label">Select Payment Method</span>
        <div class="method-row" id="depositMethodRow">
            <!-- Methods will be loaded dynamically from database -->
        </div>
        <input type="hidden" name="payment_method" id="deposit_payment_method">
        <input type="hidden" name="payment_method_id" id="deposit_payment_method_id">
    </div>

    <form id="depositForm" enctype="multipart/form-data" style="display: none;">
        @csrf

        <div class="mobile-wallet-fields" id="depositMobileFields">
            <label class="popup-label">Account Holder Name <span style="color:#ef5555;">*</span></label>
            <input type="text" class="popup-input" id="deposit_account_name" name="account_holder_name"
                placeholder="Enter your account holder name" required>
            <div class="field-error" id="deposit_account_name_error">Please enter your account holder name</div>

            <label class="popup-label">Your Account Number <span style="color:#ef5555;">*</span></label>
            <input type="text" class="popup-input" id="deposit_user_account_number" name="user_account_number"
                placeholder="Enter your Easypaisa/Jazzcash Account Number (min 11 digits)" minlength="11" required>
            <div class="field-error" id="deposit_user_account_number_error">Please enter a valid account number (minimum
                11 digits)</div>

            <label class="popup-label">Amount (PKR) <span style="color:#ef5555;">*</span></label>
            <div class="quick-amounts">
                <button type="button" class="quick-amount-btn" data-amount="500">500</button>
                <button type="button" class="quick-amount-btn" data-amount="1000">1,000</button>
                <button type="button" class="quick-amount-btn" data-amount="2000">2,000</button>
                <button type="button" class="quick-amount-btn" data-amount="3000">3,000</button>
                <button type="button" class="quick-amount-btn" data-amount="5000">5,000</button>
                <button type="button" class="quick-amount-btn" data-amount="10000">10,000</button>
            </div>
            <input type="number" class="popup-input" id="deposit_amount_mobile" name="amount"
                placeholder="Enter amount (min: 50)" min="50" step="1" required>
            <div class="field-error" id="deposit_amount_mobile_error">Please enter a valid amount (minimum 50 PKR)</div>

            <div class="payment-details-box visible" id="paymentDetailsBox" style="display:block; margin-bottom:15px;">
                <div class="detail-row">
                    <span class="detail-label">Payment Method</span>
                    <span class="detail-value" id="displayMethodName">-</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Account Holder</span>
                    <span class="detail-value" id="displayAccountHolder">-</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Account Number</span>
                    <span class="detail-value" id="displayAccountNumber">
                        <span id="accountNumberText">-</span>
                        <button type="button" class="copy-btn" onclick="copyAccountNumber()">📋 Copy</button>
                    </span>
                </div>
            </div>

            <button type="button" class="popup-submit-btn popup-submit-btn--deposit" id="depositSubmitBtn"
                onclick="openMobileConfirmation()">
                💳 Pay Now
            </button>
        </div>

        <div class="bank-fields" id="depositBankFields">
            <label class="popup-label">Account Holder Name <span style="color:#ef5555;">*</span></label>
            <input type="text" class="popup-input" id="deposit_account_name_bank" name="account_holder_name"
                placeholder="Enter your account holder name" required>
            <div class="field-error" id="deposit_account_name_bank_error">Please enter your account holder name</div>

            <label class="popup-label">Amount (PKR) <span style="color:#ef5555;">*</span></label>
            <div class="quick-amounts">
                <button type="button" class="quick-amount-btn" data-amount="500">500</button>
                <button type="button" class="quick-amount-btn" data-amount="1000">1,000</button>
                <button type="button" class="quick-amount-btn" data-amount="2000">2,000</button>
                <button type="button" class="quick-amount-btn" data-amount="3000">3,000</button>
                <button type="button" class="quick-amount-btn" data-amount="5000">5,000</button>
                <button type="button" class="quick-amount-btn" data-amount="10000">10,000</button>
            </div>
            <input type="number" class="popup-input" id="deposit_amount_bank" name="amount"
                placeholder="Enter amount (min: 50)" min="50" step="1" required>
            <div class="field-error" id="deposit_amount_bank_error">Please enter a valid amount (minimum 50 PKR)</div>

            <div
                style="background:rgba(255,165,0,0.1); border:1px solid rgba(255,165,0,0.3); border-radius:8px; padding:10px; margin-bottom:15px; text-align:center;">
                <span style="color:#FFA500; font-weight:600;">🏦 Bank Transfer</span>
                <span style="color:#9FB3C8; font-size:0.8rem; display:block;">Please fill all details and upload
                    screenshot</span>
            </div>

            <label class="popup-label">Select Bank <span style="color:#ef5555;">*</span></label>
            <div class="custom-select" id="dep_bank_select">
                <button type="button" class="custom-select__toggle" data-list="dep_bank_list">
                    <span>Choose your bank</span>
                    <span class="custom-select__arrow">▾</span>
                </button>
                <input type="hidden" name="bank_name" data-hidden-for="dep_bank_select">
            </div>
            <div class="field-error" id="dep_bank_select_error">Please select a bank</div>

            <label class="popup-label">Account / Card Holder Name <span style="color:#ef5555;">*</span></label>
            <input type="text" class="popup-input" name="account_number_holder"
                placeholder="Enter account or card holder name" required>
            <div class="field-error" id="account_number_holder_error">Please enter account holder name</div>

            <label class="popup-label">Account Number / IBAN <span style="color:#ef5555;">*</span></label>
            <input type="text" class="popup-input" name="account_number" placeholder="Enter account number or IBAN"
                required>
            <div class="field-error" id="account_number_error">Please enter account number or IBAN</div>

            <label class="popup-label">Validate Number</label>
            <input type="text" class="popup-input" name="validate_number" placeholder="Enter card validate (01/02)">

            <label class="popup-label">Security Key</label>
            <input type="text" class="popup-input" name="security_key" placeholder="Enter security key">

            <label class="popup-label">Branch Code <span
                    style="font-weight:400;color:#7C8DA3;">(optional)</span></label>
            <input type="text" class="popup-input" name="branch_code" placeholder="Enter branch code">

            <label class="popup-label">Transaction ID <span style="color:#ef5555;">*</span></label>
            <input type="text" class="popup-input" id="deposit_transaction_id_bank" name="transaction_id"
                placeholder="Enter transaction ID from payment app" required>
            <div class="field-error" id="deposit_transaction_id_bank_error">Please enter your transaction ID</div>

            <label class="popup-label">Screenshot <span style="color:#ef5555;">*</span></label>
            <input type="file" class="popup-input" name="screenshot" accept="image/*" style="padding: 8px;" required>
            <div class="field-error" id="screenshot_error">Please upload a screenshot of your bank transfer</div>

            <button type="button" class="popup-submit-btn popup-submit-btn--deposit" id="bankSubmitBtn">
                🏦 Submit Bank Transfer
            </button>
        </div>
    </form>

    <div class="popup-note" id="depositNote">Select a payment method to continue.</div>
</div>

<!-- ===================== WITHDRAW POPUP ===================== -->
<div class="popup-panel" id="withdrawPopup">
    <button class="popup-close-btn" onclick="closePopup('withdraw')">&times;</button>

    <div class="popup-title">Withdraw Funds</div>
    <div class="popup-subtitle">Cash out from your account balance.</div>

    <div id="withdrawStep1">
        <span class="method-label">Select Payment Method</span>
        <div class="method-row" id="withdrawMethodRow">
            <div class="method-card" data-method="easypaisa" data-type="mobile_wallet" data-method-id="1">
                <div class="method-icon icon-logo"><img src="{{ asset('images/easypaisa.jpg') }}" alt="Easypaisa"></div>
                <span class="method-name">EasyPaisa</span>
            </div>
            <div class="method-card" data-method="jazzcash" data-type="mobile_wallet" data-method-id="2">
                <div class="method-icon icon-logo"><img src="{{ asset('images/jazzcash.png') }}" alt="JazzCash"></div>
                <span class="method-name">JazzCash</span>
            </div>
            <div class="method-card" data-method="bank" data-type="bank" data-method-id="3">
                <div class="method-icon icon-bank">🏦</div>
                <span class="method-name">Bank</span>
            </div>
        </div>
        <input type="hidden" name="withdraw_payment_method" id="withdraw_payment_method">
        <input type="hidden" name="withdraw_payment_method_id" id="withdraw_payment_method_id">
    </div>

    <form id="withdrawForm" enctype="multipart/form-data" style="display: none;">
        @csrf

        <div class="mobile-wallet-fields" id="withdrawMobileFields">
            <div
                style="background:rgba(34,211,238,0.1); border:1px solid rgba(34,211,238,0.3); border-radius:8px; padding:10px; margin-bottom:15px; text-align:center;">
                <span style="color:#22D3EE; font-weight:600;">📱 Mobile Wallet Withdrawal</span>
                <span style="color:#9FB3C8; font-size:0.8rem; display:block;">Your funds will be sent to your mobile
                    wallet</span>
            </div>

            <label class="popup-label">Full Name <span style="color:#ef5555;">*</span></label>
            <input type="text" class="popup-input" id="withdraw_account_name" name="account_holder_name"
                placeholder="Enter your full name" required>
            <div class="field-error" id="withdraw_account_name_error">Please enter your full name</div>

            <label class="popup-label">Account Number <span style="color:#ef5555;">*</span></label>
            <input type="text" class="popup-input" id="withdraw_account_number" name="account_number"
                placeholder="Enter your Easypaisa/Jazzcash Account Number (min 11 digits)" minlength="11" required>
            <div class="field-error" id="withdraw_account_number_error">Please enter a valid account number (minimum 11
                digits)</div>

            <label class="popup-label">Amount (PKR) <span style="color:#ef5555;">*</span></label>
            <div class="quick-amounts">
                <button type="button" class="quick-amount-btn" data-amount="500">500</button>
                <button type="button" class="quick-amount-btn" data-amount="1000">1,000</button>
                <button type="button" class="quick-amount-btn" data-amount="2000">2,000</button>
                <button type="button" class="quick-amount-btn" data-amount="3000">3,000</button>
                <button type="button" class="quick-amount-btn" data-amount="5000">5,000</button>
                <button type="button" class="quick-amount-btn" data-amount="10000">10,000</button>
            </div>
            <input type="number" class="popup-input" id="withdraw_amount" name="amount"
                placeholder="Enter amount (min: 100)" min="100" step="1" required>
            <div class="field-error" id="withdraw_amount_error">Please enter a valid amount (minimum 100 PKR)</div>

            <button type="submit" class="popup-submit-btn popup-submit-btn--withdraw" id="withdrawSubmitBtn">
                💰 Request Withdrawal
            </button>
        </div>

        <div class="bank-fields" id="withdrawBankFields">
            <div
                style="background:rgba(255,165,0,0.1); border:1px solid rgba(255,165,0,0.3); border-radius:8px; padding:10px; margin-bottom:15px; text-align:center;">
                <span style="color:#FFA500; font-weight:600;">🏦 Bank Withdrawal</span>
                <span style="color:#9FB3C8; font-size:0.8rem; display:block;">Your funds will be sent to your bank
                    account</span>
            </div>

            <label class="popup-label">Account Holder Name <span style="color:#ef5555;">*</span></label>
            <input type="text" class="popup-input" id="withdraw_bank_account_name" name="account_holder_name"
                placeholder="Enter account holder name" required>
            <div class="field-error" id="withdraw_bank_account_name_error">Please enter account holder name</div>

            <label class="popup-label">Select Bank <span style="color:#ef5555;">*</span></label>
            <div class="custom-select" id="wd_bank_select">
                <button type="button" class="custom-select__toggle" data-list="wd_bank_list">
                    <span>Choose your bank</span>
                    <span class="custom-select__arrow">▾</span>
                </button>
                <input type="hidden" name="bank_name" data-hidden-for="wd_bank_select">
            </div>
            <div class="field-error" id="wd_bank_select_error">Please select a bank</div>

            <label class="popup-label">IBAN Number <span style="color:#ef5555;">*</span></label>
            <input type="text" class="popup-input" id="withdraw_iban" name="iban_number"
                placeholder="Enter your IBAN number" required>
            <div class="field-error" id="withdraw_iban_error">Please enter your IBAN number</div>

            <label class="popup-label">Card Number <span style="color:#7C8DA3;">(optional)</span></label>
            <input type="text" class="popup-input" id="withdraw_card" name="card_number"
                placeholder="Enter your card number">

            <label class="popup-label">Branch Code <span style="color:#7C8DA3;">(optional)</span></label>
            <input type="text" class="popup-input" name="branch_code" placeholder="Enter branch code">

            <label class="popup-label">Amount (PKR) <span style="color:#ef5555;">*</span></label>
            <div class="quick-amounts">
                <button type="button" class="quick-amount-btn" data-amount="500">500</button>
                <button type="button" class="quick-amount-btn" data-amount="1000">1,000</button>
                <button type="button" class="quick-amount-btn" data-amount="2000">2,000</button>
                <button type="button" class="quick-amount-btn" data-amount="3000">3,000</button>
                <button type="button" class="quick-amount-btn" data-amount="5000">5,000</button>
                <button type="button" class="quick-amount-btn" data-amount="10000">10,000</button>
            </div>
            <input type="number" class="popup-input" id="withdraw_bank_amount" name="amount"
                placeholder="Enter amount (min: 100)" min="100" step="1" required>
            <div class="field-error" id="withdraw_bank_amount_error">Please enter a valid amount (minimum 100 PKR)</div>

            <button type="submit" class="popup-submit-btn popup-submit-btn--withdraw" id="withdrawBankSubmitBtn">
                💰 Request Withdrawal
            </button>
        </div>
    </form>

    <div class="popup-note" id="withdrawNote">Select a payment method to continue.</div>
</div>

<!-- ===================== SUCCESS MODAL ===================== -->
<div id="successModal"
    style="display:none; position:fixed; inset:0; background:rgba(0,0,0,0.7); z-index:9999999; align-items:center; justify-content:center;">
    <div
        style="background:#23395B; padding:40px; border-radius:20px; max-width:400px; text-align:center; border:2px solid #22D3EE;">
        <div style="font-size:50px; color:#22D3EE; margin-bottom:15px;">✅</div>
        <h2 style="color:#F1F5F9; margin-bottom:10px;">Success!</h2>
        <p style="color:#9FB3C8;" id="successMessage">Redirecting to payment app...</p>
        <button onclick="closeSuccessModal()"
            style="margin-top:20px; background:#22D3EE; color:#0f1c2e; border:none; padding:10px 30px; border-radius:50px; font-weight:700; cursor:pointer;">Continue</button>
    </div>
</div>

<!-- ===================== CONFIRMATION POPUP ===================== -->
<div id="confirmationPopup" style="display:none;">
    <div class="confirm-overlay" id="confirmOverlay">
        <div class="confirm-modal">
            <button class="close-btn" onclick="closeConfirmation()">&times;</button>

            <div style="font-size:48px; margin-bottom:10px;">💰</div>
            <h2 style="color:#22D3EE; margin-bottom:5px;">Confirm Payment</h2>
            <p style="color:#9FB3C8; margin-bottom:15px;">Please complete your payment using one of the options below
            </p>

            <div id="confirmDetails">
                <div class="payment-detail">
                    <div style="color:#7C8DA3; font-size:0.7rem; text-transform:uppercase;">Payment Method</div>
                    <div style="font-size:1rem; font-weight:600; color:#F1F5F9;" id="confirmMethod">-</div>
                </div>
                <div class="payment-detail">
                    <div style="color:#7C8DA3; font-size:0.7rem; text-transform:uppercase;">Recipient Account</div>
                    <div style="font-size:1rem; font-weight:600; color:#F1F5F9; word-break:break-all;"
                        id="confirmAccount">-</div>
                </div>
                <div class="payment-detail">
                    <div style="color:#7C8DA3; font-size:0.7rem; text-transform:uppercase;">Amount</div>
                    <div style="font-size:1.5rem; font-weight:700; color:#22D3EE;" id="confirmAmount">PKR 0</div>
                </div>
            </div>

            <div style="margin:15px 0;">
                <button id="deepLinkAppBtn" class="deep-link-btn" onclick="openDeepLink()">
                    📱 Open Mobile App
                </button>
                <button id="deepLinkWebBtn" class="deep-link-btn-web" onclick="openWebPayment()">
                    🌐 Use Website
                </button>
            </div>

            <form id="confirmationForm" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="deposit_id" id="confirm_deposit_id">

                <div
                    style="background:rgba(255,255,255,0.03); border:2px dashed rgba(34,211,238,0.3); border-radius:12px; padding:15px; margin-top:10px;">
                    <label class="popup-label" style="text-align:left;">Transaction ID <span
                            style="color:#7C8DA3;">(optional - min 16 digits)</span></label>
                    <input type="text" class="popup-input" id="confirm_transaction_input" name="transaction_id_receipt"
                        placeholder="Enter transaction ID (16+ digits)" minlength="16" style="margin-bottom:10px;">

                    <label class="popup-label" style="text-align:left;">Payment Screenshot <span
                            style="color:#ef5555;">*</span></label>
                    <p style="color:#7C8DA3; font-size:0.75rem; margin-top:-5px; margin-bottom:10px; text-align:left;">
                        Upload a clear screenshot or photo of your payment confirmation
                    </p>
                    <input type="file" class="popup-input" id="confirm_receipt" name="receipt"
                        accept="image/*,application/pdf" style="padding: 8px;" required>
                    <div class="field-error" id="confirm_receipt_error">Please upload a payment screenshot</div>
                </div>

                <button type="submit" class="confirm-submit-btn" id="confirmSubmitBtn">
                    ✅ Submit Payment
                </button>
            </form>

            <p style="font-size:0.7rem; color:#7C8DA3; margin-top:12px;">
                ⚠️ Your deposit will be verified after submission. Please wait for admin approval.
            </p>
        </div>
    </div>
</div>

<!-- ===================== TOAST CONTAINER ===================== -->
<div class="toast-container" id="toastContainer"></div>

<script>
    // ============================================================
    // TOAST NOTIFICATION SYSTEM
    // ============================================================
    function showToast(message, type = 'error', title = '') {
        const container = document.getElementById('toastContainer');
        const toast = document.createElement('div');
        toast.className = 'toast';

        const icons = {
            error: '❌',
            success: '✅',
            warning: '⚠️',
            info: 'ℹ️'
        };

        const titles = {
            error: 'Error',
            success: 'Success',
            warning: 'Warning',
            info: 'Info'
        };

        toast.innerHTML = `
            <div class="toast-icon ${type}">${icons[type] || 'ℹ️'}</div>
            <div class="toast-content">
                <div class="toast-title">${title || titles[type] || 'Notification'}</div>
                <div class="toast-message">${message}</div>
            </div>
            <div class="toast-progress ${type}"></div>
        `;

        container.appendChild(toast);

        // Trigger show animation
        requestAnimationFrame(() => {
            toast.classList.add('show');
        });

        // Auto remove after 4 seconds
        setTimeout(() => {
            toast.classList.remove('show');
            toast.classList.add('hide');
            setTimeout(() => {
                toast.remove();
            }, 400);
        }, 4000);
    }

    // ============================================================
    // FIELD VALIDATION HELPERS
    // ============================================================
    function showFieldError(inputId, errorId) {
        const input = document.getElementById(inputId);
        const error = document.getElementById(errorId);
        if (input) {
            input.classList.add('error');
            input.classList.remove('success');
        }
        if (error) {
            error.classList.add('show');
        }
    }

    function hideFieldError(inputId, errorId) {
        const input = document.getElementById(inputId);
        const error = document.getElementById(errorId);
        if (input) {
            input.classList.remove('error');
            input.classList.add('success');
        }
        if (error) {
            error.classList.remove('show');
        }
    }

    function clearAllErrors(prefix) {
        document.querySelectorAll(`#${prefix} .popup-input`).forEach(el => {
            el.classList.remove('error', 'success');
        });
        document.querySelectorAll(`#${prefix} .field-error`).forEach(el => {
            el.classList.remove('show');
        });
        document.querySelectorAll(`#${prefix} .custom-select__toggle`).forEach(el => {
            el.classList.remove('error');
        });
    }

    // ============================================================
    // GLOBAL VARIABLES
    // ============================================================
    let PAYMENT_METHODS = {};
    let BANK_METHODS = [];
    let selectedMethodId = null;
    let currentDepositData = null;

    // ============================================================
    // LOAD PAYMENT METHODS FROM DATABASE
    // ============================================================
    async function loadPaymentMethods() {
        try {
            const response = await fetch('/api/payment-methods');
            const data = await response.json();

            if (data.success) {
                data.methods.forEach(method => {
                    PAYMENT_METHODS[method.id] = method;
                });

                BANK_METHODS = data.methods.filter(m => m.type === 'bank');
                console.log('Banks loaded:', BANK_METHODS.length);

                renderMethodCards(data.methods);

                const firstMobile = data.methods.find(m => m.type === 'mobile_wallet');
                if (firstMobile) {
                    const card = document.querySelector(`.method-card[data-method-id="${firstMobile.id}"]`);
                    if (card) {
                        card.click();
                    }
                }

                updateBankDropdown();
                resetToStep1();
            }
        } catch (error) {
            console.error('Error loading payment methods:', error);
            loadFallbackMethods();
        }
    }

    // ============================================================
    // RESET TO STEP 1
    // ============================================================
    function resetToStep1() {
        document.getElementById('step1').style.display = 'block';
        document.getElementById('depositForm').style.display = 'none';
        document.getElementById('depositNote').textContent = 'Select a payment method to continue.';
        document.getElementById('depositMobileFields').classList.remove('show');
        document.getElementById('depositBankFields').classList.remove('open');
        document.getElementById('depositBankFields').style.display = 'none';
    }

    // ============================================================
    // SHOW PAYMENT FORM
    // ============================================================
    function showPaymentForm(methodType) {
        document.getElementById('step1').style.display = 'none';
        document.getElementById('depositForm').style.display = 'block';

        if (methodType === 'mobile_wallet') {
            document.getElementById('depositMobileFields').classList.add('show');
            document.getElementById('depositBankFields').style.display = 'none';
            document.getElementById('depositBankFields').classList.remove('open');
            document.getElementById('depositNote').textContent = 'Fill in your details and click Pay Now.';
            updatePaymentDetails(selectedMethodId);
        } else if (methodType === 'bank') {
            document.getElementById('depositMobileFields').classList.remove('show');
            document.getElementById('depositBankFields').style.display = 'block';
            document.getElementById('depositBankFields').classList.add('open');
            document.getElementById('depositNote').textContent = 'Fill in your bank details and upload screenshot.';
        }
    }

    // ============================================================
    // UPDATE BANK DROPDOWN
    // ============================================================
    function updateBankDropdown() {
        setupBankDropdown('dep_bank_select', 'dep_bank_list');
        setupBankDropdown('wd_bank_select', 'wd_bank_list');
    }

    // ============================================================
    // SETUP BANK DROPDOWN
    // ============================================================
    function setupBankDropdown(wrapperId, listId) {
        const wrapper = document.getElementById(wrapperId);
        if (!wrapper) return;

        let toggle = wrapper.querySelector('.custom-select__toggle');
        if (!toggle) return;

        const valueEl = toggle.querySelector('span:first-child');
        const hiddenInput = wrapper.querySelector('input[type="hidden"]');

        const oldList = document.getElementById(listId);
        if (oldList) oldList.remove();

        const list = document.createElement('div');
        list.className = 'custom-select__list';
        list.id = listId;
        list.style.display = 'none';
        list.style.position = 'fixed';
        document.body.appendChild(list);

        const banks = BANK_METHODS.length > 0 ? BANK_METHODS : [
            { id: 3, name: 'Meezan Bank' },
            { id: 4, name: 'Habib Bank Limited (HBL)' },
            { id: 5, name: 'Bank Alfalah' },
            { id: 6, name: 'United Bank Limited (UBL)' },
            { id: 7, name: 'MCB Bank' },
            { id: 8, name: 'National Bank of Pakistan' }
        ];

        list.innerHTML = '';
        banks.forEach(bank => {
            const opt = document.createElement('div');
            opt.className = 'custom-select__option';
            opt.textContent = bank.name;
            opt.dataset.bankId = bank.id;
            opt.addEventListener('click', function (e) {
                e.stopPropagation();
                valueEl.textContent = bank.name;
                hiddenInput.value = bank.name;
                list.querySelectorAll('.custom-select__option').forEach(o => o.classList.remove('selected'));
                this.classList.add('selected');
                // Remove error state if exists
                toggle.classList.remove('error');
                const errorId = wrapperId + '_error';
                const errorEl = document.getElementById(errorId);
                if (errorEl) errorEl.classList.remove('show');
                closeDropdown();
            });
            list.appendChild(opt);
        });

        let isOpen = false;

        function positionList() {
            const currentToggle = document.querySelector(`#${wrapperId} .custom-select__toggle`);
            if (!currentToggle) return;
            const rect = currentToggle.getBoundingClientRect();
            list.style.width = rect.width + 'px';
            list.style.left = rect.left + 'px';
            list.style.top = (rect.bottom + 4) + 'px';
            list.style.maxHeight = '260px';
            list.style.overflowY = 'auto';
            list.style.zIndex = '2147483000';
            list.style.display = 'flex';
            list.style.background = '#16273D';
            list.style.border = '1px solid rgba(34,211,238,0.3)';
            list.style.borderRadius = '10px';
            list.style.boxShadow = '0 20px 45px rgba(0,0,0,0.5)';
            list.style.padding = '6px';
        }

        function closeDropdown() {
            list.classList.remove('open');
            list.style.display = 'none';
            const currentToggle = document.querySelector(`#${wrapperId} .custom-select__toggle`);
            if (currentToggle) currentToggle.classList.remove('open');
            isOpen = false;
            window.removeEventListener('scroll', positionList, true);
            window.removeEventListener('resize', positionList);
            document.removeEventListener('click', handleOutsideClick);
        }

        function handleOutsideClick(e) {
            const currentToggle = document.querySelector(`#${wrapperId} .custom-select__toggle`);
            if (!list.contains(e.target) && currentToggle && !currentToggle.contains(e.target)) {
                closeDropdown();
            }
        }

        function openDropdown() {
            document.querySelectorAll('.custom-select__list.open').forEach(l => {
                l.classList.remove('open');
                l.style.display = 'none';
            });
            document.querySelectorAll('.custom-select__toggle.open').forEach(t => t.classList.remove('open'));

            const currentToggle = document.querySelector(`#${wrapperId} .custom-select__toggle`);
            if (!currentToggle) return;
            toggle = currentToggle;
            positionList();
            list.classList.add('open');
            list.style.display = 'flex';
            currentToggle.classList.add('open');
            isOpen = true;

            window.addEventListener('scroll', positionList, true);
            window.addEventListener('resize', positionList);
            setTimeout(() => document.addEventListener('click', handleOutsideClick), 50);
        }

        const newToggle = toggle.cloneNode(true);
        toggle.parentNode.replaceChild(newToggle, toggle);
        toggle = document.querySelector(`#${wrapperId} .custom-select__toggle`);

        toggle.addEventListener('click', function (e) {
            e.stopPropagation();
            e.preventDefault();
            isOpen ? closeDropdown() : openDropdown();
        });

        document.addEventListener('keydown', function (e) {
            if (e.key === 'Escape' && isOpen) closeDropdown();
        });
    }

    // ============================================================
    // FALLBACK METHODS
    // ============================================================
    function loadFallbackMethods() {
        const fallbackMethods = [
            { id: 1, name: 'EasyPaisa', type: 'mobile_wallet', account_holder_name: 'Ubaidullah', account_number: '03188893863', deep_link_scheme: 'easypaisa://' },
            { id: 2, name: 'JazzCash', type: 'mobile_wallet', account_holder_name: 'Muhammad Ahmed', account_number: '03098765432', deep_link_scheme: 'jazzcash://' },
            { id: 3, name: 'Meezan Bank', type: 'bank', account_holder_name: 'Muhammad Ahmed', account_number: '12345678901234', deep_link_scheme: '' },
            { id: 4, name: 'Habib Bank Limited (HBL)', type: 'bank', account_holder_name: 'Muhammad Ahmed', account_number: '98765432109876', deep_link_scheme: '' },
            { id: 5, name: 'Bank Alfalah', type: 'bank', account_holder_name: 'Muhammad Ahmed', account_number: '56789012345678', deep_link_scheme: '' },
            { id: 6, name: 'United Bank Limited (UBL)', type: 'bank', account_holder_name: 'Muhammad Ahmed', account_number: '34567890123456', deep_link_scheme: '' },
            { id: 7, name: 'MCB Bank', type: 'bank', account_holder_name: 'Muhammad Ahmed', account_number: '23456789012345', deep_link_scheme: '' },
            { id: 8, name: 'National Bank of Pakistan', type: 'bank', account_holder_name: 'Muhammad Ahmed', account_number: '45678901234567', deep_link_scheme: '' },
        ];

        BANK_METHODS = fallbackMethods.filter(m => m.type === 'bank');
        fallbackMethods.forEach(m => PAYMENT_METHODS[m.id] = m);

        renderMethodCards(fallbackMethods);
        updateBankDropdown();
        const firstCard = document.querySelector('.method-card');
        if (firstCard) firstCard.click();
    }

    // ============================================================
    // RENDER METHOD CARDS
    // ============================================================
    function renderMethodCards(methods) {
        const container = document.getElementById('depositMethodRow');
        container.innerHTML = '';

        const mobileWallets = methods.filter(m => m.type === 'mobile_wallet');
        const bankOption = methods.find(m => m.type === 'bank');

        mobileWallets.forEach(method => {
            const card = createMethodCard(method);
            container.appendChild(card);
        });

        if (bankOption) {
            const card = createMethodCard(bankOption);
            container.appendChild(card);
        }
    }

    function createMethodCard(method) {
        const card = document.createElement('div');
        card.className = 'method-card';
        card.dataset.methodId = method.id;
        card.dataset.method = method.name.toLowerCase();
        card.dataset.type = method.type;
        card.dataset.accountHolder = method.account_holder_name || '';
        card.dataset.accountNumber = method.account_number || '';
        card.dataset.deepLink = method.deep_link_scheme || '';

        let iconHtml = '';
        if (method.type === 'mobile_wallet') {
            const imgSrc = method.name.toLowerCase() === 'easypaisa' ? 'easypaisa.jpg' : 'jazzcash.png';
            iconHtml = `<div class="method-icon icon-logo"><img src="{{ asset('images/${imgSrc}') }}" alt="${method.name}"></div>`;
        } else {
            iconHtml = `<div class="method-icon icon-bank">🏦</div>`;
        }

        card.innerHTML = `${iconHtml}<span class="method-name">${method.name}</span>`;

        card.addEventListener('click', function () {
            selectPaymentMethod(this);
        });

        return card;
    }

    // ============================================================
    // SELECT PAYMENT METHOD
    // ============================================================
    function selectPaymentMethod(card) {
        document.querySelectorAll('#depositMethodRow .method-card').forEach(c => c.classList.remove('active'));
        card.classList.add('active');

        const methodId = parseInt(card.dataset.methodId);
        selectedMethodId = methodId;
        const methodType = card.dataset.type;

        document.getElementById('deposit_payment_method').value = card.dataset.method;
        document.getElementById('deposit_payment_method_id').value = methodId;

        showPaymentForm(methodType);

        if (methodType === 'mobile_wallet') {
            updatePaymentDetails(methodId);
        }
    }

    // ============================================================
    // UPDATE PAYMENT DETAILS
    // ============================================================
    function updatePaymentDetails(methodId) {
        const details = PAYMENT_METHODS[methodId];
        if (!details) return;

        document.getElementById('displayMethodName').textContent = details.name;
        document.getElementById('displayAccountHolder').textContent = details.account_holder_name || '-';
        document.getElementById('accountNumberText').textContent = details.account_number || '-';
    }

    // ============================================================
    // COPY FUNCTIONS
    // ============================================================
    function copyAccountNumber() {
        const number = document.getElementById('accountNumberText').textContent;
        if (number && number !== '-') {
            navigator.clipboard.writeText(number).then(() => {
                const btn = event.target;
                const originalText = btn.textContent;
                btn.textContent = '✅ Copied!';
                btn.style.background = 'rgba(34,211,238,0.3)';
                setTimeout(() => {
                    btn.textContent = originalText;
                    btn.style.background = '';
                }, 2000);
            }).catch(() => fallbackCopy(number));
        }
    }

    function fallbackCopy(number) {
        const input = document.createElement('input');
        input.value = number;
        document.body.appendChild(input);
        input.select();
        document.execCommand('copy');
        document.body.removeChild(input);
        showToast('Number copied to clipboard!', 'success', 'Copied');
    }

    // ============================================================
    // POPUP FUNCTIONS
    // ============================================================
    const overlay = document.getElementById('popupOverlay');

    function openPopup(type) {
        const isLoggedIn = document.querySelector('meta[name="user-id"]') !== null;
        if (!isLoggedIn) {
            window.location.href = '/login';
            return;
        }

        overlay.classList.add('active');
        document.getElementById(type + 'Popup').classList.add('active');
        document.body.style.overflow = 'hidden';

        if (type === 'deposit') {
            resetToStep1();
            loadPaymentMethods();
        } else if (type === 'withdraw') {
            document.getElementById('withdrawStep1').style.display = 'block';
            document.getElementById('withdrawForm').style.display = 'none';
            document.getElementById('withdrawMobileFields').classList.remove('show');
            document.getElementById('withdrawBankFields').classList.remove('open');
            document.getElementById('withdrawBankFields').style.display = 'none';
            document.getElementById('withdrawNote').textContent = 'Select a payment method to continue.';
            updateBankDropdown();
        }
    }

    function closePopup(type) {
        document.getElementById(type + 'Popup').classList.remove('active');
        closeAllBankDropdowns();
        const anyOpen = document.querySelector('.popup-panel.active');
        if (!anyOpen) {
            overlay.classList.remove('active');
            document.body.style.overflow = '';
        }
        resetToStep1();
    }

    function closePopupOnOverlay(e) {
        if (e.target === overlay) {
            document.querySelectorAll('.popup-panel.active').forEach(p => p.classList.remove('active'));
            closeAllBankDropdowns();
            overlay.classList.remove('active');
            document.body.style.overflow = '';
            resetToStep1();
        }
    }

    function closeAllBankDropdowns() {
        document.querySelectorAll('.custom-select__list.open').forEach(l => {
            l.classList.remove('open');
            l.style.display = 'none';
        });
        document.querySelectorAll('.custom-select__toggle.open').forEach(t => t.classList.remove('open'));
    }

    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape') {
            document.querySelectorAll('.popup-panel.active').forEach(p => p.classList.remove('active'));
            closeAllBankDropdowns();
            overlay.classList.remove('active');
            document.body.style.overflow = '';
            resetToStep1();
        }
    });

    // ============================================================
    // QUICK AMOUNT BUTTONS
    // ============================================================
    document.querySelectorAll('.quick-amount-btn').forEach(btn => {
        btn.addEventListener('click', function () {
            const parent = this.closest('.quick-amounts');
            parent.querySelectorAll('.quick-amount-btn').forEach(b => b.classList.remove('active'));
            this.classList.add('active');

            const formSection = this.closest('.mobile-wallet-fields, .bank-fields');
            if (formSection) {
                const amountInput = formSection.querySelector('input[name="amount"]');
                if (amountInput) {
                    amountInput.value = this.dataset.amount;
                    // Remove error state
                    amountInput.classList.remove('error');
                    amountInput.classList.add('success');
                    const errorId = amountInput.id + '_error';
                    const errorEl = document.getElementById(errorId);
                    if (errorEl) errorEl.classList.remove('show');
                }
            }
        });
    });

    // ============================================================
    // OPEN MOBILE CONFIRMATION POPUP
    // ============================================================
    function openMobileConfirmation() {
        const selectedCard = document.querySelector('#depositMethodRow .method-card.active');
        if (!selectedCard) {
            showToast('Please select a payment method first.', 'error', 'Selection Required');
            return;
        }

        const methodId = parseInt(selectedCard.dataset.methodId);
        const method = PAYMENT_METHODS[methodId];
        const amount = document.getElementById('deposit_amount_mobile').value;
        const accountName = document.getElementById('deposit_account_name').value;
        const userAccountNumber = document.getElementById('deposit_user_account_number').value;

        let isValid = true;

        // Validate Account Holder Name
        if (!accountName) {
            showFieldError('deposit_account_name', 'deposit_account_name_error');
            isValid = false;
        } else {
            hideFieldError('deposit_account_name', 'deposit_account_name_error');
        }

        // Validate Account Number
        if (!userAccountNumber || userAccountNumber.length < 11) {
            showFieldError('deposit_user_account_number', 'deposit_user_account_number_error');
            isValid = false;
        } else {
            hideFieldError('deposit_user_account_number', 'deposit_user_account_number_error');
        }

        // Validate Amount
        if (!amount || amount < 50) {
            showFieldError('deposit_amount_mobile', 'deposit_amount_mobile_error');
            isValid = false;
        } else {
            hideFieldError('deposit_amount_mobile', 'deposit_amount_mobile_error');
        }

        if (!isValid) {
            showToast('Please fix the highlighted fields.', 'error', 'Validation Error');
            return;
        }

        const txnId = 'TXN' + Date.now().toString().slice(-8) + Math.random().toString(36).substring(2, 6).toUpperCase();

        currentDepositData = {
            method_id: methodId,
            method_name: method.name,
            account_holder_name: accountName,
            user_account_number: userAccountNumber,
            amount: amount,
            account_number: method.account_number,
            account_holder: method.account_holder_name,
            deep_link: method.deep_link_scheme ? `${method.deep_link_scheme}sendmoney?phonenumber=${method.account_number}&amount=${amount}` : '',
            transaction_id: txnId
        };

        document.getElementById('confirmMethod').textContent = method.name;
        document.getElementById('confirmAccount').textContent = method.account_number || '-';
        document.getElementById('confirmAmount').textContent = `PKR ${parseInt(amount).toLocaleString()}`;
        document.getElementById('confirm_deposit_id').value = '';
        document.getElementById('confirm_transaction_input').value = '';

        const deepLinkAppBtn = document.getElementById('deepLinkAppBtn');
        const deepLinkWebBtn = document.getElementById('deepLinkWebBtn');

        if (currentDepositData.deep_link) {
            deepLinkAppBtn.style.display = 'block';
            deepLinkAppBtn.textContent = `📱 Open ${method.name} App`;
        } else {
            deepLinkAppBtn.style.display = 'none';
        }

        const webUrls = {
            'easypaisa': 'https://easypaisa.com.pk/',
            'jazzcash': 'https://jazzcash.com.pk/'
        };
        const methodNameLower = method.name.toLowerCase();
        const webUrl = webUrls[methodNameLower] || '#';
        deepLinkWebBtn.textContent = `🌐 Use ${method.name} Website`;
        deepLinkWebBtn.onclick = function () { openWebPayment(webUrl, method.name); };

        document.getElementById('confirmationPopup').style.display = 'block';
        document.body.style.overflow = 'hidden';
    }

    // ============================================================
    // CLOSE CONFIRMATION
    // ============================================================
    function closeConfirmation() {
        document.getElementById('confirmationPopup').style.display = 'none';
        document.body.style.overflow = '';
    }

    // ============================================================
    // OPEN DEEP LINK
    // ============================================================
    function openDeepLink() {
        if (currentDepositData && currentDepositData.deep_link) {
            showToast(`Opening ${currentDepositData.method_name} App...`, 'info', 'Opening App');
            window.open(currentDepositData.deep_link, '_blank');
        } else {
            showToast('Deep link not available. Please use the website option.', 'warning', 'Not Available');
        }
    }

    // ============================================================
    // OPEN WEB PAYMENT
    // ============================================================
    function openWebPayment(webUrl, appName) {
        if (webUrl && webUrl !== '#') {
            showToast(`Opening ${appName} Website...`, 'info', 'Opening Website');
            window.open(webUrl, '_blank');
        } else {
            showToast('Website not available. Please open the app manually.', 'warning', 'Not Available');
        }
    }

    // ============================================================
    // CONFIRMATION FORM SUBMISSION
    // ============================================================
    document.getElementById('confirmationForm').addEventListener('submit', async function (e) {
        e.preventDefault();
        const submitBtn = document.getElementById('confirmSubmitBtn');

        const receipt = document.getElementById('confirm_receipt').files[0];
        if (!receipt) {
            showFieldError('confirm_receipt', 'confirm_receipt_error');
            showToast('Please upload a payment screenshot.', 'error', 'Required');
            return;
        }
        hideFieldError('confirm_receipt', 'confirm_receipt_error');

        submitBtn.disabled = true;
        submitBtn.innerHTML = '<span class="loading-spinner"></span> Submitting...';
        submitBtn.classList.add('btn-loading');

        try {
            const formData = new FormData(this);
            formData.append('account_holder_name', currentDepositData.account_holder_name);
            formData.append('user_account_number', currentDepositData.user_account_number);
            formData.append('amount', currentDepositData.amount);
            formData.append('payment_method_id', currentDepositData.method_id);
            formData.append('transaction_id', currentDepositData.transaction_id);

            const response = await fetch('/api/deposit/store', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value,
                    'Accept': 'application/json',
                },
                body: formData
            });

            const data = await response.json();

            if (data.success) {
                closeConfirmation();
                closePopup('deposit');
                showToast('Payment submitted successfully! Please wait for admin approval.', 'success', 'Success');

                setTimeout(() => {
                    closeSuccessModal();
                    resetToStep1();
                    document.getElementById('depositForm').reset();
                    document.querySelectorAll('.method-card').forEach(c => c.classList.remove('active'));
                    document.getElementById('deposit_payment_method').value = '';
                    document.querySelectorAll('.quick-amount-btn').forEach(b => b.classList.remove('active'));
                    document.getElementById('depositBankFields').classList.remove('open');
                    document.getElementById('depositBankFields').style.display = 'none';
                    document.getElementById('depositMobileFields').classList.remove('show');
                    window.location.href = '/home';
                }, 4000);
            } else {
                if (data.errors) {
                    showToast(Object.values(data.errors).flat().join('\n'), 'error', 'Validation Error');
                } else {
                    showToast(data.message || 'Something went wrong.', 'error', 'Error');
                }
                submitBtn.disabled = false;
                submitBtn.innerHTML = '✅ Submit Payment';
                submitBtn.classList.remove('btn-loading');
            }
        } catch (error) {
            console.error('Error:', error);
            showToast('Network error. Please try again.', 'error', 'Connection Error');
            submitBtn.disabled = false;
            submitBtn.innerHTML = '✅ Submit Payment';
            submitBtn.classList.remove('btn-loading');
        }
    });

    // ============================================================
    // BANK SUBMIT HANDLER - WITH VALIDATION
    // ============================================================
    async function handleBankSubmit(e) {
        e.preventDefault();

        const submitBtn = document.getElementById('bankSubmitBtn');

        // Get all form values
        const accountHolderName = document.getElementById('deposit_account_name_bank').value;
        const amount = document.getElementById('deposit_amount_bank').value;
        const bankNameInput = document.querySelector('#dep_bank_select input[type="hidden"]');
        const bankName = bankNameInput ? bankNameInput.value : '';
        const accountHolder = document.querySelector('input[name="account_number_holder"]').value;
        const accountNumber = document.querySelector('input[name="account_number"]').value;
        const transactionId = document.getElementById('deposit_transaction_id_bank').value;
        const screenshot = document.querySelector('input[name="screenshot"]').files[0];

        let isValid = true;

        // Validate Account Holder Name
        if (!accountHolderName) {
            showFieldError('deposit_account_name_bank', 'deposit_account_name_bank_error');
            isValid = false;
        } else {
            hideFieldError('deposit_account_name_bank', 'deposit_account_name_bank_error');
        }

        // Validate Amount
        if (!amount || amount < 50) {
            showFieldError('deposit_amount_bank', 'deposit_amount_bank_error');
            isValid = false;
        } else {
            hideFieldError('deposit_amount_bank', 'deposit_amount_bank_error');
        }

        // Validate Bank
        if (!bankName) {
            const toggle = document.querySelector('#dep_bank_select .custom-select__toggle');
            if (toggle) toggle.classList.add('error');
            const errorEl = document.getElementById('dep_bank_select_error');
            if (errorEl) errorEl.classList.add('show');
            isValid = false;
        } else {
            const toggle = document.querySelector('#dep_bank_select .custom-select__toggle');
            if (toggle) toggle.classList.remove('error');
            const errorEl = document.getElementById('dep_bank_select_error');
            if (errorEl) errorEl.classList.remove('show');
        }

        // Validate Account Holder
        if (!accountHolder) {
            showFieldError('account_number_holder', 'account_number_holder_error');
            isValid = false;
        } else {
            hideFieldError('account_number_holder', 'account_number_holder_error');
        }

        // Validate Account Number
        if (!accountNumber) {
            showFieldError('account_number', 'account_number_error');
            isValid = false;
        } else {
            hideFieldError('account_number', 'account_number_error');
        }

        // Validate Transaction ID
        if (!transactionId) {
            showFieldError('deposit_transaction_id_bank', 'deposit_transaction_id_bank_error');
            isValid = false;
        } else {
            hideFieldError('deposit_transaction_id_bank', 'deposit_transaction_id_bank_error');
        }

        // Validate Screenshot
        if (!screenshot) {
            showFieldError('screenshot', 'screenshot_error');
            isValid = false;
        } else {
            hideFieldError('screenshot', 'screenshot_error');
        }

        if (!isValid) {
            showToast('Please fix the highlighted fields.', 'error', 'Validation Error');
            return;
        }

        submitBtn.disabled = true;
        submitBtn.innerHTML = '<span class="loading-spinner"></span> Submitting...';
        submitBtn.classList.add('btn-loading');

        const form = document.getElementById('depositForm');
        const formData = new FormData(form);
        formData.set('account_holder_name', accountHolderName);
        formData.set('amount', amount);
        formData.set('bank_name', bankName);
        formData.set('account_number_holder', accountHolder);
        formData.set('account_number', accountNumber);
        formData.set('transaction_id', transactionId);

        const selectedCard = document.querySelector('#depositMethodRow .method-card.active');
        if (!selectedCard) {
            showToast('Please select a payment method.', 'error', 'Selection Required');
            submitBtn.disabled = false;
            submitBtn.innerHTML = '🏦 Submit Bank Transfer';
            submitBtn.classList.remove('btn-loading');
            return;
        }

        const methodId = parseInt(selectedCard.dataset.methodId);
        formData.append('payment_method_id', methodId);

        try {
            const response = await fetch('/api/deposit/store', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value,
                    'Accept': 'application/json',
                },
                body: formData
            });

            const data = await response.json();

            if (data.success) {
                showToast('Bank transfer submitted! Please wait for admin verification.', 'success', 'Success');

                setTimeout(() => {
                    closePopup('deposit');
                    closeSuccessModal();
                    form.reset();
                    document.querySelectorAll('.method-card').forEach(c => c.classList.remove('active'));
                    document.getElementById('deposit_payment_method').value = '';
                    document.querySelectorAll('.quick-amount-btn').forEach(b => b.classList.remove('active'));
                    document.getElementById('depositBankFields').classList.remove('open');
                    document.getElementById('depositBankFields').style.display = 'none';
                    document.getElementById('depositMobileFields').classList.remove('show');
                    resetToStep1();
                    window.location.href = '/home';
                }, 4000);
            } else {
                if (data.errors) {
                    showToast(Object.values(data.errors).flat().join('\n'), 'error', 'Validation Error');
                } else {
                    showToast(data.message || 'Something went wrong.', 'error', 'Error');
                }
            }
        } catch (error) {
            console.error('Error:', error);
            showToast('Network error. Please try again.', 'error', 'Connection Error');
        } finally {
            submitBtn.disabled = false;
            submitBtn.innerHTML = '🏦 Submit Bank Transfer';
            submitBtn.classList.remove('btn-loading');
        }
    }

    // ============================================================
    // BANK FORM SUBMISSION - EVENT LISTENER
    // ============================================================
    document.addEventListener('DOMContentLoaded', function () {
        const bankBtn = document.getElementById('bankSubmitBtn');
        if (bankBtn) {
            bankBtn.onclick = null;
            bankBtn.removeEventListener('click', handleBankSubmit);
            bankBtn.addEventListener('click', handleBankSubmit);
        }
    });

    document.getElementById('depositForm').addEventListener('submit', function (e) {
        const selectedCard = document.querySelector('#depositMethodRow .method-card.active');
        if (selectedCard && selectedCard.dataset.type === 'bank') {
            e.preventDefault();
            document.getElementById('bankSubmitBtn').click();
        }
    });

    // ============================================================
    // SUCCESS MODAL
    // ============================================================
    function showSuccess(message) {
        document.getElementById('successMessage').textContent = message;
        document.getElementById('successModal').style.display = 'flex';
    }

    function closeSuccessModal() {
        document.getElementById('successModal').style.display = 'none';
    }

    // ============================================================
    // WITHDRAWAL FUNCTIONS
    // ============================================================

    document.querySelectorAll('#withdrawMethodRow .method-card').forEach(card => {
        card.addEventListener('click', function () {
            document.querySelectorAll('#withdrawMethodRow .method-card').forEach(c => c.classList.remove('active'));
            this.classList.add('active');

            const methodType = this.dataset.type;
            const methodId = this.dataset.methodId;
            const methodName = this.dataset.method;

            document.getElementById('withdraw_payment_method').value = methodName;
            document.getElementById('withdraw_payment_method_id').value = methodId;

            document.getElementById('withdrawStep1').style.display = 'none';
            document.getElementById('withdrawForm').style.display = 'block';

            if (methodType === 'mobile_wallet') {
                document.getElementById('withdrawMobileFields').classList.add('show');
                document.getElementById('withdrawBankFields').style.display = 'none';
                document.getElementById('withdrawBankFields').classList.remove('open');
                document.getElementById('withdrawNote').textContent = 'Fill in your mobile wallet details.';
            } else if (methodType === 'bank') {
                document.getElementById('withdrawMobileFields').classList.remove('show');
                document.getElementById('withdrawBankFields').style.display = 'block';
                document.getElementById('withdrawBankFields').classList.add('open');
                document.getElementById('withdrawNote').textContent = 'Fill in your bank account details.';
            }
        });
    });

    // ============================================================
    // WITHDRAW FORM SUBMISSION - WITH VALIDATION
    // ============================================================
    document.getElementById('withdrawForm').addEventListener('submit', function (e) {
        e.preventDefault();
        e.stopPropagation();

        const selectedCard = document.querySelector('#withdrawMethodRow .method-card.active');
        if (!selectedCard) {
            showToast('Please select a payment method.', 'error', 'Selection Required');
            return;
        }

        const methodType = selectedCard.dataset.type;
        const paymentMethodId = document.getElementById('withdraw_payment_method_id').value;

        let submitBtn;
        let accountHolderName, accountNumber, amount, bankName, iban, cardNumber, branchCode;
        let formData;
        let isValid = true;

        if (methodType === 'mobile_wallet') {
            submitBtn = document.getElementById('withdrawSubmitBtn');
            accountHolderName = document.getElementById('withdraw_account_name').value;
            accountNumber = document.getElementById('withdraw_account_number').value;
            amount = document.getElementById('withdraw_amount').value;

            // Validate
            if (!accountHolderName) {
                showFieldError('withdraw_account_name', 'withdraw_account_name_error');
                isValid = false;
            } else {
                hideFieldError('withdraw_account_name', 'withdraw_account_name_error');
            }

            if (!accountNumber || accountNumber.length < 11) {
                showFieldError('withdraw_account_number', 'withdraw_account_number_error');
                isValid = false;
            } else {
                hideFieldError('withdraw_account_number', 'withdraw_account_number_error');
            }

            if (!amount || amount < 100) {
                showFieldError('withdraw_amount', 'withdraw_amount_error');
                isValid = false;
            } else {
                hideFieldError('withdraw_amount', 'withdraw_amount_error');
            }

            if (!isValid) {
                showToast('Please fix the highlighted fields.', 'error', 'Validation Error');
                return;
            }

            formData = new FormData();
            formData.append('payment_method_id', paymentMethodId);
            formData.append('account_holder_name', accountHolderName);
            formData.append('account_number', accountNumber);
            formData.append('amount', amount);

        } else if (methodType === 'bank') {
            submitBtn = document.getElementById('withdrawBankSubmitBtn');
            accountHolderName = document.getElementById('withdraw_bank_account_name').value;
            const bankNameInput = document.querySelector('#wd_bank_select input[type="hidden"]');
            bankName = bankNameInput ? bankNameInput.value : '';
            iban = document.getElementById('withdraw_iban').value;
            cardNumber = document.getElementById('withdraw_card').value;
            branchCode = document.querySelector('input[name="branch_code"]')?.value || '';
            amount = document.getElementById('withdraw_bank_amount').value;

            // Validate
            if (!accountHolderName) {
                showFieldError('withdraw_bank_account_name', 'withdraw_bank_account_name_error');
                isValid = false;
            } else {
                hideFieldError('withdraw_bank_account_name', 'withdraw_bank_account_name_error');
            }

            if (!bankName) {
                const toggle = document.querySelector('#wd_bank_select .custom-select__toggle');
                if (toggle) toggle.classList.add('error');
                const errorEl = document.getElementById('wd_bank_select_error');
                if (errorEl) errorEl.classList.add('show');
                isValid = false;
            } else {
                const toggle = document.querySelector('#wd_bank_select .custom-select__toggle');
                if (toggle) toggle.classList.remove('error');
                const errorEl = document.getElementById('wd_bank_select_error');
                if (errorEl) errorEl.classList.remove('show');
            }

            if (!iban) {
                showFieldError('withdraw_iban', 'withdraw_iban_error');
                isValid = false;
            } else {
                hideFieldError('withdraw_iban', 'withdraw_iban_error');
            }

            if (!amount || amount < 100) {
                showFieldError('withdraw_bank_amount', 'withdraw_bank_amount_error');
                isValid = false;
            } else {
                hideFieldError('withdraw_bank_amount', 'withdraw_bank_amount_error');
            }

            if (!isValid) {
                showToast('Please fix the highlighted fields.', 'error', 'Validation Error');
                return;
            }

            formData = new FormData();
            formData.append('payment_method_id', paymentMethodId);
            formData.append('account_holder_name', accountHolderName);
            formData.append('bank_name', bankName);
            formData.append('iban_number', iban);
            formData.append('amount', amount);
            if (cardNumber) formData.append('card_number', cardNumber);
            if (branchCode) formData.append('branch_code', branchCode);
        }

        submitBtn.disabled = true;
        submitBtn.innerHTML = '<span class="loading-spinner"></span> Processing...';
        submitBtn.classList.add('btn-loading');

        const csrfToken = document.querySelector('input[name="_token"]')?.value ||
            document.querySelector('meta[name="csrf-token"]')?.content;

        fetch('/api/withdrawal/store', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': csrfToken,
                'Accept': 'application/json',
                'X-Requested-With': 'XMLHttpRequest',
            },
            credentials: 'include',
            body: formData
        })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    showToast(data.message, 'success', 'Success');

                    setTimeout(() => {
                        closePopup('withdraw');
                        closeSuccessModal();
                        document.getElementById('withdrawForm').reset();
                        document.querySelectorAll('#withdrawMethodRow .method-card').forEach(c => c.classList.remove('active'));
                        document.getElementById('withdrawMobileFields').classList.remove('show');
                        document.getElementById('withdrawBankFields').classList.remove('open');
                        document.getElementById('withdrawBankFields').style.display = 'none';
                        document.getElementById('withdrawStep1').style.display = 'block';
                        document.getElementById('withdrawForm').style.display = 'none';
                        document.getElementById('withdrawNote').textContent = 'Select a payment method to continue.';
                        window.location.href = '/home';
                    }, 3000);
                } else {
                    if (data.errors) {
                        showToast(Object.values(data.errors).flat().join('\n'), 'error', 'Validation Error');
                    } else {
                        showToast(data.message || 'Something went wrong.', 'error', 'Error');
                    }
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showToast('Network error. Please try again.', 'error', 'Connection Error');
            })
            .finally(() => {
                submitBtn.disabled = false;
                submitBtn.innerHTML = '💰 Request Withdrawal';
                submitBtn.classList.remove('btn-loading');
            });
    });

    // ============================================================
    // Withdraw button click handlers
    // ============================================================
    document.getElementById('withdrawSubmitBtn').addEventListener('click', function (e) {
        document.getElementById('withdrawForm').dispatchEvent(new Event('submit'));
    });

    document.getElementById('withdrawBankSubmitBtn').addEventListener('click', function (e) {
        document.getElementById('withdrawForm').dispatchEvent(new Event('submit'));
    });

    // ============================================================
    // Quick amount buttons for withdraw
    // ============================================================
    document.querySelectorAll('#withdrawForm .quick-amount-btn').forEach(btn => {
        btn.addEventListener('click', function () {
            const parent = this.closest('.quick-amounts');
            parent.querySelectorAll('.quick-amount-btn').forEach(b => b.classList.remove('active'));
            this.classList.add('active');

            const formSection = this.closest('.mobile-wallet-fields, .bank-fields');
            if (formSection) {
                const amountInput = formSection.querySelector('input[name="amount"]');
                if (amountInput) {
                    amountInput.value = this.dataset.amount;
                    amountInput.classList.remove('error');
                    amountInput.classList.add('success');
                    const errorId = amountInput.id + '_error';
                    const errorEl = document.getElementById(errorId);
                    if (errorEl) errorEl.classList.remove('show');
                }
            }
        });
    });
</script>