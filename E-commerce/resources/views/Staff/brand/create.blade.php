@extends('Staff.layouts.master')


@section('content')

<section class="section">
    <div class="section-header">
      <h1>Brand</h1>
    </div>

    <div class="section-body">

      <div class="row">
        <div class="col-12">
          <div class="card">
              <div class="card-header">
                  <h4>Create Brand</h4>
              </div>
              <div class="card-body">
                <form action="{{ route('brand.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label>Brand logo (196x100)</label>
                        <input type="file" class="form-control" name="logo">
                    </div>
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" class="form-control" name="name" value="">
                    </div>
                    <div class="form-group">
                        <label>Feature</label>
                        <select name="is_featured" class="form-control"">
                            <option value="1">Yes</option>
                            <option value="0">No</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Status</label>
                        <select name="status" class="form-control"">
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Create Brand</button>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>

    </div>
  </section>

@endsection
