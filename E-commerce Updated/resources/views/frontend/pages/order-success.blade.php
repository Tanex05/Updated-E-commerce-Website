@extends('frontend.layouts.master')

@section('content')
    <!--============================
        BREADCRUMB START
    ==============================-->
    <section id="wsus__breadcrumb">
        <div class="wsus_breadcrumb_overlay">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h4>payment</h4>
                        <ul>
                            <li><a href="{{ route('home') }}">home</a></li>
                            <li><a href="javascript:;">payment</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--============================
        BREADCRUMB END
    ==============================-->


    <!--============================
        PAYMENT PAGE START
    ==============================-->
    <section id="wsus__cart_view">
        <div class="container">
            <div class="wsus__pay_info_area">
                <div class="row justify-content-center">
                    <div class="col-md-8 text-center">
                        <h1 class="mb-4">Order Successful!</h1>
                        <p class="lead">Thank you for your purchase.</p>
                        <p class="lead">You will be redirected to the home page shortly.</p>
                        <div id="countdown" class="mt-4"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--============================
        PAYMENT PAGE END
    ==============================-->

    <script>
        // Countdown timer
        const countdown = document.getElementById('countdown');
        let timeLeft = 5; // Time in seconds

        const countdownInterval = setInterval(() => {
            if (timeLeft <= 0) {
                clearInterval(countdownInterval);
                window.location.href = "{{ route('home') }}"; // Redirect to home page
            } else {
                countdown.innerHTML = `<p>Redirecting in ${timeLeft} seconds...</p>`;
                timeLeft--;
            }
        }, 1000);

    </script>
@endsection

