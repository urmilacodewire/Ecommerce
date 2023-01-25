    <!--begin::Head-->
    <head>
        <meta charset="utf-8" />
        <title>{{config('app.name')}} | @yield('title') </title>
        <meta name="description" content="@yield('description')" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <!--begin::Fonts-->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
        <!--end::Fonts-->
        <link href="{{url('assets/plugins/custom/prismjs/prismjs.bundle.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{url('assets/css/style.bundle.css')}}" rel="stylesheet" type="text/css" />
        <!--end::Global Theme Styles-->
        <!--begin::Layout Themes(used by all pages)-->
        <link href="{{url('assets/css/themes/layout/header/base/light.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{url('assets/css/themes/layout/header/menu/light.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{url('assets/css/themes/layout/brand/dark.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{url('assets/css/themes/layout/aside/dark.css')}}" rel="stylesheet" type="text/css" />
        <!--end::Layout Themes-->
        <link rel="shortcut icon" href="{{url('assets/logo/elogo.png')}}" />
        <!--begin::Global Theme Styles(used by all pages)-->
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
        <link href="{{url('assets/plugins/global/plugins.bundle.css')}}" rel="stylesheet" type="text/css" />
        <!-- Editor -->
        <script src="https://cdn.ckeditor.com/4.17.1/standard/ckeditor.js"></script>
        
        @yield('style')
    </head>
    <!--end::Head-->
