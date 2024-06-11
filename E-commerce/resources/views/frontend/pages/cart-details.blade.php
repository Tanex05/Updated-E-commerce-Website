@extends('frontend.layouts.master')

@section('content')
    <!--============================
        BREADCRUMB START
    ==============================-->
    <section id="wsus__breadcrumb">
        <div class="wsus_breadcrumb_overlay">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h4>cart View</h4>
                        <ul>
                            <li><a href="#">home</a></li>
                            <li><a href="#">product</a></li>
                            <li><a href="#">cart view</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--============================
        BREADCRUMB END
    ==============================-->


    <!--============================
        CART VIEW PAGE START
    ==============================-->
    <section id="wsus__cart_view">
        <div class="container">
            <div class="row">
                <div class="col-xl-9">
                    <div class="wsus__cart_list">
                        <div class="table-responsive">
                            <table>
                                <tbody>
                                    <tr class="d-flex">
                                        <th class="wsus__pro_img">
                                            product item
                                        </th>

                                        <th class="wsus__pro_name">
                                            product details
                                        </th>

                                        <th class="wsus__pro_tk">
                                           unit price
                                        </th>

                                        <th class="wsus__pro_tk">
                                            total
                                        </th>

                                        <th class="wsus__pro_select">
                                            quantity
                                        </th>



                                        <th class="wsus__pro_icon">
                                            <a href="#" class="common_btn clear_cart">clear cart</a>
                                        </th>
                                    </tr>
                                    @foreach ($cartItems as $item)
                                    <tr class="d-flex">
                                        <td class="wsus__pro_img"><img src="{{asset($item->options->image)}}" alt="product"
                                                class="img-fluid w-100">
                                        </td>

                                        <td class="wsus__pro_name">
                                            <p>{!! $item->name !!}</p>
                                            @foreach ($item->options->variants as $key => $variant)
                                            <span>{{ $key }}: {{ $variant['name'] }} (₱{{ number_format((double) $variant['price'], 2) }})</span>
                                            @endforeach

                                        </td>

                                        <td class="wsus__pro_tk">
                                            <h6>{{ '₱' . number_format((double) $item->price, 2) }}</h6>
                                        </td>

                                        <td class="wsus__pro_tk">
                                            <h6 id="{{ $item->rowId }}">{{ '₱' . number_format((double) (($item->price + $item->options->variants_total) * $item->qty), 2) }}</h6>
                                        </td>

                                        <td class="wsus__pro_select">
                                            <div class="product_qty_wrapper">
                                                <button class="btn btn-danger product-decrement">-</button>
                                                <input class="product-qty" data-rowid="{{$item->rowId}}" data-max-quantity="{{ optional($item->model)->qty ?? 0 }}" type="text" min="1" value="{{$item->qty}}" readonly />



                                                <button class="btn btn-success product-increment">+</button>
                                            </div>
                                        </td>

                                        <td class="wsus__pro_icon">
                                            <a href="{{route('cart.remove-product', $item->rowId)}}"><i class="far fa-times"></i></a>
                                        </td>
                                    </tr>
                                    @endforeach

                                    @if (count($cartItems) === 0)
                                        <tr class="d-flex" >
                                            <td class="wsus__pro_icon" rowspan="2" style="width:100%">
                                                Cart is empty!
                                            </td>
                                        </tr>

                                    @endif

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3">
                    <div class="wsus__cart_list_footer_button" id="sticky_sidebar">
                        <h6>total cart</h6>
                        <p>subtotal: <span id="sub_total">₱ {{ number_format(getCartTotal(), 2, '.', ',') }}</span></p>
                        <p>coupon(-): <span id="discount">₱ {{ number_format(getCartDiscount(), 2, '.', ',') }}</span></p>
                        <p class="total"><span>total:</span> <span id="cart_total">₱ {{ number_format(getMainCartTotal(), 2, '.', ',') }}</span></p>




                        <form id="coupon_form">
                            <input type="text" placeholder="Coupon Code" name="coupon_code" value="{{ session()->has('coupon') ? session()->get('coupon')['coupon_code'] : '' }}" {{ $disabled ? 'disabled' : '' }}>
                            <button type="submit" class="common_btn" {{ $disabled ? 'disabled' : '' }}>apply</button>
                        </form>
                        @if ($disabled)
                            <p style="color:red">Coupon disabled because the cart contains a flashout item.</p>
                        @endif

                        <a class="common_btn mt-4 w-100 text-center" href="{{route('user.checkout')}}">checkout</a>
                        <a class="common_btn mt-1 w-100 text-center" href="{{route('home')}}"> <i class="fas fa-shopping-basket"></i>Keep Shopping</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section id="wsus__single_banner">
        <div class="container">
            <div class="row">
                <div class="col-xl-6 col-lg-6">
                    <div class="wsus__single_banner_content">
                        @if(isset($cartpage_banner_section->banner_one) && isset($cartpage_banner_section->banner_one->status) && $cartpage_banner_section->banner_one->status == 1)
                            <a href="{{$cartpage_banner_section->banner_one->banner_url}}">
                                <img class="img-fluid" style="max-width: 100%; height: auto;" src="{{asset($cartpage_banner_section->banner_one->banner_image)}}" alt="">
                            </a>
                        @endif
                    </div>
                </div>
                <div class="col-xl-6 col-lg-6">
                    <div class="wsus__single_banner_content single_banner_2">
                        @if(isset($cartpage_banner_section->banner_two) && isset($cartpage_banner_section->banner_two->status) && $cartpage_banner_section->banner_two->status == 1)
                            <a href="{{$cartpage_banner_section->banner_two->banner_url}}">
                                <img class="img-fluid" style="max-width: 100%; height: auto;" src="{{asset($cartpage_banner_section->banner_two->banner_image)}}" alt="">
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!--============================
          CART VIEW PAGE END
    ==============================-->
@endsection

@push('scripts')
<script>
    $(document).ready(function(){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        // Increment product quantity
        $('.product-increment').on('click', function(){
            let input = $(this).siblings('.product-qty');
            let currentQuantity = parseInt(input.val());
            let maxAllowedQuantity = parseInt(input.data('max-quantity')); // Retrieve the maximum allowed quantity from the 'max-quantity' data attribute
            let rowId = input.data('rowid');

            // Check if the current quantity is equal to the maximum allowed quantity
            if (currentQuantity >= maxAllowedQuantity) {
                toastr.error('Reached maximum quantity of product');
                return;
            }

            // Increment the quantity only if it's less than the maximum allowed quantity
            let quantity = Math.min(currentQuantity + 1, maxAllowedQuantity);
            input.val(quantity);

            let productId = '#' + rowId;
            $(productId).text(""); // Or any other default value

            // Send Ajax request to update the quantity
            $.ajax({
                url: "{{ route('cart.update-quantity') }}", // Use the existing route for updating quantity
                method: 'POST',
                data: {
                    rowId: rowId,
                    quantity: quantity
                },
                success: function(data){
                    if(data.status === 'success'){
                        let productId = '#' + rowId;
                        let totalAmount = "₱" + parseFloat(data.product_total).toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,'); // Format the currency
                        $(productId).text(totalAmount);

                        // Update cart total
                        $('#cart_total').text("₱" + parseFloat(data.cart_total).toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,')); // Format the currency

                        // Update other cart details
                        renderCartSubTotal();
                        calculateCouponDiscount();

                        if (data.message !== '') {
                            toastr.success(data.message);
                        }
                    } else if (data.status === 'error'){
                        // Display error message
                        toastr.error(data.message);

                        // Reset the input value to previous quantity
                        input.val(currentQuantity);
                    }
                },
                // Display error message directly
                error: function(xhr, status, error){
                    toastr.error('Failed to update product quantity');

                    // Reset the input value to previous quantity
                    input.val(currentQuantity);
                }
            });
        });


        // Decrement product quantity
        $('.product-decrement').on('click', function(){
            let input = $(this).siblings('.product-qty');
            let quantity = parseInt(input.val()) - 1;
            let rowId = input.data('rowid');

            if(quantity < 1){
                quantity = 1;
            }

            input.val(quantity);

            $.ajax({
                url: "{{route('cart.update-quantity')}}",
                method: 'POST',
                data: {
                    rowId: rowId,
                    quantity: quantity
                },
                success: function(data){
                    if(data.status === 'success'){
                        let productId = '#' + rowId;
                        let totalAmount = "₱" + parseFloat(data.product_total).toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,'); // Format the currency
                        $(productId).text(totalAmount);

                        renderCartSubTotal();
                        calculateCouponDiscount();

                        if (quantity !== 1) {
                            toastr.success(data.message);
                        }
                    } else if (data.status === 'error'){
                        toastr.error(data.message);
                    }
                },
                error: function(data){
                    // Handle error
                }
            });
        });

        // clear cart
        $('.clear_cart').on('click', function(e){
            e.preventDefault();
            Swal.fire({
                    title: 'Are you sure?',
                    text: "This action will clear your cart!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, clear it!'
                    }).then((result) => {
                    if (result.isConfirmed) {

                        $.ajax({
                            type: 'get',
                            url: "{{route('clear.cart')}}",
                            success: function(data){
                                if(data.status === 'success'){
                                    window.location.reload();
                                }
                            },
                            error: function(xhr, status, error){
                                console.log(error);
                            }
                        })
                    }
                })
        })

        // get subtotal of cart and put it on dom
        function renderCartSubTotal(){
            $.ajax({
                method: 'GET',
                url: "{{ route('cart.sidebar-product-total') }}",
                success: function(data) {
                    // Format the subtotal amount with commas and two decimal places
                    let formattedSubTotal = "₱" + parseFloat(data).toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,');
                    $('#sub_total').text(formattedSubTotal);
                },
                error: function(data) {
                    console.log(data);
                }
            })
        }

        $('#coupon_form').on('submit', function(e){
            e.preventDefault();
            let formData = $(this).serialize();
            $.ajax({
                method: 'GET',
                url: "{{ route('apply-coupon') }}",
                data: formData,
                success: function(data) {
                if(data.status === 'error'){
                    toastr.error(data.message)
                } else if (data.status === 'success'){
                    calculateCouponDiscount(); // corrected function name
                    toastr.success(data.message)
                }
                },
                error: function(data) {
                    console.log(data);
                }
            });
        });

        // Calculate discount amount
        function calculateCouponDiscount(){
            $.ajax({
                method: 'GET',
                url: "{{ route('coupon-calculation') }}",
                success: function(data) {
                    if(data.status === 'success'){
                        $('#discount').text('₱' + parseFloat(data.discount).toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,')); // Format the currency
                        $('#cart_total').text('₱' + parseFloat(data.cart_total).toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,')); // Format the currency
                    }
                },
                error: function(data) {
                    console.log(data);
                }
            });
        }


    })


</script>
@endpush
