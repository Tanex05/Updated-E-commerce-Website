@extends('Staff.layouts.master')


@section('content')

<section class="section">
    <div class="section-header">
      <h1>Category</h1>
    </div>

    <div class="section-body">

      <div class="row">
        <div class="col-12">
          <div class="card">
              <div class="card-header">
                  <h4>Create Category</h4>
              </div>
              <div class="card-body">
                <form action="{{ route('category.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label>Icon</label>
                        <div>
                            <button class="btn btn-primary" data-selected-class="btn-danger" data-unselected-class="btn-info" name="icon" role="iconpicker"></button>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" class="form-control" name="name" value="">
                    </div>
                    <div class="form-group">
                        <label>Status</label>
                        <select name="status" class="form-control"">
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Create Category</button>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>

    </div>
  </section>

@endsection
