{{-- resources/views/components/receipt-modal.blade.php --}}
<style>
    .receipt-overlay {
        position: fixed;
        inset: 0;
        background: rgba(0, 0, 0, 0.85);
        z-index: 9999999;
        display: none;
        align-items: center;
        justify-content: center;
        padding: 20px;
        animation: fadeIn 0.3s ease;
    }
    
    .receipt-overlay.active {
        display: flex;
    }
    
    .receipt-modal {
        background: linear-gradient(160deg, #23395B 0%, #16273D 100%);
        border: 2px solid #22D3EE;
        border-radius: 20px;
        padding: 40px;
        max-width: 500px;
        width: 100%;
        max-height: 90vh;
        overflow-y: auto;
        animation: slideUp 0.3s ease;
        position: relative;
    }
    
    .receipt-modal .close-btn {
        position: absolute;
        top: 15px;
        right: 15px;
        background: rgba(255,255,255,0.1);
        border: 1px solid rgba(255,255,255,0.2);
        color: #F1F5F9;
        width: 34px;
        height: 34px;
        border-radius: 50%;
        cursor: pointer;
        font-size: 1.2rem;
        transition: all 0.2s;
    }
    
    .receipt-modal .close-btn:hover {
        background: rgba(239, 68, 68, 0.7);
        transform: rotate(90deg);
    }
    
    .receipt-modal .icon {
        font-size: 50px;
        text-align: center;
        margin-bottom: 15px;
    }
    
    .receipt-modal h2 {
        color: #22D3EE;
        text-align: center;
        margin-bottom: 10px;
    }
    
    .receipt-modal .subtitle {
        color: #9FB3C8;
        text-align: center;
        font-size: 0.9rem;
        margin-bottom: 20px;
    }
    
    .receipt-modal .info-box {
        background: rgba(255,255,255,0.05);
        border-radius: 10px;
        padding: 15px;
        margin-bottom: 15px;
    }
    
    .receipt-modal .info-box .label {
        color: #7C8DA3;
        font-size: 0.7rem;
        text-transform: uppercase;
    }
    
    .receipt-modal .info-box .value {
        color: #F1F5F9;
        font-size: 1rem;
        font-weight: 600;
        margin-top: 2px;
    }
    
    .receipt-modal .info-box .value.highlight {
        color: #22D3EE;
        font-size: 1.3rem;
    }
    
    .receipt-modal .timer {
        text-align: center;
        padding: 10px;
        background: rgba(239, 68, 68, 0.1);
        border-radius: 8px;
        border: 1px solid rgba(239, 68, 68, 0.2);
        margin-bottom: 20px;
    }
    
    .receipt-modal .timer .time {
        color: #ef5555;
        font-size: 1.5rem;
        font-weight: 700;
    }
    
    .receipt-modal .file-upload {
        border: 2px dashed rgba(34,211,238,0.3);
        border-radius: 10px;
        padding: 30px;
        text-align: center;
        cursor: pointer;
        transition: all 0.2s;
        margin-bottom: 15px;
    }
    
    .receipt-modal .file-upload:hover {
        border-color: #22D3EE;
        background: rgba(34,211,238,0.05);
    }
    
    .receipt-modal .file-upload .upload-icon {
        font-size: 40px;
        color: #22D3EE;
    }
    
    .receipt-modal .file-upload .upload-text {
        color: #9FB3C8;
        margin-top: 10px;
    }
    
    .receipt-modal .file-upload .file-name {
        color: #22D3EE;
        font-weight: 600;
        margin-top: 5px;
    }
    
    .receipt-modal .file-upload input[type="file"] {
        display: none;
    }
    
    .receipt-modal .btn-submit {
        width: 100%;
        padding: 14px;
        border: none;
        border-radius: 50px;
        background: #22D3EE;
        color: #0f1c2e;
        font-weight: 700;
        font-size: 1rem;
        cursor: pointer;
        transition: all 0.2s;
    }
    
    .receipt-modal .btn-submit:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(34,211,238,0.3);
    }
    
    .receipt-modal .btn-submit:disabled {
        opacity: 0.5;
        cursor: not-allowed;
        transform: none;
    }
    
    .receipt-modal .skip-link {
        display: block;
        text-align: center;
        margin-top: 15px;
        color: #7C8DA3;
        font-size: 0.8rem;
        cursor: pointer;
        transition: all 0.2s;
    }
    
    .receipt-modal .skip-link:hover {
        color: #F1F5F9;
    }
    
    @keyframes fadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
    }
    
    @keyframes slideUp {
        from { transform: translateY(30px); opacity: 0; }
        to { transform: translateY(0); opacity: 1; }
    }
</style>

