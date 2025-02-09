@extends('layouts.admin')

@section('title')
Dashboard
@endsection

@section('content')
<div class="container">
    @include('includes.session_messages')

    <div class="page-inner">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Edit Manager</h4>
                    </div>
                    <div class="card-body">
                        <!-- Branch Edit Form -->

                        <form action="{{ route('adminmanagerupdate', $manager->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="row">
                                <!-- Manager Name -->
                                <div class="mb-3">
                                    <label for="name" class="form-label">Manager Name</label>
                                    <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $manager->name) }}" required>
                                </div>

                                <!-- Manager Email -->
                                <div class="col-md-6 mb-3">
                                    <label for="email" class="form-label">Manager Email</label>
                                    <input type="email" class="form-control" id="email" name="email" required value="{{ old('email', $manager->email) }}">
                                </div>

                                <!-- Manager Phone -->
                                <div class="col-md-6 mb-3">
                                    <label for="phone_number" class="form-label">Phone Number</label>
                                    <input type="text" class="form-control" id="phone_number" name="phone_number" required value="{{ old('phone_number', $manager->phone_number) }}">
                                </div>

                                <!-- Branch Assignment -->
                                <div class="col-md-6 mb-3">
                                    <label for="branch_id" class="form-label">Select Branch</label>
                                    <select class="form-select" id="branch_id" name="branch_id" required>
                                        <option value="">Select Branch</option>
                                        @foreach($branches as $branch)
                                        <option value="{{ $branch->id }}" {{ old('branch_id', $manager->branch_id) == $branch->id ? 'selected' : '' }}>
                                            {{ $branch->branch_name }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>

                                <!-- Role Assignment -->
                                <div class="col-md-6 mb-3">
                                    <label for="role_id" class="form-label">Select Role</label>
                                    <select class="form-select" id="role_id" name="role_id" required>
                                        <option value="">Select Role</option>
                                        @foreach($roles as $role)
                                        <option value="{{ $role->id }}" {{ old('role_id', $manager->role_id) == $role->id ? 'selected' : '' }}>
                                            {{ $role->role_name }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>

                                <!-- Start Date -->
                                <div class="col-md-6 mb-3">
                                    <label for="start_date" class="form-label">Start Date</label>
                                    <input type="date" class="form-control" id="start_date" name="start_date" required value="{{ old('start_date', $manager->start_date) }}">
                                </div>

                                <!-- Salary -->
                                <div class="col-md-6 mb-3">
                                    <label for="salary" class="form-label">Salary</label>
                                    <input type="number" class="form-control" id="salary" name="salary" placeholder="Salary in ₦" required value="{{ old('salary', $manager->salary) }}">
                                </div>

                                <!-- Manager Status -->
                                <div class="col-md-6 mb-3">
                                    <label for="status" class="form-label">Status</label>
                                    <select class="form-select" id="status" name="status" required>
                                        <option value="active" {{ old('status', $manager->status) == 'active' ? 'selected' : '' }}>Active</option>
                                        <option value="inactive" {{ old('status', $manager->status) == 'inactive' ? 'selected' : '' }}>Inactive</option>
                                    </select>
                                </div>

                                <!-- Password (Optional) -->
                                <div class="col-md-6 mb-3">
                                    <label for="password" class="form-label">Password (Leave blank to keep current password)</label>
                                    <input type="password" class="form-control" id="password" name="password">
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary">Update Manager</button>
                        </form>


                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection