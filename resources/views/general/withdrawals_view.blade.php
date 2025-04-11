@extends('layouts.admin')

@section('title')
    Withdrawal
@endsection

@section('content')
    <!-- DataTables CSS -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css" />
    <!-- jQuery (Make sure this is included before DataTables) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>

    <div class="container">
        @include('includes.session_messages')

        <div class="page-inner">
            <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
                <div>
                    <h3 class="fw-bold mb-3">Withdrawal</h3>
                    <h6 class="op-7 mb-2">Withdrawal record for {{ $user->name }}</h6>
                </div>
                <div class="ms-md-auto py-2 py-md-0">
                    <a href="{{ route('withdraw') }}" class="btn btn-primary">Go back</a>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="fw-bold">{{ $user->name }}'s Withdrawal Records</h3>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">

                                <table id="savingsTable" class="table table-striped table-bordered" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Amount</th>
                                            <th>Comment</th>
                                            <th>Date</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach ($withdrawals as $index => $withdrawal)
                                            <tr>
                                                <td>{{ $index + 1 }}</td>
                                                <td>₦{{ number_format($withdrawal->amount, 2) }}</td>
                                                <td>{{ $withdrawal->comment ?? 'No comment' }}</td> {{-- Display comment or "No comment" --}}
                                                <td>{{ $withdrawal->created_at->format('d M Y') }}</td>
                                                <td>
                                                    <button class="btn btn-warning btn-sm edit-btn" data-bs-toggle="modal"
                                                        data-bs-target="#editModal" data-id="{{ $withdrawal->id }}"
                                                        data-amount="{{ $withdrawal->amount }}"
                                                        data-comment="{{ $withdrawal->comment }}">
                                                        Edit
                                                    </button>

                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>

                                </table>

                                <script>
                                    $(document).ready(function() {
                                        $(".edit-btn").on("click", function() {
                                            let withdrawalId = $(this).data("id");
                                            let amount = $(this).data("amount");
                                            let comment = $(this).data("comment");

                                            // Populate the modal fields
                                            $("#editModal input[name='withdrawal_id']").val(withdrawalId);
                                            $("#editModal input[name='amount']").val(amount);
                                            $("#editModal textarea[name='comment']").val(comment);
                                        });
                                    });
                                </script>
                            </div> <!-- End table-responsive -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Edit Modal -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Edit Withdrawal</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('withdrawals.update') }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <input type="hidden" name="withdrawal_id">

                    <div class="mb-3">
                        <label for="amount" class="form-label">Amount</label>
                        <input type="number" class="form-control" name="amount" required>
                    </div>

                    <div class="mb-3">
                        <label for="comment" class="form-label">Comment</label>
                        <textarea class="form-control" name="comment"></textarea>
                    </div>

                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </form>
            </div>
        </div>
    </div>
</div>


    <script>
        $(document).ready(function() {
            $('#savingsTable').DataTable({
                "paging": true, // Enables pagination
                "searching": true, // Enables search box
                "ordering": true, // Enables column sorting
                "info": true, // Shows info (e.g., "Showing 1-10 of 50")
                "lengthMenu": [5, 10, 25, 50, 100], // Dropdown to select number of rows
                "pageLength": 10, // Default number of rows per page
                "responsive": true, // Makes table responsive
            });
        });
    </script>
@endsection
