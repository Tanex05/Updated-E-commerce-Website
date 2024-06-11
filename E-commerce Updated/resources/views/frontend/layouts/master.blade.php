<!DOCTYPE html>
<html lang="en">

<head>
    <title>@yield('seo_title', 'TechnoBlast')</title>
    <meta name="description" content="@yield('description', 'Discover a wide range of high-quality computer equipment, CCTV systems, computer parts, peripherals, and accessories at our e-commerce store. Shop now for the latest technology and best deals on hardware and software products.')">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, target-densityDpi=device-dpi" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />


    @php
        $settings = \App\Models\FooterInfo::first();
        $favicon = $settings ? $settings->favicon : ''; // Check if $settings is not null before accessing properties
    @endphp

    @if ($favicon)
        <link rel="icon" type="image/png" href="{{ asset($favicon) }}">
    @endif

    <!-- Defer loading non-critical CSS -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" media="print" onload="this.media='all'">
    <link rel="stylesheet" href="{{ asset('Frontend/css/bootstrap.min.css') }}" defer>
    <link rel="stylesheet" href="{{ asset('Frontend/css/select2.min.css') }}" defer>
    <link rel="stylesheet" href="{{ asset('Frontend/css/jquery.exzoom.css') }}" defer>
    <link rel="stylesheet" href="{{ asset('Frontend/css/style.css') }}" defer>

    <!-- Remaining non-critical CSS -->
    <link rel="stylesheet" href="{{ asset('Frontend/css/all.min.css') }}" defer>
    <link rel="stylesheet" href="{{ asset('Frontend/css/slick.css') }}" defer>
    <link rel="stylesheet" href="{{ asset('Frontend/css/jquery.nice-number.min.css') }}" defer>
    <link rel="stylesheet" href="{{ asset('Frontend/css/jquery.calendar.css') }}" defer>
    <link rel="stylesheet" href="{{ asset('Frontend/css/add_row_custon.css') }}" defer>
    <link rel="stylesheet" href="{{ asset('Frontend/css/mobile_menu.css') }}" defer>
    <link rel="stylesheet" href="{{ asset('Frontend/css/multiple-image-video.css') }}" defer>
    <link rel="stylesheet" href="{{ asset('Frontend/css/ranger_style.css') }}" defer>
    <link rel="stylesheet" href="{{ asset('Frontend/css/jquery.classycountdown.css') }}" defer>
    <link rel="stylesheet" href="{{ asset('Frontend/css/venobox.min.css') }}" defer>
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" defer>
    <link rel="stylesheet" href="{{ asset('Frontend/css/responsive.css') }}" defer>
    <!-- <link rel="stylesheet" href="css/rtl.css"> -->
    <link rel="stylesheet" href="//cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css" defer>

</head>

<body>

    <!--============================
        HEADER START
    ==============================-->

        @include('frontend.layouts.header')

    <!--============================
        HEADER END
    ==============================-->


    <!--============================
        MAIN MENU START
    ==============================-->

        @include('frontend.layouts.menu')

    <!--============================
        MAIN MENU END
    ==============================-->

    <!--==========================
        Main Content Start
    ===========================-->

        @yield('content')

    <!--==========================
        Main Content End
    ===========================-->


    <!--============================
        FOOTER PART START
    ==============================-->

        @include('frontend.layouts.footer')

    <!--============================
        FOOTER PART END
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
    <script src="{{ asset('Frontend/js/jquery-3.6.0.min.js') }}"></script>
    <!--bootstrap js-->
    <script src="{{ asset('Frontend/js/bootstrap.bundle.min.js') }}"></script>
    <!--font-awesome js-->
    <script src="{{ asset('Frontend/js/Font-Awesome.js') }}"></script>
    <!--select2 js-->
    <script src="{{ asset('Frontend/js/select2.min.js') }}"></script>
    <!--slick slider js-->
    <script src="{{ asset('Frontend/js/slick.min.js') }}"></script>
    <!--simplyCountdown js-->
    <script src="{{ asset('Frontend/js/simplyCountdown.js') }}"></script>
    <!--product zoomer js-->
    <script src="{{ asset('Frontend/js/jquery.exzoom.js') }}"></script>
    <!--nice-number js-->
    <script src="{{ asset('Frontend/js/jquery.nice-number.min.js') }}"></script>
    <!--counter js-->
    <script src="{{ asset('Frontend/js/jquery.waypoints.min.js') }}"></script>
    <script src="{{ asset('Frontend/js/jquery.countup.min.js') }}"></script>
    <!--add row js-->
    <script src="{{ asset('Frontend/js/add_row_custon.js') }}"></script>
    <!--multiple-image-video js-->
    <script src="{{ asset('Frontend/js/multiple-image-video.js') }}"></script>
    <!--sticky sidebar js-->
    <script src="{{ asset('Frontend/js/sticky_sidebar.js') }}"></script>
    <!--price ranger js-->
    <script src="{{ asset('Frontend/js/ranger_jquery-ui.min.js') }}"></script>
    <script src="{{ asset('Frontend/js/ranger_slider.js') }}"></script>
    <!--isotope js-->
    <script src="{{ asset('Frontend/js/isotope.pkgd.min.js') }}"></script>
    <!--venobox js-->
    <script src="{{ asset('Frontend/js/venobox.min.js') }}"></script>
    <!--classycountdown js-->
    <script src="{{ asset('Frontend/js/jquery.classycountdown.js') }}"></script>
    <!--Toastr js-->
    <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <!--Sweetalert js-->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


    <!--main/custom js-->
    <script src="{{ asset('Frontend/js/main.js') }}"></script>
    
    <!-- Defer loading of offscreen and hidden images -->
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var lazyImages = document.querySelectorAll('img[data-src]');
            lazyImages.forEach(function(img) {
                img.src = img.getAttribute('data-src');
                img.removeAttribute('data-src');
            });
        });
    </script>

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


    <script src="//cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>


      <!-- Notification Error -->
    <script>
        @if ($errors->any())
            @foreach ($errors->all() as $error)
                toastr.error("{{ $error }}")
            @endforeach
        @endif
    </script>

    @include('frontend.layouts.scripts')
    @stack('scripts')
</body>

</html>
