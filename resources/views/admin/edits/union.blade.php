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
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4 class="card-title">Edit Union</h4>
                        <a href="{{ route('adminunion') }}" class="btn btn-secondary">Go Back</a>
                    </div>
                    
                    <div class="card-body">
                        <!-- Branch Edit Form -->

                    
                        <form action="{{ route('adminunionupdate', $union->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                        
                            <div class="container">
                                <div class="row">
                                    <!-- Union Name -->
                                    <div class="col-md-6 mb-3">
                                        <label for="unionName" class="form-label">Union Name</label>
                                        <input type="text" class="form-control" id="unionName" name="union_name" value="{{ $union->union_name }}" required>
                                    </div>
                        
                                    <!-- Union Leader -->
                                    <div class="col-md-6 mb-3">
                                        <label for="unionLeader" class="form-label">Union Leader</label>
                                        <input type="text" class="form-control" id="unionLeader" name="union_leader" value="{{ $union->union_leader }}" required>
                                    </div>
                                </div>
                        
                                <div class="row">
                                    <!-- Number of Members -->
                                    <div class="col-md-6 mb-3">
                                        <label for="numberOfMembers" class="form-label">Number of Members</label>
                                        <input type="number" class="form-control" id="numberOfMembers" name="number_of_members" value="{{ $union->number_of_members }}" required>
                                    </div>
                        
                                    <!-- Location -->
                                    <div class="col-md-6 mb-3">
                                        <label for="location" class="form-label">Location</label>
                                        <input type="text" class="form-control" id="location" name="location" value="{{ $union->location }}" required>
                                    </div>
                                </div>
                        
                                <div class="row">
                                    <!-- Union Officer Selection -->
                                    <div class="col-md-6 mb-3">
                                        <label for="union_officer" class="form-label">Union Officer</label>
                                        <select name="union_officer" id="union_officer" class="form-control" required>
                                            <option value="" disabled>Select Union Officer</option>
                                            @foreach ($officers as $officer)
                                                <option value="{{ $officer->id }}" {{ $union->union_officer == $officer->id ? 'selected' : '' }}>
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
                                        <input type="text" class="form-control" id="branch" name="branch_name" value="{{ $union->branch_name }}" readonly>
                                    </div>
                        
                                    <!-- Manager (Auto-updated) -->
                                    <div class="col-md-6 mb-3">
                                        <label for="manager" class="form-label">Manager</label>
                                        <input type="text" class="form-control" id="manager" name="manager_name" value="{{ $union->manager_name }}" readonly>
                                    </div>
                                </div>
                        
                                <div class="row">
                                    <!-- Submit Button -->
                                    <div class="col-md-12">
                                        <button type="submit" class="btn btn-primary">Update Union</button>
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
    </div>
</div>
@endsection