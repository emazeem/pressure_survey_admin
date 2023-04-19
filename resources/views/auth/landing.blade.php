
@extends('layout.main')
@section('title')
    Welcome to NP Social
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
    border: 2px solid #000;
}
.login-btn{
    border: 2px solid #000;
}
.w3-button-contact{
  padding: 4px 5px;
    font-size: 14px;
    border-radius: 4px;
}
.w3-button-contact:hover{
  background-color: #fff !important;
  color: #000 !important;
}
.login-btn-main{
  display: flex;
    align-items: center;
}
/* Turn off parallax scrolling for tablets and phones */
@media only screen and (max-device-width: 1600px) {
  .bgimg-1, .bgimg-2, .bgimg-3 {
    background-attachment: scroll;
    min-height: 400px;
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

    </style>
    <link href="https://fonts.googleapis.com/css2?family=Josefin+Sans:wght@300;500&display=swap" rel="stylesheet">
    {{-- <div class="site-landing-page">
        <div class="site-landing-page-inner">
            <div class="landing-page-site-logo">
                <img src="{{url('main-assets/images/logo.png')}}" alt="">
            </div>
            <div class="landing-page-content" style="font-family:  'Josefin Sans', sans-serif;">
                <p class='bigger'>Socialize With Your </p>
                <p>Fellow Nurse Practitioners</p>
            </div>
            <div class="landing-page-bottom-buttons">
                <div class="landing-page-bottom-button">
                    <a href="{{route('sign.up')}}" class="landing-page-button-link">Sign Up</a>
                </div>
                <div class="landing-page-bottom-button">
                    <a href="{{route('login')}}" class="landing-page-button-link">Sign In</a>
                </div>
            </div>
        </div>
    </div>
    <div class="site-landing-page">
        <div class="site-landing-page-inner-div">
            <div class="site-landing-page-top">
                <div class="site-landing-page-top-logo">
                    <img src="{{url('main-assets/images/logo.png')}}" alt="">
                </div>
            </div>
            <div class="site-landing-page-content">
                <div class="site-landing-page-top-center">
                    <div class="landing-page-content" style="font-family:  system-ui;">
                        <p class='bigger'>Socialize</p>
                       
                        <p class="bigger-1">Social media exclusively for <br>
                            nurse practitioners</p>
                       <p class="bottom-text"><img src="{{asset('main-assets/images/text.png')}}" alt=""></p>
                    </div>
                </div>
                <div class="site-landing-page-top-bottom">
                    <div class="landing-page-bottom-buttons-align">
                        <div class="landing-page-bottom-button">
                            <a href="{{route('login')}}" class="landing-page-button-link">Sign In</a>
                        </div>
                       <div class="landing-page-bottom-button">
                            <a href="{{route('sign.up')}}" class="landing-page-button-link invert">Sign Up</a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div> --}}

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
                            <a class="nav-link" href="#home"><i class="fa fa-home fa-fw mr-1"></i>Home</a>
                        </li>
                        <li class="nav-item pl-1">
                            <a class="nav-link" href="#about"><i class="fa fa-info-circle fa-fw mr-1"></i>About</a>
                        </li>
                        <li class="nav-item  pl-1">
                            <a class="nav-link" href="#contact"><i class="fa fa-phone fa-fw fa-rotate-180 mr-1"></i>Contact</a>
                        </li>
                        <li class="nav-item  pl-1">
                            <a class="nav-link" href="{{ route('privacy.policy') }}"><i class="fa fa-lock fa-fw mr-1"></i>Privacy Policy</a>
                        </li>
                        <li class="nav-item  pl-1 login-btn-main" >
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
      <span class="w3-center w3-padding-large w3-black w3-xlarge  w3-animate-opacity">Together, we are unstoppable</span>
    </div>
  </div>
  
  <!-- Container (About Section) -->
  <div class="w3-content w3-container w3-padding-64" id="about">
    <h3 class="w3-center">ABOUT US</h3>
    <p class="w3-center"><em>I love photography</em></p>
    <p>We have created a fictional "personal" website/blog, and our fictional character is a hobby photographer. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
      quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa
      qui officia deserunt mollit anim id est laborum consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
    <div class="w3-row">
      <div class="w3-col m6 w3-center w3-padding-large">
        <p><b><i class="fa fa-user w3-margin-right"></i>My Name</b></p><br>
        <img src="{{ asset('main-assets/images/landing/new.jfif') }}" class="w3-round w3-image w3-opacity w3-hover-opacity-off" alt="Photo of Me" width="500" height="333">
      </div>
  
      <!-- Hide this text on small devices -->
      <div class="w3-col m6 w3-hide-small w3-padding-large">
        <p>Welcome to my website. I am lorem ipsum consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure
          dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum consectetur adipiscing elit, sed do eiusmod tempor
          incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
      </div>
    </div>
    {{-- <p class="w3-large w3-center w3-padding-16">Im really good at:</p>
    <p class="w3-wide"><i class="fa fa-camera"></i>Photography</p>
    <div class="w3-light-grey">
      <div class="w3-container w3-padding-small w3-dark-grey w3-center" style="width:90%">90%</div>
    </div>
    <p class="w3-wide"><i class="fa fa-laptop"></i>Web Design</p>
    <div class="w3-light-grey">
      <div class="w3-container w3-padding-small w3-dark-grey w3-center" style="width:85%">85%</div>
    </div>
    <p class="w3-wide"><i class="fa fa-photo"></i>Photoshop</p>
    <div class="w3-light-grey">
      <div class="w3-container w3-padding-small w3-dark-grey w3-center" style="width:75%">75%</div>
    </div> --}}
  </div>
{{--   
  <div class="w3-row w3-center w3-dark-grey w3-padding-16">
    <div class="w3-quarter w3-section">
      <span class="w3-xlarge">14+</span><br>
      Partners
    </div>
    <div class="w3-quarter w3-section">
      <span class="w3-xlarge">55+</span><br>
      Projects Done
    </div>
    <div class="w3-quarter w3-section">
      <span class="w3-xlarge">89+</span><br>
      Happy Clients
    </div>
    <div class="w3-quarter w3-section">
      <span class="w3-xlarge">150+</span><br>
      Meetings
    </div>
  </div>
  

  <div class="bgimg-2 w3-display-container w3-opacity-min">
    <div class="w3-display-middle">
      <span class="w3-xxlarge w3-text-white w3-wide">PORTFOLIO</span>
    </div>
  </div>
  
 
  <div class="w3-content w3-container w3-padding-64" id="portfolio">
    <h3 class="w3-center">MY WORK</h3>
    <p class="w3-center"><em>Here are some of my latest lorem work ipsum tipsum.<br> Click on the images to make them bigger</em></p><br>
  
    <!-- Responsive Grid. Four columns on tablets, laptops and desktops. Will stack on mobile devices/small screens (100% width) -->
    <div class="w3-row-padding w3-center">
      <div class="w3-col m3">
        <img src="{{ asset('main-assets/images/landing/photo3.jpg') }}" style="width:100%" onclick="onClick(this)" class="w3-hover-opacity" alt="The mist over the mountains">
      </div>
  
      <div class="w3-col m3">
        <img src="{{ asset('main-assets/images/landing/photo3.jpg') }}" style="width:100%" onclick="onClick(this)" class="w3-hover-opacity" alt="Coffee beans">
      </div>
  
      <div class="w3-col m3">
        <img src="{{ asset('main-assets/images/landing/photo3.jpg') }}" style="width:100%" onclick="onClick(this)" class="w3-hover-opacity" alt="Bear closeup">
      </div>
  
      <div class="w3-col m3">
        <img src="{{ asset('main-assets/images/landing/photo3.jpg') }}" style="width:100%" onclick="onClick(this)" class="w3-hover-opacity" alt="Quiet ocean">
      </div>
    </div>
  
    <div class="w3-row-padding w3-center w3-section">
      <div class="w3-col m3">
        <img src="{{ asset('main-assets/images/landing/photo3.jpg') }}" style="width:100%" onclick="onClick(this)" class="w3-hover-opacity" alt="The mist">
      </div>
  
      <div class="w3-col m3">
        <img src="{{ asset('main-assets/images/landing/photo3.jpg') }}" style="width:100%" onclick="onClick(this)" class="w3-hover-opacity" alt="My beloved typewriter">
      </div>
  
      <div class="w3-col m3">
        <img src="{{ asset('main-assets/images/landing/photo3.jpg') }}" style="width:100%" onclick="onClick(this)" class="w3-hover-opacity" alt="Empty ghost train">
      </div>
  
      <div class="w3-col m3">
        <img src="{{ asset('main-assets/images/landing/photo3.jpg') }}" style="width:100%" onclick="onClick(this)" class="w3-hover-opacity" alt="Sailing">
      </div>
      <button class="w3-button w3-padding-large w3-light-grey" style="margin-top:64px">LOAD MORE</button>
    </div>
  </div>
  
 
  <div id="modal01" class="w3-modal w3-black" onclick="this.style.display='none'">
    <span class="w3-button w3-large w3-black w3-display-topright" title="Close Modal Image"><i class="fa fa-remove"></i></span>
    <div class="w3-modal-content w3-animate-zoom w3-center w3-transparent w3-padding-64">
      <img id="img01" class="w3-image">
      <p id="caption" class="w3-opacity w3-large"></p>
    </div>
  </div> --}}
  
  <!-- Third Parallax Image with Portfolio Text -->
  <div class="bgimg-3 w3-display-container w3-opacity-min">
    <div class="w3-display-middle">
       <span class="w3-xxlarge w3-text-white w3-wide">CONTACT</span>
    </div>
  </div>
  
  <!-- Container (Contact Section) -->
  <div class="w3-content w3-container w3-padding-64" id="contact">
    <h3 class="w3-center">WHERE I WORK</h3>
    <p class="w3-center"><em>I'd love your feedback!</em></p>
  
    <div class="w3-row w3-padding-32 w3-section">
      <div class="w3-col m4 w3-container">
        <img src="{{ asset('main-assets/images/landing/new.jfif') }}" class="w3-image w3-round" style="width:100%">
      </div>
      <div class="w3-col m8 w3-panel">
        <div class="w3-large w3-margin-bottom">
          <i class="fa fa-map-marker fa-fw w3-hover-text-black w3-xlarge w3-margin-right"></i> Chicago, US<br>
          <i class="fa fa-phone fa-fw w3-hover-text-black w3-xlarge w3-margin-right"></i> Phone: +00 151515<br>
          <i class="fa fa-envelope fa-fw w3-hover-text-black w3-xlarge w3-margin-right"></i> Email: mail@mail.com<br>
        </div>
        <p> Or leave me a note:</p>
        <form action="{{ route('contact.message')}}" method="post" >
          @csrf
          <div class="w3-row-padding" style="margin:0 -16px 8px -16px">
            <div class="w3-half">
              <input class="w3-input w3-border" type="text" placeholder="Name" required name="name">
            </div>
            <div class="w3-half">
              <input class="w3-input w3-border" type="text" placeholder="Email" required name="email">
            </div>
          </div>
          <input class="w3-input w3-border" type="text" placeholder="Message" required name="message">
          <button class="w3-button-contact w3-black w3-right w3-section" type="submit">
            <i class="fa fa-paper-plane"></i> Submit
          </button>
        </form>
      </div>
    </div>
  </div>
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

            <!-- Google -->
            {{-- <a
               class="btn btn-primary btn-floating m-1"
               style="background-color: #dd4b39"
               href="#!"
               role="button"
               ><i class="fab fa-google"></i
              ></a> --}}

            <!-- Instagram -->
            {{-- <a
               class="btn btn-primary btn-floating m-1"
               style="background-color: #ac2bac"
               href="#!"
               role="button"
               ><i class="fab fa-instagram"></i
              ></a> --}}

            <!-- Linkedin -->
            {{-- <a
               class="btn btn-primary btn-floating m-1"
               style="background-color: #0082ca"
               href="#!"
               role="button"
               ><i class="fab fa-linkedin-in"></i
              ></a> --}}
            <!-- Github -->
            {{-- <a
               class="btn btn-primary btn-floating m-1"
               style="background-color: #333333"
               href="#!"
               role="button"
               ><i class="fab fa-github"></i
              ></a> --}}
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

  {{-- <footer class="w3-center w3-black w3-padding-64 w3-opacity w3-hover-opacity-off">
    <a href="#home" class="w3-button w3-light-grey"><i class="fa fa-arrow-up w3-margin-right"></i>To the top</a>
    <div class="w3-xlarge w3-section">
      <i class="fa fa-facebook-official w3-hover-opacity"></i>
      <i class="fa fa-instagram w3-hover-opacity"></i>
      <i class="fa fa-snapchat w3-hover-opacity"></i>
      <i class="fa fa-pinterest-p w3-hover-opacity"></i>
      <i class="fa fa-twitter w3-hover-opacity"></i>
      <i class="fa fa-linkedin w3-hover-opacity"></i>
    </div>
    <p>Powered by <a href="https://www.w3schools.com/w3css/default.asp" title="W3.CSS" target="_blank" class="w3-hover-text-green">w3.css</a></p>
  </footer> --}}
   
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