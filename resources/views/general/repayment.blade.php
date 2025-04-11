@extends('layouts.admin')
@section('title')
    Repay
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
                    <h3 class="fw-bold mb-3">Loan Repayment</h3>
                    <h6 class="op-7 mb-2">add repayment record to client's loans</h6>
                </div>


            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="card">

                        <style>
                            .card-header {
                                display: flex;
                                justify-content: space-between;
                                /* Space between the items */
                                align-items: center;
                                /* Align items vertically */
                            }

                            #toggleButton {
                                cursor: pointer;
                                font-size: 1.25rem;
                                font-weight: bold;
                                color: #fff;
                                background-color: #007bff;
                                padding: 10px 20px;
                                border-radius: 5px;
                                border: none;
                                transition: background-color 0.3s, color 0.3s;
                                width: auto;
                                max-width: 200px;
                                text-align: center;
                                display: inline-block;
                            }

                            #toggleButton:hover {
                                background-color: #0056b3;
                                color: #e2e2e2;
                            }

                            /* Animation for fade-in and fade-out effect */
                            @keyframes fadeInOut {
                                0% {
                                    background-color: #007bff;
                                    opacity: 1;
                                }

                                50% {
                                    background-color: #002efa;
                                    opacity: 0.5;
                                }

                                100% {
                                    background-color: #007bff;
                                    opacity: 1;
                                }
                            }

                            #toggleButton {
                                animation: fadeInOut 3s infinite;
                            }
                        </style>

                        <div class="card-header">
                            <!-- Flex container to space between the buttons -->
                            <div class="d-flex justify-content-between w-100">
                                <!-- Button to trigger toggle effect -->
                                <h4 class="card-title" id="toggleButton">repay loan</h4>

                                <!-- Button to go back -->
                                {{-- <a href="/client" class="btn btn-dark me-2">Go Back</a> --}}
                            </div>
                        </div>

                        <div class="card-body" id="formContainer" style="display: none;">
                            <div class="table-responsive">

                                <form method="POST" action="{{ route('transaction.process') }}">
                                    @csrf

                                    <!-- 🔍 Search User -->
                                    <div class="mb-3">
                                        <label for="search_user" class="form-label">Search User</label>
                                        <input type="text" class="form-control" id="search_user" name="search_user"
                                            placeholder="Enter name or email">
                                        <ul id="search_results" class="list-group mt-2 d-none"></ul>
                                    </div>

                                    <!-- Hidden User ID -->
                                    <input type="hidden" name="user_id" id="user_id">

                                    <!-- 📌 Loan Repayment Section -->
                                    <div class="mt-3">
                                        <label for="loan">Select Loan:</label>
                                        <select id="loan" name="loan_id" class="form-control">
                                            <option value="">-- Select Loan --</option>
                                        </select>

                                        <label for="loan_amount">Loan Repayment (₦):</label>
                                        <input type="number" name="loan_amount" class="form-control" value="0">
                                    </div>

                                    <!-- 💰 Savings Deposit Section -->
                                    <div class="mt-3">
                                        <label for="savings_amount">Savings Deposit (₦):</label>
                                        <input type="number" name="savings_amount" class="form-control" value="0">
                                    </div>

                                    <button type="submit" class="btn btn-success mt-3">Proceed</button>
                                </form>


                                <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                                <script>
                                    $(document).ready(function() {
                                        let searchInput = $('#search_user'),
                                            resultsList = $('#search_results'),
                                            loanDropdown = $('#loan');
                                
                                        // 🔍 Search User and Fetch Loans
                                        searchInput.on('input', function() {
                                            let query = searchInput.val().trim();
                                            if (query.length >= 2) {
                                                $.get("{{ route('search.user') }}", {
                                                    query
                                                }, function(data) {
                                                    resultsList.empty().toggleClass('d-none', !data.length);
                                                    if (data.length) {
                                                        $.each(data, function(_, user) {
                                                            $('<li>')
                                                                .addClass('list-group-item list-group-item-action')
                                                                .text(`${user.name} (${user.email})`)
                                                                .on('click', function() {
                                                                    $('#user_id').val(user.id);
                                                                    searchInput.val(user.name);
                                                                    resultsList.addClass('d-none');
                                                                    fetchLoans(user.id);
                                                                })
                                                                .appendTo(resultsList);
                                                        });
                                                    } else {
                                                        resultsList.html(
                                                            '<li class="list-group-item text-danger">User not found. Please create first.</li>'
                                                        );
                                                    }
                                                });
                                            } else {
                                                resultsList.addClass('d-none');
                                            }
                                        });
                                
                                        // Hide results on outside click
                                        $(document).on('click', function(e) {
                                            if (!$(e.target).closest('#search_user, #search_results').length) {
                                                resultsList.addClass('d-none');
                                            }
                                        });
                                
                                        // Fetch Loans for Selected User
                                        function fetchLoans(userId) {
                                            $.get("{{ route('fetch.loans') }}", {
                                                user_id: userId
                                            }, function(data) {
                                                console.log(data); // Debugging: log the response to see the data
                                
                                                let filteredLoans = data.filter(loan => loan.balance > 0); // Exclude settled loans
                                
                                                const formatter = new Intl.NumberFormat('en-NG', {
                                                    style: 'currency',
                                                    currency: 'NGN',
                                                    minimumFractionDigits: 2
                                                });
                                
                                                loanDropdown.html('<option value="">-- Select Loan --</option>');
                                
                                                // Process each loan and compute the correct balance
                                                filteredLoans.forEach(loan => {
                                                    let totalExpected = parseFloat(loan.total_expected_amount) || 0;
                                                    let amountPaid = parseFloat(loan.amount_paid) || 0;
                                
                                                    let balance = totalExpected - amountPaid; // Compute balance
                                
                                                    // If no repayment has been made, display the total expected amount instead of the borrowed amount
                                                    balance = balance < 0 ? 0 : balance; // Ensure balance is not negative
                                
                                                    loanDropdown.append(
                                                        `<option value="${loan.id}">
                                                            ${loan.loan_type.loan_name}: ${formatter.format(loan.loan_amount)} 
                                                            | Total Expected: ${formatter.format(totalExpected)} 
                                                            | Bal: ${formatter.format(balance)} 
                                                        </option>`
                                                    );
                                                });
                                
                                                // If no active loans, show the message
                                                if (filteredLoans.length === 0) {
                                                    loanDropdown.append('<option value="">No active loans</option>');
                                                }
                                            }).fail(function(err) {
                                                console.log('Error fetching loans:', err); // Log any error
                                            });
                                        }
                                
                                        // Trigger loan balance recalculation on repayment (assuming you have a repayment form)
                                        $('#repayment_form').on('submit', function(e) {
                                            e.preventDefault(); // Prevent the form from submitting the traditional way
                                
                                            // Collect form data, including repayment amount
                                            let repaymentAmount = $('#repayment_amount').val();
                                            let loanId = $('#loan').val();
                                            
                                            // Make AJAX request to handle repayment submission
                                            $.ajax({
                                                url: "{{ route('repayment') }}",  // Adjust with your repayment route
                                                method: "POST",
                                                data: {
                                                    loan_id: loanId,
                                                    repayment_amount: repaymentAmount,
                                                    _token: '{{ csrf_token() }}'  // Add CSRF token for security
                                                },
                                                success: function(response) {
                                                    console.log(response); // Debugging: check if response returns success
                                                    // After successful repayment, refresh loans and update balance
                                                    fetchLoans($('#user_id').val());  // Re-fetch the loans after repayment
                                                },
                                                error: function(error) {
                                                    // Handle any error here
                                                    console.log("Error:", error);
                                                }
                                            });
                                        });
                                    });
                                </script>
                                


                            </div>
                        </div>

                        <script>
                            // Get the button and the form container
                            const toggleButton = document.getElementById('toggleButton');
                            const formContainer = document.getElementById('formContainer');

                            // Add a click event listener to toggle visibility
                            toggleButton.addEventListener('click', () => {
                                if (formContainer.style.display === 'none') {
                                    formContainer.style.display = 'block';
                                } else {
                                    formContainer.style.display = 'none';
                                }
                            });
                        </script>

                    </div>
                </div>
            </div>


            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Clients Table</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped" id="example">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Created At</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>

                                </table>

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
            // Initialize DataTable on table with id "example"
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
