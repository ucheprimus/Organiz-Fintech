@extends('layouts.admin')

@section('title')
    Loan Options
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
            <div class="row">
                <!-- Card for displaying list of roles -->
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Loan List</h4>
                        </div>
                        <div class="card-body">
                            <!-- Table displaying roles or a message if no roles exist -->
                            {{-- @if ($roles->isEmpty())
                        <p>Nothing yet. Add a new role below.</p>
                        @else --}}
                            <div class="table-responsive">
                                <table id="example" class="display table table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th>Loan Name</th>
                                            <th>Max Amount</th>
                                            <th>Min Amount</th>
                                            <th>Interest Rate</th>
                                            <th>Status</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($loans as $loan)
                                            <tr>
                                                <td>{{ $loan->loan_name }}</td>
                                                <td>{{ number_format($loan->max_amount, 2) }}</td>
                                                <td>{{ number_format($loan->min_amount, 2) }}</td>
                                                <td>{{ $loan->interest_rate }}%</td>
                                                <td>{{ $loan->status }}</td>
                                                <td>
                                                    <a href="{{ route('loantypeedit', $loan->id) }}"
                                                        class="btn btn-warning btn-sm">Edit</a>
                                                    <form action="{{ route('loantypedestroy', $loan->id) }}"
                                                        method="POST" style="display:inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Card for role creation form -->
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Create Loan</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('loantypestore') }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="loanName">Loan Name</label>
                                    <input type="text" id="loanName" name="loan_name" class="form-control"
                                        placeholder="e.g., Personal Loan" required>
                                </div>

                                <div class="form-group">
                                    <label for="maxAmount">Maximum Loan Amount</label>
                                    <input type="number" id="maxAmount" name="max_amount" class="form-control"
                                        placeholder="e.g., 500000" required>
                                </div>

                                <div class="form-group">
                                    <label for="minAmount">Minimum Loan Amount</label>
                                    <input type="number" id="minAmount" name="min_amount" class="form-control"
                                        placeholder="e.g., 5000" required>
                                </div>

                                <div class="form-group">
                                    <label for="interestRate">Interest Rate (%)</label>
                                    <input type="number" id="interestRate" name="interest_rate" class="form-control"
                                        placeholder="e.g., 10" step="0.01" required>
                                </div>

                                <div class="form-group">
                                    <label for="status">Status</label>
                                    <select id="status" name="status" class="form-control">
                                        <option value="active">Active</option>
                                        <option value="inactive">Inactive</option>
                                    </select>
                                </div>

                                <button type="submit" class="btn btn-primary mt-3">Create Loan</button>
                            </form>

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
