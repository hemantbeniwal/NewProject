@extends('layouts.admin')
@section('content')
    <section class="content-header">
        <h1>
            Product List
            <small></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
            @can('product_create')
                <li><a href="{{ route('product.create') }}">Product Add</a></li>
            @endcan
        </ol>
    </section>
    <div class="box">
        @if (session()->has('success'))
            <div class="alert alert-success" id="msg">
                {{ session()->get('success') }}
            </div>
        @endif
        <div class="box-body">
            <table id="myTable" class="table table-bordered display">
                <thead>
                    <tr>
                        <th>Sr.No</th>
                        <th>Product Name</th>
                        <th>Status</th>
                        <th>Is Featured</th>
                        <th>Stock Keeping Unit(sku)</th>
                        <th>Quantity (qty)</th>
                        <th>Stock status</th>
                        <th>Price</th>
                        <th>Special Price</th>
                        <th>Action</th>

                </thead>
                @php
                    $i = 1;
                @endphp
                <tbody>
                    @forelse ($product as $products)
                        <tr>
                            <td>{{ $i++ }}</td>
                            <td>{{ $products->name }}</td>
                            <td>{!! $products->status == 1
                                ? '<span class = "btn btn-block btn-success btn-xs">Enable</span>'
                                : '<span class="btn btn-block btn-danger btn-xs">Disable</span>' !!}</td>
                            <td>{!! $products->is_featured == 1
                                ? '<span class="btn btn-block btn-success btn-xs">Yes</span>'
                                : '<span class="btn btn-block btn-danger btn-xs">No</span>' !!}</td>
                            <td>{{ $products->sku }}</td>
                            <td>{{ $products->qty }}</td>
                            <td>{!! $products->stock_status == 1
                                ? '<span class="btn btn-block btn-success btn-xs">Instock</span>'
                                : '<span class="btn btn-block btn-danger btn-xs">Outstock</span>' !!}</td>
                            <td>{{ $products->price }}</td>
                            <td>{{ $products->special_price }}</td>
                            <td>
                                @can('product_edit')
                                    <a href="{{ route('product.edit', $products->id) }}" class="btn btn-primary"
                                        style="float: left;margin-right:4px;"><i class="fa fa-edit"></i>Edit</a>
                                @endcan
                                @can('product_delete')
                                    <form action="{{ route('product.destroy', $products->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger"><i class="fa fa-trash" aria-hidden="true"
                                                onclick="return confirm('Are you sure you want to delete this Data')"></i>
                                            Delete</button>

                                    </form>
                                @endcan
                            </td>
                        </tr>

                    @empty
                        <tr>
                            <td colspan="9" align="center">No data found.</td>
                        </tr>
                    @endforelse
            </table>
        </div><!-- /.box-body -->
    </div>

    <script>
        $(document).ready(function() {
            $('#myTable').DataTable();
        });
    </script>
@endsection
