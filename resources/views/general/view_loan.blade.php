@extends('layouts.admin')

@section('title')
    Loan
@endsection

@section('content')
    <div class="container">
        @include('includes.session_messages')

        <div class="page-inner">

            <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
                <div>
                    <h3 class="fw-bold mb-3">Loan Section</h3>
                    <h6 class="op-7 mb-2">Access all loan data here</h6>
                </div>
            </div>


            <div class="container">
                <div class="row">
                    <!-- Card 1 -->
                    <div class="col-md-4 mb-4">
                        <div class="card">
                            <img src="https://via.placeholder.com/150" class="card-img-top" alt="Card Image 1">
                            <div class="card-body">
                                <h5 class="card-title">MONTHLY LOAN</h5>
                                <p class="card-text">Every client under Monthly loan</p>
                                <a href="{{route('monthlyloan')}}" class="btn btn-primary">View Loan data</a>
                            </div>
                        </div>
                    </div>
            
                    <!-- Card 2 -->
                    <div class="col-md-4 mb-4">
                        <div class="card">
                            <img src="https://via.placeholder.com/150" class="card-img-top" alt="Card Image 2">
                            <div class="card-body">
                                <h5 class="card-title">WEEKLY LOAN</h5>
                                <p class="card-text">Every client under Weekly loan</p>
                                <a href="{{route('weeklyloan')}}" class="btn btn-primary">View Loan data</a>
                            </div>
                        </div>
                    </div>
            
                    <!-- Card 3 -->
                    <div class="col-md-4 mb-4">
                        <div class="card">
                            <img src="https://via.placeholder.com/150" class="card-img-top" alt="Card Image 3">
                            <div class="card-body">
                                <h5 class="card-title">GROUP LOAN</h5>
                                <p class="card-text">Every client under Group loan</p>
                                <a href="#" class="btn btn-primary">View Loan data</a>

                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <!-- Card 1 -->
                    <div class="col-md-4 mb-4">
                        <div class="card">
                            <img src="https://via.placeholder.com/150" class="card-img-top" alt="Card Image 1">
                            <div class="card-body">
                                <h5 class="card-title">ASSETS LOAN</h5>
                                <p class="card-text">Every client under assets loan</p>
                                <a href="{{route('assetsloan')}}" class="btn btn-primary">View Loan data</a>
                            </div>
                        </div>
                    </div>
            
                    {{-- <!-- Card 2 -->
                    <div class="col-md-4 mb-4">
                        <div class="card">
                            <img src="https://via.placeholder.com/150" class="card-img-top" alt="Card Image 2">
                            <div class="card-body">
                                <h5 class="card-title">WEEKLY LOAN</h5>
                                <p class="card-text">Every client under Weekly loan</p>
                                <a href="#" class="btn btn-primary">View Loan data</a>
                            </div>
                        </div>
                    </div>
            
                    <!-- Card 3 -->
                    <div class="col-md-4 mb-4">
                        <div class="card">
                            <img src="https://via.placeholder.com/150" class="card-img-top" alt="Card Image 3">
                            <div class="card-body">
                                <h5 class="card-title">GROUP LOAN</h5>
                                <p class="card-text">Every client under Group loan</p>
                                <a href="#" class="btn btn-primary">View Loan data</a>

                            </div>
                        </div>
                    </div> --}}
                </div>
            </div>
            
        </div>
    </div>
@endsection


