@extends('layouts.web-front')

@section('content')
    <div class="container-fluid pb-5">
        <div class="row px-xl-5">
            <div class="col">
                <div class="bg-light p-30" style="float: left;width:100%;">
                    <div class="nav nav-tabs mb-4" style="float: left;width:30%;">
                        <style>
                            .nav.nav-tabs.mb-4 a {
                                float: left;
                                width: 100%;
                            }

                            .nav-tabs .nav-link.active {
                                background-color: #d33b33;
                            }
                        </style>
                        <a class="nav-item nav-link text-dark active" data-toggle="tab" href="#tab-pane-1">PROFILE DETAILS</a>
                        <a class="nav-item nav-link text-dark" data-toggle="tab" href="#tab-pane-2">WISHLIST</a>
                        <a class="nav-item nav-link text-dark" data-toggle="tab" href="#tab-pane-3">ORDERS</a>
                        <a class="nav-item nav-link text-dark" data-toggle="tab" href="#tab-pane-4">ADDRESS</a>
                    </div>
                    <div class="tab-content" style="float: left;width:70%;padding-right:15px;padding-left:15px;">
                        <div class="tab-pane fade show active" id="tab-pane-1">
                            @if (session()->has('error'))
                                <p style="background: #FFD333; padding: 15px; color: #000; font-weight: 500;">
                                    {{ session()->get('error') }}</p>
                            @endif
                            @if (session()->has('success'))
                                <p style="background: #FFD333; padding: 15px; color: #000; font-weight: 500;">
                                    {{ session()->get('success') }}</p>
                            @endif
                            @php
                                $userId = Auth::user()->id ?? null;

                            @endphp

                            <form action="{{ route('customer.update') }}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6 form-group">
                                        <label>Name</label>
                                        <input class="form-control" name="name" value="{{ Auth::user()->name }}"
                                            type="text" placeholder="Enter name">
                                        @error('name')
                                            <p style="color: red;">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="col-md-6 form-group">
                                        <label>E-mail</label>
                                        <input class="form-control" name="email" value="{{ Auth::user()->email }}"
                                            type="text" placeholder="Enter email">
                                        @error('email')
                                            <p style="color: red;">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="col-md-6 form-group">
                                        <label>Current Password</label>
                                        <input class="form-control" name="current_password" value="" type="text"
                                            placeholder="Enter current password">
                                        @error('current_password')
                                            <p style="color: red;">{{ $message }}</p>
                                        @enderror

                                    </div>

                                    <div class="col-md-6 form-group">
                                        <label>New Password</label>
                                        <input class="form-control" name="new_password" value="" type="text"
                                            placeholder="Enter password">
                                        @error('password')
                                            <p style="color: red;">{{ $message }}</p>
                                        @enderror

                                    </div>
                                    <div class="col-md-6 form-group">
                                        <button type="submit" class="form-control btn btn-primary" style="width: 50%;">Save
                                            Change</button>
                                    </div>

                                </div>
                            </form>
                        </div>
                        <div class="tab-pane fade show" id="tab-pane-2" style="overflow: auto;">
                            <table id="myTable" class="table table-bordered display">
                                <thead class="thead-light">
                                    <tr>
                                        <th>Image</th>
                                        <th>Product Name</th>
                                        <th>Price</th>
                                        <th>Date</th>
                                        <th>Add Item</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($wishlists as $wishlist)
                                        <tr>
                                            <td><a href="{{ route('product.data', $wishlist->product->url_key) }}"><img
                                                        src="{{ productImage($wishlist->product->id) }}" width="50px"
                                                        alt="" srcset=""></a>
                                            </td>
                                            <td>{{ $wishlist->product->name }}</td>
                                            @if (isset($wishlist->product->special_price) &&
                                                    date('Y-m-d') >= $wishlist->product->special_price_from &&
                                                    date('Y-m-d') <= $wishlist->product->special_price_to)
                                                <td>₹{{ number_format($wishlist->product->special_price, 2) }}
                                                </td>
                                            @else
                                                <td>₹{{ number_format($wishlist->product->price, 2) }}</td>
                                            @endif
                                            <td>{{ $wishlist->created_at->format('d/m/Y') }}</td>
                                            <td class="add-pr">
                                                <a class="btn hvr-hover"
                                                    href="{{ route('product.data', $wishlist->product->url_key) }}">Add
                                                    to Cart</a>
                                            </td>
                                            <td><a href="{{ route('wishlist.destory', $wishlist->product->id) }}"
                                                    style="color: #fff" class="btn hvr-hover">Delete</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="tab-pane fade show" id="tab-pane-3" style="overflow: auto;">
                            <table id="myTable" class="table table-bordered display">
                                <thead>
                                    <tr>
                                        <th style="width: 10px">#</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Order Id</th>
                                        <th>User Id</th>
                                        <th>Address</th>
                                        <th>Address_2</th>
                                        <th>City</th>
                                        <th>State</th>
                                        <th>Country</th>
                                        <th>Pincode</th>
                                        <th>Subtotal</th>
                                        <th>Coupon</th>
                                        <th>Coupon Discount</th>
                                        <th>Shipping Cost</th>
                                        <th>Total</th>
                                        <th>Payment Method</th>
                                        <th>Shipping Method</th>
                                        <th>Show</th>
                                    </tr>
                                </thead>
                                @php
                                    $i = 1;
                                @endphp
                                <tbody>
                                    @forelse($order as $_order)
                                        <tr>
                                            <td>{{ $i++ . '.' }}</td>
                                            <td>{{ $_order->name }}</td>
                                            <td>{{ $_order->email }}</td>
                                            <td>{{ $_order->phone }}</td>
                                            <td>{{ $_order->order_id }}</td>
                                            <td>{{ $_order->user_id }}</td>
                                            <td>{{ $_order->address }}</td>
                                            <td>{{ $_order->address_2 }}</td>
                                            <td>{{ $_order->city }}</td>
                                            <td>{{ $_order->state }}</td>
                                            <td>{{ $_order->country }}</td>
                                            <td>{{ $_order->pincode }}</td>
                                            <td>{{ $_order->subtotal }}</td>
                                            <td>{{ $_order->coupon }}</td>
                                            <td>{{ $_order->coupon_discount }}</td>
                                            <td>{{ $_order->shipping_cost }}</td>
                                            <td>{{ $_order->total }}</td>
                                            <td>{{ $_order->payment_method }}</td>
                                            <td>{{ $_order->shipping_method }}</td>
                                            <td>
                                                <button type="button" data-order-id="{{ $_order->id }}"
                                                    class="btn btn-primary detail_show">Show</button>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="20" align="center">No order.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        <div class="tab-pane fade show" id="tab-pane-4" style="overflow: auto;">
                            <table id="myTable" class="table table-bordered display">
                                <thead>
                                    <tr>
                                        <th style="width: 10px">#</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Address</th>
                                        <th>Address_2</th>
                                        <th>City</th>
                                        <th>State</th>
                                        <th>Country</th>
                                        <th>Pincode</th>
                                        <th>Address Type</th>
                                        <th>Show</th>
                                    </tr>
                                </thead>
                                @php
                                    $i = 1;
                                @endphp
                                <tbody>
                                    @forelse($orderAddress as $_orderAddress)
                                        <tr>
                                            <td>{{ $i++ . '.' }}</td>
                                            <td>{{ $_orderAddress->name }}</td>
                                            <td>{{ $_orderAddress->email }}</td>
                                            <td>{{ $_orderAddress->phone }}</td>
                                            <td>{{ $_orderAddress->address }}</td>
                                            <td>{{ $_orderAddress->address_2 }}</td>
                                            <td>{{ $_orderAddress->city }}</td>
                                            <td>{{ $_orderAddress->state }}</td>
                                            <td>{{ $_orderAddress->country }}</td>
                                            <td>{{ $_orderAddress->pincode }}</td>
                                            <td>{{ $_orderAddress->address_type }}</td>
                                            <td>
                                                <button type="button" data-order-id="{{ $_orderAddress->id }}"
                                                    class="btn btn-primary detail_show">Show</button>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="20" align="center">No order.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
