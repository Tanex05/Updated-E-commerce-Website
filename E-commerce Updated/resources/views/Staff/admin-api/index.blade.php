@extends('Staff.layouts.master')

@section('content')
      <!-- Main Content -->
        <section class="section">
          <div class="section-header">
            <h1>API</h1>
          </div>

          <div class="section-body">

            <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <h4>Manage API</h4>

                  </div>
                  <div class="card-body">
                    <form action="{{route('Admin-Api.update', 1)}}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label>Tawk.to SRC</label>
                            <input type="text" class="form-control" name="tawk_to" value="{{@$AdminApi->tawk_to}}">
                        </div>

                        <div class="form-group">
                            <label>Paymongo Secret Key</label>
                            <input type="text" class="form-control" name="paymongo_secret_key" value="{{@$AdminApi->paymongo_secret_key}}">
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
