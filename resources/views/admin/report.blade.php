@extends("layouts.master")
@section("content")
    <!--start page wrapper -->
    <script src="{{url('assets/js/1.10.1/jquery.min.js')}}"></script>
    <script src="{{url('js/index.js')}}"></script>

    <div class="page-wrapper">
        <div class="page-content">
            <!--breadcrumb-->
            <div class="row">
                <div class="col-md-4 offset-4">
                    <div class="d-flex align-items-center mb-3">
                        <img src="{{url('SSGC_logo.png')}}" width="90" alt="" class="img-fluid mb-4" style="border-right: 1px solid black">
                        <div class="ml-4">
                            <h4>Sui Southern Gas</h4>
                            <h4>Company Limited</h4>
                        </div>
                    </div>
                </div>
            </div>

            <hr/>
            <div class="card">
                <div class="card-body">
                    <h6>Inspection Point ID  : {{$ip->title}}</h6>
                    <h6>Inspection Point Name  : {{$ip->name}}</h6>
                    <h6>Inspection Point Description  : {{$ip->description}}</h6>
                    <div class="table-responsive">
                        <table id="example" class="table table-striped table-bordered" style="width:100%">
                            <tr>
                                <th>Sr No.</th>
                                <th>Area/Book/Meter No.</th>
                                <th>Pressure (PSI)</th>
                                <th>Avg Pressure (PSI)</th>
                                <th>Pressure To Applied</th>
                            </tr>
                            @foreach($ip->data as $k=>$data)

                            <tr>
                                <td>{{$k+1}} </td>
                                <td>{{$data->meter}}</td>
                                <td>{{$data->pressure}}</td>
                                @if($k==0)
                                <td rowspan="{{count($ip->data)}}" class="text-center">{{$pressure}}</td>
                                @endif
                                @if($k==0)
                                <td rowspan="{{count($ip->data)}}" class="text-center">{{$pressure}}</td>
                                @endif

                            </tr>
                            @endforeach

                        </table>

                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
