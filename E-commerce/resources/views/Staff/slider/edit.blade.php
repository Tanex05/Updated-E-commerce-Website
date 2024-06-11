@extends('Staff.layouts.master')

@section('content')

<section class="section">
    <div class="section-header">
      <h1>Table</h1>
    </div>

    <div class="section-body">

      <div class="row">
        <div class="col-12">
          <div class="card">
              <div class="card-header">
                  <h4>Edit Slider</h4>
              </div>
              <div class="card-body">
                <form action="{{ route('slider.update', $slider->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label>Preview </label>
                        <img width="100px" src="{{ asset($slider->banner) }}" alt="">
                    </div>
                    <div class="form-group">
                        <label>Banner Image (1300x520)</label>
                        <input type="file" class="form-control" name="banner">
                    </div>
                    <div class="form-group">
                        <label>Type</label>
                        <input type="text" class="form-control" name="type" value="{{ $slider->type }}">
                    </div>
                    <div class="form-group">
                        <label>Title</label>
                        <input type="text" class="form-control" name="title" value="{{ $slider->title }}">
                    </div>
                    <div class="form-group">
                        <label>Sub_Description</label>
                        <input type="text" class="form-control" name="sub_description" value="{{ $slider->sub_description }}">
                    </div>
                    <div class="form-group">
                        <label>Button Url</label>
                        <input type="text" class="form-control" name="btn_url" value="{{ $slider->btn_url }}">
                    </div>
                    <div class="form-group">
                        <label>Serial</label>
                        <input type="text" class="form-control" name="serial" value="{{ $slider->serial }}">
                    </div>
                    <div class="form-group">
                        <label>Status</label>
                        <select name="status" class="form-control">
                            <option {{ $slider->status == 1 ? 'selected': '' }} value="1">Active</option>
                            <option {{ $slider->status == 0 ? 'selected': '' }} value="0">Inactive</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Edit Banner</button>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>

    </div>
  </section>
@endsection
