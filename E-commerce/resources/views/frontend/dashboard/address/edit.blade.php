@extends('frontend.dashboard.layouts.master')

@section('content')
<section id="wsus__dashboard">
    <div class="container-fluid">
      @include('frontend.dashboard.layouts.sidebar')

      <div class="row">
        <div class="col-xl-9 col-xxl-10 col-lg-9 ms-auto">
          <div class="dashboard_content mt-2 mt-md-0">
            <h3><i class="fal fa-gift-card"></i>Update Address</h3>
            <div class="wsus__dashboard_add wsus__add_address">
              <form action="{{route('user.address.update', $address->id)}}" method="POST">
                @csrf
                @method('PUT')
                <div class="row">
                  <div class="col-xl-6 col-md-6">
                    <div class="wsus__add_address_single">
                      <label>name <b>*</b></label>
                      <input type="text" placeholder="Name" name="name" value="{{$address->name}}">
                    </div>
                  </div>
                  <div class="col-xl-6 col-md-6">
                    <div class="wsus__add_address_single">
                      <label>email</label>
                      <input type="email" placeholder="Email" name="email" value="{{$address->email}}">
                    </div>
                  </div>
                  <div class="col-xl-6 col-md-6">
                    <div class="wsus__add_address_single">
                      <label>phone <b>*</b></label>
                      <input type="text" placeholder="Phone" name="phone" value="{{$address->phone}}">
                    </div>
                  </div>

                  <div class="col-xl-6 col-md-6">
                    <div class="wsus__add_address_single">
                      <label>region <b>*</b></label>
                      <input type="text" placeholder="Region" name="region" value="{{$address->region}}">
                    </div>
                  </div>

                  <div class="col-xl-6 col-md-6">
                    <div class="wsus__add_address_single">
                      <label>province <b>*</b></label>
                      <input type="text" placeholder="Province" name="province" value="{{$address->province}}">
                    </div>
                  </div>

                  <div class="col-xl-6 col-md-6">
                    <div class="wsus__add_address_single">
                      <label>barangay <b>*</b></label>
                      <input type="text" placeholder="Barangay" name="barangay" value="{{$address->barangay}}">
                    </div>
                  </div>


                  <div class="col-xl-6 col-md-6">
                    <div class="wsus__add_address_single">
                      <label>city<b>*</b></label>
                      <input type="text" placeholder="City" name="city" value="{{$address->city}}">
                    </div>
                  </div>

                  <div class="col-xl-6 col-md-6">
                    <div class="wsus__add_address_single">
                      <label>postal code <b>*</b></label>
                      <input type="text" placeholder="Postal Code" name="postal_code" value="{{$address->postal_code}}">
                    </div>
                  </div>

                  <div class="col-xl-6 col-md-6">
                    <div class="wsus__add_address_single">
                      <label>address <b>*</b></label>
                      <input type="text" placeholder="Address" name="address" value="{{$address->address}}">
                    </div>
                  </div>

                  <div class="col-xl-6">
                    <button type="submit" class="common_btn">Update Address</button>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection
