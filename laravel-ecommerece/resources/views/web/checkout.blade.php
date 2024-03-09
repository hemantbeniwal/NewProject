@extends('layouts.web-front')
@section('content')
    <div class="all-title-box">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h2>Checkout Detail</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item">Shop</li>
                        <li class="breadcrumb-item active">Checkout Detail</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    {{-- @if ($cartdata) --}}
        
    <div class="cart-box-main">
        <div class="container">
            <div class="row new-account-login">
                <div class="col-sm-6 col-lg-6 mb-3">
                    <div class="title-left">
                        <h3>Account Login</h3>
                    </div>

                    <h5><a data-toggle="collapse" href="#formLogin" role="button" aria-expanded="false">Click here to
                            Login</a></h5>
                    <form class="mt-3 collapse review-form-box" id="formLogin" action="{{route('customer.authenticate')}}" method="POST">
                       @csrf
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="InputEmail" class="mb-0">Email Address</label>
                                <input type="hidden" name="chekout" value="1">
                                <input type="email" class="form-control" id="InputEmail" placeholder="Enter Email" name="email">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="InputPassword" class="mb-0">Password</label>
                                <input type="password" class="form-control" id="InputPassword" placeholder="Password" name="password">
                            </div>
                        </div>
                        <button type="submit" class="btn hvr-hover">Login</button>
                    </form>
                </div>
                <div class="col-sm-6 col-lg-6 mb-3">
                    <div class="title-left">
                        <h3>Create New Account</h3>
                    </div>
                    <h5><a data-toggle="collapse" href="#formRegister" role="button" aria-expanded="false">Click here to
                            Register</a></h5>
                    <form class="mt-3 collapse review-form-box" id="formRegister">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="InputName" class="mb-0">First Name</label>
                                <input type="text" class="form-control" id="InputName" placeholder="First Name">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="InputLastname" class="mb-0">Last Name</label>
                                <input type="text" class="form-control" id="InputLastname" placeholder="Last Name">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="InputEmail1" class="mb-0">Email Address</label>
                                <input type="email" class="form-control" id="InputEmail1" placeholder="Enter Email">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="InputPassword1" class="mb-0">Password</label>
                                <input type="password" class="form-control" id="InputPassword1" placeholder="Password">
                            </div>
                        </div>
                        <button type="submit" class="btn hvr-hover">Register</button>
                    </form>
                </div>
            </div>
            <form class="needs-validation" id="checkout-address" action="{{ route('checkout.store') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-sm-6 col-lg-6 mb-3">
                        <div class="checkout-address">
                            <div class="title-left">
                                <h3>Billing address</h3>
                            </div>

                            <div class="checkout_select_address">
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <span style="color:red;">*</span>First name</label>
                                        <input type="text" class="form-control" name="billing_name"
                                            placeholder="FirstName" value="{{ old('billing_name') }}">
                                        @error('billing_name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                </div>
                                <div class="mb-3">
                                    <span style="color:red;">*</span>Email Address</label>
                                    <input type="email" class="form-control" name="billing_email" placeholder="Email"
                                        value="{{ old('billing_email') }}">
                                    @error('billing_email')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <span style="color:red;">*</span>Address </label>
                                    <input type="text" class="form-control" name="billing_address"
                                        placeholder="Address" value="{{ old('billing_address_1') }}">
                                    @error('billing_address_1')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <span style="color:red;">*</span>Address 2</label>
                                    <input type="text" class="form-control" name="billing_address_2"
                                        placeholder="Address" value="{{ old('billing_address_2') }}">
                                    @error('billing_address_2')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-3">
                                <span style="color:red;">*</span>Phone </label>
                                <input type="number" class="form-control" name="billing_phone" placeholder="Phone"
                                    value="{{ old('billing_phone') }}">
                                @error('billing_phone')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="row">
                                <div class="col-md-5 mb-6">
                                    <span style="color:red;">*</span>Country </label>
                                    <select class="wide w-100" name="billing_country">
                                        <option value="">Choose...</option>
                                        <option value="india" {{ old('billing_country') }}>India</option>
                                        <option value="japan" {{ old('billing_country') }}>Japan</option>
                                        <option value="nepal" {{ old('billing_country') }}>Nepal</option>
                                    </select>
                                    @error('billing_country')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-4 mb-6">
                                    <span style="color:red;">*</span>State </label>
                                    <select class="wide w-100" name="billing_state">
                                        <option value="">Choose...</option>
                                        <option value="haryana" {{ old('billing_state') }}>Haryana</option>
                                        <option value="punjab" {{ old('billing_state') }}>Punjab</option>
                                        <option value="rajasthan" {{ old('billing_state') }}>Rajasthan</option>
                                        <option value="assam" {{ old('billing_state') }}>Assam</option>
                                    </select>
                                    @error('billing_state')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-4 mb-8">
                                    <span style="color:red;">*</span>City </label>
                                    <input type="text" class="form-control" name="billing_city" placeholder="City"
                                        value="{{ old('billing_city') }}">
                                    @error('billing_city')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-3 mb-4">
                                    <span style="color:red;">*</span>PIN </label>
                                    <input type="number" class="form-control" name="billing_pincode"
                                        placeholder="Pincode" value="{{ old('billing_pincode') }}">
                                    @error('billing_pincode')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <hr class="mb-4">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" name="ship_to_different_address" class="custom-control-input"
                                id="same-address">
                            <label class="custom-control-label" for="same-address">Shipping address is the same as my
                                billing address</label>
                        </div>
                        <div class="second-billing-address" id="shipping-address" style="display: none">
                            <div class="title-left">
                                <h3>Shipping address</h3>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label>Name</label>
                                    <input type="text" class="form-control" name="shipping_name" placeholder="Name"
                                        value="{{ old('shipping_name') }}">

                                </div>
                            </div>
                            <div class="mb-3">
                                <label>Email</label>
                                <input type="email" class="form-control" name="shipping_email" placeholder="Emial"
                                    value="{{ old('shipping_email') }}">

                            </div>

                            <div class="mb-3">
                                <label>Phone</label>
                                <input type="number" class="form-control" name="shipping_phone" placeholder="Phone"
                                    value="{{ old('shipping_phone') }}">

                            </div>
                            <div class="mb-3">
                                <label>Address</label>
                                <input type="text" class="form-control" name="shipping_address" placeholder="Address"
                                    value="{{ old('shipping_address_1') }}">

                            </div>
                            <div class="mb-3">
                                <label for="address2">Address 2 *</label>
                                <input type="text" class="form-control" name="shipping_address_2"
                                    placeholder="Address" value="{{ old('shipping_address_2') }}">
                            </div>
                            <div class="row">
                                <div class="col-md-5 mb-3">
                                    <label>Country*</label>
                                    <select class="wide w-100" name="shipping_country">
                                        <option value="">Choose...</option>
                                        <option value="india" {{ old('shipping_country') }}>India</option>
                                        <option value="japan" {{ old('shipping_country') }}>Japan</option>
                                        <option value="nepal" {{ old('shipping_country') }}>Nepal</option>
                                    </select>

                                </div>
                                <div class="col-md-4 mb-3">
                                    <label>State </label>
                                    <select class="wide w-100" name="shipping_state">
                                        <option value="">Choose...</option>
                                        <option value="haryana" {{ old('shipping_state') }}>Haryana</option>
                                        <option value="punjab" {{ old('shipping_state') }}>Punjab</option>
                                        <option value="rajasthan" {{ old('shipping_state') }}>Rajasthan</option>
                                        <option value="assam" {{ old('shipping_state') }}>Assam</option>
                                    </select>

                                </div>
                                <div class="col-md-4 mb-8">
                                    <label>City </label>
                                    <input type="text" class="form-control" name="shipping_city" placeholder="City"
                                        value="{{ old('shipping_city') }}">

                                </div>
                                <div class="col-md-3 mb-3">
                                    <label>PIN</label>
                                    <input type="number" class="form-control" name="shipping_pincode" placeholder="PIN"
                                        value="{{ old('shipping_pincode') }}">

                                </div>
                            </div>
                        </div>
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="save-info">
                            <label class="custom-control-label" for="save-info">Save this information for next
                                time</label>
                        </div>
                        <hr class="mb-4">
                        <div class="title"> <span>Payment</span> </div>
                        <div class="d-block my-3">
                            <div class="custom-control custom-radio">
                                <input name="payment" value="banktransfer" id="banktransfer" type="radio"
                                    class="custom-control-input" checked required>
                                <label class="custom-control-label" for="credit">Credit card</label>
                            </div>
                            <div class="custom-control custom-radio">
                                <inputname="payment" value="directcheck" id="directcheck" type="radio"
                                class="custom-control-input"
                                required>
                                <label class="custom-control-label" for="debit">Debit card</label>
                            </div>
                            <div class="custom-control custom-radio">
                                <input name="payment" value="paypal" id="paypal" type="radio"
                                    class="custom-control-input" required>
                                <label class="custom-control-label" for="paypal">Paypal</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="cc-name">Name on card</label>
                                <input type="text" name="" class="form-control" id="cc-name" placeholder=""
                                    required> <small class="text-muted">Full name as displayed on
                                    card</small>
                                <div class="invalid-feedback"> Name on card is required </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="cc-number">Credit card number</label>
                                <input type="text" name="" class="form-control" id="cc-number" placeholder=""
                                    required>
                                <div class="invalid-feedback"> Credit card number is required </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3 mb-3">
                                <label for="cc-expiration">Expiration</label>
                                <input type="text" name="" class="form-control" id="cc-expiration"
                                    placeholder="" required>
                                <div class="invalid-feedback"> Expiration date required </div>
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="cc-expiration">CVV</label>
                                <input type="text" name="" class="form-control" id="cc-cvv" placeholder=""
                                    required>
                                <div class="invalid-feedback"> Security code required </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="payment-icon">
                                    <ul>
                                        <li><img class="img-fluid" src="{{ asset('images/payment-icon/1.png') }}"
                                                alt=""></li>
                                        <li><img class="img-fluid" src="{{ asset('images/payment-icon/2.png') }}"
                                                alt=""></li>
                                        <li><img class="img-fluid" src="{{ asset('images/payment-icon/3.png') }}"
                                                alt=""></li>
                                        <li><img class="img-fluid" src="{{ asset('images/payment-icon/5.png') }}"
                                                alt=""></li>
                                        <li><img class="img-fluid" src="{{ asset('images/payment-icon/7.png') }}"
                                                alt=""></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <hr class="mb-1">
                    </div>

                    <div class="col-sm-6 col-lg-6 mb-3">
                        <div class="row">
                            <div class="col-md-12 col-lg-12">
                                <div class="shipping-method-box">
                                    <div class="title-left">
                                        <h3>Shipping Method</h3>
                                    </div>
                                    <div class="mb-4">
                                        <div class="custom-control custom-radio">
                                            <input id="standard_delivery" name="shipping_method"
                                                value="standard_delivery" class="custom-control-input shipping-charge"
                                                checked="checked" data-cost="0" type="radio">
                                            <label class="custom-control-label" for="standard_delivery">Standard
                                                Delivery</label> <span class="float-right font-weight-bold">FREE</span>
                                        </div>
                                        <div class="ml-4 mb-2 small">(3-7 business days)</div>
                                        <div class="custom-control custom-radio">
                                            <input id="express_delivery" name="shipping_method" value="express_delivery"
                                                class="custom-control-input shipping-charge" data-cost="50"
                                                type="radio">
                                            <label class="custom-control-label" for="express_delivery">Express
                                                Delivery</label>
                                            <span class="float-right font-weight-bold">₹50.00</span>
                                        </div>
                                        <div class="ml-4 mb-2 small">(2-4 business days)</div>
                                        <div class="custom-control custom-radio">
                                            <input id="next_business_day" name="shipping_method"
                                                value="next_business_day" class="custom-control-input shipping-charge"
                                                data-cost="100" type="radio">
                                            <label class="custom-control-label" for="next_business_day">Next Business
                                                day</label> <span class="float-right font-weight-bold">₹100.00</span>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="col-md-12 col-lg-12">
                                <div class="odr-box">
                                    <div class="title-left">
                                        <h3>Shopping cart</h3>
                                    </div>
                                    <div class="rounded p-2 bg-light">
                                        <div class="media mb-2 border-bottom">
                                                @foreach ($cartdata->quoteItems as $quote)
                                                    <div class="media-body"> <a href=""> Lorem ipsum dolor sit
                                                            amet</a>
                                                        <div class="small text-muted">
                                                            Price:₹{{ getProductPrice($quote->product_id) }} <span
                                                                class="mx-2">|</span> Qty:{{ $quote->qty }}
                                                            <span class="mx-2">|</span>
                                                            Subtotal:₹{{ $cartdata->subtotal }}
                                                        </div>
                                                    </div>
                                                @endforeach
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 col-lg-12">
                                <div class="order-box">
                                    <div class="title-left">
                                        <h3>Your order</h3>
                                    </div>
                                    <div class="d-flex">
                                        <div class="font-weight-bold">Product</div>
                                        <div class="ml-auto font-weight-bold">Total</div>
                                    </div>
                                    <hr class="my-1">
                                    <div class="d-flex">
                                        <h4>Sub Total</h4>
                                        <div class="ml-auto font-weight-bold">₹({{ $cartdata->subtotal ?? 00 }}) </div>
                                    </div>
                                    <hr class="my-1">
                                    <div class="d-flex">
                                        <h4 style="margin-right: 15px;">Coupon Discount ({{ $cartdata->coupon ?? '' }})
                                        </h4>
                                        <div class="ml-auto font-weight-bold">- ₹ {{ $cartdata->coupon_discount ?? 0 }}
                                        </div>
                                    </div>
                                    <div class="d-flex">
                                        <h4>Shipping Cost</h4>
                                        <h3 class="ml-auto font-weight-bold cost-shipping"> ₹ 0 </h3>
                                    </div>
                                    <hr>
                                    <div class="gr-total">
                                        <h3 style="float: left;">Grand Total</h3>
                                        <h3 class="cart-total" style="float: right;">₹{{ $cartdata->total ?? 00 }}</h3>
                                    </div>
                                    <hr>
                                </div>
                            </div>
                            <div class="col-12 d-flex shopping-box"> <button type="submit"
                                    class="ml-auto btn hvr-hover place-order">Place
                                    Order</button> </div>
                            {{-- <button type="submit" class="ml-auto btn hvr-hover">Place
                                Order </button> --}}
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    {{-- @else
      <h1>Your order</h1>  
    @endif --}}

    <!-- End Cart -->

    <!-- Start Instagram Feed  -->
    <div class="instagram-box">
        <div class="main-instagram owl-carousel owl-theme">
            <div class="item">
                <div class="ins-inner-box">
                    <img src="{{ asset('images/instagram-img-01.jpg') }}" alt="" />
                    <div class="hov-in">
                        <a href="#"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
            </div>
            <div class="item">
                <div class="ins-inner-box">
                    <img src="{{ asset('images/instagram-img-02.jpg') }}" alt="" />
                    <div class="hov-in">
                        <a href="#"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
            </div>
            <div class="item">
                <div class="ins-inner-box">
                    <img src="{{ asset('images/instagram-img-03.jpg') }}" alt="" />
                    <div class="hov-in">
                        <a href="#"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
            </div>
            <div class="item">
                <div class="ins-inner-box">
                    <img src="{{ asset('images/instagram-img-04.jpg') }}" alt="" />
                    <div class="hov-in">
                        <a href="#"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
            </div>
            <div class="item">
                <div class="ins-inner-box">
                    <img src="{{ asset('images/instagram-img-05.jpg') }}" alt="" />
                    <div class="hov-in">
                        <a href="#"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
            </div>
            <div class="item">
                <div class="ins-inner-box">
                    <img src="{{ asset('images/instagram-img-06.jpg') }}" alt="" />
                    <div class="hov-in">
                        <a href="#"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
            </div>
            <div class="item">
                <div class="ins-inner-box">
                    <img src="{{ asset('images/instagram-img-07.jpg') }}" alt="" />
                    <div class="hov-in">
                        <a href="#"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
            </div>
            <div class="item">
                <div class="ins-inner-box">
                    <img src="{{ asset('images/instagram-img-08.jpg') }}" alt="" />
                    <div class="hov-in">
                        <a href="#"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
            </div>
            <div class="item">
                <div class="ins-inner-box">
                    <img src="{{ asset('images/instagram-img-09.jpg') }}" alt="" />
                    <div class="hov-in">
                        <a href="#"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
            </div>
            <div class="item">
                <div class="ins-inner-box">
                    <img src="{{ asset('images/instagram-img-05.jpg') }}" alt="" />
                    <div class="hov-in">
                        <a href="#"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Instagram Feed  -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <script>
        $('.shipping-charge').change(function() {
            const cost = parseInt($(this).data('cost'));


            $('.cost-shipping').text('₹ ' + cost);

            var amount = parseFloat($('.cart-total').text().replace('₹', ''));
            // alert(amount);
            var total = amount + cost;
            // alert(total);
            // console.log(amount);
            $('.cart-total').text('₹ ' + total);

        });


        $(document).ready(function() {
            $("input:checkbox#same-address").on('change', function() {
                if (!$(this).is(':checked')) $('.second-billing-address').css('display', 'block');
                if ($(this).is(':checked')) $('.second-billing-address').css('display', 'none');
            });
            $('.place-order').click(function(e) {
                e.preventDefault();
                $('#checkout-address').submit();
            });


        });
    </script>
@endsection
