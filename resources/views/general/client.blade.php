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
                    <h3 class="fw-bold mb-3">Clients</h3>
                    <h6 class="op-7 mb-2">A list of all Clients/Accounts</h6>
                </div>


                <div class="d-flex ms-md-auto py-2 py-md-0">
                    <!-- Button to trigger modal for creating account -->
                    <a href="/account" class="btn btn-dark btn-round me-2">
                        Create Account
                    </a>



                    <!-- Button to trigger modal for creating client -->
                    <a href="#" class="btn btn-primary btn-round" data-bs-toggle="modal"
                        data-bs-target="#addBranchModal">
                        Create Client
                    </a>
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
                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>passport</th>
                                            <th>Client Name</th>
                                            <th>Officer</th>
                                            <th>Gender</th>
                                            <th>Phone Number</th>
                                            <th>Address</th>
                                            <th>Bank Name</th>
                                            <th>Account Number</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    @php
                                        use App\Models\Client;
                                        $clients = Client::with('officer')->get();
                                    @endphp

                                    <tbody>
                                        @forelse($clients as $client)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>
                                                    @if ($client->upload)
                                                        <img src="{{ asset('storage/' . $client->upload) }}"
                                                            alt="Uploaded Picture"
                                                            style="width: 50px; height: 50px; object-fit: cover; border-radius: 4px;">
                                                    @else
                                                        <span>N/A</span>
                                                    @endif
                                                </td>

                                                <td>{{ $client->user->name ?? 'N/A' }}</td>
                                                <td>{{ $client->officer?->first_name ?? 'N/A' }}</td>
                                                <td>{{ $client->phone_number }}</td>
                                                <td>{{ $client->address }}</td>
                                                <td>{{ $client->bank_name }}</td>
                                                <td>{{ $client->account_no }}</td>
                                                <td>{{ $client->g_name }}</td>
                                                <td>
                                                    <a href="{{ route('clientshow', $client->id) }}"
                                                        class="btn btn-primary btn-sm">View</a>
                                                    <a href="{{ route('clientedit', $client->id) }}"
                                                        class="btn btn-warning btn-sm">Edit</a>
                                                    <form action="{{ route('clientdelete', $client->id) }}" method="POST"
                                                        style="display:inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="10" class="text-center">No clients found.</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>




    <!-- client Modal -->
    <div class="modal fade" id="addBranchModal" tabindex="-1" aria-labelledby="addBranchModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl"> <!-- Set the modal to large -->
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addBranchModalLabel">Update Account</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body m-4">
                    <form action="{{ route('clientstore') }}" method="POST" enctype="multipart/form-data">

                        @csrf

                        @error('field_name')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror

                        <div class="step" id="step-1">
                            <h3>Find User account</h3>

                            <div class="mb-3">
                                <label for="search_user" class="form-label">Search User</label>
                                <input type="text" class="form-control" id="search_user" name="search_user"
                                    placeholder="Enter name or email to search">
                                <ul id="search_results" class="list-group mt-2 d-none"></ul>
                            </div>

                            <input type="hidden" name="user_id" id="user_id">

                            <script>
                                const searchInput = document.getElementById('search_user');
                                const resultsList = document.getElementById('search_results');

                                searchInput.addEventListener('input', function() {
                                    const query = searchInput.value.trim();

                                    if (query.length >= 2) { // Trigger search if input is 2 or more characters
                                        fetch(`/search-user?query=${encodeURIComponent(query)}`)
                                            .then(response => response.json())
                                            .then(data => {
                                                console.log(data); // Log the response data to the console
                                                resultsList.innerHTML = ''; // Clear previous results
                                                if (data.length > 0) {
                                                    resultsList.classList.remove('d-none');
                                                    data.forEach(user => {
                                                        const li = document.createElement('li');
                                                        li.className = 'list-group-item list-group-item-action';
                                                        li.textContent = `${user.name} (${user.email})`;
                                                        li.addEventListener('click', function() {
                                                            // Populate fields when a user is selected
                                                            document.getElementById('user_id').value = user
                                                            .id; // Populate the hidden user_id field
                                                            document.getElementById('full_name').value = user.name;
                                                            document.getElementById('email').value = user.email;
                                                            resultsList.classList.add(
                                                            'd-none'); // Hide the results list
                                                        });
                                                        resultsList.appendChild(li);
                                                    });
                                                } else {
                                                    resultsList.classList.remove('d-none');
                                                    const li = document.createElement('li');
                                                    li.className = 'list-group-item text-danger';
                                                    li.textContent = 'User not found. Please create first.';
                                                    resultsList.appendChild(li);
                                                }
                                            })
                                            .catch(error => {
                                                console.error('Error fetching search results:', error);
                                            });
                                    } else {
                                        resultsList.classList.add('d-none'); // Hide the list if query is too short
                                    }
                                });

                                // Hide results if clicked outside
                                document.addEventListener('click', function(event) {
                                    if (!resultsList.contains(event.target) && event.target !== searchInput) {
                                        resultsList.classList.add('d-none');
                                    }
                                });
                            </script>



                            <div class="step" id="step-1">
                                <h3>Step 1: Personal Information</h3>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="full_name" class="form-label">Full Name</label>
                                        <input type="text" class="form-control" id="full_name" name="full_name" required
                                            value="{{ old('full_name') }}">
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="email" class="form-label">Email Address</label>
                                        <input type="email" class="form-control" id="email" name="email" required
                                            value="{{ old('email') }}">
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="officer" class="form-label">Assign Officer</label>
                                        <select name="officer" id="officer" class="form-control" required>
                                            <option value="">-- Select Officer --</option>
                                            @foreach ($officers as $officer)
                                                <option value="{{ $officer->id }}">{{ $officer->first_name }}</option>
                                            @endforeach

                                        </select>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="dob" class="form-label">Date of Birth</label>
                                        <input type="date" class="form-control" id="dob" name="dob"
                                            value="{{ old('dob') }}">
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="gender" class="form-label">Gender</label>
                                        <select class="form-select" id="gender" name="gender">
                                            <option value="">select ---</option>
                                            <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>Male
                                            </option>
                                            <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>
                                                Female
                                            </option>
                                            <option value="other" {{ old('gender') == 'other' ? 'selected' : '' }}>Other
                                            </option>
                                        </select>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="marital_status" class="form-label">Marital Status</label>
                                        <select class="form-select" id="marital_status" name="marital_status">
                                            <option value="">select ---</option>
                                            <option value="single"
                                                {{ old('marital_status') == 'single' ? 'selected' : '' }}>
                                                Single</option>
                                            <option value="married"
                                                {{ old('marital_status') == 'married' ? 'selected' : '' }}>
                                                Married</option>
                                            <option value="divorced"
                                                {{ old('marital_status') == 'divorced' ? 'selected' : '' }}>Divorced
                                            </option>
                                        </select>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="tin" class="form-label">TIN</label>
                                        <input type="text" class="form-control" id="tin" name="tin"
                                            value="{{ old('tin') }}">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="phone_number" class="form-label">Phone Number</label>
                                        <input type="text" class="form-control" id="phone_number" name="phone_number"
                                            value="{{ old('phone_number') }}">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="address" class="form-label">Address</label>
                                        <textarea class="form-control" id="address" name="address" rows="1">{{ old('address') }}</textarea>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="identification_type" class="form-label">Identification Type</label>
                                        <select class="form-select" id="identification_type" name="identification_type">
                                            <option value="">select ---</option>
                                            <option value="NIN"
                                                {{ old('identification_type') == 'NIN' ? 'selected' : '' }}>NIN</option>
                                            <option value="driver's license"
                                                {{ old('identification_type') == 'drivers licence' ? 'selected' : '' }}>
                                                Drivers
                                                licence</option>
                                            <option value="Voter's Card"
                                                {{ old('identification_type') == 'Voters Card' ? 'selected' : '' }}>Voters
                                                Card
                                            </option>
                                            <option value="Int_passport"
                                                {{ old('identification_type') == 'International Passport' ? 'selected' : '' }}>
                                                International Passport</option>
                                        </select>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="id_no" class="form-label">Identification No.</label>
                                        <input type="text" class="form-control" id="id_no" name="id_no"
                                            value="{{ old('id_no') }}">
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="upload" class="form-label">Upload Document (ID document) </label>
                                        <input type="file" class="form-control" id="upload" name="upload"
                                            value="{{ old('upload') }}">
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="utility_bill" class="form-label">Utility Bill </label>
                                        <input type="file" class="form-control" id="utility_bill" name="utility_bill"
                                            value="{{ old('utility_bill') }}">
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="account_type">Select Account Type</label>
                                        <select class="form-control" id="account_type" name="account_type" required>
                                            <option value="" disabled selected>-- Select --</option>
                                            <option value="savings">Savings</option>
                                            <option value="loan">Loan</option>
                                            <option value="investment">Investment</option>
                                        </select>
                                    </div>
                                    
                                </div>
                            </div>

                            <div class="step" id="step-2">
                                <h3>Step 2: Employment Details</h3>
                                <div class="row">

                                    <div class="col-md-6 mb-3">
                                        <label for="employment_status" class="form-label">Employment Status</label>
                                        <select class="form-select" id="employment_status" name="employment_status">
                                            <option value="">select ---</option>
                                            <option value="employed"
                                                {{ old('employment_status') == 'employed' ? 'selected' : '' }}>Employed
                                            </option>
                                            <option value="self_employed"
                                                {{ old('employment_status') == 'self_employed' ? 'selected' : '' }}>Self
                                                Employed</option>
                                            <option value="student"
                                                {{ old('employment_status') == 'student' ? 'selected' : '' }}>Student
                                            </option>
                                            <option value="other"
                                                {{ old('employment_status') == 'other' ? 'selected' : '' }}>Other</option>
                                        </select>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="job_title" class="form-label">Job Title</label>
                                        <input type="text" class="form-control" id="job_title" name="job_title"
                                            value="{{ old('job_title') }}">
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="monthly_income" class="form-label">Monthly Income</label>
                                        <input type="number" class="form-control" id="monthly_income"
                                            name="monthly_income" value="{{ old('monthly_income') }}">
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="job_duration" class="form-label">Job Duration (Years)</label>
                                        <input type="number" class="form-control" id="job_duration" name="job_duration"
                                            value="{{ old('job_duration') }}">
                                    </div>
                                </div>
                            </div>

                            <div class="step" id="step-3">
                                <h3>Step 3: Bank Details</h3>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="bank_name" class="form-label">Bank name</label>
                                        <input type="text" class="form-control" id="bank_name" name="bank_name"
                                            value="{{ old('bank_name') }}">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="bank_account_type" class="form-label">Bank Account Type</label>
                                        <select class="form-select" id="bank_account_type" name="bank_account_type">
                                            <option value="">select ---</option>
                                            <option value="savings"
                                                {{ old('bank_account_type') == 'savings' ? 'selected' : '' }}>
                                                Savings Loan</option>
                                            <option value="current"
                                                {{ old('bank_account_type') == 'current' ? 'selected' : '' }}>
                                                Current</option>
                                            <option value="fixed" {{ old('bank_account_type') == 'fixed' ? 'selected' : '' }}>
                                                Fixed</option>
                                            <option value="domicillary"
                                                {{ old('bank_account_type') == 'domicillary' ? 'selected' : '' }}>Domicillary
                                                Loan
                                            </option>
                                        </select>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="loan_amount" class="form-label">Account No.</label>
                                        <input type="number" class="form-control" id="loan_amount" name="account_no"
                                            value="{{ old('loan_amount') }}">
                                    </div>
                                </div>
                            </div>
                            <div class="step" id="step-4">
                                <h3>Step 4: Guarantor's Details</h3>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="g_name" class="form-label">Guarantor's Name</label>
                                        <input type="text" class="form-control" id="g_name" name="g_name"
                                            value="{{ old('g_name') }}">
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="g_phone" class="form-label">Phone Number</label>
                                        <input type="number" class="form-control" id="g_phone" name="g_phone"
                                            value="{{ old('g_phone') }}">
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="g_address" class="form-label">Guarantor's Address</label>
                                        <input type="text" class="form-control" id="g_address" name="g_address"
                                            value="{{ old('g_address') }}">
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="g_relationship" class="form-label">Relationship with Guarantor</label>
                                        <input type="text" class="form-control" id="g_relationship"
                                            name="g_relationship" value="{{ old('g_relationship') }}">
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="g_occupation" class="form-label">Guarantor's Occupation</label>
                                        <input type="text" class="form-control" id="g_occupation" name="g_occupation"
                                            value="{{ old('g_occupation') }}">
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="g_passport" class="form-label">Guarantor's Passport</label>
                                        <input type="file" class="form-control" id="g_passport" name="g_passport"
                                            value="{{ old('g_passport') }}">
                                    </div>
                                </div>
                            </div>
                            <div class="step" id="step-5">
                                <h3>Step 5: Review and Submit</h3>
                                <div class="col-md-6 mb-3">
                                    <input type="checkbox"> I agree to the Terms & Conditions of {{ config('app.name') }}
                                </div>
                                <button type="submit" class="btn btn-primary">Submit Application</button>
                            </div>
                    </form>

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
