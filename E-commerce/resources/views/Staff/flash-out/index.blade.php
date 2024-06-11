@extends('Staff.layouts.master')

@section('content')
      <!-- Main Content -->
        <section class="section">
          <div class="section-header">
            <h1>Flash Out</h1>
          </div>

          <div class="section-body">

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <h4>Add Flash Out Products</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('flash-out.add-product') }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label>Search For Product</label>
                                    <div class="form-group">
                                        <input type="text" id="productSearch" class="form-control" placeholder="Search for a product">
                                    </div>
                                    <label>Add Product</label>
                                    <select name="product" id="productDropdown" class="form-control select2">
                                        <option value="">Select</option>
                                        @foreach ($products as $product)
                                        <option value="{{ $product->id }}">{{ $product->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Show at home?</label>
                                            <select name="show_at_home" id="" class="form-control">
                                                <option value="">Select</option>
                                                <option value="1">Yes</option>
                                                <option value="0">No</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Status</label>
                                            <select name="status" id="" class="form-control">
                                                <option value="">Select</option>
                                                <option value="1">Active</option>
                                                <option value="0">Inactive</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary">Save</button>
                            </form>
                        </div>
                    </div>
                </div>

            </div>

          </div>

          <div class="section-body">

            <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <h4>All Flash Out Products</h4>

                  </div>
                  <div class="card-body">
                    {{ $dataTable->table() }}
                  </div>

                </div>
              </div>
            </div>

          </div>
        </section>

@endsection

@push('scripts')
    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}

    <script>
        $(document).ready(function(){
            // chage the flash sale status
            $('body').on('click', '.change-status', function(){
                let isChecked = $(this).is(':checked');
                let id = $(this).data('id');

                $.ajax({
                    url: "{{route('flash-out-status')}}",
                    method: 'PUT',
                    data: {
                        status: isChecked,
                        id: id
                    },
                    success: function(data){
                        toastr.success(data.message)
                    },
                    error: function(xhr, status, error){
                        console.log(error);
                    }
                })

            })

            // chage show at home status
            $('body').on('click', '.change-at-home-status', function(){
                let isChecked = $(this).is(':checked');
                let id = $(this).data('id');

                $.ajax({
                    url: "{{route('flash-out.show-at-home.change-status')}}",
                    method: 'PUT',
                    data: {
                        status: isChecked,
                        id: id
                    },
                    success: function(data){
                        toastr.success(data.message)
                    },
                    error: function(xhr, status, error){
                        console.log(error);
                    }
                })

            })
        })
    </script>

<script>
    $(document).ready(function () {
        // Initialize the search input
        $('#productSearch').on('input', function () {
            var searchQuery = $(this).val();

            // Fetch products using AJAX
            $.ajax({
                url: "{{ route('get.products.dropdown-flashout') }}",
                method: 'GET',
                data: { q: searchQuery },
                success: function (data) {
                    // Update the Select2 dropdown with the fetched products
                    $('#productDropdown').empty();

                    if (data.length === 1) {
                        // If there's only one result, automatically select it
                        $('#productDropdown').append('<option value="' + data[0].id + '" selected>' + data[0].name + '</option>');
                    } else {
                        // If there are multiple results, show the "Select" option
                        $('#productDropdown').append('<option value="">Select</option>');
                        $.each(data, function (index, product) {
                            $('#productDropdown').append('<option value="' + product.id + '">' + product.name + '</option>');
                        });
                    }

                    // Reinitialize Select2
                    $('#productDropdown').select2({
                        placeholder: 'Search for a product',
                        allowClear: true,
                        minimumInputLength: 1,
                        tags: true,
                        data: data
                    });

                    // Trigger change event to update Select2 UI
                    $('#productDropdown').trigger('change');
                },
                error: function (xhr, status, error) {
                    console.log(error);
                }
            });
        });

        // Initialize the Select2 dropdown without options
        $('#productDropdown').select2({
            placeholder: 'Search for a product',
            allowClear: true,
            minimumInputLength: 1,
            tags: true,
            data: []
        });
    });
</script>


@endpush

