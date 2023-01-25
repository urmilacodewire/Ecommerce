
<!DOCTYPE html>

<html lang="en">
<!--begin::Head-->

<head>
    <base href="">
    <meta charset="utf-8" />
    <title>E-Commerce</title>
    <meta name="description" content="Metronic admin dashboard live demo. Check out all the features of the admin panel. A large number of settings, additional services and widgets." />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
    <!--end::Fonts-->

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />

    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap.min.css">

    <!--begin::Global Theme Styles(used by all pages)-->
    <link href="assets/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css" />
    <link href="assets/plugins/custom/prismjs/prismjs.bundle.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/style.bundle.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="assets/css/login.css">
    <!--end::Global Theme Styles-->

    <!--begin::Layout Themes(used by all pages)-->
    <link href="assets/css/themes/layout/header/base/light.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/themes/layout/header/menu/light.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/themes/layout/brand/dark.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/themes/layout/aside/dark.css" rel="stylesheet" type="text/css" />
    <!--end::Layout Themes-->

    <link rel="shortcut icon" href="{{url('assets/logo/CarfixPro2.png')}}" />
</head>
<!--end::Head-->
<!--begin::Body-->

<body style="background-color: #9703cd; background-image: url(../dist/assets/image/abstract-background-made-halftone-dots-white-gray-colors_444390-4058.webp);">

    <div class="login">
        <div class="container">
            <div class="row">
            <div class="col-md-3 col-12 px-md-0"></div>
                <div class="col-md-6 col-12 px-md-0">

                    <div class="parentlogin">
                         <form class="form" id="kt_login_signin_form" method="post" action="{{route('admin.login')}}">
                            @csrf
                            <div class="title">
                                <h1>Log In</h1>
                            </div>

                            <label class="label" for="name">Email</label>
                            <input type="text" name="email" placeholder="Enter Email Address">
                            <label class="label" for="password">Password</label>
                            <input type="password" name="password" placeholder="Enter Password">
                            <input type="submit" class="submit" >
                            <div class="extra">
                                <div class="checkbox mt-4 mt-md-0">
                                    <label><input type="checkbox" checked /> Remember me</label>
                                </div>
                               <!--  <div class="forget mt-4 mt-md-0">
                                    <a href="#">Forgot Password</a>
                                </div> -->
                            </div>
                        </form>
                    </div>
                </div>
                <!-- <div class="col-md-6 col-12 px-md-0">
                    <div class="parentdesc">
                        <div class="description">
                            <h2>Welcome To Login</h2>
                            <p>Don't have an password?</p>
                            <a href="Sign-up.html">Forgot Password</a>
                        </div>
                    </div>
                </div> -->
                <div class="col-md-3 col-12 px-md-0"></div>
            </div>
        </div>
    </div>


    <!--begin::Global Theme Bundle(used by all pages)-->
    <script src="assets/plugins/global/plugins.bundle.js"></script>
    <script src="assets/plugins/custom/prismjs/prismjs.bundle.js"></script>
    <script src="assets/js/scripts.bundle.js"></script>
    <!--end::Global Theme Bundle-->
    <!--begin::Page Vendors(used by this page)-->
    <script src="assets/plugins/custom/fullcalendar/fullcalendar.bundle.js"></script>
    <!--end::Page Vendors-->

    <!--begin::Page Scripts(used by this page)-->
    <script src="assets/js/pages/widgets.js"></script>
    <!--end::Page Scripts-->
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
            <!--begin::Page Scripts(used by this page)-->
        {{-- <script src="{{url('assets/js/pages/custom/login/login-general.js')}}"></script> --}}
        <!--end::Page Scripts-->
        <script src="{{url('assets/js/pages/features/miscellaneous/sweetalert2.js?v=7.2.5')}}"></script>
<!--end::Global Theme Bundle-->
<script>
const Toastr = swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000,
});
@if(count($errors) > 0)
    @foreach($errors->all() as $error)
        Toastr.fire({
            icon: 'error',
            title: "{{ $error }}"
        })
    @endforeach
@endif
@if(Session::has('success'))
    Toastr.fire({
        icon: 'success',
        title: "{{ Session::get('success') }}"
    })
@endif
@if(Session::has('info'))
    Toastr.fire({
        icon: 'info',
        title: "{{ Session::get('info') }}"
    })
@endif
@if(Session::has('warning'))
    Toastr.fire({
        icon: 'warning',
        title: "{{ Session::get('warning') }}"
    })
@endif
@if(Session::has('error'))
    Toastr.fire({
        icon: 'error',
        title: "{{ Session::get('error') }}"
    })
@endif
</script>

</body>
<!--end::Body-->

</html>
