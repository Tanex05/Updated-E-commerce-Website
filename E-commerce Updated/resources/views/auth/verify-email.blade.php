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
                        <h4>login / register</h4>
                        <ul>
                            <li><a href="#">home</a></li>
                            <li><a href="#">login / register</a></li>
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
       Add Verfication Email Design Here
    ==============================-->
    <section id="wsus__verify_email" style="margin-top: 50px">
        <div style="background-color: #f8f9fa;">
            <div style="max-width: 800px; margin: 0 auto; padding: 30px;">
                <!-- Verification Card -->
                <div style="background-color: #fff; border-radius: 10px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
                    <div style="background-color: #26577C; color: #fff; padding: 20px; border-top-left-radius: 10px; border-top-right-radius: 10px;">
                        <h2 style="font-size: 24px; font-weight: bold; margin: 0; color:white">Verify Your Email Address</h2>
                    </div>
                    <div style="padding: 20px;">
                        @if (session('resent'))
                            <div style="background-color: #d4edda; color: #155724; border: 1px solid #c3e6cb; border-radius: 5px; padding: 10px; margin-bottom: 20px;">
                                A fresh verification link has been sent to your email address.
                            </div>
                        @endif

                        <p style="margin-bottom: 20px;">Before proceeding, please check your email for a verification link.</p>
                        <p style="margin-bottom: 5px;">If you did not receive the email,
                            <x-verification-resend-button :route="route('verification.send')" style="background-color: #26577C; color: #fff; padding: 10px 20px; border-radius: 5px; text-decoration: none;">
                                Click here to request another
                            </x-verification-resend-button>
                        </p>
                        <p style="margin-top: 20px;">Already verified? <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" style="color: #26577C; text-decoration: none;">Logout</a></p>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!--============================
       LOGIN/REGISTER PAGE END
    ==============================-->

@endsection
