@extends('layouts.admin')

@section('title')
    Loan
@endsection

@section('content')
    <div class="container">
        <style>
            .dataTables_wrapper .dataTables_filter {
                display: inline-block !important;
                margin-left: 10px;
            }

            .dataTables_wrapper .dataTables_length {
                display: inline-block !important;
                margin-right: 10px;
            }

            .dataTables_wrapper .dataTables_paginate {
                display: block !important;
            }
        </style>

        @include('includes.session_messages')

        <div class="page-inner">

            <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
                <div>
                    <h3 class="fw-bold mb-3">Loan Application Form</h3>
                    <h6 class="op-7 mb-2">Assign loan to an individual</h6>
                </div>
                <div class="ms-md-auto py-2 py-md-0">
                    <!-- <a href="#" class="btn btn-label-info btn-round me-2">Manage</a> -->
                    <!-- Button to trigger the modal -->
                    <!-- Button to trigger modal -->
                    <a href="#" class="btn btn-primary btn-round" data-bs-toggle="modal"
                        data-bs-target="#addBranchModal">
                        Create Union
                    </a>

                </div>
            </div>


            <div class="row">
                <!-- Card for displaying list of roles -->
                <div class="col-md-12">
                    <div class="card">
                        {{-- <div class="card-header">
                            <h4 class="card-title">Loan Application Form</h4>
                        </div> --}}
                        <div class="card-body">
                            <!-- Table displaying roles or a message if no roles exist -->
                            <div class="container">


                                <form action="{{ route('loanstore') }}" method="POST">
                                    @csrf
                                    <div class="row">
                                        <!-- Search User Section -->
                                        <div class="col-md-12 mb-4">
                                            <p>Select an existing user from the database to assign this loan.</p>
                                            <div class="mb-3">
                                                <label for="search_user" class="form-label">Search User</label>
                                                <input type="text" class="form-control" id="search_user"
                                                    name="search_user" placeholder="Enter name or email to search">
                                                <ul id="search_results" class="list-group mt-2 d-none"></ul>
                                            </div>
                                        </div>

                                        <!-- Loan Type -->
                                        <div class="col-md-6 mb-3">
                                            <label for="user_name" class="form-label">Account Name</label>
                                            <input type="text" class="form-control" id="account_name" name="user_name"
                                                readonly>
                                        </div>

                                        <input type="hidden" id="user_id" name="user_id">


                                        <div class="col-md-6 mb-3">
                                            <label for="loanType" class="form-label">Loan Type</label>

                                            <select class="form-select" id="loanType" name="loanType">
                                                <option value="" disabled selected>-- Select Loan --</option>
                                                @foreach ($loanTypes as $type)
                                                    <option value="{{ $type->id }}"
                                                        data-interest="{{ $type->interest_rate }}">
                                                        {{ $type->loan_name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <!-- Loan Amount -->
                                        <div class="col-md-6 mb-3">
                                            <label for="loanAmount" class="form-label">Loan Amount</label>
                                            <input type="number" class="form-control" id="loanAmount" name="loanAmount"
                                                placeholder="Enter loan amount" required>
                                        </div>

                                        <!-- Interest Rate -->
                                        <div class="col-md-6 mb-3">
                                            <label for="interestRate" class="form-label">Interest Rate (%)</label>
                                            <input type="number" step="0.01" class="form-control" id="interestRate"
                                                name="interestRate" value="{{ old('interestRate', $interestRate) }}"
                                                placeholder="Enter interest rate" required readonly>
                                        </div>

                                        <!-- Loan Duration -->
                                        <div class="col-md-6 mb-3">
                                            <label for="loanDuration" class="form-label">Loan Duration
                                                (Months/Years)</label>
                                            <input type="number" class="form-control" id="loanDuration" name="loanDuration"
                                                placeholder="Enter loan duration" required>
                                        </div>

                                        <!-- Repayment Frequency -->
                                        <div class="col-md-6 mb-3">
                                            <label for="repaymentFrequency" class="form-label">Repayment Frequency</label>
                                            <select class="form-select" id="repaymentFrequency" name="repaymentFrequency">
                                                <option value="" disabled selected>-- Select Loan --</option>

                                                <option value="Weekly">Weekly</option>
                                                <option value="Monthly">Monthly</option>
                                                <option value="Twice_a_month">Twice_a_month</option>
                                                <option value="Quarterly">Quarterly</option>
                                                <option value="Annually">Annually</option>
                                            </select>
                                        </div>


                                        <!-- Total Expected Amount -->
                                        <div class="col-md-6 mb-3">
                                            <label for="totalExpectedAmount" class="form-label">Total Expected
                                                Amount</label>
                                            <input type="number" class="form-control" id="totalExpectedAmount"
                                                name="totalExpectedAmount" readonly>
                                        </div>

                                        <!-- Payment Amount -->
                                        <div class="col-md-6 mb-3">
                                            <label for="paymentAmount" class="form-label">Payment Amount per
                                                Installment</label>
                                            <input type="number" class="form-control" id="paymentAmount"
                                                name="paymentAmount" readonly>
                                        </div>


                                        <!-- Loan Start Date -->
                                        <div class="col-md-6 mb-3">
                                            <label for="loanStartDate" class="form-label">Loan Start Date</label>
                                            <input type="date" class="form-control" id="loanStartDate"
                                                name="loanStartDate" required>
                                        </div>

                                        <!-- Loan End Date -->
                                        <div class="col-md-6 mb-3">
                                            <label for="loanEndDate" class="form-label">Loan End Date</label>
                                            <input type="date" class="form-control" id="loanEndDate"
                                                name="loanEndDate" required>
                                        </div>

                                        <!-- Loan Purpose -->
                                        <div class="col-md-6 mb-3">
                                            <label for="loanPurpose" class="form-label">Loan Purpose</label>
                                            <textarea class="form-control" id="loanPurpose" name="loanPurpose" rows="1"
                                                placeholder="Describe the purpose of the loan"></textarea>
                                        </div>

                                        <!-- Collateral Type -->
                                        <div class="col-md-6 mb-3">
                                            <label for="collateralType" class="form-label">Collateral Type</label>
                                            <textarea class="form-control" id="collateralType" name="collateralType" rows="1"
                                                placeholder="Enter the collateral for this loan"></textarea>
                                        </div>
                                    </div>

                                    <button type="submit" class="btn btn-primary mt-3">Submit Loan Application</button>
                                </form>

                                <script>
                                    document.getElementById('search_user').addEventListener('input', function() {
                                        const query = this.value.trim();
                                        const resultsList = document.getElementById('search_results');
                                        resultsList.classList.remove('d-none');
                                        resultsList.innerHTML = '';

                                        if (query.length > 2) {
                                            fetch(`/search-user?query=${encodeURIComponent(query)}`)
                                                .then(response => response.json())
                                                .then(data => {
                                                    resultsList.innerHTML = ''; // Clear old results
                                                    if (data.length > 0) {
                                                        data.forEach(user => {
                                                            const listItem = document.createElement('li');
                                                            listItem.classList.add('list-group-item');
                                                            listItem.textContent = `${user.name} - ${user.email}`;
                                                            listItem.dataset.userId = user.id;
                                                            listItem.dataset.userName = user.name;

                                                            listItem.addEventListener('click', () => {
                                                                document.getElementById('search_user').value = user.name;
                                                                document.getElementById('account_name').value = user
                                                                .name; // Corrected field assignment
                                                                document.getElementById('user_id').value = user
                                                                .id; // Correctly populate user_id
                                                                resultsList.innerHTML =
                                                                ''; // Clear the results list after selection
                                                            });

                                                            resultsList.appendChild(listItem);
                                                        });
                                                    } else {
                                                        resultsList.innerHTML =
                                                            '<li class="list-group-item text-muted">No matching results found</li>';
                                                    }
                                                })
                                                .catch(error => {
                                                    console.error('Error fetching user data:', error);
                                                    resultsList.innerHTML =
                                                        '<li class="list-group-item text-danger">Error fetching results</li>';
                                                });
                                        } else {
                                            resultsList.classList.add('d-none');
                                        }
                                    });
                                </script>
                                <script>
                                    document.getElementById('loanType').addEventListener('change', function() {
                                        const selectedOption = this.options[this.selectedIndex];
                                        const interestRate = selectedOption.dataset.interest || 0;
                                        document.getElementById('interestRate').value = interestRate;
                                    });
                                </script>
                                <script>
                                    // Helper function to add duration based on repayment frequency
                                    function calculateEndDate(startDate, duration, frequency) {
                                        const date = new Date(startDate);
                                        if (isNaN(date.getTime())) return null; // Invalid date

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

                                    // Event handler to update loan end date
                                    function updateLoanEndDate() {
                                        const duration = parseInt(document.getElementById('loanDuration').value);
                                        const frequency = document.getElementById('repaymentFrequency').value;
                                        const startDate = document.getElementById('loanStartDate').value;

                                        if (duration > 0 && frequency && startDate) {
                                            const endDate = calculateEndDate(startDate, duration, frequency);
                                            document.getElementById('loanEndDate').value = endDate || '';
                                        }
                                    }

                                    // Attach event listeners
                                    document.getElementById('loanDuration').addEventListener('input', updateLoanEndDate);
                                    document.getElementById('repaymentFrequency').addEventListener('change', updateLoanEndDate);
                                    document.getElementById('loanStartDate').addEventListener('change', updateLoanEndDate);
                                </script>
                                <script>
                                    document.addEventListener('DOMContentLoaded', function() {
                                        const loanAmountInput = document.getElementById('loanAmount');
                                        const interestRateInput = document.getElementById('interestRate');
                                        const loanDurationInput = document.getElementById('loanDuration');
                                        const repaymentFrequencyInput = document.getElementById('repaymentFrequency');
                                        const totalExpectedAmountInput = document.getElementById('totalExpectedAmount');
                                        const paymentAmountInput = document.getElementById('paymentAmount');

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

                                            // Update form fields
                                            totalExpectedAmountInput.value = totalExpectedReturn.toFixed(2);
                                            paymentAmountInput.value = paymentAmountPerInstallment.toFixed(2);
                                        }

                                        // Attach event listeners to update calculations
                                        [loanAmountInput, interestRateInput, loanDurationInput].forEach(element => {
                                            element.addEventListener('input', calculateLoanDetails);
                                        });
                                    });
                                </script>


                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <!-- Include jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Include DataTables CSS -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css" />

    <!-- Include DataTables JS -->
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js">
    </script>

    <!-- DataTables Initialization -->
    <script>
        $(document).ready(function() {
            $('#example').DataTable({
                "paging": true,
                "searching": true,
                "ordering": true,
                "info": true,
                "responsive": true
            });
        });
    </script>
@endsection
