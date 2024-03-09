@extends('layouts.web-front')
@section('content')
    <div class="cart-box-main">
        <div class="container">
            @if (cartSummaryCount())
                <div class="row">
                    <div class="col-lg-12">
                        <div class="table-main table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Images</th>
                                        <th>Product Name</th>
                                        <th>Price</th>
                                        <th>Quantity</th>
                                        <th>Total</th>
                                        <th>Remove</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach ($quotes->quoteItems as $quote)
                                        @php
                                            $data = json_decode($quote->custom_option);
                                        @endphp
                                        <tr>
                                            <td class="thumbnail-img">
                                                <a href="#">
                                                    <img class="img-fluid" src="{{ productImage($quote->product_id) }}"
                                                        alt="" />
                                                </a>
                                            </td>

                                            <td class="name-pr">
                                                <h2>{{ $quote->name }}</h2>
                                                {{-- <h2>{{ ($quote->custom_option) }}</h2> --}}
                                                @if (!$data == null)
                                                    <p>Color: {{ $data->Colors ?? '' }} <br /> <span>Size:
                                                            {{ $data->Size ?? '' }}</span></p>
                                                @endif
                                            </td>
                                            <td class="price-pr">
                                                <p>₹{{ $quote->price }}</p>
                                            </td>
                                            <td class="quantity-box">
                                                <form action="{{ route('cart.update', $quote->id) }}" method="post">
                                                    @csrf
                                                    <input type="number" name="qty" style="width: 65%;" size="2"
                                                        value="{{ $quote->qty }}" min="0" step="1"
                                                        class="c-input-text qty text qty-box">

                                                    <button type="submit" class="btn btn-dark w-200 ">✓</button>


                                                </form>
                                            </td>
                                            <td>
                                                <p>₹{{ $quote->row_total }}</p>
                                            </td>
                                            <td class="remove-pr">
                                                <form action="{{ route('cart.delete', $quote->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <input type="hidden" value="{{ $quote->product_id }}" name="produt_id">
                                                    <button type="submit" class="btn btn-sm btn-danger"><i
                                                            class="fa fa-times"></i></button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="row my-5">
                    <div class="col-lg-6 col-sm-6">
                        @if (session()->has('error'))
                            <div style="color: red;" class="callout callout-danger" style="margin-top: 20px;">
                                {{ session()->get('error') }}
                            </div>
                        @elseif(session()->has('success'))
                            <div style="color: green;" class="callout callout-success" style="margin-top: 20px;">
                                {{ session()->get('success') }}
                            </div>
                        @endif
                        <form class="mb-30" action="{{ route('coupon.apply') }}" method="POST">
                            @csrf
                            <div class="coupon-box">
                                <div class="input-group input-group-sm">
                                    <input type="hidden" value="{{ $quotes->id }}" name="quotes_id">
                                    <input type="text" name="coupon" class="form-control border-0 p-4" value=""
                                        placeholder="Coupon Code">
                                    <div class="input-group-append">
                                        <button class="btn btn-theme" type="submit">Apply Coupon</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    {{-- <div class="col-lg-6 col-sm-6">
                    <div class="update-box">
                        <input value="Update Cart" type="submit">
                    </div>
                </div> --}}
                </div>

                <div class="row my-5">
                    <div class="col-lg-8 col-sm-12"></div>
                    <div class="col-lg-4 col-sm-12">
                        <div class="order-box">
                            <h3>Order summary</h3>
                            <div class="d-flex">
                                <h4>Sub Total</h4>
                                <div class="ml-auto font-weight-bold">₹ {{ $quotes->subtotal }}</div>
                            </div>
                            {{-- <div class="d-flex">
                                <h4>Coupon Discount</h4>
                                <div class="ml-auto font-weight-bold">₹ {{ $quotes->coupon_discount ?? 0 }}</div>
                            </div> --}}
                            <div class="d-flex">
                                <h4 style="margin-right: 15px;">Coupon Discount ({{ $quotes->coupon ?? '' }})</h4>
                                @if (isset($quotes->coupon_discount))
                                    <form action="{{ route('coupon.cancel', $quotes->id) }}" method="get">
                                        <button style="padding: 0px 30px;" quotes_id="{{ $quotes->id }}" type="submit"
                                            class="btn btn-danger cabcel-coupon">X</button>
                                    </form>
                                @endif
                                <div class="ml-auto font-weight-bold">- ₹ {{ $quotes->coupon_discount ?? 0 }} </div>
                            </div>
                            <div class="d-flex">
                                <h4>Shipping Cost</h4>
                                <div class="ml-auto font-weight-bold"> Free </div>
                            </div>
                            <hr>
                            <div class="d-flex gr-total">
                                <h5>Grand Total</h5>
                                <div class="ml-auto h5"> ₹ {{ $quotes->total }} </div>
                            </div>
                            <hr>
                        </div>
                    </div>
                    <div class="col-12 d-flex shopping-box"><a href="{{route('checkout')}}"
                            class="ml-auto btn hvr-hover">Checkout</a>
                    </div>

                </div>
            @else
                <tr style="color: red;">
                    <h2 class="color">Cart is Empty......</h2>
                </tr>
            @endif
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('.qty-box').on('change', function() {
                var test = $(this);
                // console.log(test);
                $(test).next('.update-qty').css('display', 'block');
            });
        });
    </script>
@endsection
