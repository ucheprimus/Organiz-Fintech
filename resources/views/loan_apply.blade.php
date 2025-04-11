@extends('layouts.dashboard')

@section('content')

 <!-- Page header -->
 <div class="cm65h c02a0 c8clx c53qs">

    <!-- Left: Title -->
    <div class="ctf03 cnexa">
        <h1 class="text-slate-800 dark:text-slate-100 font-bold coif1 cm58s">Apply for Loans ✨</h1>
    </div>

    <!-- Right: Actions -->
    <div class="cj639 cto5n cv1y9 ckl2g c1dgv cbze2">



    </div>

</div>

    <div>

        
        @if (session('success'))
        <div id="successContainer" class="d-flex justify-content-center align-items-center"
            style="position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%); background-color: rgba(255, 255, 255, 0.95); z-index: 1000; width: 100%; height: 100%; display: flex; justify-content: center; align-items: center;">
            
            <div style="background: white; padding: 2rem; border-radius: 20px; text-align: center;
                        max-width: 500px; width: 90%; box-shadow: 0 0 20px rgba(0,0,0,0.1); position: relative;">
                <div style="font-size: 2rem; color: green;">
                    ✅
                </div>
                <h2 style="margin-top: 1rem; font-weight: 700; font-size: 1.8rem;">Success!</h2>
                <p style="margin-top: 0.5rem; color: #333;">
                    {{ session('success') }}
                </p>
                <a href="{{ url()->previous() }}" class="btn btn-dark mt-3">Back</a>
            </div>
        </div>
    
        {{-- Confetti --}}
        <script src="https://cdn.jsdelivr.net/npm/canvas-confetti@1.6.0/dist/confetti.browser.min.js"></script>
        <script>
            const duration = 2 * 1000;
            const animationEnd = Date.now() + duration;
            const defaults = { startVelocity: 30, spread: 360, ticks: 60, zIndex: 2000 };
    
            function randomInRange(min, max) {
                return Math.random() * (max - min) + min;
            }
    
            const interval = setInterval(function () {
                const timeLeft = animationEnd - Date.now();
                if (timeLeft <= 0) {
                    clearInterval(interval);
                }
    
                const particleCount = 50 * (timeLeft / duration);
                confetti(Object.assign({}, defaults, {
                    particleCount,
                    origin: {
                        x: randomInRange(0.1, 0.9),
                        y: Math.random() - 0.2
                    }
                }));
            }, 250);
    
            // Auto-close the message after 4 seconds
            setTimeout(() => {
                const container = document.getElementById('successContainer');
                if (container) container.style.display = 'none';
            }, 4000);
        </script>
    @endif
    

        <form action="{{ route('loan_apply') }}" method="POST">
            @csrf

            <div class="input-row">
                <div class="input-container">
                    <select name="loan_type" id="loanType" class="input-field">
                        <option value="" disabled selected>-- Select Loan --</option>
                        @foreach ($loanTypes as $type)
                            <option value="{{ $type->id }}" data-interest="{{ $type->interest_rate }}">
                                {{ $type->loan_name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="input-container">
                    <input id="loanAmount" name="loan_amount" placeholder="Enter loan amount" required class="input-field"
                        type="number">
                </div>
            </div>

            <div class="input-row">
                <div class="input-container">
                    <input id="interestRate" name="interest_rate" value="{{ old('interestRate', $interestRate) }}"
                        placeholder="Interest rate" required readonly class="input-field" type="number">
                </div>

                <div class="input-container">
                    <input type="number" class="input-field" placeholder="How long will it take to pay in months / weeks"
                        id="loanDuration" name="loan_duration" required>
                </div>
            </div>

            <div class="input-row">
                <div class="input-container">
                    <select class="input-field" id="repaymentFrequency" name="repayment_frequency">
                        <option value="" disabled selected>-- Select Loan Frequency --</option>
                        <option value="Weekly">Weekly</option>
                        <option value="Monthly">Monthly</option>
                        <option value="Twice_a_month">Twice a month</option>
                        <option value="Quarterly">Quarterly</option>
                        <option value="Annually">Annually</option>
                    </select>
                </div>

                <div class="input-container">
                    <input type="number" class="input-field" id="totalExpectedAmount" name="total_expected_amount"
                        placeholder="Total Expected Amount" readonly>
                </div>
            </div>

            <div class="input-row">
                <div class="input-container">
                    <input type="number" class="input-field" id="paymentAmount" name="payment_amount"
                        placeholder="Amount per payment" readonly>
                </div>

                <div class="input-container">
                    <div class="tooltip-container">
                        <input type="date" class="input-field" id="loanStartDate" name="loan_start_date" required>
                        <span class="tooltip-text">Select the payment start date for the loan.</span>
                    </div>
                </div>
            </div>

            <div class="input-row">
                <div class="input-container">
                    <div class="tooltip-container">
                        <input type="date" class="input-field" id="loanEndDate" name="loan_end_date" required readonly>
                        <span class="tooltip-text">The calculated loan end date.</span>
                    </div>
                </div>

                <div class="input-container">
                    <input type="text" class="input-field" name="collateral" placeholder="Collateral (optional)">
                </div>
            </div>

            <!-- Full-width blue submit button -->
            <div style="padding: 0 10px; margin-top: 20px;">
                <button type="submit"
                    style="width: 100%; background-color: #007bff; color: white; padding: 12px; border: none; border-radius: 5px;">
                    Apply for Loan
                </button>
            </div>
        </form>


        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const loanAmountInput = document.getElementById('loanAmount');
                const interestRateInput = document.getElementById('interestRate');
                const loanDurationInput = document.getElementById('loanDuration');
                const repaymentFrequencyInput = document.getElementById('repaymentFrequency');
                const totalExpectedAmountInput = document.getElementById('totalExpectedAmount');
                const paymentAmountInput = document.getElementById('paymentAmount');
                const loanStartDateInput = document.getElementById('loanStartDate');
                const loanEndDateInput = document.getElementById('loanEndDate');
                const loanTypeSelect = document.getElementById('loanType');

                // Update interest rate when loan type is selected
                loanTypeSelect.addEventListener('change', function() {
                    const selectedOption = this.options[this.selectedIndex];
                    const interestRate = selectedOption.dataset.interest || 0;
                    interestRateInput.value = interestRate;
                    calculateLoanDetails(); // Recalculate on loan type change
                    updateLoanEndDate(); // Update end date if inputs are valid
                });

                // Helper function to calculate loan end date based on frequency and duration
                function calculateEndDate(startDate, duration, frequency) {
                    const date = new Date(startDate);
                    if (isNaN(date.getTime())) return null;

                    switch (frequency) {
                        case 'Weekly':
                            date.setDate(date.getDate() + (duration * 7));
                            break;
                        case 'Monthly':
                            date.setMonth(date.getMonth() + duration);
                            break;
                        case 'Twice_a_month':
                            date.setMonth(date.getMonth() + Math.ceil(duration / 2));
                            break;
                        case 'Quarterly':
                            date.setMonth(date.getMonth() + (duration * 3));
                            break;
                        case 'Annually':
                            date.setFullYear(date.getFullYear() + duration);
                            break;
                        default:
                            return null;
                    }
                    return date.toISOString().split('T')[0]; // Format as yyyy-mm-dd
                }

                // Update loan end date based on start date, duration, and frequency
                function updateLoanEndDate() {
                    const duration = parseInt(loanDurationInput.value);
                    const frequency = repaymentFrequencyInput.value;
                    const startDate = loanStartDateInput.value;

                    if (duration > 0 && frequency && startDate) {
                        const endDate = calculateEndDate(startDate, duration, frequency);
                        loanEndDateInput.value = endDate || '';
                    } else {
                        loanEndDateInput.value = '';
                    }
                }

                // Calculate the loan details (total expected amount and payment amount)
                function calculateLoanDetails() {
                    const loanAmount = parseFloat(loanAmountInput.value) || 0;
                    const interestRate = parseFloat(interestRateInput.value) || 0;
                    const duration = parseFloat(loanDurationInput.value) || 0;

                    if (!loanAmount || !interestRate || !duration) return;

                    // Step 1: Calculate interest per period
                    const interestPerPeriod = (loanAmount * interestRate) / 100;

                    // Step 2: Calculate total interest for the entire duration
                    const totalInterest = interestPerPeriod * duration;

                    // Step 3: Calculate total expected return
                    const totalExpectedReturn = loanAmount + totalInterest;

                    // Step 4: Calculate payment amount per installment
                    const paymentAmountPerInstallment = totalExpectedReturn / duration;

                    // Update the fields
                    totalExpectedAmountInput.value = totalExpectedReturn.toFixed(2);
                    paymentAmountInput.value = paymentAmountPerInstallment.toFixed(2);
                }

                // Attach event listeners to recalculate on input changes
                [loanAmountInput, loanDurationInput, repaymentFrequencyInput].forEach(element => {
                    element.addEventListener('input', function() {
                        calculateLoanDetails();
                        updateLoanEndDate();
                    });
                });

                loanStartDateInput.addEventListener('change', updateLoanEndDate);
            });
        </script>





    </div>
@endsection
