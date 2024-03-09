@extends('layouts.web-front')
@section('content')
@if (Session::has('success'))
<div class="alert alert-success alert-dismissible success-messeage" role="alert">
    <button type="button" class="close" data-dismiss="alert">
        <i class="fa fa-times"></i>
    </button>
    <strong>Success !</strong> {{ session('success') }}
</div>
@endif
<div class="order col-12">
    <div class="modal-dialog" style="max-width: 800px;text-align: center;">
        {{-- <img src="{{asset('images/logo.png')}}" > --}}
        <div class="modal-content" style="background-color: #fafafa;">
            <div class="modal-body ">
                <div class="px-4 py-5">

                    <div class="success">
                        <div style="border-radius:200px; height:200px; width:200px; background: #4f7e09; margin:0 auto;">
                            <i class="checkmark" style="font-size: 128px;color:#ffff">✓</i>
                        </div>
                        <h1 class="mt-5 theme-color mb-5" style="text-transform: capitalize;">your order successfully places</h1>
                        <h3 class="mt-5 theme-color mb-5 text-success" style="text-transform: capitalize;">Thanks for your Purchase</h3>
                    </div>
                    <span class="theme-color">Payment Summary</span>
                    <div class="mb-3">
                        <hr class="new1">
                    </div>
                    <div class="d-flex justify-content-between">
                        <span class="font-weight-bold">Order Date</span>
                        <span class="font-weight-bold">{{ successOrder()->created_at->format('d/m/Y')??0 }}</span>
                    </div>
                    <div class="d-flex justify-content-between">
                        <span class="font-weight-bold">Order Id#</span>
                        <span class="font-weight-bold"># {{ successOrder()->order_increment_id??0 }}</span>
                    </div>

                    <div class="d-flex justify-content-between">
                        <small>Payment Method</small>
                        <small>{{$order->payment_method??""}}</small>
                    </div>
                    <div class="d-flex justify-content-between mt-3">
                        <span class="font-weight-bold">Shipping Charge</span>
                        <span class="font-weight-bold theme-color">₹{{successOrder()->shipping_cost??0}}</span>
                    </div>
                    <div class="d-flex justify-content-between mt-3">
                        <span class="font-weight-bold">Coupon Discount</span>
                        <span class="font-weight-bold theme-color">₹{{successOrder()->coupon_discount??0}}</span>
                    </div>
                    <div class="d-flex justify-content-between mt-3">
                        <span class="font-weight-bold">Total</span>
                        <span class="font-weight-bold theme-color">₹{{number_format(successOrder()->total, 2)??0}}</span>
                    </div>
                    <div class="text-center mt-5">
                        <a href="{{route('home')}}" class="btn btn-success">Continue Shopping</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection