@extends('layouts.admin')
@section('title')
    Manager
@endsection
<meta name="csrf-token" content="{{ csrf_token() }}">

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


        <div class="container mt-5">

            <div class="d-flex justify-content-between align-items-center mb-3 mx-2 mx-md-0">
                <!-- Union Details Header -->
                <h2>Union Details</h2>

                <!-- Back to List Button -->
                <div class="card-footer p-0">
                    <a href="{{ route('adminunion') }}" class="btn btn-primary">Back to List</a>
                </div>
            </div>

            <div class="card mx-2 mx-md-0">

                <div class="card-header d-flex justify-content-between align-items-start flex-wrap">
                    <!-- Union Name -->
                    <div class="header-item">
                        <h6 style="margin-bottom: 0;">{{ $union->union_name ?? 'N/A' }}
                            <small style="font-size: 0.8rem; color: #6c757d; display: block; margin-top: -5px;">Union Name
                            </small>
                        </h6>
                    </div>

                    <!-- Union Officer -->
                    <div class="header-item">
                        <h6 style="margin-bottom: 0;">
                            @if ($union->officer)
                                {{ $union->officer->first_name }} {{ $union->officer->last_name }}
                            @else
                                Not Assigned
                            @endif
                        </h6>
                        <small style="font-size: 0.8rem; color: #6c757d; display: block; margin-top: -5px;">Officer</small>
                    </div>

                    <!-- Union Leader -->
                    <div class="header-item">
                        <h6 style="margin-bottom: 0;">{{ $union->union_leader ?? 'N/A' }}</h6>
                        <small style="font-size: 0.8rem; color: #6c757d; display: block; margin-top: -5px;">Leader</small>
                    </div>

                    <!-- Branch -->
                    <div class="header-item">
                        <h6 style="margin-bottom: 0;">
                            @if ($union->officer && $union->officer->manager && $union->officer->manager->branch)
                                {{ $union->officer->manager->branch->branch_name ?? 'N/A' }}
                            @else
                                N/A
                            @endif
                        </h6>
                        <small style="font-size: 0.8rem; color: #6c757d; display: block; margin-top: -5px;">Branch</small>
                    </div>

                    <!-- Manager -->
                    <div class="header-item">
                        <h6 style="margin-bottom: 0;">
                            @if ($union->officer && $union->officer->manager)
                                {{ $union->officer->manager->name ?? 'N/A' }}
                            @else
                                N/A
                            @endif
                        </h6>
                        <small style="font-size: 0.8rem; color: #6c757d; display: block; margin-top: -5px;">Manager</small>
                    </div>

                </div>


                <div class="card-body">


                    <div class="container mt-4">
                        <!-- Tab Navigation -->
                        <ul class="nav nav-tabs justify-content-center" id="unionTabs" role="tablist" style="border: none;">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active custom-tab" id="members-tab" data-bs-toggle="tab"
                                    data-bs-target="#members" type="button" role="tab" aria-controls="members"
                                    aria-selected="true">
                                    Members
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link custom-tab" id="add-db-tab" data-bs-toggle="tab"
                                    data-bs-target="#add-db" type="button" role="tab" aria-controls="add-db"
                                    aria-selected="false">
                                    Add from Database
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link custom-tab" id="create-new-tab" data-bs-toggle="tab"
                                    data-bs-target="#create-new" type="button" role="tab" aria-controls="create-new"
                                    aria-selected="false">
                                    Create New
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link custom-tab" id="group-disbursement-tab" data-bs-toggle="tab"
                                    data-bs-target="#group-disbursement" type="button" role="tab"
                                    aria-controls="group-disbursement" aria-selected="false">
                                    Group Disbursement
                                </button>
                            </li>
                        </ul>


                        <!-- Tab Content -->
                        <div class="tab-content mt-3" id="unionTabsContent">
                            <!-- Members Tab -->
                            <div class="tab-pane fade show active" id="members" role="tabpanel"
                                aria-labelledby="members-tab">
                                <h5>Members</h5>

                                <h1>Members of {{ $union->name }} Union</h1>
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($union->users as $user)
                                            <tr>
                                                <td>{{ $user->name }}</td>
                                                <td>{{ $user->email }}</td>
                                                <td>
                                                    <button class="btn btn-danger btn-sm"
                                                        onclick="showPasswordModal({{ $user->id }})">Remove</button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <!-- Add from Database Tab -->
                            <div class="tab-pane fade" id="add-db" role="tabpanel" aria-labelledby="add-db-tab">
                                <h5>Add from Database</h5>
                                <p>Select existing members from the database to add to this union.</p>

                                <!-- Search Form -->
                                <div class="mb-3">
                                    <label for="search_user" class="form-label">Search User</label>
                                    <input type="text" class="form-control" id="search_user" name="search_user"
                                        placeholder="Enter name or email to search">
                                    <ul id="search_results" class="list-group mt-2 d-none"></ul>
                                </div>

                                <!-- Form to Save Selected Members -->
                                <form id="saveForm" action="/add-user-to-union" method="POST">
                                    @csrf
                                    <input type="hidden" name="union_id" value="{{ $union->id }}">
                                    <!-- Union ID, fixed -->

                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody id="tableBody"></tbody>
                                    </table>

                                    <button id="saveBtn" class="btn btn-primary mt-3 ">Save</button>
                                    <!-- Save Button -->
                                </form>

                            </div>

                            <script>
                                const searchInput = document.getElementById('search_user');
                                const resultsList = document.getElementById('search_results');
                                const tableBody = document.getElementById('tableBody');

                                // Search for users
                                searchInput.addEventListener('input', function() {
                                    const query = searchInput.value.trim();

                                    if (query.length >= 2) {
                                        fetch(`/search-user?query=${encodeURIComponent(query)}`)
                                            .then(response => response.json())
                                            .then(data => {
                                                resultsList.innerHTML = '';
                                                if (data.length > 0) {
                                                    resultsList.classList.remove('d-none');
                                                    data.forEach(user => createSearchResult(user));
                                                } else {
                                                    displayNoResults();
                                                }
                                            })
                                            .catch(error => console.error('Error fetching search results:', error));
                                    } else {
                                        resultsList.classList.add('d-none');
                                    }
                                });

                                // Save user to union (AJAX request to server)
                                function saveUserToUnion(userId) {
                                    fetch('/add-user-to-union', {
                                            method: 'POST',
                                            headers: {
                                                'Content-Type': 'application/json',
                                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                                            },
                                            body: JSON.stringify({
                                                union_id: document.querySelector('[name="union_id"]').value,
                                                user_id: userId,
                                            }),
                                        })
                                        .then((response) => response.json())
                                        .then((data) => {
                                            if (data.success) {
                                                alert(data.message);
                                            } else {
                                                alert(data.message);
                                            }
                                        })
                                        .catch((error) => {
                                            console.error('Error saving user to union:', error);
                                            alert('Failed to add the user to the union.');
                                        });
                                }

                                // Add user to the table and save under union

                                function addUserToUnion(user) {
                                    // Check if user is already in the table
                                    if (document.querySelector(`tr[data-id="${user.id}"]`)) {
                                        alert("User already added to the union.");
                                        return;
                                    }

                                    // Create hidden input for form submission
                                    const userIdInput = document.createElement('input');
                                    userIdInput.type = 'hidden';
                                    userIdInput.name = 'user_id[]'; // Array notation
                                    userIdInput.value = user.id;
                                    document.getElementById('saveForm').appendChild(userIdInput);

                                    // Create table row
                                    const newRow = document.createElement('tr');
                                    newRow.setAttribute('data-id', user.id);
                                    newRow.innerHTML = `
                                        <td>${user.name}</td>
                                        <td>${user.email}</td>
                                        <td><button class="btn btn-danger btn-sm" onclick="removeUser(${user.id})">Remove</button></td>
                                    `;

                                    // Append row to table
                                    document.getElementById('tableBody').appendChild(newRow);

                                    // Show the Save button when users are added
                                    document.getElementById('saveBtn').classList.remove('d-none');
                                }

                                // Remove user from table and form
                                function removeUser(userId) {
                                    document.querySelector(`tr[data-id="${userId}"]`).remove();
                                    document.querySelector(`input[name="user_id[]"][value="${userId}"]`).remove();
                                }


                                // Create search result item
                                function createSearchResult(user) {
                                    const li = document.createElement('li');
                                    li.className = 'list-group-item d-flex justify-content-between align-items-center';
                                    li.textContent = `${user.name} (${user.email})`;

                                    const addButton = document.createElement('button');
                                    addButton.className = 'btn btn-sm btn-success ms-2';
                                    addButton.textContent = 'Add';
                                    addButton.addEventListener('click', () => {
                                        saveUserToUnion(user.id); // Directly save to the union
                                        addUserToTable(user); // Display the user in the table
                                        resultsList.classList.add('d-none'); // Hide results after adding
                                    });

                                    li.appendChild(addButton);
                                    resultsList.appendChild(li);
                                }

                                // Display "No Results" message
                                function displayNoResults() {
                                    resultsList.classList.remove('d-none');
                                    resultsList.innerHTML = `
                                        <li class="list-group-item text-danger">User not found. Please create first.</li>
                                    `;
                                }
                            </script>




                            <!-- Create New Tab -->
                            <div class="tab-pane fade" id="create-new" role="tabpanel" aria-labelledby="create-new-tab">
                                <h5>Create New</h5>
                                <p>Add a new member to the union by filling out their details.</p>



                                <div class="container my-4">
                                    <h2 class="text-center">User Details Table</h2>
                                    <div class="d-flex justify-content-end mb-3">
                                        <button id="addRowBtn" class="btn btn-primary">Add Row</button>
                                    </div>
                                    <table class="table table-bordered table-hover">
                                        <thead class="table-light">
                                            <tr>
                                                <th style="width: 10%; font-size:8px">Full Name</th>
                                                <th style="width: 10%; font-size:8px">Email Address</th>
                                                <th style="width: 10%; font-size:8px">Loan Amount Requested</th>
                                                <th style="width: 10%; font-size:8px">Repayment Schedule</th>
                                                <th style="width: 10%; font-size:8px">Loan Term</th>
                                                <th style="width: 10%; font-size:8px">Type of Loan</th>
                                                <th style="width: 10%; font-size:8px">Interest Rate</th>
                                                <th style="width: 10%; font-size:8px">Repayment Start Date</th>
                                                <th style="width: 10%; font-size:8px">Repayment End Date</th>
                                                <th style="width: 10%; font-size:8px">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody id="tableBody">
                                            <!-- Rows will be added dynamically here -->
                                        </tbody>
                                    </table>
                                    <button id="saveBtn" class="btn btn-success" style="display: none;">Save</button>
                                </div>

                                <script>
                                    // Select the button and table body
                                    const addRowBtn = document.getElementById('addRowBtn');
                                    const tableBody = document.getElementById('tableBody');
                                    const saveBtn = document.getElementById('saveBtn');

                                    // Add a new row when the button is clicked
                                    addRowBtn.addEventListener('click', () => {
                                        // Create a new table row
                                        const newRow = document.createElement('tr');

                                        // Define the columns for the form
                                        const columns = [
                                            'Full Name', 'Email Address', 'Loan Amount Requested', 'Repayment Schedule',
                                            'Loan Term', 'Type of Loan', 'Interest Rate', 'Repayment Start Date', 'Repayment End Date'
                                        ];

                                        // Add the form fields to the row
                                        columns.forEach(column => {
                                            const newCell = document.createElement('td');
                                            const input = document.createElement('input');
                                            input.type = 'text';
                                            input.placeholder = `Enter ${column}`;
                                            newCell.appendChild(input);
                                            newRow.appendChild(newCell);
                                        });

                                        // Add the "Delete" button in the last column
                                        const deleteCell = document.createElement('td');
                                        const deleteBtn = document.createElement('button');
                                        deleteBtn.classList.add('btn', 'btn-danger', 'btn-sm');
                                        deleteBtn.textContent = 'Delete';
                                        deleteBtn.addEventListener('click', () => {
                                            newRow.remove();
                                            toggleSaveButton();
                                        });
                                        deleteCell.appendChild(deleteBtn);
                                        newRow.appendChild(deleteCell);

                                        // Append the new row to the table body
                                        tableBody.appendChild(newRow);

                                        // Show the Save button when a new row is added
                                        toggleSaveButton();
                                    });

                                    // Toggle visibility of Save button
                                    function toggleSaveButton() {
                                        const rows = tableBody.querySelectorAll('tr');
                                        saveBtn.style.display = rows.length > 0 ? 'inline-block' : 'none';
                                    }

                                    // Save the table data (this can be used for actual saving to the database)
                                    saveBtn.addEventListener('click', () => {
                                        const rows = tableBody.querySelectorAll('tr');
                                        const data = [];

                                        rows.forEach(row => {
                                            const inputs = row.querySelectorAll('td input');
                                            const rowData = Array.from(inputs).map(input => input.value);
                                            data.push(rowData);
                                        });

                                        // Example: sending data to the console (you can send it to your server here)
                                        console.log('Table Data to Save:', data);

                                        // You can send this data via AJAX or form submission to save to the database
                                        // Example using fetch API for AJAX request:
                                        // fetch('/save-loan-details', {
                                        //     method: 'POST',
                                        //     body: JSON.stringify(data),
                                        //     headers: {
                                        //         'Content-Type': 'application/json'
                                        //     }
                                        // }).then(response => response.json())
                                        //   .then(result => console.log('Data saved successfully:', result))
                                        //   .catch(error => console.error('Error saving data:', error));
                                    });
                                </script>


                                <style>
                                    /* Make table container scrollable on smaller screens */
                                    .container {
                                        overflow-x: auto;
                                        -webkit-overflow-scrolling: touch;
                                    }

                                    /* Make table more compact */
                                    table {
                                        width: 100%;
                                        table-layout: fixed;
                                    }

                                    table th,
                                    table td {
                                        padding: 5px 10px;
                                        font-size: 0.8rem;
                                        /* Reduced font size for headers and data cells */
                                    }

                                    table td input {
                                        width: 100%;
                                        height: 30px;
                                        /* Reduced height for compactness */
                                        border: 1px solid #ccc;
                                        padding: 5px;
                                        border-radius: 4px;
                                    }

                                    table td input:focus {
                                        outline: none;
                                        border-color: #007bff;
                                    }

                                    /* Adding a fixed width for columns */
                                    th,
                                    td {
                                        text-align: center;
                                        font-size: 0.8rem;
                                        /* Adjusted font size */
                                    }

                                    /* Button styling */
                                    #saveBtn {
                                        margin-top: 20px;
                                        width: 100%;
                                    }
                                </style>



                            </div>
                            <!-- Group Disbursement Tab -->
                            <div class="tab-pane fade" id="group-disbursement" role="tabpanel"
                                aria-labelledby="group-disbursement-tab">
                               
                                <div class="container mt-4">
                                    <h4>Group Loan Disbursement</h4>
                                
                                    <!-- Total Amount Input -->
                                    <div class="mb-3">
                                        <label for="total_amount" class="form-label">Total Amount for Union</label>
                                        <input type="number" id="total_amount" class="form-control" placeholder="Enter total loan amount" min="0">
                                    </div>
                                
                                    <!-- Loan Disbursement Table -->
                                    <form action="/disburse-loan" method="POST">
                                        @csrf
                                        <input type="hidden" name="union_id" value="{{ $union->id }}">
                                        
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>Name</th>
                                                    <th>Email</th>
                                                    <th>Loan Amount</th>
                                                </tr>
                                            </thead>
                                            <tbody id="member_list">
                                                @foreach($union->users as $user)
                                                <tr>
                                                    <td>{{ $user->name }}</td>
                                                    <td>{{ $user->email }}</td>
                                                    <td>
                                                        <input type="number" name="loan_amount[{{ $user->id }}]" class="form-control loan_amount" min="0" data-user-id="{{ $user->id }}">
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody><tbody id="member_list">
                                                @foreach($union->users as $user)
                                                <tr>
                                                    <td>{{ $user->name }}</td>
                                                    <td>{{ $user->email }}</td>
                                                    <td>
                                                        <input type="number" name="loan_amount[{{ $user->id }}]" class="form-control loan_amount" min="0" data-user-id="{{ $user->id }}">
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                
                                        <!-- Submit Button -->
                                        <button type="submit" class="btn btn-primary">Disburse Loan</button>
                                    </form>
                                </div>
                                
                                <script>
                                    document.addEventListener("DOMContentLoaded", function() {
                                        const totalAmountInput = document.getElementById("total_amount");
                                        const loanInputs = document.querySelectorAll(".loan_amount");
                                
                                        // Function to distribute amount evenly
                                        function distributeAmount() {
                                            let totalAmount = parseFloat(totalAmountInput.value) || 0;
                                            let memberCount = loanInputs.length;
                                            let dividedAmount = memberCount > 0 ? (totalAmount / memberCount).toFixed(2) : 0;
                                
                                            loanInputs.forEach(input => {
                                                input.value = dividedAmount;
                                            });
                                        }
                                
                                        // When total amount is changed, distribute it
                                        totalAmountInput.addEventListener("input", distributeAmount);
                                        
                                        // Update total field if a user manually edits any loan amount
                                        loanInputs.forEach(input => {
                                            input.addEventListener("input", function() {
                                                let sum = 0;
                                                loanInputs.forEach(input => {
                                                    sum += parseFloat(input.value) || 0;
                                                });
                                                totalAmountInput.value = sum.toFixed(2); // Update total amount field
                                            });
                                        });
                                    });
                                </script>
                                
                                
                            </div>
                        </div>
                    </div>


                </div>
                <div class="card-footer">
                    <a href="{{ route('adminunion') }}" class="btn btn-primary">Back to List</a>
                </div>
            </div>
        </div>
    </div>


    <!-- Password Confirmation Modal -->
    <div class="modal fade" id="passwordModal" tabindex="-1" aria-labelledby="passwordModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="passwordModalLabel">Admin Password Required</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="passwordForm">
                        <div class="mb-3">
                            <label for="adminPassword" class="form-label">Enter Admin Password</label>
                            <input type="password" class="form-control" id="adminPassword" placeholder="Admin Password"
                                required>
                        </div>
                        <input type="hidden" id="userIdToRemove">
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-danger" onclick="confirmRemove()">Confirm</button>
                </div>
            </div>
        </div>


        <script>
            function showPasswordModal(userId) {
                // Store the user ID in a hidden input field
                document.getElementById('userIdToRemove').value = userId;

                // Show the modal
                const passwordModal = new bootstrap.Modal(document.getElementById('passwordModal'));
                passwordModal.show();
            }

            function confirmRemove() {
                const password = document.getElementById('adminPassword').value;
                const userId = document.getElementById('userIdToRemove').value;

                if (!password) {
                    alert('Please enter the admin password!');
                    return;
                }

                // Send an AJAX request to validate the password and remove the member
                fetch(`/validate-admin-password-and-remove`, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        },
                        body: JSON.stringify({
                            user_id: userId,
                            password: password,
                            union_id: {{ $union->id }},
                        }),
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            alert('User removed successfully!');
                            location.reload(); // Reload the page to update the table
                        } else {
                            alert('Error: ' + data.message);
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('Failed to remove member');
                    });
            }
        </script>
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
