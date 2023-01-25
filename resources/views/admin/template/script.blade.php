<!--begin::Global Theme Bundle(used by all pages)-->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

<script src="{{url('assets/plugins/custom/prismjs/prismjs.bundle.js')}}"></script>
<script src="{{url('assets/plugins/global/plugins.bundle.js')}}"></script>
<script src="{{url('assets/js/scripts.bundle.js')}}"></script>
<script src="{{url('assets/js/pages/features/miscellaneous/sweetalert2.js?v=7.2.5')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>HOST_URL="{{url('/')}}"</script>

<script>
    $(document).ready(function() {
    $('.js-example-basic-multiple').select2();
});

$(document).ready(function() {
    $('.js-example-basic-single').select2();
});
</script>

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

<script>
    var KTAppSettings = { "breakpoints": { "sm": 576, "md": 768, "lg": 992, "xl": 1200, "xxl": 1400 }, "colors": { "theme": { "base": { "white": "#ffffff", "primary": "#3699FF", "secondary": "#E5EAEE", "success": "#1BC5BD", "info": "#8950FC", "warning": "#FFA800", "danger": "#F64E60", "light": "#E4E6EF", "dark": "#181C32" }, "light": { "white": "#ffffff", "primary": "#E1F0FF", "secondary": "#EBEDF3", "success": "#C9F7F5", "info": "#EEE5FF", "warning": "#FFF4DE", "danger": "#FFE2E5", "light": "#F3F6F9", "dark": "#D6D6E0" }, "inverse": { "white": "#ffffff", "primary": "#ffffff", "secondary": "#3F4254", "success": "#ffffff", "info": "#ffffff", "warning": "#ffffff", "danger": "#ffffff", "light": "#464E5F", "dark": "#ffffff" } }, "gray": { "gray-100": "#F3F6F9", "gray-200": "#EBEDF3", "gray-300": "#E4E6EF", "gray-400": "#D1D3E0", "gray-500": "#B5B5C3", "gray-600": "#7E8299", "gray-700": "#5E6278", "gray-800": "#3F4254", "gray-900": "#181C32" } }, "font-family": "Poppins" };
</script>

@yield('script')