<div class="receipt-overlay" id="receiptOverlay">
    <div class="receipt-modal">
        <button class="close-btn" onclick="closeReceiptModal()">✕</button>
        
        <div class="icon">📄</div>
        <h2>Upload Payment Receipt</h2>
        <p class="subtitle">Please upload your payment receipt/confirmation to verify your transaction</p>
        
        <div class="info-box">
            <div class="label">Amount</div>
            <div class="value highlight" id="receiptAmount">PKR 0</div>
        </div>
        
        <div class="info-box">
            <div class="label">Payment Method</div>
            <div class="value" id="receiptMethod">-</div>
        </div>
        
        <div class="info-box">
            <div class="label">Transaction ID</div>
            <div class="value" id="receiptTransactionId">-</div>
        </div>
        
        <div class="timer" id="timerBox">
            <div>⏳ Time Remaining:</div>
            <div class="time" id="countdownTimer">23:59:59</div>
        </div>
        
        <form id="receiptForm" enctype="multipart/form-data">
            @csrf
            <div class="file-upload" onclick="document.getElementById('receiptFile').click()">
                <div class="upload-icon">📤</div>
                <div class="upload-text">Click to upload receipt</div>
                <div class="file-name" id="fileName"></div>
                <input type="file" id="receiptFile" name="receipt" accept="image/*,.pdf" required>
            </div>
            
            <button type="submit" class="btn-submit" id="submitReceiptBtn">
                ✅ Submit Receipt
            </button>
            
            <span class="skip-link" onclick="skipReceipt()">⏭️ Skip for now (I'll upload later)</span>
        </form>
    </div>
</div>

<script>
    let receiptDepositId = null;
    let countdownInterval = null;
    let remainingSeconds = 0;
    let receiptFormData = new FormData();

    // Check for pending receipt on page load
    document.addEventListener('DOMContentLoaded', function() {
        checkPendingReceipt();
    });

    // Check if user needs to upload receipt
    async function checkPendingReceipt() {
        try {
            const response = await fetch('/deposit/check-receipt');
            const data = await response.json();

            if (data.requires_receipt) {
                receiptDepositId = data.deposit.id;
                showReceiptModal(data);
                startCountdown(data.remaining_time);
            }
        } catch (error) {
            console.error('Error checking receipt:', error);
        }
    }

    // Show receipt modal
    function showReceiptModal(data) {
        const deposit = data.deposit;
        
        document.getElementById('receiptAmount').textContent = `PKR ${parseInt(deposit.amount).toLocaleString()}`;
        document.getElementById('receiptMethod').textContent = deposit.bank_name || deposit.payment_method;
        document.getElementById('receiptTransactionId').textContent = deposit.transaction_id;
        
        document.getElementById('receiptOverlay').classList.add('active');
        document.body.style.overflow = 'hidden';
    }

    // Start countdown timer
    function startCountdown(minutes) {
        if (!minutes) {
            document.getElementById('timerBox').style.display = 'none';
            return;
        }
        
        remainingSeconds = minutes * 60;
        updateTimerDisplay();
        
        if (countdownInterval) {
            clearInterval(countdownInterval);
        }
        
        countdownInterval = setInterval(() => {
            remainingSeconds--;
            updateTimerDisplay();
            
            if (remainingSeconds <= 0) {
                clearInterval(countdownInterval);
                document.getElementById('timerBox').style.display = 'none';
                alert('⏰ Your deposit request has expired. Please create a new deposit.');
                closeReceiptModal();
                window.location.reload();
            }
        }, 1000);
    }

    // Update timer display
    function updateTimerDisplay() {
        const hours = Math.floor(remainingSeconds / 3600);
        const minutes = Math.floor((remainingSeconds % 3600) / 60);
        const seconds = remainingSeconds % 60;
        
        document.getElementById('countdownTimer').textContent = 
            `${String(hours).padStart(2, '0')}:${String(minutes).padStart(2, '0')}:${String(seconds).padStart(2, '0')}`;
    }

    // Close receipt modal
    function closeReceiptModal() {
        document.getElementById('receiptOverlay').classList.remove('active');
        document.body.style.overflow = '';
        
        if (countdownInterval) {
            clearInterval(countdownInterval);
        }
    }

    // Handle file selection
    document.getElementById('receiptFile').addEventListener('change', function() {
        const file = this.files[0];
        if (file) {
            document.getElementById('fileName').textContent = `📎 ${file.name}`;
            receiptFormData = new FormData();
            receiptFormData.append('receipt', file);
        }
    });

    // Handle receipt form submission
    document.getElementById('receiptForm').addEventListener('submit', async function(e) {
        e.preventDefault();
        
        const file = document.getElementById('receiptFile').files[0];
        if (!file) {
            alert('❌ Please select a receipt file to upload.');
            return;
        }

        const submitBtn = document.getElementById('submitReceiptBtn');
        submitBtn.disabled = true;
        submitBtn.textContent = 'Uploading...';

        try {
            const formData = new FormData();
            formData.append('receipt', file);

            const response = await fetch(`/deposit/${receiptDepositId}/submit-receipt`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value,
                    'Accept': 'application/json',
                },
                body: formData
            });

            const data = await response.json();

            if (data.success) {
                alert('✅ Receipt submitted successfully! Please wait for admin verification.');
                closeReceiptModal();
                window.location.reload();
            } else {
                alert('❌ ' + (data.message || 'Something went wrong.'));
            }
        } catch (error) {
            console.error('Error:', error);
            alert('❌ Network error. Please try again.');
        } finally {
            submitBtn.disabled = false;
            submitBtn.textContent = '✅ Submit Receipt';
        }
    });

    // Skip receipt (user can upload later)
    function skipReceipt() {
        if (confirm('⚠️ Are you sure you want to skip uploading the receipt?\n\nYou can upload it later from your dashboard.')) {
            closeReceiptModal();
            // Mark that user saw the modal
            localStorage.setItem('receipt_skipped_' + receiptDepositId, 'true');
        }
    }

    // Check if user has a pending deposit on page load (for logged-in users)
    // This function is also called from the main layout
    window.checkPendingReceipt = checkPendingReceipt;
</script>