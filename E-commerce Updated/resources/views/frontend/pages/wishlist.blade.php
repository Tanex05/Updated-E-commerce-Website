@extends('frontend.layouts.master')

@section('content')
<section id="wsus__breadcrumb">
    <div class="wsus_breadcrumb_overlay">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h4>wishlist</h4>
                    <ul>
                        <li><a href="#">home</a></li>
                        <li><a href="#">product</a></li>
                        <li><a href="#">wishlist</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

<section id="wsus__cart_view">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="wsus__cart_list wishlist">
                    <div class="table-responsive">
                        <table>
                            <tbody>
                                <tr class="d-flex">
                                    <th class="wsus__pro_img">
                                        product item
                                    </th>

                                    <th class="wsus__pro_name" style="width:500px">
                                        product details
                                    </th>

                                    <th class="wsus__pro_status">
                                        quantity
                                    </th>

                                    <th class="wsus__pro_tk" style="width:238px" >
                                        price
                                    </th>

                                    <th class="wsus__pro_icon">
                                        action
                                    </th>
                                </tr>
                                @foreach ($wishlistProducts as $item)

                                <tr class="d-flex">
                                    <td class="wsus__pro_img" style="width: 200px;">
                                        <img src="{{asset($item->product->thumbnail_image)}}" alt="product"
                                            class="img-fluid w-100">
                                        <a href="{{route('user.wishlist.destory', $item->id)}}"><i class="far fa-times"></i></a>
                                    </td>

                                    <td class="wsus__pro_name" style="width:500px">
                                        <p>{{$item->product->name}}</p>
                                    </td>

                                    <td class="wsus__pro_status">
                                        <p>{{$item->product->qty}}</p>
                                    </td>

                                    <td class="wsus__pro_tk" style="width:238px">
                                        <h6>
                                            ₱{{ number_format($item->product->price, 2, '.', ',') }}
                                        </h6>
                                    </td>

                                    <td class="">
                                        <a class="common_btn" href="{{route('product-detail', $item->product->slug)}}">View Product</a>
                                    </td>
                                </tr>

                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
