@extends('layouts.admin')

@section('title')
Officers
@endsection

@section('content')
<div class="container">
    @include('includes.session_messages')

    <div class="page-inner">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Edit an Officer</h4>
                    </div>
                    <div class="card-body">
                        <!-- Branch Edit Form -->

                            <form action="{{ route('adminloanofficerupdate', $officer->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <fieldset>
                                    <legend>Personal Information</legend>

                                    <!-- First Name and Last Name -->
                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <label for="firstName" class="form-label">First Name:</label>
                                            <input type="text" class="form-control" id="firstName" name="first_name" value="{{ old('first_name', $officer->first_name) }}" required>
                                            @error('first_name')
                                            <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="col-md-6">
                                            <label for="lastName" class="form-label">Last Name:</label>
                                            <input type="text" class="form-control" id="lastName" name="last_name" value="{{ old('last_name', $officer->last_name) }}" required>
                                            @error('last_name')
                                            <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Gender and Date of Birth -->
                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <label for="gender" class="form-label">Gender:</label>
                                            <select id="gender" name="gender" class="form-select" required>
                                                <option value="male" {{ $officer->gender == 'male' ? 'selected' : '' }}>Male</option>
                                                <option value="female" {{ $officer->gender == 'female' ? 'selected' : '' }}>Female</option>
                                                <option value="other" {{ $officer->gender == 'other' ? 'selected' : '' }}>Other</option>
                                            </select>
                                            @error('gender')
                                            <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="col-md-6">
                                            <label for="dob" class="form-label">Date of Birth:</label>
                                            <input type="date" class="form-control" id="dob" name="dob" value="{{ old('dob', $officer->dob) }}" required>
                                            @error('dob')
                                            <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Nationality and Phone -->
                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <label for="nationality" class="form-label">Nationality:</label>
                                            <input type="text" class="form-control" id="nationality" name="nationality" value="{{ old('nationality', $officer->nationality) }}" required>
                                            @error('nationality')
                                            <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="col-md-6">
                                            <label for="phone" class="form-label">Phone Number:</label>
                                            <input type="tel" class="form-control" id="phone" name="phone" value="{{ old('phone', $officer->phone) }}" required>
                                            @error('phone')
                                            <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Email and Street Address -->
                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <label for="email" class="form-label">Email Address:</label>
                                            <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $officer->email) }}" required>
                                            @error('email')
                                            <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="col-md-6">
                                            <label for="streetAddress" class="form-label">Street Address:</label>
                                            <input type="text" class="form-control" id="streetAddress" name="street_address" value="{{ old('street_address', $officer->street_address) }}" required>
                                            @error('street_address')
                                            <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- City and State -->
                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <label for="city" class="form-label">City:</label>
                                            <input type="text" class="form-control" id="city" name="city" value="{{ old('city', $officer->city) }}" required>
                                            @error('city')
                                            <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="col-md-6">
                                            <label for="state" class="form-label">State/Province:</label>
                                            <input type="text" class="form-control" id="state" name="state" value="{{ old('state', $officer->state) }}" required>
                                            @error('state')
                                            <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Postal Code and SSN -->
                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <label for="postalCode" class="form-label">Postal Code:</label>
                                            <input type="text" class="form-control" id="postalCode" name="postal_code" value="{{ old('postal_code', $officer->postal_code) }}" required>
                                            @error('postal_code')
                                            <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="col-md-6">
                                            <label for="ssn" class="form-label">Social Security Number (SSN) or National ID:</label>
                                            <input type="text" class="form-control" id="ssn" name="ssn" value="{{ old('ssn', $officer->ssn) }}" required>
                                            @error('ssn')
                                            <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Profile Picture -->
                                    <div class="row mb-3">
                                        <div class="col-md-12">
                                            <label for="profilePicture" class="form-label">Profile Picture:</label>
                                            <input type="file" class="form-control" id="profilePicture" name="profile_picture">
                                            <!-- Show existing profile picture if available -->
                                            @if($officer->profile_picture)
                                            <img src="{{ asset('storage/'.$officer->profile_picture) }}" alt="Profile Picture" class="img-thumbnail mt-2" width="100">
                                            @endif
                                            @error('profile_picture')
                                            <small class="text-danger">{{ $message }}</small>
                                            @enderror
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
                                            <input type="text" class="form-control" id="employee_id" name="employee_id" value="{{ old('employee_id', $officer->employee_id) }}" required>
                                            @error('employee_id')
                                            <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="col-md-6">
                                            <label for="role" class="form-label">Role:</label>
                                            <select class="form-select" id="role_id" name="role_id" required>
                                                <option value="">Select Role</option>
                                                @foreach($roles as $role)
                                                <option value="{{ $role->id }}" {{ old('role_id', $officer->role_id) == $role->id ? 'selected' : '' }}>
                                                    {{ $role->role_name }}
                                                </option>
                                                @endforeach
                                            </select>
                                            @error('role_id')
                                            <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Branch and Manager -->
                                    <div class="row mb-3">
                                        <!-- Branch Field (Read-Only) -->
                                        <div class="col-md-6">
                                            <label for="branch" class="form-label">Branch:</label>
                                            <input type="text" id="branch" name="branch" class="form-control" value="{{ old('branch', $officer->branch) }}" readonly>

                                            @error('branch')
                                            <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>

                                        <!-- Manager Dropdown -->
                                        <div class="col-md-6">
                                            <label for="manager" class="form-label">Manager:</label>
                                            <select class="form-select" id="manager_id" name="manager_id" required onchange="updateBranch()">
                                                <option value="">Select Manager</option>
                                                @foreach($managers as $manager)
                                                <option value="{{ $manager->id }}" data-branch="{{ $manager->branch->branch_name }}"
                                                    {{ old('manager_id', $officer->manager_id) == $manager->id ? 'selected' : '' }}>
                                                    {{ $manager->name }}
                                                </option>
                                                @endforeach
                                            </select>
                                            @error('manager_id')
                                            <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>

                                    <script>
                                        function updateBranch() {
                                            const managerSelect = document.getElementById('manager_id');
                                            const branchInput = document.getElementById('branch');

                                            const selectedOption = managerSelect.options[managerSelect.selectedIndex];
                                            const branchName = selectedOption.getAttribute('data-branch');

                                            branchInput.value = branchName || '';
                                        }
                                    </script>

                                    <!-- Date of Hire and Employment Status -->
                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <label for="dateOfHire" class="form-label">Date of Hire:</label>
                                            <input type="date" class="form-control" id="dateOfHire" name="date_of_hire" value="{{ old('date_of_hire', $officer->date_of_hire) }}" required>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="employmentStatus" class="form-label">Employment Status:</label>
                                            <select id="employmentStatus" name="employment_status" class="form-select" required>
                                                <option value="active" {{ $officer->employment_status == 'active' ? 'selected' : '' }}>Active</option>
                                                <option value="onLeave" {{ $officer->employment_status == 'onLeave' ? 'selected' : '' }}>On Leave</option>
                                                <option value="terminated" {{ $officer->employment_status == 'terminated' ? 'selected' : '' }}>Terminated</option>
                                            </select>
                                        </div>
                                    </div>

                                    <!-- Employment Type and Work Schedule -->
                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <label for="employmentType" class="form-label">Type of Employment:</label>
                                            <select id="employmentType" name="employment_type" class="form-select" required>
                                                <option value="fullTime" {{ $officer->employment_type == 'fullTime' ? 'selected' : '' }}>Full-Time</option>
                                                <option value="partTime" {{ $officer->employment_type == 'partTime' ? 'selected' : '' }}>Part-Time</option>
                                                <option value="contract" {{ $officer->employment_type == 'contract' ? 'selected' : '' }}>Contract</option>
                                            </select>
                                            @error('employment_type')
                                            <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="col-md-6">
                                            <label for="workSchedule" class="form-label">Work Schedule:</label>
                                            <input type="text" class="form-control" id="workSchedule" name="work_schedule" value="{{ old('work_schedule', $officer->work_schedule) }}" required>
                                            @error('work_schedule')
                                            <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Submit Button -->
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-primary">Save Changes</button>
                                    </div>
                                </fieldset>
                            </form>



                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection