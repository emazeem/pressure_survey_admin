<!doctype html>
<html lang="en">

<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!--favicon-->
	<link rel="icon" href="{{url('main-assets/images/center.png')}}" type="image/png" />
	<!--plugins-->
	@yield("style")
	<link href="{{url('admin_assets/plugins/simplebar/css/simplebar.css')}}" rel="stylesheet" />
	<link href="{{url('admin_assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css')}}" rel="stylesheet" />
	<link href="{{url('admin_assets/plugins/metismenu/css/metisMenu.min.css')}}" rel="stylesheet" />
	<!-- loader-->
    <link href="{{url('main-assets/plugins/highcharts/css/highcharts.css')}}" rel="stylesheet" />
	<link href="{{url('admin_assets/css/pace.min.css')}}" rel="stylesheet" />
	<script src="{{url('admin_assets/js/pace.min.js')}}"></script>
	<!-- Bootstrap CSS -->
	<link href="{{url('admin_assets/css/bootstrap.min.css')}}" rel="stylesheet">
	<link href="{{url('admin_assets/css/app.css')}}" rel="stylesheet">
	<link href="{{url('admin_assets/css/icons.css')}}" rel="stylesheet">
    <!-- Theme Style CSS -->
    {{-- <link rel="stylesheet" href="{{url('admin_assets/css/dark-theme.css')}}" />
    <link rel="stylesheet" href="{{url('admin_assets/css/semi-dark.css')}}" />       //Hide due to error
    <link rel="stylesheet" href="{{url('admin_assets/css/header-colors.css')}}" /> --}}
    <link rel="stylesheet" href="{{url('main-assets/css/jquery.toast.css')}}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"/>

    <title>Pressure Survey {{env('ONE_SIGNAL_REST_API_KEY')?'':'•'}}</title>
</head>
<body>
	<!--wrapper-->
	<div class="wrapper">
		<!--start header -->
		@include("admin.layouts.header")
		<!--end header -->
		<!--navigation-->
		@include("admin.layouts.nav")
		<!--end navigation-->
		<!--start page wrapper -->
		@yield("wrapper")
		<!--end page wrapper -->
		<!--start overlay-->
		<div class="overlay toggle-icon"></div>
		<!--end overlay-->
		<!--Start Back To Top Button--> <a href="javaScript:;" class="back-to-top"><i class='bx bxs-up-arrow-alt'></i></a>
		<!--End Back To Top Button-->
		<footer class="page-footer">
			<p class="mb-0">Copyright © {{date('Y')}}. All right reserved.</p>
		</footer>
	</div>
	<!--end wrapper-->
    <!--start switcher-->
    <div class="switcher-wrapper">
        {{--<div class="switcher-btn"> <i class='bx bx-cog bx-spin'></i>
        </div>
        --}}
        <div class="switcher-body">
            <div class="d-flex align-items-center">
                <h5 class="mb-0 text-uppercase">Theme Customizer</h5>
                <button type="button" class="btn-close ms-auto close-switcher" aria-label="Close"></button>
            </div>
            <hr/>
            <h6 class="mb-0">Theme Styles</h6>
            <hr/>
            <div class="d-flex align-items-center justify-content-between">
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="lightmode" checked>
                    <label class="form-check-label" for="lightmode">Light</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="darkmode">
                    <label class="form-check-label" for="darkmode">Dark</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="semidark">
                    <label class="form-check-label" for="semidark">Semi Dark</label>
                </div>
            </div>
            <hr/>
            <div class="form-check">
                <input class="form-check-input" type="radio" id="minimaltheme" name="flexRadioDefault">
                <label class="form-check-label" for="minimaltheme">Minimal Theme</label>
            </div>
            <hr/>
            <h6 class="mb-0">Header Colors</h6>
            <hr/>
            <div class="header-colors-indigators">
                <div class="row row-cols-auto g-3">
                    <div class="col">
                        <div class="indigator headercolor1" id="headercolor1"></div>
                    </div>
                    <div class="col">
                        <div class="indigator headercolor2" id="headercolor2"></div>
                    </div>
                    <div class="col">
                        <div class="indigator headercolor3" id="headercolor3"></div>
                    </div>
                    <div class="col">
                        <div class="indigator headercolor4" id="headercolor4"></div>
                    </div>
                    <div class="col">
                        <div class="indigator headercolor5" id="headercolor5"></div>
                    </div>
                    <div class="col">
                        <div class="indigator headercolor6" id="headercolor6"></div>
                    </div>
                    <div class="col">
                        <div class="indigator headercolor7" id="headercolor7"></div>
                    </div>
                    <div class="col">
                        <div class="indigator headercolor8" id="headercolor8"></div>
                    </div>
                </div>
            </div>
            <hr/>
            <h6 class="mb-0">Sidebar Colors</h6>
            <hr/>
            <div class="header-colors-indigators">
                <div class="row row-cols-auto g-3">
                    <div class="col">
                        <div class="indigator sidebarcolor1" id="sidebarcolor1"></div>
                    </div>
                    <div class="col">
                        <div class="indigator sidebarcolor2" id="sidebarcolor2"></div>
                    </div>
                    <div class="col">
                        <div class="indigator sidebarcolor3" id="sidebarcolor3"></div>
                    </div>
                    <div class="col">
                        <div class="indigator sidebarcolor4" id="sidebarcolor4"></div>
                    </div>
                    <div class="col">
                        <div class="indigator sidebarcolor5" id="sidebarcolor5"></div>
                    </div>
                    <div class="col">
                        <div class="indigator sidebarcolor6" id="sidebarcolor6"></div>
                    </div>
                    <div class="col">
                        <div class="indigator sidebarcolor7" id="sidebarcolor7"></div>
                    </div>
                    <div class="col">
                        <div class="indigator sidebarcolor8" id="sidebarcolor8"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <!--end switcher-->
	<!-- Bootstrap JS -->
	<script src="{{url('admin_assets/js/bootstrap.bundle.min.js')}}"></script>
	<!--plugins-->
	<script src="{{url('admin_assets/js/jquery.min.js')}}"></script>
	<script src="{{url('admin_assets/plugins/simplebar/js/simplebar.min.js')}}"></script>
	<script src="{{url('admin_assets/plugins/metismenu/js/metisMenu.min.js')}}"></script>
	<script src="{{url('admin_assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js')}}"></script>
    <script src="{{url('admin_assets/plugins/apexcharts-bundle/js/apexcharts.min.js')}}"></script>
    <script src="{{url('main-assets/plugins/highcharts/js/highcharts.js')}}"></script>
	<!--app JS-->
	<script src="{{url('admin_assets/js/app.js')}}"></script>
    <script>
        var token = '{{csrf_token()}}';
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="{{url('main-assets/js/index.js')}}"></script>
    <script type="text/javascript" src="{{url('main-assets/js/jquery.toast.js')}}"></script>
	@yield("script")
    @include("admin.layouts.theme-control")


</body>
</html>
