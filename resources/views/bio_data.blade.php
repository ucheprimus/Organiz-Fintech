@extends('layouts.dashboard')

@section('content')
    <!-- Page header -->
    <div class="cm65h c02a0 c8clx c53qs">

        <!-- Left: Title -->
        <div class="ctf03 cnexa">
            <h1 class="text-slate-800 dark:text-slate-100 font-bold coif1 cm58s">Add your Bio-Data ✨</h1>
        </div>
        <!-- Right: Actions -->
        <div class="cj639 cto5n cv1y9 ckl2g c1dgv cbze2">
        </div>

    </div>

    <div>

        @if (session('success'))
            <div id="successContainer" class="d-flex justify-content-center align-items-center"
                style="position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%); background-color: rgba(255, 255, 255, 0.95); z-index: 1000; width: 100%; height: 100%; display: flex; justify-content: center; align-items: center;">

                <div
                    style="background: white; padding: 2rem; border-radius: 20px; text-align: center;
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
                const defaults = {
                    startVelocity: 30,
                    spread: 360,
                    ticks: 60,
                    zIndex: 2000
                };

                function randomInRange(min, max) {
                    return Math.random() * (max - min) + min;
                }

                const interval = setInterval(function() {
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

        <form action="{{ route('clientstore') }}" method="POST" enctype="multipart/form-data">
            @csrf

            @if ($errors->any())
                <div class="alert alert-danger">
                    <strong>Validation errors:</strong>
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <!-- ======= BASIC INFORMATION (ALWAYS VISIBLE) ======= -->

            {{-- <div class="input-row">
                <div class="input-container">
                    <select name="officer" id="officer" class="input-field" required>
                        <option value="">-- Assign Officer --</option>
                        @foreach ($officers as $officer)
                            <option value="{{ $officer->id }}">{{ $officer->first_name }}</option>
                        @endforeach

                    </select>
                </div>
            </div> --}}

            <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">


            <div class="input-row">
                <div class="input-container">
                    <input type="text" class="input-field" id="full_name" placeholder="Your fullname" name="full_name"
                        required value="">
                </div>
                <div class="input-container">
                    <select class="input-field" id="marital_status" name="marital_status">
                        <option value="">--- Marital Status ---</option>
                        <option value="single">
                            Single</option>
                        <option value="married">
                            Married</option>
                        <option value="divorced">Divorced
                        </option>
                    </select>
                </div>
            </div>

            <div class="input-row">
                <div class="input-container">
                    <select class="input-field" id="gender" name="gender">
                        <option value="">-- Gender ---</option>
                        <option value="male">Male
                        </option>
                        <option value="female">
                            Female
                        </option>
                        <option value="other">Other
                        </option>
                    </select>
                </div>

                <div class="input-container">
                    <input type="text" class="input-field" id="tin" placeholder="TIN no" name="tin" required
                        value="">
                </div>
            </div>

            <div class="input-row">
                <div class="input-container">
                    <input type="text" class="input-field" id="phone" placeholder="your Phone no" name="phone_number"
                        required value="">
                </div>

                <div class="input-container">
                    <input type="text" class="input-field" id="Address" placeholder="Address" name="address" required
                        value="">
                </div>
            </div>

            <div class="input-row">
                <div class="input-container">
                    <select class="input-field" id="identification_type" name="identification_type">
                        <option value="">--- Identification Document ---</option>
                        <option value="NIN">NIN</option>
                        <option value="driver's license">
                            Drivers
                            licence</option>
                        <option value="Voter's Card">Voters
                            Card
                        </option>
                        <option value="Int_passport">
                            International Passport</option>
                    </select>
                </div>

                <div class="input-container">
                    <input type="text" class="input-field" id="identification" placeholder="Identification No"
                        name="id_no" required value="">
                </div>
            </div>



            <div class="input-row">
                <div class="input-container">


                    <div class="tooltip-container">
                        <input type="file" class="input-field" id="upload" name="upload" required>
                        <span class="tooltip-text">Upload Identification Document</span>
                    </div>
                </div>

            </div>
            <!-- ======= RANGE SELECTION ======= -->
            <div class="input-row">
                <div class="input-container">
                    <select class="input-field" id="application_range" name="application_range" required>
                        <option value="">-- Select Amount Range --</option>
                        <option value="10000-100000">10,000 - 100,000 Naira</option>
                        <option value="100001-500000">100,001 - 500,000 Naira</option>
                        <option value="500001-above">500,001 Naira and above</option>
                    </select>
                </div>
            </div>

            <!-- ======= FIELDS FOR 10,000 - 100,000 ======= -->
            <div id="range_10000_100000" class="application-details" style="display:none;">
                {{-- ONLY ASK FOR A SIMPLE REASON --}}
                <div class="input-row">
                    <div class="input-container">
                        <select class="input-field" id="account_type" name="account_type" required>
                            <option value="" disabled selected>-- What account do you want with us --</option>
                            <option value="savings">Savings</option>
                            <option value="loan">Loan</option>
                            <option value="investment">Investment</option>
                        </select>
                    </div>
                    <div class="input-container">
                        <input type="text" placeholder="your bank name" class="input-field" id="bank_name"
                            name="bank_name" value="">
                    </div>
                </div>


                <div class="input-row">
                    <div class="input-container">
                        <select class="input-field" id="bank_account_type" name="bank_account_type">
                            <option value="">--- Your bank account type ---</option>
                            <option value="savings">
                                Savings Loan</option>
                            <option value="current">
                                Current</option>
                            <option value="fixed">
                                Fixed</option>
                            <option value="domicillary">Domicillary
                                Loan
                            </option>
                        </select>
                    </div>
                    <div class="input-container">
                        <input type="number" class="input-field" placeholder="Account No." id="account_no"
                            name="account_no" value="">
                    </div>
                </div>


            </div>

            <!-- ======= FIELDS FOR 100,001 - 500,000 ======= -->
            <div id="range_100001_500000" class="application-details" style="display:none;">
                {{-- ASK FOR REASON + EMPLOYMENT STATUS --}}


                <div class="input-row">
                    <div class="input-container">
                        <input type="text" placeholder="Gurantor's name" class="input-field" id="g_name"
                            name="g_name" value="">
                    </div>
                    <div class="input-container">
                        <input type="number" placeholder="Guarantor's phone no." class="input-field" id="g_phone"
                            name="g_phone" value="">
                    </div>
                </div>

                <div class="input-row">
                    <div class="input-container">
                        <input type="text" placeholder="Guarantor's Address" class="input-field" id="g_address"
                            name="g_address" value="">
                    </div>
                    <div class="input-container">
                        <input type="text" placeholder="your relationship with guarantor" class="input-field"
                            id="g_relationship" name="g_relationship" value="">
                    </div>
                </div>

                <div class="input-row">
                    <div class="input-container">
                        <input type="date" class="input-field" name="dob" id="dob" placeholder="Date of Birth" value="">
                    </div>
                    <div class="input-container">

                        <div class="tooltip-container">
                            <input type="file" class="input-field" id="g_passport" name="g_passport"required>
                            <span class="tooltip-text">Upload Guarantor's Passport</span>
                        </div>

                    </div>
                </div>


            </div>

            <!-- ======= FIELDS FOR 500,001 AND ABOVE ======= -->
            <div id="range_500001_above" class="application-details" style="display:none;">
                {{-- ASK FOR REASON + EMPLOYMENT + INCOME + COLLATERAL --}}


                <div class="input-row">
                    <div class="input-container">

                        <div class="tooltip-container">
                            <input type="file" class="input-field" id="utility_bill" name="utility_bill"required>
                            <span class="tooltip-text">Upload Utility Bill</span>
                        </div>

                    </div>
                    <div class="input-container">

                    </div>

                </div>

            </div>

            <!-- Full-width blue submit button -->
            <div style="padding: 0 10px; margin-top: 20px;">
                <button type="submit"
                    style="width: 100%; background-color: #007bff; color: white; padding: 12px; border: none; border-radius: 5px;">
                    Submit Bio-Data
                </button>
            </div>
        </form>


        <script>
            document.addEventListener("DOMContentLoaded", function() {
                const applicationRange = document.getElementById("application_range");

                const range100 = document.getElementById("range_10000_100000");
                const range500 = document.getElementById("range_100001_500000");
                const rangeAbove = document.getElementById("range_500001_above");

                applicationRange.addEventListener("change", function() {
                    const selected = this.value;

                    // Hide all first
                    [range100, range500, rangeAbove].forEach(div => {
                        div.style.display = "none";
                    });

                    // Remove 'required' from all inputs/selects inside those sections
                    document.querySelectorAll(".application-details input, .application-details select")
                        .forEach(el => {
                            el.removeAttribute("required");
                        });

                    // Cumulative show + add required depending on selected range
                    if (selected === "10000-100000") {
                        range100.style.display = "flex";
                        range100.querySelectorAll("input, select").forEach(el => el.setAttribute("required",
                            "required"));
                    } else if (selected === "100001-500000") {
                        [range100, range500].forEach(section => {
                            section.style.display = "flex";
                            section.querySelectorAll("input, select").forEach(el => el.setAttribute(
                                "required", "required"));
                        });
                    } else if (selected === "500001-above") {
                        [range100, range500, rangeAbove].forEach(section => {
                            section.style.display = "flex";
                            section.querySelectorAll("input, select").forEach(el => el.setAttribute(
                                "required", "required"));
                        });
                    }
                });
            });
        </script>



    </div>
@endsection
