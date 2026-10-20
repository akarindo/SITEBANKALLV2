<head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <meta name="csrf-token" content="{{ csrf_token() }}">
     <title>{{ env(('APP_NAME')) }}</title>

     <!--=====FAB ICON=======-->
     <link rel="shortcut icon" href="{{asset('frontend/bprtaruna/assets/img/logo/logo.png')}}" type="image/x-icon">


     <!--=====CSS=======--> 
     <link rel="stylesheet" href="{{asset('frontend/bprtaruna/assets/css/bootstrap.min.css')}}">
     <link rel="stylesheet" href="{{asset('frontend/bprtaruna/assets/css/fontawesome.css')}}">
     <link rel="stylesheet" href="{{asset('frontend/bprtaruna/assets/css/magnific-popup.css')}}">
     <link rel="stylesheet" href="{{asset('frontend/bprtaruna/assets/css/nice-select.css')}}">
     <link rel="stylesheet" href="{{asset('frontend/bprtaruna/assets/css/slick-slider.css')}}">
     <link rel="stylesheet" href="{{asset('frontend/bprtaruna/assets/css/owl.carousel.min.css')}}">
     <link rel="stylesheet" href="{{asset('frontend/bprtaruna/assets/css/aos.css')}}">
     <link rel="stylesheet" href="{{asset('frontend/bprtaruna/assets/css/mobile-menu.css')}}">
     <link rel="stylesheet" href="{{asset('frontend/bprtaruna/assets/css/main.css')}}">



     <!--=====JQUERY=======-->
     <script src="{{asset('frontend/bprtaruna/assets/js/jquery-3-7-1.min.js')}}"></script>
</head>