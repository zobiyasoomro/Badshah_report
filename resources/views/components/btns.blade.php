
    <style>
        /* Block Component: Direct UI Action Section */
        .cta-section {
            background: linear-gradient(135deg, #0F172A 0%, #1E2937 100%);
            min-height: 280px;
            position: relative;
            overflow: hidden;
            display: flex;
            align-items: center;
            border-top: 6px solid #22D3EE;     
            border-bottom: 6px solid #22D3EE;  
        }
        
        /* Decorative Background Elements - Subse piche layer (z-index: 1) */
        .cta-section::before {
            content: '';
            position: absolute;
            top: 15%;
            right: 10%;
            width: 160px;
            height: 160px;
            background: rgba(34, 211, 238, 0.08);
            border: 2px solid rgba(34, 211, 238, 0.2);
            border-radius: 16px;
            transform: rotate(15deg);
            z-index: 1; /* Piche rakhne ke liye */
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
            z-index: 1; /* Piche rakhne ke liye */
        }
        
        /* Elements content wrapper ko hamesha upar lane ke liye */
        .cta-section__content {
            position: relative;
            z-index: 2; /* Yeh buttons aur text ko background shapes ke upar layega */
        }
        
        /* Element: Heading Content */
        .cta-section__heading {
            font-size: 2.05rem;
            font-weight: 700;
            line-height: 1.1;
            color: #F1F5F9;
        }
        
        /* Element: Action Button Base Class */
        .cta-section__btn {
            color: #ffffff;
            border: none;
            padding: 14px 34px;
            font-weight: 600;
            font-size: 1.1rem;
            border-radius: 50px;
            transition: all 0.3s ease-in-out;
        }

        .cta-section__btn:hover {
            transform: translateY(-4px);
            color: #ffffff;
        }
        
        /* Modifier: Deposit Button Specific Styles */
        .cta-section__btn--deposit {
            background: #22C55E;
            box-shadow: 0 10px 25px rgba(34, 197, 94, 0.4);
        }
        
        .cta-section__btn--deposit:hover {
            background: #16A34A;
        }
        
        /* Modifier: Withdraw Button Specific Styles */
        .cta-section__btn--withdraw {
            background: #EF4444;
            box-shadow: 0 10px 25px rgba(239, 68, 68, 0.4);
        }
        
        .cta-section__btn--withdraw:hover {
            background: #DC2626;
        }
        
        /* Element: Button Icon Alignment */
        .cta-section__btn-icon { 
            font-size: 1.45rem; 
            margin-left: 8px; 
        }
    </style>


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
                        
                        <button onclick="alert('Deposit clicked!')" class="cta-section__btn cta-section__btn--deposit d-flex align-items-center">
                            DEPOSIT <span class="cta-section__btn-icon">↑</span>
                        </button>
                        
                        <button onclick="alert('Withdraw clicked!')" class="cta-section__btn cta-section__btn--withdraw d-flex align-items-center">
                            WITHDRAW <span class="cta-section__btn-icon">↓</span>
                        </button>
                        
                    </div>
                </div>

            </div>
        </div>
    </section>

