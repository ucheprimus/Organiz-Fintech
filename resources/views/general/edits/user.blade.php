@extends('layouts.admin')
@section('title')
Branch
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
                <h3 class="fw-bold mb-3">Branches</h3>
                <h6 class="op-7 mb-2">A list of all branches</h6>
            </div>
            <div class="ms-md-auto py-2 py-md-0">
                <!-- <a href="#" class="btn btn-label-info btn-round me-2">Manage</a> -->
                <!-- Button to trigger the modal -->
                <!-- Button to trigger modal -->
                <a href="#" class="btn btn-primary btn-round" data-bs-toggle="modal" data-bs-target="#addBranchModal">
                    Create Branch
                </a>

            </div>
        </div>


        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Basic Users Table</h4>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('account.update', $user->id) }}">
                            @csrf
                            @method('PUT')
                    
                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror"
                                    value="{{ old('name', $user->name) }}" required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                    
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror"
                                    value="{{ old('email', $user->email) }}" required>
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                    
                            <button type="submit" class="btn btn-primary">Update</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
