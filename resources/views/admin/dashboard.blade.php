@extends("layouts.master")
@section("content")
    <script src="{{asset('main-assets/js/jquery.js')}}"></script>
    <div class="page-wrapper">
        <div class="page-content">
            <h4>Dashboard</h4>
            <div class="row">


                <div class="col-xl-4 col-md-6">
                    <div class="card prod-p-card bg-c-red">
                        <div class="card-body">
                            <div class="row align-items-center m-b-0">
                                <div class="col">
                                    <h6 class="m-b-5 text-white">
                                        <a class="text-white" href="{{route('team')}}">Teams</a>
                                    </h6>
                                    <h3 class="m-b-0 text-white customer-count">
                                        {{\App\Models\Team::get()->count()}}
                                    </h3>
                                </div>
                                <div class="col-auto">
                                    <i class="feather icon-user text-white"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-md-6">
                    <div class="card prod-p-card bg-c-green">
                        <div class="card-body">
                            <div class="row align-items-center m-b-0">
                                <div class="col">
                                    <h6 class="m-b-5 text-white">
                                        <a class="text-white" href="{{route('team')}}">Members</a>
                                    </h6>
                                    <h3 class="m-b-0 text-white customer-count">
                                        {{\App\Models\Member::get()->count()}}
                                    </h3>
                                </div>
                                <div class="col-auto">
                                    <i class="feather icon-user text-white"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-md-6">
                    <div class="card prod-p-card bg-c-blue">
                        <div class="card-body">
                            <div class="row align-items-center m-b-0">
                                <div class="col">
                                    <h6 class="m-b-5 text-white">
                                        <a class="text-white" href="{{route('import')}}">Imports</a>
                                    </h6>
                                    <h3 class="m-b-0 text-white customer-count">
                                        {{\App\Models\File::get()->count()}}
                                    </h3>
                                </div>
                                <div class="col-auto">
                                    <i class="feather icon-user text-white"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>
@endsection