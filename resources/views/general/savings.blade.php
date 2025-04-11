@extends('layouts.admin')
@section('title')
    Savings
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
                    <h3 class="fw-bold mb-3">Savings</h3>
                    <h6 class="op-7 mb-2">Savings record for all Users</h6>
                </div>
                <div class="ms-md-auto py-2 py-md-0">
                    <!-- Add Savings Button -->
                    <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addBranchModal">
                        Add Savings
                    </a>

                    <a href="{{ route('withdraw') }}" class="btn" style="background-color: black; color:white">
                        Withdraw
                    </a>

                </div>

            </div>


            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Basic Savings Table</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="savingsTable" class="table table-bordered table-striped">
                                    
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>User</th>
                                            <th>Total Savings</th>
                                            <th>Withdrawn Amount</th>
                                            <th>Balance</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $counter = 1; @endphp
                                        @foreach ($userSavings as $user)
                                            <tr>
                                                <td>{{ $counter++ }}</td>
                                                <td>{{ $user['name'] }}</td>
                                                <td>₦{{ number_format($user['total_savings'], 2) }}</td>
                                                <td>₦{{ number_format($user['total_withdrawals'], 2) }}</td>
                                                <td>₦{{ number_format($user['current_balance'], 2) }}</td>
                                                <td class="d-flex gap-2">
                                                    <a href="{{ route('savings.show', $user['id']) }}" class="btn btn-info btn-sm">View</a>
                                                    <form action="{{ route('savings.destroy', $user['id']) }}" method="POST"
                                                          onsubmit="return confirm('Are you sure you want to delete this user savings?');">
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

                    <form action="{{ route('savings.store') }}" method="POST">
                        @csrf

                        <div class="row">
                            <!-- Search User Section -->
                            <div class="col-md-12 mb-4">
                                <p>Select an existing user to assign this savings.</p>
                                <div class="mb-3">
                                    <label for="search_user" class="form-label">Search User</label>
                                    <input type="text" class="form-control" id="search_user" name="search_user"
                                        placeholder="Enter name or email">
                                    <ul id="search_results" class="list-group mt-2 d-none"></ul>
                                </div>
                            </div>

                            <!-- Hidden Field to Store Selected User ID -->
                            <input type="hidden" id="selected_user_id" name="user_id">

                            <!-- Account Name (Auto-filled after selecting a user) -->
                            <div class="col-md-6 mb-3">
                                <label for="name" class="form-label">Account Name</label>
                                <input type="text" class="form-control" id="name" name="name" required
                                    value="{{ old('name') }}" readonly>
                            </div>


                            <!-- Savings Amount -->
                            <div class="col-md-6 mb-3">
                                <label for="amount" class="form-label">Savings Amount</label>
                                <input type="text" class="form-control" id="amount" name="amount" required
                                    value="{{ old('amount') }}">
                            </div>

                            <!-- Savings Amount -->
                            <div class="col-md-12 mb-3">
                                <label for="comment">Comment (Optional)</label>
                                <textarea name="comment" class="form-control" rows="2" placeholder="Enter a comment"></textarea>
                            </div>


                        </div>

                        <button type="submit" class="btn btn-primary">Add Savings</button>
                    </form>

                </div>


                <script>
                    document.getElementById('search_user').addEventListener('input', function() {
                        const query = this.value.trim();
                        const resultsList = document.getElementById('search_results');
                        resultsList.innerHTML = ''; // Clear previous results
                        resultsList.classList.remove('d-none');

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

                                            // Add click event to select the user
                                            listItem.addEventListener('click', function() {
                                                document.getElementById('search_user').value = user.name;
                                                document.getElementById('name').value = user
                                                    .name; // Auto-fill name
                                                document.getElementById('selected_user_id').value = user
                                                    .id; // Store user ID
                                                resultsList.classList.add(
                                                    'd-none'); // Hide results after selection
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
