
@extends('layout.main')
@section('title')
    Privacy policy:Np Social
@endsection
@section('content')
    <style>
        body,h1,h2,h3,h4,h5,h6 {font-family: "Lato", sans-serif;}
body, html {
  height: 100%;
  color: #333333;
  line-height: 1.8;
}
.navbar { background-color: #fff; }
.navbar .navbar-nav .nav-link { color: #484848; }
.navbar .navbar-nav .nav-link:hover { color: #7f8082; }
.navbar .navbar-nav .active > .nav-link { color: #7f8082; }

/* Create a Parallax Effect */
.bgimg-1, .bgimg-2, .bgimg-3 {
  background-attachment: fixed;
  background-position: center;
  background-repeat: no-repeat;
  background-size: cover;
}

/* First image (Logo. Full height) */
.bgimg-1 {
  background-image: url({{ asset('main-assets/images/landing/new.jfif') }});
  min-height: 100%;
}

/* Second image (Portfolio) */
.bgimg-2 {
  background-image: url({{ asset('main-assets/images/landing/new.jfif') }});
  min-height: 400px;
}

/* Third image (Contact) */
.bgimg-3 {
  background-image: url({{ asset('main-assets/images/landing/new.jfif') }});
  min-height: 400px;
}

.w3-wide {letter-spacing: 10px;}
.w3-hover-opacity {cursor: pointer;}
.login-btn:hover{
    background-color: #fff;
    color:#000;
    border: 1px solid #000;
}
.login-btn{
    border: 1px solid #000;
}
.login-btn-main{
  display: flex;
    align-items: center;
}
/* Turn off parallax scrolling for tablets and phones */
@media only screen and (max-device-width: 1600px) {
  .bgimg-1, .bgimg-2, .bgimg-3 {
    background-attachment: scroll;
    min-height: 300px;
  }
}
@media only screen and (max-width: 300px) {
    .navbar-brands {
        margin-left: 21px !important;
    }
    .navbar-toggler-icon {
        margin-right: 19px !important;
    }

}
@media only screen and (max-width: 786px) and (min-width: 200px)  {
body{
  overflow-x: hidden;
}
}
/* p.bigger {
    font-size: 1.7em;
    font-weight: 500;
    position: relative;
    margin: -20px;
} */
        /* p.bigger::after {
            content: '';
            position: absolute;
            width: 50px;
            height: 2px;
            background: #000;
            bottom: -6px;
            left: 50%;
            transform: translateX(-50%);
        } */
/* 
        .landing-page-content {
            font-size: 1.6em;
            text-align: center;
            color: #000;
            text-shadow: unset;
        }
p.bigger-1 {
    font-weight: 300;
    margin: -12px;
}
.landing-page-content {
    font-size: 1.6em;
    text-align: center;
    color: #000;
    text-shadow: unset;
    font-weight: 300;
} */

    </style>
    <link href="https://fonts.googleapis.com/css2?family=Josefin+Sans:wght@300;500&display=swap" rel="stylesheet">
   

    <!-- Navbar (sit on top) -->
<div class="w3-top">
    <header>
        <!--- Navbar --->
        <nav class="navbar navbar-expand-lg">
            <div class="container">
                <a class="navbar-brands text-white" href="{{ url('/') }}"><img src="{{url('main-assets/images/logo.png')}}" class="np-logo-img" alt=""></a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#nvbCollapse" aria-controls="nvbCollapse">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="nvbCollapse">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item pl-1">
                            <a class="nav-link" href="{{url('/')}}"><i class="fa fa-home fa-fw mr-1"></i>Home</a>
                        </li>
                        <li class="nav-item pl-1">
                            <a class="nav-link" href="{{url('/')}}#about"><i class="fa fa-info-circle fa-fw mr-1"></i>About</a>
                        </li>
                        <li class="nav-item  pl-1">
                            <a class="nav-link" href="{{url('/')}}#contact"><i class="fa fa-phone fa-fw fa-rotate-180 mr-1"></i>Contact</a>
                        </li>
                        <li class="nav-item  pl-1 login-btn-main">
                          @if (Auth::check())
                          <a class="btn btn-black p-2  login-btn" href="{{ route('home') }}"><i class="fa fa-sign-in fa-fw mr-1"></i>Home</a>
                           @else
                           <a class="btn btn-black p-2  login-btn" href="{{ route('login') }}"><i class="fa fa-sign-in fa-fw mr-1"></i>Login</a>
                           @endif
                        </li>
                        
                    </ul>
                </div>
            </div>
        </nav>
        <!--# Navbar #-->
        </header>
  </div>
  
  <!-- First Parallax Image with Logo Text -->
  <div class="bgimg-1 w3-display-container w3-opacity-min" id="home">
    <div class="w3-display-middle" style="white-space:nowrap;">
      <span class="w3-center w3-padding-large w3-black w3-xlarge  w3-animate-opacity">Privacy Policy </span>
    </div>
  </div>
  
  <!-- Container (About Section) -->
  <div class="w3-content w3-container w3-padding-64" id="about">
    <h3 class="w3-center">Privacy Policy</h3>
    
    <p>We have created a fictional "personal" website/blog, and our fictional character is a hobby photographer. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
      quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa
      qui officia deserunt mollit anim id est laborum consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
    
      <p>We have created a fictional "personal" website/blog, and our fictional character is a hobby photographer. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
        quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa
        qui officia deserunt mollit anim id est laborum consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
      <p>We have created a fictional "personal" website/blog, and our fictional character is a hobby photographer. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
        quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa
        qui officia deserunt mollit anim id est laborum consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
      <p>We have created a fictional "personal" website/blog, and our fictional character is a hobby photographer. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
        quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa
        qui officia deserunt mollit anim id est laborum consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                
  </div>

  
  <!-- Third Parallax Image with Portfolio Text -->
  
  
 
  <footer
          class="text-center text-lg-start text-white"
          style="background-color: #3d3d3d"
          >
    <!-- Grid container -->
    <div class="container p-4 pb-0">
      <!-- Section: Links -->
      <section class="">
        <!--Grid row-->
        <div class="row">
          <!-- Grid column -->
          <div class="col-md-3 col-lg-3 col-xl-3 mx-auto mt-3">
            <h6 class="text-uppercase mb-4 font-weight-bold">
              Np Social
            </h6>
            <p>
              Here you can use rows and columns to organize your footer
              content. Lorem ipsum dolor sit amet, consectetur adipisicing
              elit.
            </p>
          </div>
          <!-- Grid column -->

          <hr class="w-100 clearfix d-md-none" />

          

          <hr class="w-100 clearfix d-md-none" />

          <!-- Grid column -->
          <hr class="w-100 clearfix d-md-none" />

          <!-- Grid column -->
          <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mt-3">
            <h6 class="text-uppercase mb-4 font-weight-bold">Contact</h6>
            <p><i class="fas fa-home mr-3"></i> New York, NY 10012, US</p>
            <p><i class="fas fa-envelope mr-3"></i> info@gmail.com</p>
            <p><i class="fas fa-phone mr-3"></i> + 01 234 567 88</p>
            <p><i class="fas fa-print mr-3"></i> + 01 234 567 89</p>
          </div>
          <!-- Grid column -->

          <!-- Grid column -->
          <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mt-3">
            <h6 class="text-uppercase mb-4 font-weight-bold">Follow us</h6>

            <!-- Facebook -->
            <a
               class="btn btn-primary btn-floating m-1"
               style="background-color: #3b5998"
               href="#!"
               role="button"
               ><i class="fab fa-facebook-f"></i
              ></a>

            <!-- Twitter -->
            <a
               class="btn btn-primary btn-floating m-1"
               style="background-color: #55acee"
               href="#!"
               role="button"
               ><i class="fab fa-twitter"></i
              ></a>

           
          </div>
        </div>
        <!--Grid row-->
      </section>
      <!-- Section: Links -->
    </div>
    <!-- Grid container -->

    <!-- Copyright -->
    <div
         class="text-center p-3"
         style="background-color: black"
         >
      © 2023 Copyright:
      <a class="text-white" href="#"
         >Np Social</a
        >
    </div>
    <!-- Copyright -->
  </footer>
  <!-- Footer -->
  <!-- Footer -->

  
   
  <script>
  // Modal Image Gallery
  function onClick(element) {
    document.getElementById("img01").src = element.src;
    document.getElementById("modal01").style.display = "block";
    var captionText = document.getElementById("caption");
    captionText.innerHTML = element.alt;
  }
  
  // Change style of navbar on scroll
  window.onscroll = function() {myFunction()};
  function myFunction() {
      var navbar = document.getElementById("myNavbar");
      if (document.body.scrollTop > 100 || document.documentElement.scrollTop > 100) {
          navbar.className = "w3-bar" + " w3-card" + " w3-animate-top" + " w3-white";
      } else {
          navbar.className = navbar.className.replace(" w3-card w3-animate-top w3-white", "");
      }
  }
  
  // Used to toggle the menu on small screens when clicking on the menu button
  function toggleFunction() {
      var x = document.getElementById("navDemo");
      if (x.className.indexOf("w3-show") == -1) {
          x.className += " w3-show";
      } else {
          x.className = x.className.replace(" w3-show", "");
      }
  }
  </script>
@endsection
<script src="https://www.google.com/recaptcha/api.js"></script>
@push('scripts')
    <script>
        function onSubmit(token) {
            document.getElementById("login").submit();
        }
        $(document).on('click','.show-password',function(){
            var target_input = $(this).attr('data-target');
            console.log('hhh');
            $(target_input).attr('type','text');
            $(this).removeClass('show-password').addClass('hide-password')
            $(this).html('<i class="fa fa-eye-slash" aria-hidden="true"></i>');
        });

        $(document).on('click','.hide-password',function(){
            var target_input = $(this).attr('data-target');
            $(target_input).attr('type','password');
            $(this).removeClass('hide-password').addClass('show-password')
            $(this).html('<i class="fa fa-eye" aria-hidden="true"></i>');
        });
    </script>

@endpush