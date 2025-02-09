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
                        <h4 class="card-title">Edit Branch</h4>
                    </div>
                    <div class="card-body">
                        <!-- Branch Edit Form -->

                        <form action="{{ route('adminbranchupdate', $branch->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <!-- Branch Name -->
                            <div class="mb-3">
                                <label for="branchName" class="form-label">Branch Name</label>
                                <input type="text" class="form-control" id="branchName" name="branch_name" required value="{{ old('branch_name', $branch->branch_name) }}">

                                <!-- Display error for branch_name -->
                                @if ($errors->has('branch_name'))
                                <div class="alert alert-danger mt-2">
                                    {{ $errors->first('branch_name') }}
                                </div>
                                @endif
                            </div>

                            <!-- Branch Location -->
                            <div class="mb-3">
                                <label for="branchLocation" class="form-label">Location</label>
                                <input type="text" class="form-control" id="branchLocation" name="branch_location" required value="{{ old('branch_location', $branch->branch_location) }}">

                                <!-- Display error for branch_location -->
                                @if ($errors->has('branch_location'))
                                <div class="alert alert-danger mt-2">
                                    {{ $errors->first('branch_location') }}
                                </div>
                                @endif
                            </div>

                            <!-- Branch Code (Read-only, generated automatically) -->
                            <div class="mb-3">
                                <label for="branchCode" class="form-label">Branch Code</label>
                                <input type="text" class="form-control" id="branchCode" name="branch_code" value="{{ old('branch_code', $branch->branch_code) }}" readonly>
                            </div>

                            <button type="submit" class="btn btn-primary">Update Branch</button>
                        </form>


                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection