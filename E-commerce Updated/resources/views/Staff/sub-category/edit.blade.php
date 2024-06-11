@extends('Staff.layouts.master')


@section('content')

<section class="section">
    <div class="section-header">
      <h1>Sub Category</h1>
    </div>

    <div class="section-body">

      <div class="row">
        <div class="col-12">
          <div class="card">
              <div class="card-header">
                  <h4>Update Sub Category</h4>
              </div>
              <div class="card-body">
                <form action="{{ route('sub-category.update', $subCategory->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label>Category</label>
                        <select name="category" select2 class="form-control"">
                            <option value="">Select</option>
                            @foreach ($categories as $category)
                                <option {{ $category->id == $subCategory->category_id ? 'selected' : '' }} value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" class="form-control" name="name" value="{{ $subCategory->name }}">
                    </div>
                    <div class="form-group">
                        <label>Status</label>
                        <select name="status" class="form-control"">
                            <option {{ $subCategory->status == 1 ? 'selected': '' }} value="1">Active</option>
                            <option {{ $subCategory->status == 0 ? 'selected': '' }} value="0">Inactive</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Update Sub Category</button>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>

    </div>
  </section>

@endsection
