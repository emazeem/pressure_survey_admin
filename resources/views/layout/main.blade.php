<?php $data_needed = get_files_array(Route::currentRouteName()) ?>
<?php extract($data_needed); ?>

        <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @yield('meta')
    <link rel="icon" type="image/x-icon" href="{{url('main-assets/images/center.png')}}">
    <title>@yield('title') - NP Social</title>
    <!-- Universal Styles -->
    <link rel="stylesheet" href="{{asset('main-assets/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{url('main-assets/css/themify.css')}}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Slab&display=swap" rel="stylesheet">
    {{-- Emojis link--}}
    <link href="{{asset('main-assets/emoji-picker/lib/css/emoji.css')}}" rel="stylesheet">
    <link href="{{asset('main-assets/emoji-picker/lib/css/style.css')}}" rel="stylesheet">
    {{--Emojis Script--}}
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<!-- Font Awesome -->
<link
  href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
  rel="stylesheet"
/>
<!-- Google Fonts -->
<link
  href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap"
  rel="stylesheet"
/>
<!-- MDB -->
<link
  href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.1.0/mdb.min.css"
  rel="stylesheet"
/>
    {{-- Scripts --}}
    <script src="{{asset('main-assets/js/jquery.js')}}"></script>
    <script src="{{asset('main-assets/js/bootstrap.min.js')}}"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="{{asset('main-assets/emoji-picker/lib/js/config.js')}}"></script>
    <script src="{{asset('main-assets/emoji-picker/lib/js/util.js')}}"></script>
    <script src="{{asset('main-assets/emoji-picker/lib/js/jquery.emojiarea.js')}}"></script>
    <script src="{{asset('main-assets/emoji-picker/lib/js/emoji-picker.js')}}"></script>
    <!-- Specific Styles -->
    {{load_styles(( isset($styles) ? $styles : '' ))}}
    <link rel="stylesheet" href="{{url('main-assets/css/jquery.toast.css')}}">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/themify-icons/0.1.2/css/themify-icons.css">
    <link href='{{asset('main-assets/css/i-uploader.css')}}' rel='stylesheet'>
</head>
<body>


{{-- Include To Top --}}
@if(isset($include_top))
    @include('layout.include_top')
@endif

{{-- Main Content --}}
@yield('content')

{{-- Include To Bottom --}}
@if(isset($include_bottom))
    @include('layout.include_bottom')
@endif

{{-- Include Scripts --}}
@if(isset($in_script))
    @include('layout.in_scripts')
@endif

{{load_scripts(( isset($scripts) ? $scripts : '' ))}}
<script type="text/javascript" src="{{url('main-assets/js/jquery.toast.js')}}"></script>
<script src='{{url('main-assets/js/i-uploader.js')}}'></script>
@stack('scripts')
<script>
    $(function () {


    });

</script>
</body>
</html>
