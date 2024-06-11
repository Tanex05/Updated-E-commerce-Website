@extends('Staff.layouts.master')

@section('content')
      <!-- Main Content -->
        <section class="section">
          <div class="section-header">
            <h1>Footer</h1>
          </div>

          <div class="section-body">

            <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <h4>Footer Info</h4>

                  </div>
                  <div class="card-body">
                    <form action="{{route('footer-info.update', 1)}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <img src="{{asset(@$footerInfo->logo)}}" width="150px" alt="">
                            <br>
                            <label>Logo (249x87)</label>
                            <input type="file" class="form-control" name="logo" >
                        </div>
                        <div class="form-group">
                            <img src="{{asset(@$footerInfo->favicon)}}" width="150px" alt="">
                            <br>
                            <label>Favicon</label>
                            <input type="file" class="form-control" name="favicon" >
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>phone</label>
                                    <input type="text" class="form-control" name="phone" value="{{@$footerInfo->phone}}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>email</label>
                                    <input type="text" class="form-control" name="email" value="{{@$footerInfo->email}}">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>address</label>
                            <input type="text" class="form-control" name="address" value="{{@$footerInfo->address}}">
                        </div>

                        <div class="form-group">
                            <label>copyright</label>
                            <input type="text" class="form-control" name="copyright" value="{{@$footerInfo->copyright}}">
                        </div>

                        <div class="form-group">
                            <label>Map</label>
                            <input type="text" class="form-control" name="map" value="{{@$footerInfo->map}}">
                        </div>

                        <button type="submit" class="btn btn-primary">Update</button>
                    </form>
                  </div>

                </div>
              </div>
            </div>

          </div>
        </section>

@endsection
