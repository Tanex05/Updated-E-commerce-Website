@extends('frontend.dashboard.layouts.master')

@section('content')
<section id="wsus__dashboard">
    <div class="container-fluid">
      @include('frontend.dashboard.layouts.sidebar')
      <div class="row">
        <div class="col-xl-9 col-xxl-10 col-lg-9 ms-auto">
          <div class="dashboard_content">
            <h3><i class="fal fa-gift-card"></i> address</h3>
            <div class="wsus__dashboard_add">
              <div class="row">
                @foreach ($addresses as $address)
                <div class="col-xl-6">
                  <div class="wsus__dash_add_single">
                    <h4>Billing Address</h4>
                    <ul>
                      <li><span>name :</span> {{$address->name}}</li>
                      <li><span>email :</span> {{$address->email}}</li>
                      <li><span>phone :</span> {{$address->phone}}</li>
                      <li><span>region :</span> {{$address->region}}</li>
                      <li><span>province :</span> {{$address->province}}</li>
                      <li><span>barangay :</span> {{$address->barangay}}</li>
                      <li><span>city :</span> {{$address->city}}</li>
                      <li><span>postal code :</span> {{$address->postal_code}}</li>
                      <li><span>address :</span> {{$address->address}}</li>
                    </ul>
                    <div class="wsus__address_btn">
                      <a href="{{route('user.address.edit', $address->id)}}" class="edit"><i class="fal fa-edit"></i> edit</a>
                      <a href="{{route('user.address.destroy', $address->id)}}" class="del delete-item"><i class="fal fa-trash-alt"></i> delete</a>
                    </div>
                  </div>
                </div>
                @endforeach
                <div class="col-12">
                  <a href="{{route('user.address.create')}}" class="add_address_btn common_btn"><i class="far fa-plus"></i>
                    add new address</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection
