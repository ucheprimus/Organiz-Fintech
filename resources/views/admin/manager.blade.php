@extends('layouts.admin')
@section('title')
Manager
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
                <h3 class="fw-bold mb-3">Managers</h3>
                <h6 class="op-7 mb-2">A list of all managers</h6>
            </div>
            <div class="ms-md-auto py-2 py-md-0">
                <!-- <a href="#" class="btn btn-label-info btn-round me-2">Manage</a> -->
                <!-- Button to trigger the modal -->
                <!-- Button to trigger modal -->
                <a href="#" class="btn btn-primary btn-round" data-bs-toggle="modal" data-bs-target="#addBranchModal">
                    Add Manager
                </a>

            </div>
        </div>


        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Basic Manager Table</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="example" class="display table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>S/N</th>
                                        <th>Manager's Name</th>
                                        <th>Email</th>
                                        <th>Phone Number</th>
                                        <th>Branch</th>
                                        <th>Role</th>
                                        <th>Date Created</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>S/N</th>
                                        <th>Manager's Name</th>
                                        <th>Email</th>
                                        <th>Phone Number</th>
                                        <th>Branch</th>
                                        <th>Role</th>
                                        <th>Date Created</th>
                                        <th>Action</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    @foreach($managers as $manager)
                                    <tr>
                                        <!-- Serial Number Column -->
                                        <td>{{ $loop->iteration }}</td>

                                        <!-- Manager's Name -->
                                        <td>{{ $manager->name }}</td>

                                        <!-- Manager's Email -->
                                        <td>{{ $manager->email }}</td>

                                        <!-- Manager's Phone Number -->
                                        <td>{{ $manager->phone_number }}</td>

                                        <!-- Branch Name (related) -->
                                        <td>{{ $manager->branch->branch_name }}</td>

                                        <!-- Role Name (related) -->
                                        <td>{{ $manager->role->role_name }}</td>

                                        <!-- Date Created -->
                                        <td>{{ $manager->created_at->format('Y-m-d') }}</td>

                                        <!-- Action Buttons -->
                                        <td>
                                            <!-- Edit Button -->
                                            <a href="{{ route('adminmanageredit', $manager->id) }}" class="btn btn-primary btn-sm">Edit</a>

                                            <!-- Delete Button -->
                                            <form action="{{ route('adminmanagerdestroy', $manager->id) }}" method="POST" style="display:inline-block;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this manager?')">Delete</button>
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
    <div class="modal-dialog modal-lg"> <!-- Set the modal to large -->
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addBranchModalLabel">Create Manager</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Manager form -->
                <form action="{{ route('adminmanagerstore') }}" method="POST">
                    @csrf

                    <div class="row"> <!-- Use Bootstrap grid to structure form fields -->
                        <!-- Manager Name -->
                        <div class="col-md-6 mb-3">
                            <label for="name" class="form-label">Manager Name</label>
                            <input type="text" class="form-control" id="name" name="name" required value="{{ old('name') }}">
                        </div>

                        <!-- Manager Email -->
                        <div class="col-md-6 mb-3">
                            <label for="email" class="form-label">Manager Email</label>
                            <input type="email" class="form-control" id="email" name="email" required value="{{ old('email') }}">
                        </div>

                        <!-- Manager Phone -->
                        <div class="col-md-6 mb-3">
                            <label for="phone_number" class="form-label">Phone Number</label>
                            <input type="text" class="form-control" id="phone_number" name="phone_number" required value="{{ old('phone_number') }}">
                        </div>

                        <!-- Branch Assignment -->
                        <div class="col-md-6 mb-3">
                            <label for="branch_id" class="form-label">Select Branch</label>
                            <select class="form-select" id="branch_id" name="branch_id" required>
                                <option value="">Select Branch</option>
                                @foreach($branches as $branch)
                                <option value="{{ $branch->id }}" {{ old('branch_id') == $branch->id ? 'selected' : '' }}>{{ $branch->branch_name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Role Assignment -->
                        <div class="col-md-6 mb-3">
                            <label for="role_id" class="form-label">Select Role</label>
                            <select class="form-select" id="role_id" name="role_id" required>
                                <option value="">Select Role</option>
                                @foreach($roles as $role)
                                <option value="{{ $role->id }}" {{ old('role_id') == $role->id ? 'selected' : '' }}>{{ $role->role_name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Start Date -->
                        <div class="col-md-6 mb-3">
                            <label for="start_date" class="form-label">Start Date</label>
                            <input type="date" class="form-control" id="start_date" name="start_date" required value="{{ old('start_date') }}">
                        </div>

                        <!-- Salary -->
                        <div class="col-md-6 mb-3">
                            <label for="salary" class="form-label">Salary</label>
                            <input type="number" class="form-control" id="salary" name="salary" placeholder="salary in &#8358;" required value=" {{ old('salary') }}">
                        </div>

                        <!-- Manager Status -->
                        <div class="col-md-6 mb-3">
                            <label for="status" class="form-label">Status</label>
                            <select class="form-select" id="status" name="status" required>
                                <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Active</option>
                                <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                            </select>
                        </div>

                        <!-- Manager Password (if authentication is needed) -->
                        <div class="col-md-6 mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>

                    </div> <!-- End of row -->

                    <button type="submit" class="btn btn-primary">Create Manager</button>
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