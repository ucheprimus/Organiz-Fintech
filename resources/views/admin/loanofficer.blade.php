@extends('layouts.admin')
@section('title')
Loan officer
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
                <h3 class="fw-bold mb-3">Officers</h3>
                <h6 class="op-7 mb-2">A list of all Loan Officers</h6>
            </div>
            <div class="ms-md-auto py-2 py-md-0">
                <!-- <a href="#" class="btn btn-label-info btn-round me-2">Manage</a> -->
                <!-- Button to trigger the modal -->
                <!-- Button to trigger modal -->
                <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addBranchModal">
                    New Officer
                </a>

            </div>
        </div>


        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Basic Officer Table</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table
                                id="example"
                                class="display table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>S/N</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Role</th>
                                        <th>Manager</th>
                                        <th>Hire date</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>s/n</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Role</th>
                                        <th>Manager</th>
                                        <th>Hire date</th>
                                        <th>Actions</th>
                                    </tr>
                                </tfoot>
                                @php
                                $loanOfficers = App\Models\LoanOfficer::with(['manager', 'role', 'branch'])->get();
                                @endphp

                                <tbody>
                                    @foreach($loanOfficers as $officer)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $officer->first_name }} {{ $officer->last_name }}</td>
                                        <td>{{ $officer->email }}</td>
                                        <td>{{ $officer->phone }}</td>
                                        <td>{{ $officer->role->role_name }}</td> <!-- Displaying role -->
                                        <td>{{ $officer->manager->name ?? 'N/A' }}</td>
                                        <td>{{ $officer->date_of_hire }}</td>
                                        <td>
                                            <div class="d-flex gap-2">

                                                
                                            <a href="{{ route('adminloanofficeredit', ['id' => $officer->id]) }}" class="btn btn-warning">Edit</a>

                                            <form action="{{ route('adminloanofficerdestroy', $officer->id) }}" method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">Delete</button>
                                            </form>

                                            </div>
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
    <div class="modal-dialog modal-xl"> <!-- Modal Size: Large -->
        <div class="modal-content p-5">
            <div class="modal-header">
                <h5 class="modal-title" id="addBranchModalLabel">Add an Officer</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <form action="{{route('adminloanofficerstore')}}" method="post" enctype="multipart/form-data">
                    <!-- Personal Information Section -->
                    @csrf
                    <fieldset>
                        <legend>Personal Information</legend>

                        <!-- First Name and Last Name -->
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="firstName" class="form-label">First Name:</label>
                                <input type="text" class="form-control" id="firstName" name="first_name" required>
                            </div>
                            <div class="col-md-6">
                                <label for="lastName" class="form-label">Last Name:</label>
                                <input type="text" class="form-control" id="lastName" name="last_name" required>
                            </div>
                        </div>

                        <!-- Gender and Date of Birth -->
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="gender" class="form-label">Gender:</label>
                                <select id="gender" name="gender" class="form-select" required>
                                    <option value="male">Male</option>
                                    <option value="female">Female</option>
                                    <option value="other">Other</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="dob" class="form-label">Date of Birth:</label>
                                <input type="date" class="form-control" id="dob" name="dob" required>
                            </div>
                        </div>

                        <!-- Nationality and Phone -->
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="nationality" class="form-label">Nationality:</label>
                                <input type="text" class="form-control" id="nationality" name="nationality" required>
                            </div>
                            <div class="col-md-6">
                                <label for="phone" class="form-label">Phone Number:</label>
                                <input type="tel" class="form-control" id="phone" name="phone" required>
                            </div>
                        </div>

                        <!-- Email and Street Address -->
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="email" class="form-label">Email Address:</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>
                            <div class="col-md-6">
                                <label for="streetAddress" class="form-label">Street Address:</label>
                                <input type="text" class="form-control" id="streetAddress" name="street_address" required>
                            </div>
                        </div>

                        <!-- City and State -->
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="city" class="form-label">City:</label>
                                <input type="text" class="form-control" id="city" name="city" required>
                            </div>
                            <div class="col-md-6">
                                <label for="state" class="form-label">State/Province:</label>
                                <input type="text" class="form-control" id="state" name="state" required>
                            </div>
                        </div>

                        <!-- Postal Code and SSN -->
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="postalCode" class="form-label">Postal Code:</label>
                                <input type="text" class="form-control" id="postalCode" name="postal_code" required>
                            </div>
                            <div class="col-md-6">
                                <label for="ssn" class="form-label">Social Security Number (SSN) or National ID:</label>
                                <input type="text" class="form-control" id="ssn" name="ssn" required>
                            </div>
                        </div>

                        <!-- Profile Picture -->
                        <div class="row mb-3">
                            <div class="col-md-12">
                                <label for="profilePicture" class="form-label">Profile Picture:</label>
                                <input type="file" class="form-control" id="profilePicture" name="profile_picture">
                            </div>
                        </div>
                    </fieldset>

                    <!-- Employment Details Section -->
                    <fieldset>
                        <legend>Employment Details</legend>

                        <!-- Employee ID and Role -->
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="employee_id" class="form-label">Employee ID:</label>
                                <input type="text" class="form-control" id="employee_id" name="employee_id" required>
                            </div>
                            <div class="col-md-6">
                                <label for="role" class="form-label">Role:</label>
                                <select class="form-select" id="role_id" name="role_id" required>
                                    <option value="">Select Role</option>
                                    <!-- Loop through roles dynamically -->
                                    @foreach($roles as $role)
                                    <option value="{{ $role->id }}" {{ old('role_id') == $role->id ? 'selected' : '' }}>{{ $role->role_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <!-- Branch and Manager -->
                        <div class="row mb-3">
                            <!-- Branch Field -->
                            <div class="col-md-6">
                                <label for="branch" class="form-label">Branch:</label>
                                <input type="text" id="branch" name="branch" class="form-control" readonly>
                            </div>

                            <!-- Manager Dropdown -->
                            <div class="col-md-6">
                                <label for="manager" class="form-label">Manager:</label>
                                <select class="form-select" id="manager_id" name="manager_id" required onchange="updateBranch()">
                                    <option value="">Select Manager</option>
                                    @foreach($managers as $manager)
                                    <option
                                        value="{{ $manager->id }}"
                                        data-branch="{{ $manager->branch->branch_name }}">
                                        {{ $manager->name }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <script>
                            function updateBranch() {
                                // Manager dropdown and branch input field
                                const managerSelect = document.getElementById('manager_id');
                                const branchInput = document.getElementById('branch');

                                // Get the selected manager's branch data
                                const selectedOption = managerSelect.options[managerSelect.selectedIndex];
                                const branchName = selectedOption.getAttribute('data-branch');

                                // Update the branch field with the branch name
                                branchInput.value = branchName || '';
                            }
                        </script>




                        <!-- Date of Hire and Employment Status -->
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="dateOfHire" class="form-label">Date of Hire:</label>
                                <input type="date" class="form-control" id="dateOfHire" name="date_of_hire" required>
                            </div>
                            <div class="col-md-6">
                                <label for="employmentStatus" class="form-label">Employment Status:</label>
                                <select id="employmentStatus" name="employment_status" class="form-select" required>
                                    <option value="active">Active</option>
                                    <option value="onLeave">On Leave</option>
                                    <option value="terminated">Terminated</option>
                                </select>
                            </div>
                        </div>

                        <!-- Employment Type and Work Schedule -->
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="employmentType" class="form-label">Type of Employment:</label>
                                <select id="employmentType" name="employment_type" class="form-select" required>
                                    <option value="fullTime">Full-Time</option>
                                    <option value="partTime">Part-Time</option>
                                    <option value="contract">Contract</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="workSchedule" class="form-label">Work Schedule (hours per week):</label>
                                <input type="number" class="form-control" id="workSchedule" name="work_schedule" required>
                            </div>
                        </div>
                    </fieldset>

                    <br>
                    <div class="text-center">
                        <input type="submit" class="btn btn-primary w-100" value="Submit">
                    </div>
                    
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