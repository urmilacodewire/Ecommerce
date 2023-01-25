<html>
   <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <title>@yield('meta-title')</title>
      <meta name="keywords" content="@yield('meta-keywords')" />
      <meta name="description" content="@yield('meta-description')" />
      <link rel="shortcut icon" href="{{url('assets/logo/elogo.png')}}" type="image/x-icon">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="stylesheet" href="{{url('assets/css/bootstrap.min.css')}}">
      <link rel="stylesheet" href="{{url('assets/css/custom.css')}}">
      <link rel="stylesheet" href="{{url('assets/css/owl.carousel.min.css')}}">
      <link rel="stylesheet" href="{{url('assets/css/owl.theme.default.min.css')}}">
      <link rel="stylesheet" href="{{url('assets/css/responsive.css')}}">
      <link href="https://fonts.googleapis.com/css2?family=Josefin+Sans:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;1,200;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet">
      <link href="https://fonts.googleapis.com/css2?family=Exo+2:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100&display=swap" rel="stylesheet">
      <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css" rel="stylesheet">
      <!-- Font Awesome 5.15.1 CSS -->
<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css'>

 <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

      
      <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-5039407364094036"
     crossorigin="anonymous"></script>
      <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
      @yield('style')
     
   </head>