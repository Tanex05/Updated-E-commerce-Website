<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport"
    content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no, target-densityDpi=device-dpi" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    @php
        $settings = \App\Models\FooterInfo::first();
        $favicon = $settings ? $settings->favicon : ''; // Check if $settings is not null before accessing properties
    @endphp

    @if ($favicon)
        <link rel="icon" type="image/png" href="{{ asset($favicon) }}">
    @endif

  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
  <title>TechnoBlast</title>
  <link rel="stylesheet" href="{{asset('Frontend/css/all.min.css')}}">
  <link rel="stylesheet" href="{{asset('Frontend/css/bootstrap.min.css')}}">
  <link rel="stylesheet" href="{{asset('Frontend/css/select2.min.css')}}">
  <link rel="stylesheet" href="{{asset('Frontend/css/slick.css')}}">
  <link rel="stylesheet" href="{{asset('Frontend/css/jquery.nice-number.min.css')}}">
  <link rel="stylesheet" href="{{asset('Frontend/css/jquery.calendar.css')}}">
  <link rel="stylesheet" href="{{asset('Frontend/css/add_row_custon.css')}}">
  <link rel="stylesheet" href="{{asset('Frontend/css/mobile_menu.css')}}">
  <link rel="stylesheet" href="{{asset('Frontend/css/jquery.exzoom.css')}}">
  <link rel="stylesheet" href="{{asset('Frontend/css/multiple-image-video.css')}}">
  <link rel="stylesheet" href="{{asset('Frontend/css/ranger_style.css')}}">
  <link rel="stylesheet" href="{{asset('Frontend/css/jquery.classycountdown.css')}}">
  <link rel="stylesheet" href="{{asset('Frontend/css/venobox.min.css')}}">
  <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

  <link rel="stylesheet" href="{{asset('Frontend/css/style.css')}}">
  <link rel="stylesheet" href="{{asset('Frontend/css/responsive.css')}}">
  <!-- <link rel="stylesheet" href="css/rtl.css"> -->
  <link rel="stylesheet" href="//cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
</head>

<body>


  <!--=============================
    DASHBOARD MENU START
  ==============================-->
  <div class="wsus__dashboard_menu">
    <div class="wsusd__dashboard_user">
      <img src="{{ Auth::user()->image ? asset(Auth::user()->image) : asset('Frontend/images/default.jpg') }}" alt="img" class="img-fluid">
      <p>{{ Auth::user()->name }}</p>
    </div>
  </div>
  <!--=============================
    DASHBOARD MENU END
  ==============================-->


  <!--=============================
    DASHBOARD START
  ==============================-->
    @yield('content')
  <!--=============================
    DASHBOARD START
  ==============================-->


  <!--============================
      SCROLL BUTTON START
    ==============================-->
  <div class="wsus__scroll_btn">
    <i class="fas fa-chevron-up"></i>
  </div>
  <!--============================
    SCROLL BUTTON  END
  ==============================-->


  <!--jquery library js-->
  <script src="{{asset('Frontend/js/jquery-3.6.0.min.js')}}"></script>
  <!--bootstrap js-->
  <script src="{{asset('Frontend/js/bootstrap.bundle.min.js')}}"></script>
  <!--font-awesome js-->
  <script src="{{asset('Frontend/js/Font-Awesome.js')}}"></script>
  <!--select2 js-->
  <script src="{{asset('Frontend/js/select2.min.js')}}"></script>
  <!--slick slider js-->
  <script src="{{asset('Frontend/js/slick.min.js')}}"></script>
  <!--simplyCountdown js-->
  <script src="{{asset('Frontend/js/simplyCountdown.js')}}"></script>
  <!--product zoomer js-->
  <script src="{{asset('Frontend/js/jquery.exzoom.js')}}"></script>
  <!--nice-number js-->
  <script src="{{asset('Frontend/js/jquery.nice-number.min.js')}}"></script>
  <!--counter js-->
  <script src="{{asset('Frontend/js/jquery.waypoints.min.js')}}"></script>
  <script src="{{asset('Frontend/js/jquery.countup.min.js')}}"></script>
  <!--add row js-->
  <script src="{{asset('Frontend/js/add_row_custon.js')}}"></script>
  <!--multiple-image-video js-->
  <script src="{{asset('Frontend/js/multiple-image-video.js')}}"></script>
  <!--sticky sidebar js-->
  <script src="{{asset('Frontend/js/sticky_sidebar.js')}}"></script>
  <!--price ranger js-->
  <script src="{{asset('Frontend/js/ranger_jquery-ui.min.js')}}"></script>
  <script src="{{asset('Frontend/js/ranger_slider.js')}}"></script>
  <!--isotope js-->
  <script src="{{asset('Frontend/js/isotope.pkgd.min.js')}}"></script>
  <!--venobox js-->
  <script src="{{asset('Frontend/js/venobox.min.js')}}"></script>
  <!--classycountdown js-->
  <script src="{{asset('Frontend/js/jquery.classycountdown.js')}}"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
  <!--Sweetalert js-->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <!--main/custom js-->
  <script src="{{asset('Frontend/js/main.js')}}"></script>

  <script src="//cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>

    @php
        $settingtwo = \App\Models\AdminApi::first();
        $TawkToSRC = $settingtwo ? $settingtwo->tawk_to : '';
    @endphp

    @php
        $settingtwo = \App\Models\AdminApi::first();
        $TawkToSRC = $settingtwo ? $settingtwo->tawk_to : '';
    @endphp

    @auth
        @if (!empty($TawkToSRC))
            <!--Start of Tawk.to Script-->
            <script type="text/javascript">
                var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
                // Set visitor name dynamically
                Tawk_API.visitor = {
                    name: '{{ auth()->user()->name }}', // Assuming user's name is stored in 'name' field
                    email: '{{ auth()->user()->email }}' // Assuming user's email is stored in 'email' field
                };
                (function(){
                    var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
                    s1.async=true;
                    s1.src= "{{ $TawkToSRC }}";
                    s1.charset='UTF-8';
                    s1.setAttribute('crossorigin','*');
                    s0.parentNode.insertBefore(s1,s0);
                })();
            </script>
            <!--End of Tawk.to Script-->
        @endif
    @endauth


  @stack('scripts')
  <!-- Notification Error -->
  <script>
    @if ($errors->any())
        @foreach ($errors->all() as $error)
            toastr.error("{{ $error }}")
        @endforeach
    @endif
  </script>

      <!-- Dynamic Delete Alert -->
      <script>
        $(document).ready(function(){
            $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

            $('body').on('click', '.delete-item', function(event){
                event.preventDefault();

                let deleteURL = $(this).attr('href');

                Swal.fire({
                    title: "Are you sure?",
                    text: "You won't be able to revert this!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Yes, delete it!"
                    }).then((result) => {
                        if (result.isConfirmed) {

                            $.ajax({
                                type: 'DELETE',
                                url: deleteURL,

                                success: function(data) {
                                if (data.status === 'success') {
                                    Swal.fire({
                                        title: "Deleted!",
                                        text: data.message,
                                        icon: "success",
                                        willClose: () => {
                                            window.location.reload();
                                        }
                                    });
                                } else if (data.status === 'error') {
                                    Swal.fire({
                                        title: "Can't Delete",
                                        text: data.message,
                                        icon: "error",
                                    });
                                }
                            },


                                error: function(xhr, status, error ){
                                    console.log(error);
                                }
                            })



                        }
                    });
                })

        })
      </script>

</body>

</html>
