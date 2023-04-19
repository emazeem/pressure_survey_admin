@extends('layout.main')
@section('title')
   Construction Page
@endsection
@section('content')
    <link rel="stylesheet" href="{{url('main-assets/css/default.css')}}">
        <div class="row-top h-68">
            <div class="col-12">
                <div class="d-flex justify-content-center ">
                    <img src="{{asset('ambassador_assets/images/icons/coin.png')}} " class="logo-medium rounded" alt="">
                </div>
                {{-- <br> --}}
                <div class="page-alert-text bold-text justify-content-center text-center text-soon" style="margin-top: 20%">
                    Coming Soon
                </div>
            </div>
        </div>
    </div>
@endsection