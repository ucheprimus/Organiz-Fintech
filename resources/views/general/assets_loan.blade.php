@extends('layouts.admin')

@section('title')
    Assets
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

        <style>
            /* Centering the tabs */
            .nav-tabs {
                display: flex;
                justify-content: center;
                border-bottom: none;
                background-color: white;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);

            }

            /* Styling the tabs */
            .nav-tabs .nav-link {
                color: #555;
                background: #f8f9fa;
                border-radius: 5px;
                margin: 0 10px;
                padding: 10px 20px;
                transition: all 0.3s ease-in-out;
            }

            /* Hover effect */
            .nav-tabs .nav-link:hover {
                background: #007bff;
                color: #fff;
            }

            /* Active effect */
            .nav-tabs .nav-link.active {
                background: #0056b3;
                color: #fff;
                font-weight: bold;
            }

            /* Tab content styling */
            .tab-content {
                background: #fff;
                padding: 20px;
                border-radius: 5px;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            }

            @media (max-width: 576px) {
                .nav-tabs {
                    display: flex;
                    flex-wrap: nowrap;
                    /* Ensures tabs stay in one row */
                    justify-content: space-between;
                    /* Distributes evenly */
                }

                .nav-tabs .nav-item {
                    flex: 1;
                    /* Equal width for all tabs */
                }

                .nav-tabs .nav-link {
                    padding: 10px 5px;
                    /* Adjust padding for smaller screens */
                }
            }
        </style>

        @include('includes.session_messages')

        <div class="page-inner">

            <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
                <div>
                    <h3 class="fw-bold mb-3">Assets Loan</h3>
                    <div class="">
                        <strong>{{ $totalLoans }} loans in total</strong> —
                        <span class="text-success">{{ $activeCount }} active</span>, 
                        <span class="text-primary">{{ $settledCount }} settled</span>, 
                        <span class="text-danger">{{ $overdueCount }} overdue</span>.
                    </div>
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


            <div class="mt-5">
                <ul class="nav nav-tabs" id="loanTabs" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="active-tab" data-bs-toggle="tab" data-bs-target="#active"
                            type="button" role="tab">Active</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="settled-tab" data-bs-toggle="tab" data-bs-target="#settled"
                            type="button" role="tab">Settled</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="overdue-tab" data-bs-toggle="tab" data-bs-target="#overdue"
                            type="button" role="tab">Overdue</button>
                    </li>
                </ul>

                <div class="tab-content mt-3" id="loanTabsContent">
                    <div class="tab-pane fade show active" id="active" role="tabpanel">
                        <!-- Card for displaying list of roles -->
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Active Loans </h4>
                                </div>
                                <div class="card-body">
                                    <!-- Table displaying roles or a message if no roles exist -->

                                    <div class="table-responsive">
                                        <table id="example" class="display table table-striped table-hover">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>User Name</th>
                                                    <th>Amount</th>
                                                    <th>Duration (Weeks)</th>
                                                    <th>Total Expected</th>
                                                    <th>Payment Amount</th>
                                                    <th>Amount Paid</th>
                                                    <th>Balance</th>
                                                    <th>Start Date</th>
                                                    <th>End Date</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tfoot>
                                                <tr>
                                                    <th>#</th>
                                                    <th>User Name</th>
                                                    <th>Amount</th>
                                                    <th>Duration (Weeks)</th>
                                                    <th>Total Expected</th>
                                                    <th>Payment Amount</th>
                                                    <th>Amount Paid</th>
                                                    <th>Balance</th>
                                                    <th>Start Date</th>
                                                    <th>End Date</th>
                                                    <th>Action</th>
                                                </tr>
                                            </tfoot>
                                            <tbody>

                                                @foreach ($activeLoans as $key => $loan)
                                                    <tr>
                                                        <td>{{ $key + 1 }}</td>
                                                        <td>{{ $loan->user->name ?? 'N/A' }}</td>
                                                        <td>{{ number_format($loan->loan_amount, 2) }}</td>
                                                        <td>{{ $loan->loan_duration }}</td>
                                                        <td>{{ number_format($loan->total_expected_amount, 2) }}</td>
                                                        <td>{{ number_format($loan->payment_amount, 2) }}</td>
                                                        <td>{{ number_format($loan->repayments->sum('amount'), 2) }}</td>
                                                        <td>{{ number_format($loan->balance, 2) }}</td>
                                                        <td>{{ $loan->loan_start_date }}</td>
                                                        <td>{{ $loan->loan_end_date }}</td>
                                                        <td>
                                                            <button type="button" class="btn btn-primary btn-sm"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#repayLoanModal-{{ $loan->id }}">
                                                                Repay
                                                            </button>
                                                            <a href="{{ route('loan.show', $loan->id) }}"
                                                                class="btn btn-success btn-sm">View</a>
                                                        </td>
                                                    </tr>
                                                @endforeach

                                            </tbody>

                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="settled" role="tabpanel">
                        <h3>Settled Loans</h3>


                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Borrower</th>
                                    <th>Loan Type</th>
                                    <th>Expected Amount</th>
                                    <th>Amount Paid</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($settledLoans as $loan)
                                    <tr>
                                        <td>{{ $loan->user->name }}</td>
                                        <td>{{ $loan->loanType->loan_name }}</td>
                                        <td>{{ number_format($loan->total_expected_amount, 2) }}</td>
                                        <td>{{ number_format($loan->repayment_amount, 2) }}</td>
                                        <td><span class="badge bg-success">Fully Settled</span></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="tab-pane fade" id="overdue" role="tabpanel">
                        <h3>Overdue Loans</h3>
                        <table id="overdueLoansTable" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>Borrower</th>
                                    <th>Loan Type</th>
                                    <th>Loan Amount</th>
                                    <th>Balance</th>
                                    <th>Loan End Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($overdueLoans as $loan)
                                    <tr>
                                        <td>{{ $loan->user->name }}</td>
                                        <td>{{ $loan->loanType->loan_name }}</td>
                                        <td>₦{{ number_format($loan->loan_amount, 2) }}</td>
                                        <td>₦{{ number_format($loan->balance, 2) }}</td>
                                        <td>{{ \Carbon\Carbon::parse($loan->loan_end_date)->format('d M, Y') }}</td>
                                        <td>
                                            <a href="" class="btn btn-primary btn-sm">View</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
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
