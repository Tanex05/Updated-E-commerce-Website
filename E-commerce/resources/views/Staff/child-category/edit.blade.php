@extends('Staff.layouts.master')


@section('content')

<section class="section">
    <div class="section-header">
      <h1>Child Category</h1>
    </div>

    <div class="section-body">

      <div class="row">
        <div class="col-12">
          <div class="card">
              <div class="card-header">
                  <h4>Update Child Category</h4>
              </div>
              <div class="card-body">
                <form action="{{ route('child-category.update', $childCategory->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label>Category</label>
                        <select name="category" select2 class="form-control main-category">
                            <option value="">Select</option>
                            @foreach ($categories as $category )
                                <option {{ $category->id == $childCategory->category_id ? 'selected' : '' }} value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Sub Category</label>
                        <select name="sub_category" select2 class="form-control sub-category"">
                            <option value="">Select</option>
                            @foreach ($subCategory as $subCategories)
                                <option {{ $subCategories->id == $childCategory->sub_category_id ? 'selected' : ''}} value="{{ $subCategories->id }}">{{ $subCategories->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" class="form-control" name="name" value="{{ $childCategory->name }}">
                    </div>
                    <div class="form-group">
                        <label>Status</label>
                        <select name="status" class="form-control"">
                            <option {{ $childCategory->status == 1 ? 'selected': '' }} value="1">Active</option>
                            <option {{ $childCategory->status == 0 ? 'selected': '' }} value="0">Inactive</option>
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

@push('scripts')


<!-- Script for Fetching Sub Categories -->
<script>
    $(document).ready(function(){
        $('body').on('change', '.main-category', function(e){
            let id = $(this).val();

            $.ajax({
                method: 'GET',
                url: "{{ route('get-subcategories') }}",
                data: {
                    id: id
                },
                success: function(data) {

                    $('.sub-category').html(`<option value="">Select</option>`);

                    $.each(data, function(i, item){
                        $('.sub-category').append(`<option value="${item.id}">${item.name}</option>`);
                    });
                },
                error: function(xhr, status, error){
                    console.log(error);
                }
            });
        });
    });
</script>

@endpush
