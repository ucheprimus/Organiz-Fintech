@extends('layouts.admin')

@section('title')
    Unions
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
                    <h3 class="fw-bold mb-3">Unions</h3>
                    <h6 class="op-7 mb-2">All Unions and their details</h6>
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


            <div class="row">
                <!-- Card for displaying list of roles -->
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Unions / Groups </h4>
                        </div>
                        <div class="card-body">
                            <!-- Table displaying roles or a message if no roles exist -->

                            <div class="table-responsive">
                                <table id="example" class="display table table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th>S/N</th>
                                            <th>Union Name</th>
                                            <th>Leader</th>
                                            <th>Members</th>
                                            <th>Union Officer</th>
                                            <th>Date Created</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>S/N</th>
                                            <th>Union Name</th>
                                            <th>Leader</th>
                                            <th>Members</th>
                                            <th>Union Officer</th>
                                            <th>Date Created</th>
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>

                                        @php
                                            use App\Models\Union;
                                            $unions = Union::orderBy('created_at', 'desc')->get();
                                        @endphp
                                        @foreach ($unions as $index => $union)
                                            <tr>
                                                <td>{{ $index + 1 }}</td>
                                                <td>{{ $union->union_name }}</td>
                                                <td>{{ $union->union_leader }}</td>
                                                <td>{{ $union->number_of_members }}</td>
                                                <td>{{ $union->officer->first_name ?? 'No Officer Assigned' }}</td>
                                                <td>{{ $union->created_at->format('d-m-Y') }}</td>

                                                <td>

                                                    <style>
                                                        .d-flex {
                                                            gap: 5px;
                                                            /* Adjust the spacing between buttons */
                                                        }
                                                    </style>
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <!-- View Button -->
                                                        <a href="{{ route('adminunionshow', $union->id) }}"
                                                            class="btn btn-sm btn-success">View</a>

                                                        <!-- Edit Button -->
                                                        <a href="{{ route('adminunionedit', $union->id) }}"
                                                            class="btn btn-sm btn-primary">Edit</a>

                                                        <!-- Delete Button -->
                                                        <form action="{{ route('adminuniondestroy', $union->id) }}"
                                                            method="POST" style="margin: 0;">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-sm btn-danger"
                                                                onclick="return confirm('Are you sure you want to delete this union?')">Delete</button>

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
        <div class="modal-dialog modal-lg"> <!-- Set the modal to large -->
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addBranchModalLabel">Create Manager</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <form action="{{ route('adminunionstore') }}" method="POST">
                        @csrf

                        <div class="container">
                            <div class="row">
                                <!-- Union Name -->
                                <div class="col-md-6 mb-3">
                                    <label for="unionName" class="form-label">Union Name</label>
                                    <input type="text" class="form-control" id="unionName" name="union_name" required>
                                </div>

                                <!-- Union Leader -->
                                <div class="col-md-6 mb-3">
                                    <label for="unionLeader" class="form-label">Union Leader</label>
                                    <input type="text" class="form-control" id="unionLeader" name="union_leader"
                                        required>
                                </div>
                            </div>

                            <div class="row">
                                <!-- Number of Members -->
                                <div class="col-md-6 mb-3">
                                    <label for="numberOfMembers" class="form-label">Number of Members</label>
                                    <input type="number" class="form-control" id="numberOfMembers" name="number_of_members"
                                        required>
                                </div>

                                <!-- Location -->
                                <div class="col-md-6 mb-3">
                                    <label for="location" class="form-label">Location</label>
                                    <input type="text" class="form-control" id="location" name="location" required>
                                </div>
                            </div>

                            <div class="row">
                                <!-- Union Officer Selection -->
                                <div class="col-md-6 mb-3">
                                    <label for="union_officer" class="form-label">Union Officer</label>
                                    <select name="union_officer" id="union_officer" class="form-control" required>
                                        <option value="" disabled selected>Select Union Officer</option>
                                        @foreach ($officers as $officer)
                                            <option value="{{ $officer->id }}">
                                                {{ $officer->first_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="row">
                                <!-- Branch (Auto-updated) -->
                                <div class="col-md-6 mb-3">
                                    <label for="branch" class="form-label">Branch</label>
                                    <input type="text" class="form-control" id="branch" name="branch_name" readonly>
                                </div>

                                <!-- Manager (Auto-updated) -->
                                <div class="col-md-6 mb-3">
                                    <label for="manager" class="form-label">Manager</label>
                                    <input type="text" class="form-control" id="manager" name="manager_name"
                                        readonly>
                                </div>
                            </div>

                            <div class="row">
                                <!-- Submit Button -->
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-primary">Create Union</button>
                                </div>
                            </div>
                        </div>
                    </form>


                    <script>
                        const officersData = @json($officers);
                        console.log(officersData);
                    </script>


                    <script>
                        document.getElementById('union_officer').addEventListener('change', function() {
                            const selectedOfficerId = this.value;

                            // Find the selected officer in the officersData
                            const selectedOfficer = officersData.find(officer => officer.id == selectedOfficerId);

                            if (selectedOfficer) {
                                // Update the branch and manager fields
                                document.getElementById('branch').value = selectedOfficer.manager?.branch?.branch_name ||
                                    'No branch assigned';
                                document.getElementById('manager').value = selectedOfficer.manager?.name || 'No manager assigned';
                            } else {
                                // Clear the fields if no officer is selected
                                document.getElementById('branch').value = '';
                                document.getElementById('manager').value = '';
                            }
                        });
                    </script>
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
