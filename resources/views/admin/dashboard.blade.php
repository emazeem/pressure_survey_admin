@extends("admin.layouts.app")
@section("style")
    {{-- <link href="assets/plugins/datatable/css/dataTables.bootstrap5.min.css" rel="stylesheet" /> --}}
@endsection

@section("wrapper")
<script src="{{asset('main-assets/js/jquery.js')}}"></script>
    <div class="page-wrapper">
            <div class="page-content">
                <div class="card radius-10 w-100">
                    <div class="card-body" style="position: relative;">
                        <div class="d-flex" style="justify-content: space-between">
                            <h5 class="mb-1">Total Users on Platform</h5>

                        </div>
                        <div class="row mt-4">
                            <div class="col">
                                <div class="card p-3">
                                    <p class="mb-0 text-secondary">Total Users</p>
                                    <h4 class="my-1" id="total-ambassador"><i class="fa fa-spinner fa-spin"></i></h4>
                                    <div class="progress mt-3" style="height:7px;">
                                        <div class="progress-bar bg-primary" role="progressbar" style="width: 100%"
                                             aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="card p-3">

                                    <p class="mb-0 text-secondary">Pending Users</p>
                                    <h4 class="my-1" id="requested"><i class="fa fa-spinner fa-spin"></i></h4>
                                    <div class="progress mt-3" style="height:7px;">
                                        <div class="progress-bar bg-success" id="kyc_requested" role="progressbar"
                                             aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>

                            <div class="col">
                                <div class="card p-3 ">
                                    <p class="mb-0 text-secondary">Non Active Users</p>
                                    <h4 class="my-1" id="rejected"><i class="fa fa-spinner fa-spin"></i></h4>
                                    <div class="progress mt-3" style="height:7px;">
                                        <div class="progress-bar bg-info" id="kyc_rejected" role="progressbar"
                                             aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="card p-3">
                                    <p class="mb-0 text-secondary">Active Users</p>
                                    <h4 class="my-1" id="approved"><i class="fa fa-spinner fa-spin"></i></h4>

                                    <div class="progress mt-3" style="height:7px;">
                                        <div class="progress-bar bg-warning" id="kyc_approved" role="progressbar"
                                             aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                            {{-- <div class="col">
                                <div class="card p-3">
                                    <p class="mb-0 text-secondary">Non-Active</p>
                                    <h4 class="my-1" id="non-active"><i class="fa fa-spinner fa-spin"></i></h4>
                                    <div class="progress mt-3" style="height:7px;">
                                        <div class="progress-bar bg-secondary" id="non-active-progress" role="progressbar"
                                             aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div> --}}
                        </div>
                        {{-- dddd --}}

                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="card radius-10 w-100">
                            <div class="card-body">

                                <div class="mt-4" id="gender-chart" style="height: 250px;"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="card radius-10 w-100">
                            <div class="card-body">
                                <div class="mt-4" id="age-chart" style="height: 250px;"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

@endsection

@section("script")

<script src="{{url('main-assets/js/index.js')}}"></script>
@endsection
