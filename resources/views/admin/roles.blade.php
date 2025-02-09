@extends('layouts.admin')

@section('title')
Roles
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
                        <h4 class="card-title">Roles List</h4>
                    </div>
                    <div class="card-body">
                        <!-- Table displaying roles or a message if no roles exist -->
                        @if($roles->isEmpty())
                        <p>Nothing yet. Add a new role below.</p>
                        @else
                        <div class="table-responsive">
                            <table id="example" class="display table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>S/N</th>
                                        <th>Role Name</th>
                                        <th>Date Created</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>S/N</th>
                                        <th>Role Name</th>
                                        <th>Date Created</th>
                                        <th>Action</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    @foreach($roles as $role)
                                    <tr>
                                        <!-- Serial Number Column -->
                                        <td>{{ $loop->iteration }}</td>

                                        <!-- Role Details -->
                                        <td>{{ $role->role_name }}</td>
                                        <td>{{ $role->created_at->format('Y-m-d') }}</td>

                                        <!-- Action Buttons -->
                                        <td>
                                            <!-- Delete Button -->
                                            <form action="{{ route('adminroledestroy', $role->id) }}" method="POST" style="display:inline-block;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this role?')">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Card for role creation form -->
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Create Role</h4>
                    </div>
                    <div class="card-body">
                        <!-- Role Creation Form -->
                        <form action="{{ route('adminrolestore') }}" method="POST">
                            @csrf

                            <!-- Display error for role_name -->
                            @if ($errors->has('role_name'))
                            <div class="alert alert-danger">
                                {{ $errors->first('role_name') }}
                            </div>
                            @endif

                            <div class="mb-3">
                                <label for="roleName" class="form-label">Role Name</label>
                                <input type="text" class="form-control" id="roleName" name="role_name" required value="{{ old('role_name') }}">
                            </div>

                            <button type="submit" class="btn btn-primary">Create Role</button>
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