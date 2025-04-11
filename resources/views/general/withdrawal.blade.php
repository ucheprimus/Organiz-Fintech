@extends('layouts.admin')
@section('title')
    Withdraw
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
                    <h3 class="fw-bold mb-3">Withdrawal</h3>
                    <h6 class="op-7 mb-2">Process a withdrawal for a user's account</h6>
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
                                <h4 class="card-title" id="toggleButton">Withdraw Savings</h4>

                                <!-- Button to go back -->
                                {{-- <a href="/client" class="btn btn-dark me-2">Go Back</a> --}}
                            </div>
                        </div>

                        <div class="card-body" id="formContainer" style="display: none;">
                            <div class="table-responsive">
                                <form method="POST" action="{{ route('withdraw.process') }}">
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

                                    <!-- 💰 Withdrawal Amount -->
                                    <div class="mb-2">
                                        <label for="withdraw_amount">Withdrawal Amount (₦):</label>
                                        <input type="number" name="amount" id="withdraw_amount" class="form-control"
                                            value="0" min="1" step="0.01">
                                    </div>

                                    <!-- Display Savings Balance -->
                                    <div class="mb-2">
                                        <label for="savings_balance">Savings Balance (₦):</label>
                                        <input type="text" id="savings_balance" class="form-control" readonly>
                                    </div>


                                    <!-- Savings Amount -->
                                    <div class="col-md-12 mb-2">
                                        <label for="comment">Comment (Optional)</label>
                                        <textarea name="comment" class="form-control" rows="2" placeholder="Enter a comment"></textarea>
                                    </div>

                                    <button type="submit" class="btn btn-danger mt-3">Withdraw</button>
                                </form>
                                <!-- jQuery -->
                                <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

                                <script>
                                    $(document).ready(function() {
                                        let searchInput = $('#search_user'),
                                            resultsList = $('#search_results'),
                                            savingsBalanceInput = $('#savings_balance');

                                        searchInput.on('input', function() {
                                            let query = searchInput.val().trim();
                                            if (query.length >= 2) {
                                                $.get("{{ route('search.user') }}", {
                                                    query
                                                }, function(data) {
                                                    resultsList.empty().toggleClass('d-none', data.length === 0);

                                                    if (data.length) {
                                                        $.each(data, function(_, user) {
                                                            $('<li>')
                                                                .addClass('list-group-item list-group-item-action')
                                                                .text(`${user.name} (${user.email})`)
                                                                .on('click', function() {
                                                                    $('#user_id').val(user.id);
                                                                    searchInput.val(user.name);
                                                                    resultsList.addClass('d-none');

                                                                    // Fetch user's updated savings balance
                                                                    $.get("{{ route('fetch.savings.balance') }}", {
                                                                        user_id: user.id
                                                                    }, function(balanceData) {
                                                                        savingsBalanceInput.val(balanceData
                                                                            .balance || '0.00');
                                                                    });
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

                                        // Hide results when clicking outside
                                        $(document).on('click', function(e) {
                                            if (!$(e.target).closest('#search_user, #search_results').length) {
                                                resultsList.addClass('d-none');
                                            }
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

                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h4 class="card-title">Withdrawal Table</h4>
                            <button class="btn btn-success" id="exportBtn">
                                <i class="fas fa-file-export"></i> Export
                            </button>
                        </div>

                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped" id="example">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>Amount</th>
                                            <th>Comment</th>
                                            <th>Created At</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @php
                                            // Group withdrawals by user ID and sum their amounts
                                            $groupedWithdrawals = $withdrawals->groupBy('user_id');
                                        @endphp

                                        @if ($groupedWithdrawals->isEmpty())
                                            <tr>
                                                <td colspan="6" class="text-center">No withdrawals found</td>
                                            </tr>
                                        @else
                                            @foreach ($groupedWithdrawals as $userId => $userWithdrawals)
                                                @php
                                                    $user = $userWithdrawals->first()->user ?? null;
                                                    $totalAmount = $userWithdrawals->sum('amount');
                                                @endphp
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $user->name ?? 'Unknown User' }}</td>
                                                    <td>₦{{ number_format($totalAmount, 2) }}</td>
                                                    <td>{{ $userWithdrawals->first()->comment ?? 'No comment' }}</td>
                                                    <td>{{ $userWithdrawals->first()->created_at->format('d M Y') }}</td>
                                                    <td>
                                                        <button class="btn btn-warning btn-sm edit-btn"
                                                            data-bs-toggle="modal" data-bs-target="#editWithdrawalModal"
                                                            data-id="{{ $userId }}" data-amount="{{ $totalAmount }}">
                                                            Edit
                                                        </button>

                                                        <button class="btn btn-info btn-sm view-btn">
                                                            <a href="{{ route('withdrawals.view', ['user_id' => $userId]) }}" class="text-decoration-none text-white">
                                                                View
                                                            </a>
                                                        </button>
                                                        
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endif
                                    </tbody>


                                </table>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>




    <!-- View Withdrawal Modal -->
    <div class="modal fade" id="viewWithdrawalModal" tabindex="-1" aria-labelledby="viewWithdrawalModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="viewWithdrawalModalLabel">User Withdrawal Records</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="userWithdrawalsList">
                        <!-- Dynamic content will go here -->
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>


    <script>
        $(document).on('click', '.view-btn', function() {
            var userId = $(this).data('user-id');

            // Fetch the user withdrawals using AJAX
            $.ajax({
                url: '/get-user-withdrawals', // Adjust this to your route
                method: 'GET',
                data: {
                    user_id: userId
                },
                success: function(data) {
                    var withdrawalsHtml = '';
                    if (data.withdrawals.length > 0) {
                        data.withdrawals.forEach(function(withdrawal, index) {
                            withdrawalsHtml += `
                        <div class="withdrawal-record">
                            <p><strong>Withdrawal #${index + 1}</strong></p>
                            <p>Amount: ₦${withdrawal.amount}</p>
                            <p>Comment: ${withdrawal.comment}</p>
                            <p>Date: ${new Date(withdrawal.created_at).toLocaleDateString()}</p>
                            <hr>
                        </div>
                    `;
                        });
                    } else {
                        withdrawalsHtml = '<p>No withdrawal records found for this user.</p>';
                    }

                    // Append the withdrawal data into the modal body
                    $('#userWithdrawalsList').html(withdrawalsHtml);
                },
                error: function() {
                    $('#userWithdrawalsList').html('<p>Error loading withdrawal records.</p>');
                }
            });
        });
    </script>
@endsection

@section('scripts')
    <!-- Include jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Include DataTables CSS -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css" />
    <link rel="stylesheet" type="text/css"
        href="https://cdn.datatables.net/buttons/2.3.6/css/buttons.dataTables.min.css" />

    <!-- Include DataTables JS -->
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js">
    </script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/2.3.6/js/dataTables.buttons.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.html5.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.print.min.js"></script>

    <!-- DataTables Initialization -->
    <script>
        $(document).ready(function() {
            let table = $('#example').DataTable({
                "paging": true,
                "searching": true,
                "ordering": true,
                "info": true,
                "responsive": true,
                dom: 'Bfrtip', // Add export buttons
                buttons: [{
                        extend: 'copyHtml5',
                        text: 'Copy',
                        className: 'btn btn-primary'
                    },
                    {
                        extend: 'csvHtml5',
                        text: 'CSV',
                        className: 'btn btn-success'
                    },
                    {
                        extend: 'excelHtml5',
                        text: 'Excel',
                        className: 'btn btn-warning'
                    },
                    {
                        extend: 'pdfHtml5',
                        text: 'PDF',
                        className: 'btn btn-danger'
                    },
                    {
                        extend: 'print',
                        text: 'Print',
                        className: 'btn btn-info'
                    }
                ]
            });
        });
    </script>
@endsection
