<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
<script src="{{url('assets/js/jquery.min.js')}}"></script>
<script src="{{url('assets/js/bootstrap.min.js')}}"></script>
<script src="{{url('assets/plugins/custom/prismjs/prismjs.bundle.js')}}"></script>
<script src="{{url('assets/plugins/global/plugins.bundle.js')}}"></script>
<script src="{{url('assets/js/scripts.bundle.js')}}"></script>
<script src="{{url('assets/js/owl.carousel.min.js')}}"></script>
<script src="{{url('assets/js/pages/features/miscellaneous/sweetalert2.js?v=7.2.5')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>HOST_URL="{{url('/')}}"</script>
<script type="text/javascript">
 $(document).ready(function() {
   
 
   $(".cutom_sidebar_menu_icon").click(function(){
     $(".cutom_sidebar_menu_icon").toggleClass("open_slidebar");
     $(".small_right").toggleClass("open_slidebar");
   });
   var base_url = 'https://delhicrimepress.in/';
   
   var s = $("body");
      var pos = s.position();
      $(window).scroll(function() {
      var windowpos = $(window).scrollTop();
      if (windowpos >= pos.top & windowpos >=300) {
         s.addClass("footer_stick");
      } else {
         s.removeClass("footer_stick");
      }
      });
 
   var s = $("#back-top");
   var pos = s.position();
   $(window).scroll(function() {
      var windowpos = $(window).scrollTop();
      if (windowpos >= pos.top & windowpos >=250) {
         s.addClass("active");
      } else {
         s.removeClass("active");
      }
   });
 
   $("#searchNews").on('keyup', function(){
      var searchNews = $("#searchNews").val();
 
      if(searchNews != undefined && searchNews != "undefined" && searchNews != "" && searchNews != " "){
         $.ajax({
            type: "post",
            url: 'https://delhicrimepress.in/welcome/search',
            data: { searchNews: searchNews },
            dataType: 'json',
            success: function(response){
 
               $("#searchNewsResult").addClass('display');
               if(response.status && parseInt(response.count) > 0){
                  var _searchResultHtml = '<ul>';
                  for(i=0; i < response.data.length; i++){
                     _searchResultHtml += '<li>';
                        _searchResultHtml += '<a href="'+ base_url + response.data[i].slug +'">';
                           _searchResultHtml += response.data[i].title;
                        _searchResultHtml += '</a>';
                     _searchResultHtml += '</li>';
                  }
                  _searchResultHtml += '</ul>';
               }
               else{
                  var _searchResultHtml = 'No Results';
               }
               $("#searchNewsResult").html(_searchResultHtml);
            }
         })
      }
      else{
         $("#searchNewsResult").html('');
         $("#searchNewsResult").removeClass('display');
      }
   });
 });
   document.querySelectorAll('a[href^="#"]').forEach(anchor => {
     anchor.addEventListener('click', function (e) {
         e.preventDefault();
 
         document.querySelector(this.getAttribute('href')).scrollIntoView({
             behavior: 'smooth'
         });
     });
 }); 


 //////////////////////success messages

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
     