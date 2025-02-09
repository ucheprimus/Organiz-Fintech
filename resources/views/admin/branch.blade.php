@extends('layouts.admin')
@section('title')
Branch
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
                <h3 class="fw-bold mb-3">Branches</h3>
                <h6 class="op-7 mb-2">A list of all branches</h6>
            </div>
            <div class="ms-md-auto py-2 py-md-0">
                <!-- <a href="#" class="btn btn-label-info btn-round me-2">Manage</a> -->
                <!-- Button to trigger the modal -->
                <!-- Button to trigger modal -->
                <a href="#" class="btn btn-primary btn-round" data-bs-toggle="modal" data-bs-target="#addBranchModal">
                    Create Branch
                </a>

            </div>
        </div>


        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Basic Branch Table</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table
                                id="example"
                                class="display table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>S/N</th>
                                        <th>Branch Name</th>
                                        <th>Location</th>
                                        <th>Branch Code</th>
                                        <th>Date Created</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>S/N</th>
                                        <th>Branch Name</th>
                                        <th>Location</th>
                                        <th>Branch Code</th>
                                        <th>Date Created</th>
                                        <th>Action</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    @foreach($branches as $branch)
                                    <tr>
                                        <!-- Serial Number Column -->
                                        <td>{{ $loop->iteration }}</td> <!-- $loop->iteration gives the serial number -->

                                        <!-- Branch Details -->
                                        <td>{{ $branch->branch_name }}</td>
                                        <td>{{ $branch->branch_location }}</td>
                                        <td>{{ $branch->branch_code }}</td>
                                        <td>{{ $branch->created_at->format('Y-m-d') }}</td>

                                        <!-- Action Buttons -->
                                        <td>
                                            <!-- Edit Button -->
                                            <a href="{{ route('adminbranchedit', $branch->id) }}" class="btn btn-primary btn-sm">Edit</a>

                                            <!-- Delete Button -->
                                            <form action="{{ route('adminbranchdestroy', $branch->id) }}" method="POST" style="display:inline-block;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this branch?')">Delete</button>
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
        </div>
    </div>
</div>




<!-- Modal -->
<div class="modal fade" id="addBranchModal" tabindex="-1" aria-labelledby="addBranchModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addBranchModalLabel">Create Branch</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Branch form -->
                <form action="{{ route('adminbranchstore') }}" method="POST">
                    @csrf

                    <!-- Display error for branch_name -->
                    @if ($errors->has('branch_name'))
                    <div class="alert alert-danger">
                        {{ $errors->first('branch_name') }}
                    </div>
                    @endif

                    <div class="mb-3">
                        <label for="branchName" class="form-label">Branch Name</label>
                        <input type="text" class="form-control" id="branchName" name="branch_name" required value="{{ old('branch_name') }}">
                    </div>

                    <!-- Display error for branch_location -->
                    @if ($errors->has('branch_location'))
                    <div class="alert alert-danger">
                        {{ $errors->first('branch_location') }}
                    </div>
                    @endif

                    <div class="mb-3">
                        <label for="branchLocation" class="form-label">Location</label>
                        <input type="text" class="form-control" id="branchLocation" name="branch_location" required value="{{ old('branch_location') }}">
                    </div>

                    <!-- Branch Code (disabled, generated by JS) -->
                    <div class="mb-3">
                        <label for="branchCode" class="form-label">Branch Code</label>
                        <input type="text" class="form-control" id="branchCode" name="branch_code" required disabled value="{{ old('branch_code') }}">
                    </div>

                    <button type="submit" class="btn btn-primary">Create Branch</button>
                </form>
            </div>
        </div>
    </div>
</div>


<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Get the input fields
        const branchNameInput = document.getElementById('branchName');
        const branchCodeInput = document.getElementById('branchCode');

        // Listen for input on the branch name field
        branchNameInput.addEventListener('input', function() {
            const branchName = branchNameInput.value;

            // Check if the branch name has at least 3 characters
            if (branchName.length >= 3) {
                // Get the first 3 letters of the branch name and convert to uppercase
                const prefix = branchName.slice(0, 3).toUpperCase();

                // Generate a random 5-digit number
                const randomNumber = Math.floor(10000 + Math.random() * 90000);

                // Combine the prefix with the random number
                const branchCode = prefix + randomNumber;

                // Set the branch code in the disabled input field
                branchCodeInput.value = branchCode;
            } else {
                // If the branch name is too short, clear the branch code
                branchCodeInput.value = '';
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

<!-- Include DataTables JS -->
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>

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