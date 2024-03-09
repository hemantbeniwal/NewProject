@extends('layouts.admin')
@section('content')
    <section class="content-header">
        <h1>Orders List</h1>
    </section>

    <section class="content">

        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header">
                        {{-- <h3 class="box-title">Orders List</h3> --}}
                        {{-- @if (session()->has('success'))
                            <div class="callout callout-success" style="float:left;width:100%;margin-top:5px;">
                                {{ session()->get('success') }}</div>
                        @endif
                        <!-- Add any action buttons or links here --> --}}
                    </div><!-- /.box-header -->
                    <div class="box-body">
                        <table id="myTable" class="table table-bordered display" style="overflow: auto;display:block;">
                            <thead>
                                <tr>
                                    <th style="width: 10px">#</th>
                                    <th>Order ID</th>
                                    <th>User ID</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Address</th>
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
                                    <th>Created At</th>
                                    <th>Updated At</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $i = 1;
                                @endphp
                                @forelse($orders as $order)
                                    <tr>
                                        <td>{{ $i++ }}</td>
                                        <td>{{ $order->order_increment_id }}</td>
                                        <td>{{ $order->user_id }}</td>
                                        <td>{{ $order->name }}</td>
                                        <td>{{ $order->email }}</td>
                                        <td>{{ $order->phone }}</td>
                                        <td>{{ $order->address }}</td>
                                        <td>{{ $order->city }}</td>
                                        <td>{{ $order->state }}</td>
                                        <td>{{ $order->country }}</td>
                                        <td>{{ $order->pincode }}</td>
                                        <td>{{ $order->subtotal }}</td>
                                        <td>{{ $order->coupon }}</td>
                                        <td>{{ $order->coupon_discount }}</td>
                                        <td>{{ $order->shipping_cost }}</td>
                                        <td>{{ $order->total }}</td>
                                        <td>{{ $order->payment_method }}</td>
                                        <td>{{ $order->shipping_method }}</td>
                                        <td>{{ $order->created_at }}</td>
                                        <td>{{ $order->updated_at }}</td>
                                        <!-- Add any action buttons or links here -->
                                        <td><a href="{{ route('order.show', $order->id) }}"
                                            class="btn btn-primary btn-success">Show</a></td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="21" align="center">No orders found.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div><!-- /.box-body -->
                </div><!-- /.box -->
            </div>
        </div>
        <script>
            $(document).ready(function() {
                $('#myTable').DataTable();
            });
        </script>
    </section>
@endsection