@extends('layouts.admin')
@section('title')
    Account
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
                                <h4 class="card-title" id="toggleButton">Create User</h4>

                                <!-- Button to go back -->
                                <a href="/client" class="btn btn-dark me-2">Go Back</a>
                            </div>
                        </div>

                        <div class="card-body" id="formContainer" style="display: none;">
                            <div class="table-responsive">
                                <form method="POST" action="{{ route('registerclient') }}">
                                    @csrf
                                    <div class="row">
                                        <!-- Name -->
                                        <div class="col-md-6 mb-3">
                                            <label for="name"
                                                class="form-label @error('name') is-invalid @enderror">Name</label>
                                            <input type="text" class="form-control" id="name" name="name"
                                                value="{{ old('name') }}" required autocomplete="name">
                                            @error('name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                        <!-- Email -->
                                        <div class="col-md-6 mb-3">
                                            <label for="email"
                                                class="form-label @error('email') is-invalid @enderror">Email
                                                address</label>
                                            <input type="email" class="form-control" id="email" name="email"
                                                value="{{ old('email') }}" required autocomplete="email">
                                            @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="row">
                                        <!-- Password -->
                                        <div class="col-md-6 mb-3">
                                            <label for="password"
                                                class="form-label @error('password') is-invalid @enderror">Create
                                                Password</label>
                                            <input type="password" class="form-control" id="password" name="password"
                                                value="{{ old('password') }}" required>
                                            @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                        <!-- Confirm Password -->
                                        <div class="col-md-6 mb-3">
                                            <label for="password_confirm"
                                                class="form-label @error('password_confirm') is-invalid @enderror">Confirm
                                                Password</label>
                                            <input type="password" class="form-control" id="password_confirm"
                                                name="password_confirmation" value="{{ old('password_confirm') }}" required>
                                            @error('password_confirm')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Submit Button -->
                                    <div class="row mb-0">
                                        <div class="col-12 text-md-end text-center">
                                            <button type="submit" class="btn btn-primary">
                                                {{ __('Register') }}
                                            </button>
                                        </div>
                                    </div>
                                </form>
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
                                    <tbody>
                                        @php
                                            use App\Models\User;
                                            $users = User::orderBy('created_at', 'desc')->get();
                                        @endphp
                                        @forelse ($users as $user)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $user->name }}</td>
                                                <td>{{ $user->email }}</td>
                                                <td>{{ $user->created_at->format('Y-m-d H:i:s') }}</td>
                                                <td>
                                                    <!-- Action buttons (Edit, Delete, etc.) -->
                                                    <a href="{{ route('account.edit', $user->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                                    <form action="{{ route('account.destroy', $user->id) }}" method="POST" style="display:inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <!-- Trigger Delete Button -->
                                                        <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#confirmDeleteModal">
                                                            Delete
                                                        </button>
                                
                                                        <!-- Modal for Admin Password -->
                                                        <div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="confirmDeleteModalLabel">Confirm Deletion</h5>
                                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <form id="deleteUserForm" method="POST" action="/account/{{ $user->id }}">
                                                                            @csrf
                                                                            @method('DELETE')
                                                                            <div class="mb-3">
                                                                                <label for="admin_password" class="form-label">Enter Admin Password</label>
                                                                                <input type="password" class="form-control" id="admin_password" name="admin_password" required>
                                                                            </div>
                                                                            <div class="modal-footer">
                                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                                                <button type="submit" class="btn btn-danger">Confirm Delete</button>
                                                                            </div>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </td>
                                            </tr>
                                        @empty
                                                <p class="text-center">No users found</p>
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
