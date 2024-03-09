@extends('layouts.web-front')
@section('content')
    @if (WishlistSummaryCount())
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
                                        src="{{ productImage($wishlist->product->id) }}" width="50px" alt=""
                                        srcset=""></a>
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
                                <a class="btn hvr-hover" href="{{ route('product.data', $wishlist->product->url_key) }}">Add
                                    to Cart</a>
                            </td>
                            <td><a href="{{ route('wishlist.destory', $wishlist->product->id) }}" style="color: #fff"
                                    class="btn hvr-hover">Delete</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <tr style="color:red;">
            <h2 class="color"><span class="color"> Your Wishlist is empty......</span></h2>
        </tr>
    @endif
@endsection
